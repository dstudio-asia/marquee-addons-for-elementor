(function ($) {
  function initiateTwistedText({
    $element,
    animationSpeed = 5,
    delayPerLetter = 150,
    pauseBetweenLoops = 1,
    sync = false,
    isPauseOnHover,
  }) {
    const baseDuration = 10000;
    const twistDuration = baseDuration / animationSpeed;

    const words = [];
    $element.find("span").each(function () {
      const text = $(this).text().trim();
      if (text) words.push(text);
    });

    if (words.length === 0) {
      console.warn("initiateTwistedText: No words found for animation.");
      return;
    }

    $element.empty();

    const wordWrappers = [];

    // --- State Management ---
    let mainLoopTimeoutId = null;
    let pauseStartTime = 0;
    let remainingTimeOnLoop = 0;
    let isPaused = false;
    let currentWordIndex = 0; // Index of the word currently or about to be animated.

    // --- DOM Setup ---
    words.forEach((word) => {
      const $wordWrapper = $("<span></span>").addClass("deensimc-word-wrapper");
      [...word].forEach((char) => {
        const $span = $("<span></span>").text(char === " " ? "\u00A0" : char);
        $wordWrapper.append($span);
      });
      $element.append($wordWrapper);
      wordWrappers.push($wordWrapper);
    });

    // --- Core Animation Logic ---

    function getWordAnimationDuration($wordWrapper) {
      const numChars = $wordWrapper.find("span").length;
      if (numChars === 0) return 0;
      return (numChars - 1) * delayPerLetter + twistDuration;
    }

    // Applies the animation to a word using CSS delays.
    // This function should only be called when a word is meant to START its animation.
    function triggerWordAnimation(wordIndex) {
      const $wordWrapper = wordWrappers[wordIndex];
      if (!$wordWrapper) return;

      $wordWrapper.find("span").each(function (i) {
        const $span = $(this);
        // Reset animation properties to ensure it can be re-triggered
        $span.css({
          animation: "none",
          opacity: 1, // Make sure it's visible before animation
        });
        // Force a reflow to apply the reset.
        void $span[0].offsetWidth;
        // Apply the new animation with a delay
        $span.css({
          "animation-name": "deensimcTwist",
          "animation-duration": `${twistDuration}ms`,
          "animation-timing-function": "linear",
          "animation-iteration-count": "1",
          "animation-delay": `${i * delayPerLetter}ms`,
          "animation-fill-mode": "forwards",
          "animation-play-state": "running",
        });
      });
    }

    // --- Main Animation Loops ---

    function scheduleNextAnimation() {
      if (isPaused) return;

      let nextDelay = 0;

      if (sync) {
        // In sync mode, trigger all words at once.
        wordWrappers.forEach((_, index) => {
          triggerWordAnimation(index);
        });
        // The next loop starts after the longest word finishes, plus the pause.
        const longestDuration = Math.max(
          ...wordWrappers.map(getWordAnimationDuration)
        );
        nextDelay = longestDuration + pauseBetweenLoops * 1000;
      } else {
        // In sequential mode, trigger the current word.
        triggerWordAnimation(currentWordIndex);
        const currentWordDuration = getWordAnimationDuration(
          wordWrappers[currentWordIndex]
        );

        // Determine the delay for the next word.
        const isLastWord = currentWordIndex === wordWrappers.length - 1;
        nextDelay =
          currentWordDuration + (isLastWord ? pauseBetweenLoops * 1000 : 0);

        // Set up the index for the next iteration.
        currentWordIndex = (currentWordIndex + 1) % wordWrappers.length;
      }

      remainingTimeOnLoop = nextDelay;
      pauseStartTime = Date.now();

      mainLoopTimeoutId = setTimeout(scheduleNextAnimation, nextDelay);
    }

    // --- Pause/Resume Logic ---

    function pauseAnimation() {
      if (isPaused) return;
      isPaused = true;

      // Stop the timer that schedules the next animation cycle.
      clearTimeout(mainLoopTimeoutId);
      mainLoopTimeoutId = null;

      // Calculate how much time was left on that timer.
      const elapsedTime = Date.now() - pauseStartTime;
      remainingTimeOnLoop = Math.max(0, remainingTimeOnLoop - elapsedTime);

      // Pause all currently running CSS animations.
      $element
        .find(".deensimc-word-wrapper span")
        .css("animation-play-state", "paused");
    }

    function resumeAnimation() {
      if (!isPaused) return;
      isPaused = false;

      // Resume all paused CSS animations.
      $element
        .find(".deensimc-word-wrapper span")
        .css("animation-play-state", "running");

      // Restart the timer to schedule the next animation cycle.
      // It will pick up where it left off.
      if (remainingTimeOnLoop > 0) {
        pauseStartTime = Date.now(); // Reset the start time for the new timeout
        mainLoopTimeoutId = setTimeout(
          scheduleNextAnimation,
          remainingTimeOnLoop
        );
      } else {
        // If the timer had already run out, schedule the next one immediately.
        scheduleNextAnimation();
      }
    }

    // --- Event Listeners ---
    if (isPauseOnHover === "yes") {
      $element.on("mouseenter", pauseAnimation);
      $element.on("mouseleave", resumeAnimation);
    }

    // --- Cleanup ---
    $element.on("remove", function () {
      clearTimeout(mainLoopTimeoutId);
      $element.off("mouseenter mouseleave");
    });

    // --- Start the animation ---
    scheduleNextAnimation();
  }

  window.initiateTwistedText = initiateTwistedText;
})(jQuery);
