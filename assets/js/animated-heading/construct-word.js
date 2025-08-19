(function ($) {
  /**
   * Animates a single word using a randomized zigzag motion (jQuery version).
   * @param {jQuery} $targetContainer - jQuery element to inject animated spans
   * @param {string} word - The word to animate
   * @param {number} animationDuration - Duration of each character animation in ms
   * @param {number} characterDelay - Delay between character animations in ms
   * @param {number} loopPauseSeconds - Pause duration after word animation in seconds
   * @returns {Promise<void>} - Resolves after the animation cycle
   */
  function animateConstructWord(
    $targetContainer,
    word,
    animationDuration,
    characterDelay,
    loopPauseSeconds,
    isPauseOnHover
  ) {
    return new Promise((resolve) => {
      const directions = [
        "left",
        "right",
        "top",
        "bottom",
        "topleft",
        "topright",
        "bottomleft",
        "bottomright",
      ];

      $targetContainer.empty();
      if (isPauseOnHover === "yes") {
        $targetContainer.addClass("deensimc-pause-on-hover");
      }

      [...word].forEach((char, i) => {
        const $span = $("<span></span>").text(char === " " ? "\u00A0" : char);
        const dir = directions[Math.floor(Math.random() * directions.length)];
        const offset = () => Math.floor(Math.random() * 100) + 20;

        let offsetX = 0;
        let offsetY = 0;

        switch (dir) {
          case "left":
            offsetX = -offset();
            break;
          case "right":
            offsetX = offset();
            break;
          case "top":
            offsetY = -offset();
            break;
          case "bottom":
            offsetY = offset();
            break;
          case "topleft":
            offsetX = -offset();
            offsetY = -offset();
            break;
          case "topright":
            offsetX = offset();
            offsetY = -offset();
            break;
          case "bottomleft":
            offsetX = -offset();
            offsetY = offset();
            break;
          case "bottomright":
            offsetX = offset();
            offsetY = offset();
            break;
        }

        $span.css({
          "--x": `${offsetX}px`,
          "--y": `${offsetY}px`,
          animationName: "deensimcConstructWord",
          animationDuration: `${animationDuration}ms`,
          animationDelay: `${i * characterDelay}ms`,
          animationTimingFunction: "ease",
          animationIterationCount: "1",
        });

        $targetContainer.append($span);
      });

      // --- Hover Pause Logic ---
      let timeoutId;
      let startTime;
      let remainingTime;
      const totalTime =
        (word.length - 1) * characterDelay +
        animationDuration +
        loopPauseSeconds * 1000;

      function startTimer() {
        startTime = Date.now();
        timeoutId = setTimeout(() => {
          $targetContainer.off("mouseenter mouseleave"); // Remove event listeners once resolved
          resolve();
        }, remainingTime);
      }

      // Initialize with totalTime
      remainingTime = totalTime;
      startTimer();

      if (isPauseOnHover === "yes") {
        $targetContainer.on("mouseenter", function () {
          clearTimeout(timeoutId); // Clear the current timer
          // Calculate elapsed time and set remaining time for when hover ends
          remainingTime -= Date.now() - startTime;
        });

        $targetContainer.on("mouseleave", function () {
          startTimer();
        });
      }
      // --- End Hover Pause Logic ---
    });
  }

  /**
   * Loops through and animates multiple words inside a container.
   * @param {Object} config - Settings
   */
  async function initConstructWordSequence({
    $element,
    animationSpeed = 3,
    delayPerCharacter = 150,
    pauseBetweenWords = 1,
    isPauseOnHover,
  }) {
    const $wordElements = $element.find(".deensimc-animated-text");

    const wordList = $wordElements.map((_, el) => $(el).text().trim()).get();

    const $measurer = $("<span></span>").css({
      position: "fixed",
      visibility: "hidden",
      whiteSpace: "nowrap",
      pointerEvents: "none",
      top: "-200px",
      left: 0,
    });

    const $animatedWrapper = $("<span></span>");
    $element.empty().append($animatedWrapper).append($measurer);

    const baseDuration = 10000;
    const animationDuration = Math.max(100, baseDuration / animationSpeed);

    let index = 0;

    while (true) {
      const word = wordList[index];

      $measurer.text(word);
      const targetWidth = $measurer.outerWidth();
      $element.stop().animate({ width: Math.round(targetWidth) }, 300);

      await animateConstructWord(
        $animatedWrapper,
        word,
        animationDuration,
        delayPerCharacter,
        pauseBetweenWords,
        isPauseOnHover
      );

      index = (index + 1) % wordList.length;
    }
  }

  window.initConstructWordSequence = initConstructWordSequence;
})(jQuery);
