(function ($) {
  function init3DRotation({ $element, animationSpeed = 10, isPauseOnHover }) {
    let wordsToCycle = $element
      .find(".deensimc-animated-text")
      .map(function () {
        return $(this).text().trim();
      })
      .get();

    if (wordsToCycle.length === 0) return;

    const faceCount = 3;
    let lastUpdatedFace = -1;
    let currentRotation = 0;
    const anglePerFace = 360 / faceCount;
    const rotationSpeed = animationSpeed / 10;
    const tolerance = 10;

    // Ensure at least 3 words
    while (wordsToCycle.length < faceCount) {
      wordsToCycle = [...wordsToCycle, ...wordsToCycle].slice(0, faceCount);
    }

    $element.empty();
    let wordIndex = 0;
    const faces = [];

    // Create a hidden temp span for measuring word widths
    const $tempSpan = $("<span>")
      .css({
        visibility: "hidden",
        position: "absolute",
        whiteSpace: "nowrap",
      })
      .appendTo($element);

    let maxWidth = 0;
    wordsToCycle.forEach((word) => {
      $tempSpan.text(word);
      maxWidth = Math.max(maxWidth, Math.ceil($tempSpan.outerWidth()));
    });
    $tempSpan.remove();

    // Set element width based on max word
    $element.css("width", `${maxWidth}px`);

    // Create faces
    for (let i = 0; i < faceCount; i++) {
      const $face = $("<span>")
        .addClass("deensimc-animated-text")
        .attr("data-index", i)
        .css("visibility", "visible")
        .text(wordsToCycle[wordIndex])
        .appendTo($element);

      faces.push($face);
      wordIndex = (wordIndex + 1) % wordsToCycle.length;
    }

    // ✅ Handle pause on hover
    let isPaused = false;
    if (isPauseOnHover === "yes") {
      $element.on("mouseenter", () => (isPaused = true));
      $element.on("mouseleave", () => (isPaused = false));
    }

    function rotate() {
      if (!isPaused) {
        currentRotation = (currentRotation + rotationSpeed) % 360;
        $element.css("transform", `rotateX(${currentRotation}deg)`);

        let backFaceIndex = -1;
        let frontFaceIndex = -1;
        let minAngleDiff = 360;

        faces.forEach(($face, i) => {
          const initialAngle = i * anglePerFace;
          const faceAngle = (initialAngle + currentRotation) % 360;

          $face.css(
            "transform",
            `rotateX(${initialAngle}deg) translateZ(0.33em)`
          );

          if (faceAngle > 180 - tolerance && faceAngle < 180 + tolerance) {
            backFaceIndex = i;
          }

          const angleToFront = Math.min(faceAngle, 360 - faceAngle);
          if (angleToFront < minAngleDiff) {
            minAngleDiff = angleToFront;
            frontFaceIndex = i;
          }
        });

        if (backFaceIndex !== -1 && backFaceIndex !== lastUpdatedFace) {
          lastUpdatedFace = backFaceIndex;
          faces[backFaceIndex].text(wordsToCycle[wordIndex]);
          wordIndex = (wordIndex + 1) % wordsToCycle.length;
        }

        if (frontFaceIndex !== -1) {
          $element.css("width", `${faces[frontFaceIndex].outerWidth()}px`);
        }
      }
      requestAnimationFrame(rotate);
    }
    requestAnimationFrame(rotate);
  }

  window.init3DRotation = init3DRotation;
})(jQuery);
