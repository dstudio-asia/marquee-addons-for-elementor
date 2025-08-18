(function ($) {
  /**
   * Typing animation that types, pauses, deletes, and loops through multiple strings.
   *
   * @param {Object} config - Configuration object
   * @param {jQuery} config.$element - jQuery wrapper of the target container
   * @param {number} config.typingRate - Characters per second
   * @param {number} config.pauseAfterTyped - Pause after full text typed (in seconds)
   * @param {number} config.pauseAfterDelete - Pause after full delete (in seconds)
   * @param {string} config.isPauseOnHover - "yes" to enable pause on hover
   */
  function initiateTypingAnimation({
    $element,
    typingRate,
    pauseAfterTyped,
    pauseAfterDelete = 0,
    isPauseOnHover,
  }) {
    const texts = $element
      .find(".deensimc-animated-text")
      .map(function () {
        return $(this).text().trim();
      })
      .get();

    let textIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let isPaused = false;
    let currentTimeout = null;

    const typingDelay = 1000 / typingRate;
    const $animatedText = $("<span></span>");

    $element.empty().append($animatedText);

    function typeLoop() {
      if (isPaused) return;

      const currentText = texts[textIndex];
      const displayText = currentText.substring(0, charIndex);
      $animatedText.text(displayText);

      if (!isDeleting) {
        if (charIndex < currentText.length) {
          charIndex++;
          currentTimeout = setTimeout(typeLoop, typingDelay);
        } else {
          isDeleting = true;
          currentTimeout = setTimeout(typeLoop, pauseAfterTyped * 1000);
        }
      } else {
        if (charIndex > 0) {
          charIndex--;
          currentTimeout = setTimeout(typeLoop, typingDelay / 2);
        } else {
          isDeleting = false;
          textIndex = (textIndex + 1) % texts.length;
          currentTimeout = setTimeout(typeLoop, pauseAfterDelete * 1000);
        }
      }
    }

    // Handle pause on hover
    if (isPauseOnHover === "yes") {
      $element.on("mouseenter", function () {
        isPaused = true;
        clearTimeout(currentTimeout);
      });

      $element.on("mouseleave", function () {
        if (isPaused) {
          isPaused = false;
          typeLoop();
        }
      });
    }

    typeLoop();
  }

  window.initiateTypingAnimation = initiateTypingAnimation;
})(jQuery);
