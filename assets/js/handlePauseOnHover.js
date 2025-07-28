(function ($, _) {
  ("use strict");

  // Helper function for hover event handling
  const handlePauseOnHover = (element, isPausedOnHover) => {
    if (isPausedOnHover === "yes") {
      element.off("mouseenter mouseleave").hover(
        () => {
          element.css("animation-play-state", "paused");
        },
        () => {
          element.css("animation-play-state", "running");
        }
      );
    } else {
      element.css("animation-play-state", "running");
    }
  };
  window.handlePauseOnHover = handlePauseOnHover;
})(jQuery, window._);
