(function ($, _) {
  "use strict";

  function initVideoAutoplay($scope) {
    $($scope)
      .find("video")
      .each(function () {
        let $video = $(this);
        let videoEl = $video[0]; // native element
        let startTime = parseInt($video.data("start"), 10) || 0;
        let endTime = parseInt($video.data("end"), 10) || 0;

        $video.on("loadedmetadata", function () {
          if (startTime > 0) {
            videoEl.currentTime = startTime;
          }
        });

        $video.on("timeupdate", function () {
          if (endTime > 0 && videoEl.currentTime >= endTime) {
            videoEl.pause();
          }
        });

        if ($video.attr("autoplay") !== undefined) {
          let playPromise = videoEl.play();
          if (playPromise !== undefined) {
            playPromise.catch((err) => {
              console.warn("Autoplay blocked:", err);
            });
          }
        }
      });
  }

  function handlePlaceholderClick($scope) {
    $($scope)
      .find(".deensimc-video-placeholder")
      .on("click", function () {
        let videoItem = $(this).closest(".deensimc-video-item");
        let video = videoItem.find("video");
        let iframe = videoItem.find("iframe.deensimc-video-wrapper");
        $(this).hide();

        if (video.length > 0) {
          video.removeClass("deensimc-d-none");
          video.attr("autoplay", true).get(0).play();
        }

        if (iframe.length > 0) {
          iframe.removeClass("deensimc-d-none");
          let src = iframe.attr("src");
          if (src.includes("autoplay")) {
            src = src.replace(/autoplay=[01]/, "autoplay=1");
          } else {
            src += src.indexOf("?") > -1 ? "&autoplay=1" : "?autoplay=1";
          }
          iframe.attr("src", src);
        }
      });
  }

  $(window).on("elementor/frontend/init", () => {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-video-marquee.default",
      function ($scope) {
        handleAnimationDuration($scope);
        initVideoAutoplay($scope);
        handlePlaceholderClick($scope);
      }
    );
  });
})(jQuery, window._);
