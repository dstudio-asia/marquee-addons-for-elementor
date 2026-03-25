(function ($, _) {
  "use strict";

  function handleAnimationDuration($scope) {
    if (typeof window.autoRegisterTrackFillFromScope === "function") {
      window.autoRegisterTrackFillFromScope($scope);
    }

    const container = $scope
      .filter(".deensimc-marquee-main-container")
      .add($scope.find(".deensimc-marquee-main-container"));
    const tracks = $scope
      .filter(".deensimc-marquee-track")
      .add($scope.find(".deensimc-marquee-track"));
    const isMarqueeOn = container.data("is-marquee-on") ?? true;
    const animationSpeed = container.data("marquee-speed");
    const isVertical = tracks.closest(".deensimc-marquee-vertical").length > 0;

    if (isMarqueeOn && tracks.length) {
      let totalLength = 0;
      tracks.each((i, el) => {
        totalLength += isVertical ? el.scrollHeight : el.scrollWidth;
      });
      const pixelFactor = 10;
      const pps = animationSpeed * pixelFactor;
      const duration = totalLength / pps;
      tracks.each((i, el) => {
        $(el).css("animation-duration", `${duration}s`);
      });
    }
  }

  window.handleAnimationDuration = handleAnimationDuration;
})(jQuery, window._);
