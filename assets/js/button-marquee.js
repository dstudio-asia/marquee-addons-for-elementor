(function ($, _) {
  "use strict";

  $(window).on("elementor/frontend/init", () => {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc_button_marquee.default",
      function ($scope) {
        const container = $scope.find(".deensimc-button-marquee-container");
        const tracks = $scope.find(".deensimc-button-marquee-track");
        const isAnimationOn = container.data("is-marquee-on");
        const animationSpeed = container.data("marquee-speed");

        if (isAnimationOn && tracks.length) {
          let totalLength = 0;

          tracks.each((i, el) => {
            totalLength += el.scrollWidth;
          });
          const pixelFactor = 10;
          const pps = animationSpeed * pixelFactor;
          const duration = (totalLength * 2) / pps;
          console.log({ duration });
          tracks.each((i, el) => {
            $(el).css("animation-duration", `${duration}s`);
          });
        }
      }
    );
  });
})(jQuery, window._);
