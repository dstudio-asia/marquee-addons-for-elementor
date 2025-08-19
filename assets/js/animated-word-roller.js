(function ($, _) {
  "use strict";

  function initInfiniteRotation($scope) {
    const $mainWrapper = $scope.find(".infinite-rotation-main-wrapper");
    if (!$mainWrapper.length) return;

    // --- Cleanup previous instance if it exists (for Editor updates) ---
    const existingInterval = $mainWrapper.data("rotationInterval");
    if (existingInterval) {
      clearInterval(existingInterval);
    }
    // Unbind previous namespaced resize handler
    $(window).off(`resize.infiniteRotation.${$scope.data("id")}`);

    const $track = $mainWrapper.find(".deensimc-vertical-scroll-track");
    const $container = $mainWrapper.find(".deensimc-text-rotator-container");
    const $wrapper = $mainWrapper.find(".deensimc-infinite-rotation-container");

    const settings = {
      delay: $track.data("rotation-delay") || 1,
      visibleWord: Number($track.data("visible-word")) || 5,
      totalCount: Number($track.data("total-text")) || 0,
      transitionSpeed: 600,
    };

    if (
      settings.visibleWord > settings.totalCount ||
      settings.visibleWord === settings.totalCount
    ) {
      settings.visibleWord = settings.totalCount;
    }

    let height = 0;
    let isInitialRun = true;

    const isWrapped = () => {
      // On the initial run, before the layout is fully stable, this check can return a false positive.
      // We hardcode it to false for the first pass and only perform the check on subsequent updates.
      if (isInitialRun) {
        return false;
      }
      return (
        $container[0].getBoundingClientRect().top >
        $wrapper[0].getBoundingClientRect().top + 2
      );
    };

    const getActiveIDX = () => {
      if (isWrapped()) return 1;
      const visible =
        settings.visibleWord % 2 === 0
          ? settings.visibleWord - 1
          : settings.visibleWord;
      return isInitialRun ? 2 : Math.ceil(visible / 2);
    };

    function updateOpacity() {
      const activeIDX = getActiveIDX();
      $track.children().each(function (idx) {
        const $el = $(this);
        if (idx === activeIDX) {
          // This is the active (center) item.
          // The timeout is likely for visual synchronization with the animation.
          setTimeout(() => {
            $el
              .removeClass(
                "deensimc-rotation-active-next deensimc-rotation-active-farnext"
              )
              .addClass("deensimc-rotation-active");
          }, 300);
        } else if (idx === activeIDX - 1 || idx === activeIDX + 1) {
          // These are the items immediately next to the active one.
          $el
            .removeClass(
              "deensimc-rotation-active deensimc-rotation-active-farnext"
            )
            .addClass("deensimc-rotation-active-next");
        } else {
          // These are the items far from the active one.
          $el
            .removeClass(
              "deensimc-rotation-active deensimc-rotation-active-next"
            )
            .addClass("deensimc-rotation-active-farnext");
        }
      });
    }

    function updateContainerSize() {
      if (!$track.children().length) return;
      height = $track.children().first().outerHeight();

      let maxWidth = 0;
      $track.children().each(function () {
        const childWidth = $(this).outerWidth();
        if (childWidth > maxWidth) maxWidth = childWidth;
      });

      $container.css("max-width", `${maxWidth}px`);
      const visible =
        settings.visibleWord % 2 === 0
          ? settings.visibleWord - 1
          : settings.visibleWord;
      const adjustedHeight = isWrapped() ? height : height * visible;

      $container.css("height", `${adjustedHeight}px`);
    }

    const rotationInterval = setInterval(() => {
      if (!$track.children().length) return;
      $track.css({
        transition: `transform ${settings.transitionSpeed}ms ease-in-out`,
        transform: `translateY(-${height}px)`,
      });

      updateOpacity();

      setTimeout(() => {
        const $first = $track.children().first();
        $track.append($first);
        $track.css({
          transition: "none",
          transform: "translateY(0)",
        });
        updateContainerSize();
      }, settings.transitionSpeed);
    }, Number(settings.delay) * 1000);

    $mainWrapper.data("rotationInterval", rotationInterval);

    requestAnimationFrame(() => {
      updateContainerSize();
      updateOpacity();
      isInitialRun = false;
    });

    // Debounced and namespaced resize handler
    let resizeTimer;
    const resizeHandler = () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(updateContainerSize, 250);
    };
    $(window).on(`resize.infiniteRotation.${$scope.data("id")}`, resizeHandler);
  }

  $(window).on("elementor/frontend/init", () => {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-animated-word-roller.default",
      initInfiniteRotation
    );
  });
})(jQuery, window._);
