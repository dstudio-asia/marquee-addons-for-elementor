(function ($, _) {
  ("use strict");

  // Show more/less text functionality
  function initShowMoreOrLess(scope) {
    $(scope)
      .find(".deensimc-tes-text")
      .each(function () {
        let blockquoteElement = $(this);
        let fullText = blockquoteElement.text().replace("Show more", "").trim();
        let wordLimit =
          $(scope)
            .find(".deensimc-tes .deensimc-marquee")
            .data("excerpt-length") || 50;
        let showMoreText =
          $(scope).find(".deensimc-tes .deensimc-marquee").data("show-more") ||
          "Show more";
        let showLessText =
          $(scope).find(".deensimc-tes .deensimc-marquee").data("show-less") ||
          "Show less";
        let quoteLeft =
          $(scope).find(".deensimc-tes .deensimc-marquee").data("quote-left") ||
          "";
        let quoteRight =
          $(scope)
            .find(".deensimc-tes .deensimc-marquee")
            .data("quote-right") || "";

        // Store truncated and full text in the element for reuse
        const truncateText = (text, limit) => {
          let wordArray = text.split(" ");
          return wordArray.length > limit
            ? wordArray.slice(0, limit).join(" ")
            : text;
        };

        let truncatedText = truncateText(fullText, wordLimit);
        let isTextTruncated = fullText.split(" ").length > wordLimit;

        blockquoteElement.data({
          "full-text": fullText,
          "truncated-text": truncatedText,
          "show-more": showMoreText,
          "show-less": showLessText,
        });

        blockquoteElement.html(`
            <div class="contents-wrapper">
              <span class="quote-left"><i class="${quoteLeft}"></i></span>
              <span class="deensimc-contents">${
                isTextTruncated ? truncatedText : fullText
              }</span>
              <span class="deensimc-toggle">${
                isTextTruncated ? showMoreText : ""
              }</span>
              <span class="quote-right"><i class="${quoteRight}"></i></span>
            </div>
            <div class="deensimc-tes-bg-overlay"></div>
          `);

        blockquoteElement
          .off("click", ".deensimc-toggle")
          .on("click", ".deensimc-toggle", toggleBlockquote);
      });
  }

  window.initShowMoreOrLess = initShowMoreOrLess;
})(jQuery, window._);
