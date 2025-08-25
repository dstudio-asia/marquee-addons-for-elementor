(function ($, _) {
  "use strict";

  $(window).on("elementor/frontend/init", () => {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-testimonial.default",
      function ($scope) {
        handleAnimationDuration($scope);
        initTextLengthToggle($scope);
      }
    );
  });
})(jQuery, window._);
