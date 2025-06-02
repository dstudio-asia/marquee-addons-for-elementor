/**
 * MarqueeAddons Main JS
 */
(function ($, _) {
  "use strict";

  // Initialize Elementor frontend hooks on window load
  $(window).on("elementor/frontend/init", function () {
    // Helper function for hover event handling
    const handlePauseOnHover = function (element, isPausedOnHover) {
      if (isPausedOnHover === "yes") {
        element.off("mouseenter mouseleave").on({
          mouseenter: function () {
            $(this).css("animation-play-state", "paused");
          },
          mouseleave: function () {
            $(this).css("animation-play-state", "running");
          },
        });
      } else {
        element.css("animation-play-state", "running");
      }
    };

    const setupMarquee = function (scope, settings) {
      const wrapper = scope.find(`.${settings.wrapper}`)[0];
      const track = scope.find(`.${settings.track}`)[0];

      if (!wrapper || !track) return;
      const numberOfClones = 3;

      // Check if already initialized to avoid duplicate clones
      if (track.dataset.marqueeInitialized === "true") return;
      track.dataset.marqueeInitialized = "true";

      // Clone all children of the track
      const children = track.children;
      const childrenArray = Array.from(children);

      // Create array with original + cloned elements
      const cloneChild = [];
      for (let i = 1; i < numberOfClones; i++) {
        childrenArray.forEach((child) => {
          cloneChild.push(child.cloneNode(true)); // true for deep clone
        });
      }

      // Combine original and cloned elements
      const combinedArray = [...childrenArray, ...cloneChild];

      // Append clones to the track
      combinedArray.forEach(function (child) {
        const clone = child.cloneNode(true);
        track.appendChild(clone);
      });

      // Apply the animation
      track.style.animation = `${settings.animationName} ${
        settings.duration * 4 || 10
      }s linear infinite`;

      handlePauseOnHover($(track), settings.pauseOnHover || "yes");
    };

    // Initialize card list marquee
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-card-list.default",
      function ($scope) {
        const animationSpeed = $($scope)
          .find(".deensimc-card-list-marquee-wrapper")
          .data("animation-speed");
        const animationName = $($scope)
          .find(".deensimc-card-list-marquee-wrapper")
          .data("animation-name");

        setupMarquee($scope, {
          wrapper: "deensimc-card-list-marquee-wrapper",
          track: "deensimc-card-list-marquee-track",
          duration: Number(animationSpeed || 10),
          pauseOnHover: "yes",
          animationName,
        });
      }
    );

    // Load marquee when it comes into viewport
    const checkVisibility = function (wrapperSelector, elementSelector) {
      const viewportHeight = window.innerHeight;
      const $wrappers = $(wrapperSelector);

      $wrappers.each(function () {
        const $wrapper = $(this);
        const rect = this.getBoundingClientRect();
        const $elements = $wrapper.find(elementSelector);
        const isVisible = rect.bottom > 0 && rect.top < viewportHeight;

        $elements.css("animation-play-state", isVisible ? "running" : "paused");
      });
    };

    const handleMultiple = function () {
      checkVisibility(
        ".deensimc-card-list-marquee-wrapper",
        ".deensimc-card-list-marquee-track"
      );
    };

    // Initial check
    handleMultiple();

    // Set up event listeners
    $(window).on("scroll", handleMultiple).on("resize", handleMultiple);
  });
})(jQuery, window._);
