/**
 * MarqueeAddons Main JS
 */
(function ($, _) {
  "use strict";

  // Initialize Elementor frontend hooks on window load
  $(window).on("elementor/frontend/init", () => {
    // Initialize image marquee
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-smooth-marquee.default",
      (scope) => {
        let animationSpeed = $(scope)
          .find(".deensimc-marquee")
          .data("animation-speed");
        if (animationSpeed) {
          setupMarquee(scope, "deensimc");
        } else {
          $(scope).find(".deensimc-marquee-group").addClass("deensimc-paused");
        }
      }
    );

    // Initialize text marquee
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-smooth-text.default",
      (scope) => {
        let animationSpeed = $(scope)
          .find(".deensimc-marquee")
          .data("animation-speed");
        if (animationSpeed) {
          setupMarquee(scope, "deensimc");
        } else {
          $(scope).find(".deensimc-marquee-group").addClass("deensimc-paused");
        }
      }
    );

    // Initialize text marquee
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-news-ticker.default",
      (scope) => {
        let animationSpeed = $(scope)
          .find(".deensimc-marquee")
          .data("animation-speed");
        if (animationSpeed) {
          setupMarquee(scope, "deensimc");
        } else {
          $(scope).find(".deensimc-marquee-group").addClass("deensimc-paused");
        }
      }
    );

    // Initialize stacked slider
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-stacked-slider.default",
      (scope) => {
        let isAutoplayEnabled =
          $(scope).find(".deensimc-image-slider-main").data("autoplay") ===
          "yes";
        let paginationElement = $(scope).find(".deensimc-swiper-pagination");
        let swiperWrapper = $(scope).find(".deensimc-ds-swiper");
        let transitionSpeed =
          parseInt(
            $(scope)
              .find(".deensimc-image-slider-main")
              .data("animation-speed"),
            10
          ) || 3000;

        new Swiper(swiperWrapper[0], {
          effect: "cards",
          grabCursor: true,
          pagination: {
            el: paginationElement[0],
            clickable: true,
          },
          autoplay: isAutoplayEnabled
            ? {
                delay: transitionSpeed,
                disableOnInteraction: false,
              }
            : false,
        });
      }
    );

    // Initialize image accordion
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-image-accordion.default",
      (scope) => {
        let accordionPanels = $(scope).find(
          ".deensimc-image-panel .deensimc-click.deensimc-panel"
        );
        let initialOpenPanelIndex = Math.floor(accordionPanels.length / 2);
        accordionPanels.eq(initialOpenPanelIndex).addClass("open");
        accordionPanels.off("click").on("click", function () {
          accordionPanels.not(this).removeClass("open");
          $(this).toggleClass("open");
        });
      }
    );

    // Initialize testimonial marquee
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-testimonial.default",
      (scope) => {
        let animationSpeed = $(scope)
          .find(".deensimc-marquee")
          .data("animation-speed");
        let isAnimationEnabled =
          $(scope).find(".deensimc-marquee").data("animation-status") || "no";
        if (animationSpeed && isAnimationEnabled === "yes") {
          setupMarquee(scope, "deensimc");
        } else {
          $(scope).find(".deensimc-marquee-group").addClass("deensimc-paused");
        }
        initShowMoreOrLess(scope);
      }
    );

    // Initialize video marquee
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-video-marquee.default",
      (scope) => {
        let isAnimationEnabled =
          $(scope).find(".deensimc-marquee").data("animation-status") || "no";
        let animationSpeed =
          $(scope).find(".deensimc-marquee").data("animation-speed") || 50;

        if (animationSpeed && isAnimationEnabled === "yes") {
          setupMarquee(scope, "deensimc");
        } else {
          $(scope).find(".deensimc-marquee-group").addClass("deensimc-paused");
        }

        // Configure video start/end time and autoplay behavior
        $(scope)
          .find("video")
          .each(function () {
            let $video = $(this);
            let startTime = parseInt($video.data("start"), 10) || 0;
            let endTime = parseInt($video.data("end"), 10) || 0;

            $video.on("loadedmetadata", () => {
              if (startTime > 0) {
                this.currentTime = startTime;
              }
            });

            $video.on("timeupdate", () => {
              if (endTime > 0 && this.currentTime >= endTime) {
                this.pause();
              }
            });

            if ($video.attr("autoplay")) {
              $video[0].play();
            }
          });

        // Handle video placeholder click to start video
        $(scope)
          .find(".deensimc-video-placeholder")
          .on("click", function () {
            let videoItem = $(this).closest(".deensimc-video-item");
            let video = videoItem.find("video");
            let iframe = videoItem.find("iframe.deensimc-video-wrapper");
            $(this).hide();

            if (video.length > 0) {
              video.removeClass("deensimc-d-none");
              video.attr("autoplay", true).get(0).play();
            }

            if (iframe.length > 0) {
              iframe.removeClass("deensimc-d-none");
              let src = iframe.attr("src");
              if (src.includes("autoplay")) {
                src = src.replace(/autoplay=[01]/, "autoplay=1");
              } else {
                src += src.indexOf("?") > -1 ? "&autoplay=1" : "?autoplay=1";
              }
              iframe.attr("src", src);
            }
          });
      }
    );

    // Load marquee when it comes into viewport
    function checkVisibility(wrapper, element) {
      const viewportHeight = window.innerHeight;

      $(wrapper).each(function () {
        const rect = this.getBoundingClientRect();
        const elements = $(this).find(element);
        const isVisible = rect.bottom > 0 && rect.top < viewportHeight;
        if (!isVisible) {
          elements.css("animation-play-state", "paused");
        } else {
          elements.css("animation-play-state", "running");
        }
      });
    }

    function handleMultiple() {
      checkVisibility(".deensimc-wrapper", ".deensimc-marquee-group");
      checkVisibility(".deensimc-tes", ".deensimc-tes-content");
    }

    handleMultiple();

    $(window).on("scroll resize", handleMultiple);
  });
})(jQuery, window._);
