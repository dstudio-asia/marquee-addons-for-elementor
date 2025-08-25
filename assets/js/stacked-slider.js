(function ($, _) {
  "use strict";

  $(window).on("elementor/frontend/init", () => {
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
  });
})(jQuery, window._);
