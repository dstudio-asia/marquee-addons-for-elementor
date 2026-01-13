(function ($, _) {
  "use strict";
  $(window).on("elementor/frontend/init", () => {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-image-accordion.default",
      (scope) => {
        let accordionPanels = $(scope).find(
          ".deensimc-image-panel .deensimc-panel"
        );
        const behaviour = accordionPanels.data("behaviour");
        let initialOpenPanelIndex = 0;

        // Toggle accordion state
        accordionPanels.eq(initialOpenPanelIndex).addClass("open");

        accordionPanels.off("click mouseenter");

        if (behaviour === "click") {
          accordionPanels.on("click", function () {
            accordionPanels.not(this).removeClass("open");
            $(this).addClass("open");
          });
        } else {
          accordionPanels.on("mouseenter", function () {
            accordionPanels.not(this).removeClass("open");
            $(this).addClass("open");
          });
        }
      }
    );
  });
})(jQuery, window._);