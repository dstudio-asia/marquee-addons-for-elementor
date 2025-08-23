(function ($, _) {
  "use strict";
  function handleAnimationDuration($scope) {
    const container = $scope.find(".deensimc-marquee-main-container");
    const tracks = $scope.find(".deensimc-marquee-track");
    const isMarqueeOn = container.data("is-marquee-on");
    const animationSpeed = container.data("marquee-speed");

    if (isMarqueeOn && tracks.length) {
      let totalLength = 0;
      tracks.each((i, el) => {
        totalLength += el.scrollWidth;
      });
      const pixelFactor = 10;
      const pps = animationSpeed * pixelFactor;
      const duration = (totalLength * 2) / pps;
      tracks.each((i, el) => {
        $(el).css("animation-duration", `${duration}s`);
      });
    }
  }

  window.handleAnimationDuration = handleAnimationDuration;
})(jQuery, window._);
