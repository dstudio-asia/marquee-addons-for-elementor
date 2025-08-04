(function ($, _) {
  "use strict";

  function initShowMoreOrLess(scope) {
    const $scope = $(scope);
    const $marquee = $scope.find(".deensimc-tes .deensimc-marquee");

    const isTruncated = $marquee.data("is-excerpt-active") === "yes";
    const limitBy = $marquee.data("excerpt-by") || "words";
    const limit = $marquee.data("excerpt-length") || 50;
    const showMoreText = $marquee.data("show-more") || "Show more";
    const showLessText = $marquee.data("show-less") || "Show less";
    const quoteLeftIcon = $marquee.data("quote-left") || "";
    const quoteRightIcon = $marquee.data("quote-right") || "";

    $scope.find(".deensimc-tes-text").each(function () {
      const $blockquote = $(this);
      const originalText = $blockquote.text().replace("Show more", "").trim();
      const texts = originalText.split(limitBy === "words" ? " " : "");

      const truncatedText = isTruncated
        ? texts.slice(0, limit).join(limitBy === "words" ? " " : "")
        : originalText;

      // Store state in data attributes
      $blockquote.data({
        "full-text": originalText,
        "truncated-text": truncatedText,
        "show-more": showMoreText,
        "show-less": showLessText,
      });

      // Build content HTML
      const contentHtml = `
        <div class="contents-wrapper">
          <span class="quote-left"><i class="${quoteLeftIcon}"></i></span>
          <span class="deensimc-contents">${
            isTruncated ? truncatedText : originalText
          }</span>
          <span class="deensimc-toggle">${
            isTruncated ? showMoreText : ""
          }</span>
          <span class="quote-right"><i class="${quoteRightIcon}"></i></span>
        </div>
      `;

      $blockquote.html(contentHtml);

      // Attach toggle handler
      $blockquote
        .off("click", ".deensimc-toggle")
        .on("click", ".deensimc-toggle", toggleBlockquote);
    });
  }

  window.initShowMoreOrLess = initShowMoreOrLess;
})(jQuery, window._);

// (function ($, _) {
//   ("use strict");

//   // Show more/less text functionality
//   function initShowMoreOrLess(scope) {
//     $(scope)
//       .find(".deensimc-tes-text")
//       .each(function () {
//         let blockquoteElement = $(this);
//         let fullText = blockquoteElement.text().replace("Show more", "").trim();
//         let wordLimit =
//           $(scope)
//             .find(".deensimc-tes .deensimc-marquee")
//             .data("excerpt-length") || 50;
//         let showMoreText =
//           $(scope).find(".deensimc-tes .deensimc-marquee").data("show-more") ||
//           "Show more";
//         let showLessText =
//           $(scope).find(".deensimc-tes .deensimc-marquee").data("show-less") ||
//           "Show less";
//         let quoteLeft =
//           $(scope).find(".deensimc-tes .deensimc-marquee").data("quote-left") ||
//           "";
//         let quoteRight =
//           $(scope)
//             .find(".deensimc-tes .deensimc-marquee")
//             .data("quote-right") || "";

//         // Store truncated and full text in the element for reuse
//         const truncateText = (text, limit) => {
//           let wordArray = text.split(" ");
//           return wordArray.length > limit
//             ? wordArray.slice(0, limit).join(" ")
//             : text;
//         };

//         let truncatedText = truncateText(fullText, wordLimit);
//         let isTextTruncated = fullText.split(" ").length > wordLimit;

//         blockquoteElement.data({
//           "full-text": fullText,
//           "truncated-text": truncatedText,
//           "show-more": showMoreText,
//           "show-less": showLessText,
//         });

//         blockquoteElement.html(`
//             <div class="contents-wrapper">
//               <span class="quote-left"><i class="${quoteLeft}"></i></span>
//               <span class="deensimc-contents">${
//                 isTextTruncated ? truncatedText : fullText
//               }</span>
//               <span class="deensimc-toggle">${
//                 isTextTruncated ? showMoreText : ""
//               }</span>
//               <span class="quote-right"><i class="${quoteRight}"></i></span>
//             </div>
//           `);

//         blockquoteElement
//           .off("click", ".deensimc-toggle")
//           .on("click", ".deensimc-toggle", toggleBlockquote);
//       });
//   }

//   window.initShowMoreOrLess = initShowMoreOrLess;
// })(jQuery, window._);
