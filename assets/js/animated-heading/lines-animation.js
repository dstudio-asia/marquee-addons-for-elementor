(function ($) {
  const pathsMap = {
    wavyUnderline: [
      `<path
         d="M0,146
            c10,-8 20,-16 30,-16
            c10,0 12,16 20,16
            c10,0 15,-16 25,-16
            c10,0 12,16 20,16
            c10,0 15,-16 25,-16
            c10,0 12,16 20,16
            c10,0 15,-16 25,-16
            c10,0 12,16 20,16
            c10,0 15,-16 25,-16
            c10,0 12,16 20,16
            c10,0 15,-16 25,-16
            c10,0 12,16 20,16
            c10,0 15,-16 25,-16
            c10,0 12,16 20,16
            c10,0 15,-16 25,-16
            c10,0 12,16 20,16
            c10,0 15,-16 25,-16
            c10,0 12,16 20,16
            c10,0 15,-16 25,-16
            c10,0 12,16 20,16
            c10,0 15,-16 25,-16
            c10,0 12,16 20,16"
       />`,
    ],
    doubleUnderline: [
      `<path
         id="path1"
         d="M5,130.4
            c30.5-3.8,137.9-7.6,177.3-7.6
            c117.2,0,252.2,4.7,312.7,7.6"
       />`,
      `<path
         id="path2"
         d="M26.9,145.8
            c55.1-6.1,126-6.3,162.2-6.1
            c46.5,0.2,203.9,3.2,268.9,6.4"
       />`,
    ],
    singleUnderline: [
      `<path
         d="M7.7,145.6
            C109,125,299.9,116.2,401,121.3
            c42.1,2.2,87.6,11.8,87.3,25.7"
       />`,
    ],
    underlineZigzag: [
      `<path
         d="M9.3,127.3
            c49.3-3,150.7-7.6,199.7-7.4
            c121.9,0.4,189.9,0.4,282.3,7.2
            C380.1,129.6,181.2,130.6,70,139
            c82.6-2.9,254.2-1,335.9,1.3
            c-56,1.4-137.2-0.3-197.1,9"
       />`,
    ],
    circle: [
      `<path
         d="M325,18
            C228.7-8.3,118.5,8.3,78,21
            C22.4,38.4,4.6,54.6,5.6,77.6
            c1.4,32.4,52.2,54,142.6,63.7 
            c66.2,7.1,212.2,7.5,273.5-8.3
            c64.4-16.6,104.3-57.6,33.8-98.2
            C386.7-4.9,179.4-1.4,126.3,20.7"
       />`,
    ],
  };
  function initiateLineAnimation({
    $element,
    animationSpeed,
    delayBeforeErase,
    lineType = "singleUnderline",
  }) {
    const $container = $element.find(".deensimc-animated-lines");
    const pathHTML = pathsMap[lineType].join("");
    $container.html(pathHTML);
    const $paths = $container.find("path");
    const baseDuration = 10000;
    const drawDuration = Math.max(100, baseDuration / animationSpeed);

    function resetPaths() {
      $paths.each(function () {
        const length = this.getTotalLength();
        $(this).css({
          strokeDasharray: length,
          strokeDashoffset: length,
        });
      });
    }

    function draw($path) {
      $path.css({
        transition: `stroke-dashoffset ${drawDuration}ms linear`,
        strokeDashoffset: 0,
      });
    }

    function erase($path) {
      const length = $path[0].getTotalLength();
      $path.css({
        transition: `stroke-dashoffset ${drawDuration}ms linear`,
        strokeDashoffset: length,
      });
    }

    function startLoop(index = 0) {
      if (index < $paths.length) {
        const $path = $paths.eq(index);
        draw($path);
        setTimeout(() => startLoop(index + 1), drawDuration);
      } else {
        setTimeout(() => eraseLoop(0), delayBeforeErase * 1000);
      }
    }

    function eraseLoop(index = 0) {
      if (index < $paths.length) {
        const $path = $paths.eq(index);
        erase($path);
        setTimeout(() => eraseLoop(index + 1), drawDuration);
      } else {
        setTimeout(() => startLoop(), delayBeforeErase * 1000);
      }
    }

    resetPaths();
    startLoop();
  }

  window.initiateLineAnimation = initiateLineAnimation;
})(jQuery);
