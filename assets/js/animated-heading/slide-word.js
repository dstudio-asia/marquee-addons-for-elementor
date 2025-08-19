(function ($) {
  function initWordSlide({
    $element,
    delaySec = 1.5,
    animationSpeed = 10,
    direction = 1,
    isPauseOnHover,
  }) {
    let height = $element.children().first().outerHeight();
    let isStarted = false;
    const $container = $element.parent();
    const baseDuration = 10000;
    const animationDuration = Math.max(100, baseDuration / animationSpeed);

    const existing = $element.children().toArray();

    while ($element.children().length < 3) {
      existing.forEach((el) => {
        if ($element.children().length < 3) {
          $element.append($(el).clone(true));
        }
      });
    }

    $container.css({
      height: `${height}px`,
      display: "inline-block",
      overflow: "hidden",
      transition: `width ${animationDuration}ms ease`,
    });

    function updateNextWordWidth(nextIndex = isStarted ? 1 : 0) {
      const $words = $element.children();
      const $next =
        direction === 1
          ? $words.eq(nextIndex % $words.length)
          : $words.eq(($words.length - nextIndex) % $words.length);

      const wordWidth = $next.outerWidth(true);
      $container.css("width", wordWidth + "px");
      isStarted = true;
    }

    updateNextWordWidth();

    function rotateWord() {
      updateNextWordWidth();

      if (direction === 1) {
        $element.css({
          transition: `transform ${animationDuration}ms ease-in-out`,
          transform: `translateY(-${height}px)`,
        });

        setTimeout(() => {
          const $first = $element.children().first();
          $element.append($first);
          $element.css({
            transition: "none",
            transform: "translateY(0)",
          });
        }, animationDuration);
      } else {
        const $last = $element.children().last();
        $last.prependTo($element);

        $element.css({
          transition: "none",
          transform: `translateY(-${height}px)`,
        });

        requestAnimationFrame(() => {
          requestAnimationFrame(() => {
            $element.css({
              transition: `transform ${animationDuration}ms ease-in-out`,
              transform: "translateY(0)",
            });
          });
        });
      }
    }

    let interval = setInterval(rotateWord, delaySec * 1000);

    if (isPauseOnHover === "yes") {
      $container
        .on("mouseenter", () => clearInterval(interval))
        .on("mouseleave", () => {
          interval = setInterval(rotateWord, delaySec * 1000);
        });
    }

    $(window).on("resize", () => {
      height = $element.children().first().outerHeight();
      $container.css("height", height + "px");
      updateNextWordWidth();
    });
  }

  function initHorizontalWordSlide({
    $element,
    delaySec,
    direction = 1,
    animationSpeed,
    isPauseOnHover,
  }) {
    const $parent = $element.parent();

    if (
      !$element.length ||
      !$parent.length ||
      $element.children().length === 0
    ) {
      return;
    }

    const existing = $element.children().toArray();

    while ($element.children().length < 3) {
      existing.forEach((el) => {
        if ($element.children().length < 3) {
          $element.append($(el).clone(true));
        }
      });
    }

    const baseDuration = 2500;
    const transitionDuration = Math.max(
      100,
      baseDuration / Math.max(animationSpeed, delaySec)
    );

    $element.css("transition", `transform ${transitionDuration}ms ease-in-out`);
    $parent.css("transition", `width ${transitionDuration}ms ease-in-out`);

    function setParentWidth() {
      const $currentWord = $element.children().first();
      if ($currentWord.length) {
        $parent.css("width", $currentWord.outerWidth());
      }
    }

    function rotateWord() {
      if (direction === 1) {
        // ➤ Right-to-left sliding
        const $firstWord = $element.children().first();
        const $nextWord = $firstWord.next().length
          ? $firstWord.next()
          : $firstWord;
        const currentWidth = $firstWord.outerWidth();

        $parent.css("width", $nextWord.outerWidth());
        $element.css("transform", `translateX(-${currentWidth}px)`);

        setTimeout(() => {
          $firstWord.appendTo($element);
          $element.css("transition", "none");
          $element.css("transform", "translateX(0)");
          $element[0].offsetHeight; // Force reflow
          $element.css(
            "transition",
            `transform ${transitionDuration}ms ease-in-out`
          );
        }, transitionDuration);
      } else {
        // ➤ Left-to-right sliding
        const $lastWord = $element.children().last();
        const lastWidth = $lastWord.outerWidth();

        $lastWord.prependTo($element);
        $parent.css("width", lastWidth);
        $element.css("transition", "none");
        $element.css("transform", `translateX(-${lastWidth}px)`);

        requestAnimationFrame(() => {
          requestAnimationFrame(() => {
            $element.css(
              "transition",
              `transform ${transitionDuration}ms ease-in-out`
            );
            $element.css("transform", "translateX(0)");
          });
        });
      }
    }

    // Initial setup
    setParentWidth();

    // Interval control
    let intervalId = setInterval(rotateWord, delaySec * 1000);

    // Pause on hover (if enabled)
    if (isPauseOnHover === "yes") {
      $parent
        .on("mouseenter", () => clearInterval(intervalId))
        .on("mouseleave", () => {
          intervalId = setInterval(rotateWord, delaySec * 1000);
        });
    }

    // Handle resize
    $(window).on("resize", () => {
      $parent.css("transition", "none");
      $element.css("transition", "none");
      setParentWidth();
      setTimeout(() => {
        $parent.css("transition", `width ${transitionDuration}ms ease-in-out`);
        $element.css(
          "transition",
          `transform ${transitionDuration}ms ease-in-out`
        );
      }, 50);
    });
  }

  window.initWordSlide = initWordSlide;
  window.initHorizontalWordSlide = initHorizontalWordSlide;
})(jQuery);
