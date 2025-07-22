/**
 * MarqueeAddons Main JS
 */
(function ($, _) {
  "use strict";

  // Initialize Elementor frontend hooks on window load
  $(window).on("elementor/frontend/init", () => {
    // Helper function for hover event handling
    const handlePauseOnHover = (element, isPausedOnHover) => {
      if (isPausedOnHover === "yes") {
        element.off("mouseenter mouseleave").hover(
          () => element.css("animation-play-state", "paused"),
          () => element.css("animation-play-state", "running")
        );
      } else {
        element.css("animation-play-state", "running");
      }
    };

    const setupMarquee = (scope, widgetPrefix) => {
      let marqueeContainer = $(scope).find(`.${widgetPrefix}-marquee`);
      let marqueeGroup = $(scope).find(`.${widgetPrefix}-marquee-group`);

      // Determine orientation
      let isVertical =
        marqueeContainer.hasClass(`deensimc-marquee-vertical`) ||
        $(scope).find(`.deensimc-wrapper-vertical`).length > 0;
      if (!isVertical) {
        isVertical = marqueeContainer
          .closest(".deensimc-wrapper")
          .hasClass("deensimc-wrapper-vertical");
      }

      let isAnimationEnabled =
        marqueeContainer.data("animation-status") || "yes";
      let isPausedOnHover = marqueeContainer.data("pause-on-hover") || "no";
      let isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

      let originalChildElements = marqueeGroup.children().clone(true, true);

      marqueeGroup.empty();
      originalChildElements.each(function () {
        marqueeGroup.append($(this));
      });
      originalChildElements.each(function () {
        marqueeGroup.append($(this).clone(true, true));
      });

      let originalContentSize = 0;
      if (isVertical) {
        originalChildElements.each(function () {
          let $item = $(this);
          let originalDisplay = $item.css("display");
          if (originalDisplay === "none") {
            $item.css({
              display: "block",
              visibility: "hidden",
            });
          }
          originalContentSize += $item.outerHeight(true);
          if (originalDisplay === "none") {
            $item.css({
              display: originalDisplay,
              visibility: "",
            });
          }
        });
      } else {
        originalChildElements.each(function () {
          let $item = $(this);
          let originalDisplay = $item.css("display");
          if (originalDisplay === "none") {
            $item.css({
              display: "inline-block",
              visibility: "hidden",
            });
          }
          originalContentSize += $item.outerWidth(true);
          if (originalDisplay === "none") {
            $item.css({
              display: originalDisplay,
              visibility: "",
            });
          }
        });
      }

      if (originalContentSize === 0) {
        marqueeGroup.addClass(`${widgetPrefix}-paused`);
        console.warn(
          `Marquee original content ${
            isVertical ? "height" : "width"
          } is 0. Animation paused.`
        );
        return;
      }

      let pixelsPerSecondSetting = marqueeContainer.data("animation-speed");
      let pixelsPerSecond = 50;

      if (typeof pixelsPerSecondSetting !== "undefined") {
        const parsedSpeed = parseFloat(pixelsPerSecondSetting);
        if (!isNaN(parsedSpeed) && parsedSpeed > 0) {
          pixelsPerSecond = parsedSpeed;
        } else {
          console.warn(
            `Invalid data-animation-speed value: ${pixelsPerSecondSetting}. Using default ${pixelsPerSecond}px/s.`
          );
        }
      }

      if (pixelsPerSecond <= 0) {
        marqueeGroup.addClass(`${widgetPrefix}-paused`);
        console.warn("Marquee speed is 0 or negative. Animation paused.");
        return;
      }

      let animationDuration = originalContentSize / pixelsPerSecond;

      if (isSafari && Math.abs(animationDuration - 3) < 0.01) {
        animationDuration += 0.01;
      }

      marqueeGroup.css("animation-duration", animationDuration + "s");
      handlePauseOnHover(marqueeGroup, isPausedOnHover);

      if (isAnimationEnabled === "yes") {
        marqueeGroup.css("animation-play-state", "running");
      } else {
        marqueeGroup.css("animation-play-state", "paused");
      }

      if (
        isAnimationEnabled === "yes" &&
        originalContentSize > 0 &&
        pixelsPerSecond > 0
      ) {
        marqueeGroup.removeClass(`${widgetPrefix}-paused`);
      }
    };

    const toggleBlockquote = (e) => {
      e.preventDefault();
      let toggleElement = $(e.currentTarget);
      let blockquoteElement = toggleElement.closest(".deensimc-tes-text");
      let widget = $(".deensimc-tes .deensimc-marquee");

      let fullText = blockquoteElement.data("full-text");
      let truncatedText = blockquoteElement.data("truncated-text");
      let showMoreText = blockquoteElement.data("show-more");
      let showLessText = blockquoteElement.data("show-less");
      let quoteLeft = widget.data("quoteLeft");
      let quoteRight = widget.data("quoteRight");

      if (toggleElement.text() === showMoreText) {
        blockquoteElement.html(`
          <div class="contents-wrapper">
            <span class="quote-left"><i class="${quoteLeft}"></i></span>
            <span class="deensimc-contents">${fullText}</span>
            <span class="deensimc-toggle">${showLessText}</span>
            <span class="quote-right"><i class="${quoteRight} bottom"></i></span>
          </div>
        `);
      } else {
        blockquoteElement.html(`
          <div class="contents-wrapper">
            <span class="quote-left"><i class="${quoteLeft}"></i></span>
            <span class="deensimc-contents">${truncatedText}</span>
            <span class="deensimc-toggle">${showMoreText}</span>
            <span class="quote-right"><i class="${quoteRight}"></i></span>
          </div>
        `);
      }

      blockquoteElement
        .off("click", ".deensimc-toggle")
        .on("click", ".deensimc-toggle", toggleBlockquote);
    };

    const initSimpleMarquee = (scope) => {
      const marquee = $(scope).find(".deensimc-marquee");
      if (marquee.data("animation-speed")) {
        setupMarquee(scope, "deensimc");
      } else {
        $(scope).find(".deensimc-marquee-group").addClass("deensimc-paused");
      }
    };

    const initTestimonialMarquee = (scope) => {
      const marquee = $(scope).find(".deensimc-marquee");
      const animationSpeed = marquee.data("animation-speed");
      const isAnimationEnabled = marquee.data("animation-status") || "no";

      if (animationSpeed && isAnimationEnabled === "yes") {
        setupMarquee(scope, "deensimc");
      } else {
        $(scope).find(".deensimc-marquee-group").addClass("deensimc-paused");
      }

      $(scope)
        .find(".deensimc-tes-text")
        .each(function () {
          const blockquoteElement = $(this);
          const marqueeData = $(scope).find(".deensimc-tes .deensimc-marquee");
          const fullText = blockquoteElement
            .text()
            .replace("Show more", "")
            .trim();
          const wordLimit = marqueeData.data("excerpt-length") || 50;
          const showMoreText = marqueeData.data("show-more") || "Show more";
          const showLessText = marqueeData.data("show-less") || "Show less";
          const quoteLeft = marqueeData.data("quote-left") || "";
          const quoteRight = marqueeData.data("quote-right") || "";

          const truncateText = (text, limit) => {
            const wordArray = text.split(" ");
            return wordArray.length > limit
              ? wordArray.slice(0, limit).join(" ")
              : text;
          };

          const truncatedText = truncateText(fullText, wordLimit);
          const isTextTruncated = fullText.split(" ").length > wordLimit;

          blockquoteElement.data({
            "full-text": fullText,
            "truncated-text": truncatedText,
            "show-more": showMoreText,
            "show-less": showLessText,
          });

          blockquoteElement.html(`
            <div class="contents-wrapper">
              <span class="quote-left"><i class="${quoteLeft}"></i></span>
              <span class="deensimc-contents">${
                isTextTruncated ? truncatedText : fullText
              }</span>
              <span class="deensimc-toggle">${
                isTextTruncated ? showMoreText : ""
              }</span>
              <span class="quote-right"><i class="${quoteRight}"></i></span>
            </div>
          `);

          blockquoteElement
            .off("click", ".deensimc-toggle")
            .on("click", ".deensimc-toggle", toggleBlockquote);
        });
    };

    const initVideoMarquee = (scope) => {
      const marquee = $(scope).find(".deensimc-marquee");
      const isAnimationEnabled = marquee.data("animation-status") || "no";
      const animationSpeed = marquee.data("animation-speed") || 50;

      if (animationSpeed && isAnimationEnabled === "yes") {
        setupMarquee(scope, "deensimc");
      } else {
        $(scope).find(".deensimc-marquee-group").addClass("deensimc-paused");
      }

      $(scope)
        .find("video")
        .each(function () {
          const $video = $(this);
          const startTime = parseInt($video.data("start"), 10) || 0;
          const endTime = parseInt($video.data("end"), 10) || 0;

          $video.on("loadedmetadata", () => {
            if (startTime > 0) this.currentTime = startTime;
          });

          $video.on("timeupdate", () => {
            if (endTime > 0 && this.currentTime >= endTime) this.pause();
          });

          if ($video.attr("autoplay")) $video[0].play();
        });

      $(scope)
        .find(".deensimc-video-placeholder")
        .on("click", function () {
          const videoItem = $(this).closest(".deensimc-video-item");
          const video = videoItem.find("video");
          const iframe = videoItem.find("iframe.deensimc-video-wrapper");
          $(this).hide();

          if (video.length > 0) {
            video
              .removeClass("deensimc-d-none")
              .attr("autoplay", true)
              .get(0)
              .play();
          }

          if (iframe.length > 0) {
            iframe.removeClass("deensimc-d-none");
            let src = iframe.attr("src");
            if (src.includes("autoplay")) {
              src = src.replace(/autoplay=[01]/, "autoplay=1");
            } else {
              src += (src.includes("?") ? "&" : "?") + "autoplay=1";
            }
            iframe.attr("src", src);
          }
        });
    };

    const initStackedSlider = (scope) => {
      const slider = $(scope).find(".deensimc-image-slider-main");
      const isAutoplayEnabled = slider.data("autoplay") === "yes";
      const paginationElement = $(scope).find(".deensimc-swiper-pagination");
      const swiperWrapper = $(scope).find(".deensimc-ds-swiper");
      const transitionSpeed =
        parseInt(slider.data("animation-speed"), 10) || 3000;

      new Swiper(swiperWrapper[0], {
        effect: "cards",
        grabCursor: true,
        pagination: {
          el: paginationElement[0],
          clickable: true,
        },
        autoplay: isAutoplayEnabled
          ? {
              delay: transitionSpeed,
              disableOnInteraction: false,
            }
          : false,
      });
    };

    const initImageAccordion = (scope) => {
      const accordionPanels = $(scope).find(
        ".deensimc-image-panel .deensimc-click.deensimc-panel"
      );
      const initialOpenPanelIndex = Math.floor(accordionPanels.length / 2);

      accordionPanels.eq(initialOpenPanelIndex).addClass("open");
      accordionPanels.off("click").on("click", function () {
        accordionPanels.not(this).removeClass("open");
        $(this).toggleClass("open");
      });
    };

    const widgetHandlers = {
      "deensimc-smooth-marquee.default": initSimpleMarquee,
      "deensimc-smooth-marquee-pro.default": initSimpleMarquee,
      "deensimc-smooth-text.default": initSimpleMarquee,
      "deensimc-smooth-text-pro.default": initSimpleMarquee,
      "deensimc-testimonial.default": initTestimonialMarquee,
      "deensimc-testimonial-pro.default": initTestimonialMarquee,
      "deensimc-video-marquee.default": initVideoMarquee,
      "deensimc-video-marquee-pro.default": initVideoMarquee,
      "deensimc-stacked-slider.default": initStackedSlider,
      "deensimc-image-accordion.default": initImageAccordion,
    };

    for (const widget in widgetHandlers) {
      elementorFrontend.hooks.addAction(
        `frontend/element_ready/${widget}`,
        widgetHandlers[widget]
      );
    }

    function checkVisibility(wrapper, element) {
      const viewportHeight = window.innerHeight;

      $(wrapper).each(function () {
        const rect = this.getBoundingClientRect();
        const elements = $(this).find(element);
        const isVisible = rect.bottom > 0 && rect.top < viewportHeight;
        if (!isVisible) {
          elements.css("animation-play-state", "paused");
        } else {
          elements.css("animation-play-state", "running");
        }
      });
    }

    function handleMultiple() {
      checkVisibility(".deensimc-wrapper", ".deensimc-marquee-group");
      checkVisibility(".deensimc-tes", ".deensimc-tes-content");
    }

    handleMultiple();
    $(window).on("scroll resize", handleMultiple);
  });
})(jQuery, window._);
