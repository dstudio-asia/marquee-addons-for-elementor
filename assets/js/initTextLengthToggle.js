(function ($, _) {
  "use strict";

  function escapeHtml(str) {
    if (typeof str !== "string") return "";
    return str
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  function initTextLengthToggle($scope) {
    const toggleButtons = $scope.find(".deensimc-toggle");

    if (toggleButtons.length) {
      toggleButtons.each(function () {
        const $btn = $(this);
        const $textWrapper = $btn.closest(".contents-wrapper");
        const $textElem = $textWrapper.find(".deensimc-contents");

        const fullText = escapeHtml($textElem.text().trim());
        const visibleWord = parseInt(
          $textWrapper.data("visible-word-length"),
          10
        );
        const truncatedText =
          fullText.split(" ").slice(0, visibleWord).join(" ") + "...";
        $textElem.html(truncatedText);

        // Toggle on click
        let isExpanded = false;
        $btn.on("click", function () {
          const foldText = $(this).find(".fold-text");
          const unfoldText = $(this).find(".unfold-text");
          if (isExpanded) {
            $textElem.html(truncatedText);
            isExpanded = false;
            foldText.show();
            unfoldText.hide();
          } else {
            $textElem.text(fullText);
            isExpanded = true;
            foldText.hide();
            unfoldText.show();
          }
        });
      });
    }
  }

  window.initTextLengthToggle = initTextLengthToggle;
})(jQuery, window._);
