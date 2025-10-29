(function ($) {
  "use strict";

  function initNumberTicker($scope) {
    const $elm = $scope.find(".deensimc-number-wrapper .deensimc-number");
    if (!$elm.length) return;

    const showSeparator = true;
    const separatorKey = $elm.data("separator") || "default";
    const separatorMap = {
      default: ",",
      dot: ".",
      space: " ",
      underline: "_",
      apostrophe: "'",
    };
    const separator = separatorMap[separatorKey] || ",";

    function formatNumber(number, sep) {
      return Math.round(number)
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, sep);
    }

    function updateText(number) {
      const value = showSeparator
        ? formatNumber(number, separator)
        : Math.round(number);
      $elm.text(value);
    }

    let start = 0;
    let target = parseInt($elm.data("number") || 50);
    let duration = parseInt($elm.data("duration") || 2) * 1000;
    let direction = $elm.data("direction") || "up";

    let from = start;
    let to = target;

    // Normalize direction logic
    if (direction === "up") {
      if (start > target) {
        from = target;
        to = start;
      }
    } else if (direction === "down") {
      if (start < target) {
        from = target;
        to = start;
      }
    }

    // If duration is 0 or same value, set immediately
    if (duration <= 0 || from === to) {
      updateText(to);
      return;
    }

    const startTime = performance.now();

    function tick(now) {
      const elapsed = now - startTime;
      const progress = Math.min(1, elapsed / duration);
      const current = from + (to - from) * progress;

      updateText(current);

      if (progress < 1) {
        requestAnimationFrame(tick);
      } else {
        updateText(to);
      }
    }
    $elm.parent().css("visibility", "visible");
    requestAnimationFrame(tick);
  }

  $(window).on("elementor/frontend/init", () => {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-number-ticker.default",
      function ($scope) {
        initNumberTicker($scope);
      }
    );
  });
})(jQuery);
