(function ($) {
  const animationMap = {
    WAVE: "deensimcWave",
    SWING: "deensimcSwing",
    TILT: "deensimcTilt",
    LEAN: "deensimcLean",
  };
  const waveSwingTiltLeanAnimation = ["wave", "swing", "tilt", "lean"];

  /**
   * Animate each letter of the text inside a container
   * @param {Object} config
   * @param {jQuery} config.$element - The container element (jQuery object)
   * @param {number} [config.animationSpeed=5]
   * @param {number} [config.delayPerLetter=125]
   * @param {string} config.animationName
   */
  function initWaveSwingTiltLeanAnimation({
    $element,
    animationSpeed = 5,
    delayPerLetter = 125,
    animationName,
    isPauseOnHover,
  }) {
    if (!$element.length) return;

    let words = [];
    $element.find("span").each(function () {
      const spanText = $(this).text().trim();
      if (spanText) {
        words.push(spanText);
      }
    });

    if (!words.length) return;

    $element.empty();

    const baseDuration = 10000;
    const animationDuration = Math.max(100, baseDuration / animationSpeed);

    words.forEach((word, wordIndex) => {
      const wordWrapper = $("<span></span>").css("white-space", "nowrap");
      if (isPauseOnHover === "yes") {
        wordWrapper.addClass("deensimc-pause-on-hover");
      }
      [...word].forEach((char, charIndex) => {
        const span = $("<span></span>").text(char === " " ? "\u00A0" : char);

        let transformOrigin = "center";
        if (animationName === animationMap.SWING) {
          transformOrigin = "top";
        } else if (animationName === animationMap.LEAN) {
          transformOrigin = "bottom";
        }

        span.css("transform-origin", transformOrigin);
        span.css({
          "animation-play-state": "running",
          "animation-name": animationName,
          "animation-duration": `${animationDuration}ms`,
          "animation-delay": `${charIndex * delayPerLetter}ms`,
          "animation-iteration-count": "infinite",
          "animation-timing-function": "ease-in-out",
          display: "inline-block", // Ensure animation works
        });

        wordWrapper.append(span);
      });

      $element.append(wordWrapper);

      // Add space between words (non-breaking space wrapper)
      if (wordIndex < words.length - 1) {
        $element.append(document.createTextNode(" "));
      }
    });
  }
  window.animationMap = animationMap;
  window.waveSwingTiltLeanAnimation = waveSwingTiltLeanAnimation;
  window.initWaveSwingTiltLeanAnimation = initWaveSwingTiltLeanAnimation;
})(jQuery);
