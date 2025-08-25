/**
 * MarqueeAddons Main JS
 */
(function ($, _) {
  "use strict";

  // Initialize Elementor frontend hooks on window load
  $(window).on("elementor/frontend/init", () => {
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

    // // Initialize testimonial marquee
    // elementorFrontend.hooks.addAction(
    //   "frontend/element_ready/deensimc-testimonial.default",
    //   (scope) => {
    //     let animationSpeed = $(scope)
    //       .find(".deensimc-marquee")
    //       .data("animation-speed");
    //     let isAnimationEnabled =
    //       $(scope).find(".deensimc-marquee").data("animation-status") || "no";
    //     if (animationSpeed && isAnimationEnabled === "yes") {
    //       setupMarquee(scope, "deensimc");
    //     } else {
    //       $(scope).find(".deensimc-marquee-group").addClass("deensimc-paused");
    //     }
    //     initShowMoreOrLess(scope);
    //   }
    // );

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
