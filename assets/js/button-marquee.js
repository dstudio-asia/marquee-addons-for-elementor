(function ($, _) {
  "use strict";

  $(window).on("elementor/frontend/init", () => {
    function injectCl() {
      if (!$(".deensimc-button-marquee-cl").length) {
        $("body").append(`
          <div class="deensimc-button-marquee-cl">
            <span class="deensimc-button-marquee-cl-close">×</span>
            <div class="deensimc-button-marquee-video-container"></div>
          </div>
        `);
      }
    }

    function handleVideoLinks($scope) {
      const $button = $scope.find(".deensimc-button");
      const linkType = $button.data("link-type");
      if (linkType === "custom") return;

      injectCl();

      const link = $button.data("link");
      if (!link) return;
      const $container = $(".deensimc-button-marquee-video-container");
      const $cl = $(".deensimc-button-marquee-cl");

      $button.on("click", function (e) {
        e.preventDefault();
        $container.empty();

        if (linkType === "hosted") {
          $container.html(`
            <video controls autoplay class="deensimc-marquee-video">
              <source src="${link}" type="video/mp4">
              Your browser does not support the video tag.
            </video>
          `);
        } else {
          $container.html(`
            <iframe src="${link}?autoplay=1" 
              frameborder="0" allow="autoplay; fullscreen" allowfullscreen
              class="deensimc-marquee-iframe"></iframe>
          `);
        }

        $cl.css("display", "flex");
      });

      // Close button
      $(document).on("click", ".deensimc-button-marquee-cl-close", function () {
        $cl.css("display", "none");
        $container.empty();
      });
      $(document).on("click", ".deensimc-button-marquee-cl", function (e) {
        if ($(e.target).is(this)) {
          $cl.css("display", "none");
          $container.empty();
        }
      });
    }

    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc_button_marquee.default",
      function ($scope) {
        handleAnimationDuration($scope); // keep your duration handler
        handleVideoLinks($scope);
      }
    );
  });
})(jQuery, window._);
