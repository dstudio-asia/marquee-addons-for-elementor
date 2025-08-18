(function ($) {
  "use strict";

  $(window).on("elementor/frontend/init", function () {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc_animated_heading.default",
      function ($scope) {
        const $element = $scope.find(".deensimc-texts-wrapper");
        if (!$element.length) return;

        const animationType = $element.data("animation");
        const isAnimationOn = $element.data("is-animation-on");
        if (isAnimationOn !== "yes") return;

        // Common animation attributes with fallbacks
        const animationSpeed = Number($element.data("animation-speed") || 1);
        const isPauseOnHover = $element.data("is-pause-on-hover") || "no";
        const delayPerWord = Number($element.data("delay-per-word") || 1.5);
        const slideDirection = Number($element.data("slide-direction") || 1);
        const pauseBetweenWords = Number(
          $element.data("pause-between-words") || 1.5
        );
        const pauseAfterTyped = Number($element.data("pause-after-typed") || 1);
        const delayBeforeErase = Number(
          $element.data("delay-before-erase") || 1.5
        );
        const lineType = $element.data("line-type") || "singleUnderline";

        // Handle animation type
        switch (animationType) {
          case "slide":
            initWordSlide({
              $element,
              delaySec: delayPerWord,
              direction: slideDirection,
              animationSpeed,
              isPauseOnHover,
            });
            break;

          case "slide-horizontal":
            initHorizontalWordSlide({
              $element,
              delaySec: delayPerWord,
              direction: slideDirection,
              animationSpeed,
              isPauseOnHover,
            });
            break;

          case "rotation-3d":
            init3DRotation({
              $element,
              animationSpeed,
              isPauseOnHover,
            });
            break;

          case "construct":
            initConstructWordSequence({
              $element,
              animationSpeed,
              delayPerCharacter: 100,
              pauseBetweenWords,
              isPauseOnHover,
            });
            break;

          case "typing":
            initiateTypingAnimation({
              $element,
              typingRate: animationSpeed,
              pauseAfterTyped,
              isPauseOnHover,
            });
            break;

          case "twist":
            initiateTwistedText({
              $element,
              animationSpeed,
              delayPerLetter: 100,
              pauseBetweenLoops: 1,
              isPauseOnHover,
            });
            break;

          case "line":
            initiateLineAnimation({
              $element,
              animationSpeed,
              delayBeforeErase,
              lineType,
            });
            break;

          default:
            // Handle mapped animation styles like wave, swing, tilt, lean
            if (waveSwingTiltLeanAnimation.includes(animationType)) {
              initWaveSwingTiltLeanAnimation({
                $element,
                animationSpeed,
                delayPerLetter: 125,
                animationName:
                  animationMap[animationType?.toUpperCase()] ||
                  animationMap.WAVE,
                isPauseOnHover,
              });
            }
            break;
        }
      }
    );
  });
})(jQuery);
