(function ($, _) {
  "use strict";

  $(window).on("elementor/frontend/init", () => {
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
  });
})(jQuery, window._);
