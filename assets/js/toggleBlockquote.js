(function ($, _) {
  ("use strict");

  // Handle blockquote text toggle
  const toggleBlockquote = (e) => {
    e.preventDefault();
    let toggleElement = $(e.currentTarget);
    let blockquoteElement = toggleElement.closest(".deensimc-tes-text");
    let widget = $(".deensimc-tes .deensimc-marquee");

    let fullText = blockquoteElement.data("full-text");
    let truncatedText = blockquoteElement.data("truncated-text");
    let showMoreText = blockquoteElement.data("show-more");
    let showLessText = blockquoteElement.data("show-less");
    let quoteLeft = widget.data("quoteLeft");
    let quoteRight = widget.data("quoteRight");

    if (toggleElement.text() === showMoreText) {
      blockquoteElement.html(`
          <div class="contents-wrapper">
            <span class="quote-left"><i class="${quoteLeft}"></i></span>
            <span class="deensimc-contents">${fullText}</span>
            <span class="deensimc-toggle">${showLessText}</span>
            <span class="quote-right"><i class="${quoteRight} bottom"></i></span>
          </div>
        `);
    } else {
      blockquoteElement.html(`
          <div class="contents-wrapper">
            <span class="quote-left"><i class="${quoteLeft}"></i></span>
            <span class="deensimc-contents">${truncatedText}</span>
            <span class="deensimc-toggle">${showMoreText}</span>
            <span class="quote-right"><i class="${quoteRight}"></i></span>
          </div>
        `);
    }

    blockquoteElement
      .off("click", ".deensimc-toggle")
      .on("click", ".deensimc-toggle", toggleBlockquote);
  };

  window.toggleBlockquote = toggleBlockquote;
})(jQuery, window._);
