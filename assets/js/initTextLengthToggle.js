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
        const visibleLength = parseInt($textWrapper.data("visible-length"), 10);
        const limitByChar = $textWrapper.data("limit-by") === "characters";

        const truncatedText =
          fullText
            .split(limitByChar ? "" : " ")
            .slice(0, visibleLength)
            .join(limitByChar ? "" : " ") + "...";
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
            $textElem.html(fullText);
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
