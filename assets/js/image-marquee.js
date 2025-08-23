(function ($, _) {
  "use strict";

  $(window).on("elementor/frontend/init", () => {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-image-marquee.default",
      handleAnimationDuration
    );
  });
})(jQuery, window._);
