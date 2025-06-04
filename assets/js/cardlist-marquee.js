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

      const userSpeed = Number(settings.duration); // from 1 to 100

      const duration = Math.max(100 - userSpeed, 1);
      track.style.animation = `${settings.animationName} ${duration}s linear infinite`;

      // const durationInSec = (settings.duration || 2000) / 1000;

      // track.style.animation = `${settings.animationName} ${durationInSec}s linear infinite`;

      handlePauseOnHover($(track), settings.pauseOnHover || "yes");
    };

    // Initialize card list marquee
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-card-list.default",
      function ($scope) {
        const animationSpeed = $($scope)
          .find(".deensimc-card-list-marquee-wrapper")
          .data("animation-speed");

        // const animationSpeed = parseInt($wrapper.data("animation-speed"), 10) || 2000;
        const animationName = $($scope)
          .find(".deensimc-card-list-marquee-wrapper")
          .data("animation-name");

        setupMarquee($scope, {
          wrapper: "deensimc-card-list-marquee-wrapper",
          track: "deensimc-card-list-marquee-track",
          duration: animationSpeed || 10,
          // duration: Number(animationSpeed || 10),
          // pauseOnHover: "yes",
          pauseOnHover:
            $($scope)
              .find(".deensimc-card-list-marquee-wrapper")
              .data("pause-on-hover") || "no",
          animationName,
        });

        
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
    
        function handleCardWidth() {
          $(".deensimc-card-list-marquee-wrapper").each(function () {
            const wrapperWidth = $(this).width();
            console.log("Wrapper Width:", wrapperWidth);
            const $track = $(this).find(".deensimc-card-content-wrapper");
            $track.css("width", wrapperWidth + "px");
          });
        }
    
        const handleMultiple = function () {
          checkVisibility(
            ".deensimc-card-list-marquee-wrapper",
            ".deensimc-card-list-marquee-track"
          );
          handleCardWidth();
        };
        // Initial check
        handleMultiple();
    
        // Set up event listeners
        $(window).on("scroll", handleMultiple).on("resize", handleMultiple);
      }

    );

  });
})(jQuery, window._);
