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

  function buildTruncatedText(fullText, visibleLength, limitByChar) {
    return (
      fullText
        .split(limitByChar ? "" : " ")
        .slice(0, visibleLength)
        .join(limitByChar ? "" : " ") + "..."
    );
  }

  function setExpandedState($textWrapper, isExpanded) {
    const $textElem = $textWrapper.find(".deensimc-contents");
    const $btn = $textWrapper.find(".deensimc-toggle").first();
    const fullText = $textWrapper.attr("data-full-text");
    const truncatedText = $textWrapper.attr("data-truncated-text");

    if (!fullText || !truncatedText || !$btn.length || !$textElem.length) {
      return;
    }

    $textElem.html(isExpanded ? fullText : truncatedText);
    $textWrapper.attr("data-is-expanded", isExpanded ? "true" : "false");
    $btn.find(".fold-text").toggle(!isExpanded);
    $btn.find(".unfold-text").toggle(isExpanded);
  }

  function initTextLengthToggle($scope) {
    const $textWrappers = $scope.find(".contents-wrapper");

    if ($textWrappers.length) {
      $textWrappers.each(function () {
        const $textWrapper = $(this);
        const $textElem = $textWrapper.find(".deensimc-contents");
        const $btn = $textWrapper.find(".deensimc-toggle").first();

        if (!$textElem.length || !$btn.length) {
          return;
        }

        const visibleLength = parseInt($textWrapper.data("visible-length"), 10);
        const limitByChar = $textWrapper.data("limit-by") === "characters";
        const fullText = escapeHtml(
          String($textWrapper.attr("data-full-text") || $textElem.text()).trim(),
        );

        if (!visibleLength || !fullText) {
          return;
        }

        $textWrapper.attr("data-full-text", fullText);
        $textWrapper.attr(
          "data-truncated-text",
          buildTruncatedText(fullText, visibleLength, limitByChar),
        );

        if (typeof $textWrapper.attr("data-is-expanded") === "undefined") {
          $textWrapper.attr("data-is-expanded", "false");
        }

        setExpandedState(
          $textWrapper,
          $textWrapper.attr("data-is-expanded") === "true",
        );

        $btn.off("click.deensimcTextToggle").on("click.deensimcTextToggle", function () {
          const $currentTextWrapper = $(this).closest(".contents-wrapper");
          const isExpanded =
            $currentTextWrapper.attr("data-is-expanded") === "true";

          setExpandedState($currentTextWrapper, !isExpanded);
        });
      });
    }
  }

  window.initTextLengthToggle = initTextLengthToggle;
})(jQuery, window._);
