(function ($, _) {
  "use strict";

  // 🔹 Define reusable function
  function deensimcSearchHandler($scope) {
    const $triggerer = $scope.find(".deensimc-search-input-triggerer");
    const $inputWrapper = $scope.find(".deensimc-input-field-wrapper");
    const $inputContainer = $scope.find(".deensimc-input-container");
    const $inputField = $scope.find(".deensimc-input-field");
    const $clearButton = $scope.find(".deensimc-input-field-clear-button");

    if (!$triggerer.length || !$inputWrapper.length || !$inputContainer.length)
      return;

    // 🔹 Clear input on clear button click
    $clearButton.on("click", function (e) {
      e.stopPropagation();
      $inputField.val("").focus();
    });

    // 🔹 Toggle search visibility
    $triggerer.on("click", function (e) {
      e.stopPropagation();
      $inputWrapper.toggleClass("deensimc-search-open");

      if ($inputWrapper.hasClass("deensimc-search-open")) {
        $inputField.focus();
      }
    });

    // 🔹 Close search when clicking outside
    $(document).on("click.deensimcSearch", function (e) {
      if (
        !$inputContainer.is(e.target) &&
        $inputContainer.has(e.target).length === 0
      ) {
        $inputWrapper.removeClass("deensimc-search-open");
      }
    });
  }

  // 🔹 Elementor Hook
  $(window).on("elementor/frontend/init", () => {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc_search.default",
      function ($scope) {
        deensimcSearchHandler($scope);
      }
    );
  });
})(jQuery, window._);
