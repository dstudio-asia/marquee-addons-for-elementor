(function ($, _) {
  "use strict";

  // Escape helper (in case we need safe strings for show-more/less labels)
  function escapeHtml(str) {
    if (typeof str !== "string") return "";
    return str
      .replace(/&/g, "")
      .replace(/</g, "")
      .replace(/>/g, "")
      .replace(/"/g, "")
      .replace(/'/g, "");
  }

  // Show more/less text functionality
  function initShowMoreOrLess(scope) {
    $(scope)
      .find(".deensimc-tes-text")
      .each(function () {
        let blockquoteElement = $(this);
        let fullText = blockquoteElement.text().replace("Show more", "").trim();

        // Get data attributes safely
        let $marquee = $(scope).find(".deensimc-tes .deensimc-marquee");
        let wordLimit = $marquee.data("excerpt-length") || 50;
        let showMoreText = escapeHtml($marquee.data("show-more") || "Show more");
        let showLessText = escapeHtml($marquee.data("show-less") || "Show less");
        let quoteLeft = escapeHtml($marquee.data("quote-left") || "");
        let quoteRight = escapeHtml($marquee.data("quote-right") || "");

        // Truncate helper
        const truncateText = (text, limit) => {
          let wordArray = text.split(" ");
          return wordArray.length > limit
            ? wordArray.slice(0, limit).join(" ")
            : text;
        };

        let truncatedText = truncateText(fullText, wordLimit);
        let isTextTruncated = fullText.split(" ").length > wordLimit;

        // Store safe strings in element
        blockquoteElement.data({
          "full-text": fullText,
          "truncated-text": truncatedText,
          "show-more": showMoreText,
          "show-less": showLessText,
        });

        // Build wrapper safely (no user text inside template)
        blockquoteElement.html(`
          <div class="contents-wrapper">
            <span class="quote-left"><i class="${quoteLeft}"></i></span>
            <span class="deensimc-contents"></span>
            <span class="deensimc-toggle">${
              isTextTruncated ? showMoreText : ""
            }</span>
            <span class="quote-right"><i class="${quoteRight}"></i></span>
          </div>
          <div class="deensimc-tes-bg-overlay"></div>
        `);

        // Insert user text safely
        blockquoteElement.find(".deensimc-contents").text(
          isTextTruncated ? truncatedText : fullText
        );

        // Toggle handler
        blockquoteElement
          .off("click", ".deensimc-toggle")
          .on("click", ".deensimc-toggle", function () {
            let isExpanded =
              $(this).text() === blockquoteElement.data("show-less");

            blockquoteElement.find(".deensimc-contents").text(
              isExpanded
                ? blockquoteElement.data("truncated-text")
                : blockquoteElement.data("full-text")
            );

            $(this).text(
              isExpanded
                ? blockquoteElement.data("show-more")
                : blockquoteElement.data("show-less")
            );
          });
      });
  }

  window.initShowMoreOrLess = initShowMoreOrLess;
})(jQuery, window._);