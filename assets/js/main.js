/**
 * MarqueeAddons Main JS
 */
(function($, _) {
  "use strict";

  // Initialize Elementor frontend hooks on window load
  $(window).on("elementor/frontend/init", () => {
    
    // Helper function for hover event handling
    const handlePauseOnHover = (element, isPausedOnHover) => {
      if (isPausedOnHover === 'yes') {
        element.off('mouseenter mouseleave').hover(
          () => {
            element.css('animation-play-state', 'paused');
          },
          () => {
            element.css('animation-play-state', 'running');
          }
        );
      } else {
        element.css('animation-play-state', 'running');
      }
    };

    // Ensures the marquee group has the target number of children.
    const adjustChildElements = (marqueeGroup, targetCount) => {

      let currentChildren = marqueeGroup.children();
      let currentChildCount = currentChildren.length;
  
      // Remove extra children if above target
      if (currentChildCount > targetCount) {
          currentChildren.slice(targetCount).remove();
      }

      // Clone children if below target
      else if (currentChildCount < targetCount) {
          let documentFragment = document.createDocumentFragment();
          let clonesNeeded = targetCount - currentChildCount;

          for (let i = 0; i < clonesNeeded; i++) {
            let childToClone = currentChildren.eq(i % currentChildCount);
            childToClone.clone().appendTo(documentFragment);
          }

          marqueeGroup.append(documentFragment);
      }
    };

    const duplicateChildElements = (scope, widgetPrefix) => {
      let marqueeGroups = $(scope).find(`.${widgetPrefix}-marquee-group`);
      let targetChildCount = 10;
      
      marqueeGroups.each(function () {
      let childElements = $(this).children();
      let childCount = childElements.length;

      if (childCount === 0) return;

      if (childCount < targetChildCount) {
        let duplicatesNeeded = targetChildCount - childCount;
        let cloneCount = Math.floor(duplicatesNeeded / childCount);

        for (let i = 0; i < cloneCount; i++) {
        childElements.clone().appendTo($(this));
        }

        let remainingDuplicates = targetChildCount - $(this).children().length;
        if (remainingDuplicates > 0) {
        childElements.slice(0, remainingDuplicates).clone().appendTo($(this));
        }
      }
      });
    };
    
    // Helper function for setting animation duration
    const configureAnimationDuration = (element, speed, totalChildrenCount, originalChildrenCount) => {
      if (!speed) return;
      let calculatedSpeed = (speed / 100) * (totalChildrenCount / originalChildrenCount);
      element.css('animation-duration', calculatedSpeed + 's');
    };

    // Setup marquee initialization logic
    const setupMarquee = (scope, widgetPrefix) => {
      let marqueeContainer = $(scope).find(`.${widgetPrefix}-marquee`);
      let marqueeGroup = $(scope).find(`.${widgetPrefix}-marquee-group`);
      let isAnimationEnabled = marqueeContainer.data('animation-status') || 'no';
      let isPausedOnHover = marqueeContainer.data('pause-on-hover') || 'no';
      let isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
      let animationSpeed = marqueeContainer.data('animation-speed') || 5000;
      if (animationSpeed === 3000 && isSafari) {
          animationSpeed += 1;
      }
      let childElements = marqueeGroup.children();

      handlePauseOnHover(marqueeGroup, isPausedOnHover);
      configureAnimationDuration(marqueeGroup, animationSpeed, marqueeGroup.children().length, childElements.length);
      duplicateChildElements(scope, widgetPrefix);
    };

    // Handle blockquote text toggle
    const toggleBlockquote = (e) => {
      e.preventDefault();
      let toggleElement = $(e.currentTarget);
      let blockquoteElement = toggleElement.closest('.deensimc-tes-text');
      let widget = $('.deensimc-tes');

      let fullText = blockquoteElement.data('full-text');
      let truncatedText = blockquoteElement.data('truncated-text');
      let showMoreText = blockquoteElement.data('show-more');
      let showLessText = blockquoteElement.data('show-less');
      let quoteLeft  = widget.data('quoteLeft');
      let quoteRight = widget.data('quoteRight');
      
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

      blockquoteElement.off('click', '.deensimc-toggle').on('click', '.deensimc-toggle', toggleBlockquote);
    };

    // Initialize image marquee
    elementorFrontend.hooks.addAction("frontend/element_ready/deensimc-smooth-marquee.default", (scope) => {
      let animationSpeed = $(scope).find('.deensimc-marquee').data('animation-speed');
      if (animationSpeed) {
        setupMarquee(scope, 'deensimc');
      } else {
        $(scope).find('.deensimc-marquee-group').addClass('deensimc-paused');
      }
    });

    // Initialize text marquee
    elementorFrontend.hooks.addAction("frontend/element_ready/deensimc-smooth-text.default", (scope) => {
      let animationSpeed = $(scope).find('.deensimc-marquee').data('animation-speed');
      if (animationSpeed) {
        setupMarquee(scope, 'deensimc');
      } else {
        $(scope).find('.deensimc-marquee-group').addClass('deensimc-paused');
      }
    });

    // Initialize stacked slider
    elementorFrontend.hooks.addAction("frontend/element_ready/deensimc-stacked-slider.default", (scope) => {
      let isAutoplayEnabled = $(scope).find('.deensimc-image-slider-main').data('autoplay') === 'yes';
      let paginationElement = $(scope).find('.deensimc-swiper-pagination');
      let swiperWrapper = $(scope).find('.deensimc-ds-swiper');
      let transitionSpeed = parseInt($(scope).find('.deensimc-image-slider-main').data('animation-speed'), 10) || 3000;

      new Swiper(swiperWrapper[0], {
        effect: "cards",
        grabCursor: true,
        pagination: {
          el: paginationElement[0],
          clickable: true,
        },
        autoplay: isAutoplayEnabled ? {
          delay: transitionSpeed,
          disableOnInteraction: false,
        } : false,
      });
    });

    // Initialize image accordion
    elementorFrontend.hooks.addAction("frontend/element_ready/deensimc-image-accordion.default", (scope) => {
      let accordionPanels = $(scope).find(".deensimc-image-panel .deensimc-click.deensimc-panel");
      let initialOpenPanelIndex = Math.floor(accordionPanels.length / 2);

      // Toggle accordion state
      accordionPanels.eq(initialOpenPanelIndex).addClass("open");
      accordionPanels.off('click').on("click", function() {
        accordionPanels.not(this).removeClass("open");
        $(this).toggleClass("open");
      });
    });

    // Initialize testimonial marquee
    elementorFrontend.hooks.addAction("frontend/element_ready/deensimc-testimonial.default", (scope) => {
      let rootElement = $(document.documentElement);
      let displayedTestimonialCount = parseInt(rootElement.css("--deensimc-marquee-elements-displayed"), 10);
      let testimonialWrapper = $(scope).find(".deensimc-tes-content");
      let isPausedOnHover = $(scope).find(".deensimc-tes").data('pause-on-hover') || 'no';
      let isAnimationEnabled = $(scope).find(".deensimc-tes").data('animation-status') || 'no';
      let animationSpeed = ($(scope).find(".deensimc-tes").data('animation-speed') || 100) / 100;

      rootElement.css("--deensimc-marquee-elements", testimonialWrapper.children().length);
      rootElement.css("--deensimc-marquee-animation-duration", `${animationSpeed}s`);

      // Duplicate testimonials if necessary
      let fragment = document.createDocumentFragment();
      for (let i = 0; i < displayedTestimonialCount; i++) {
        testimonialWrapper.children().each(function() {
          fragment.appendChild(this.cloneNode(true));
        });
      }
      testimonialWrapper.append(fragment);

      if (isAnimationEnabled !== 'yes') {
        testimonialWrapper.css("animation-play-state", "paused");
      } else {
        testimonialWrapper.css("animation-play-state", "running");
        handlePauseOnHover(testimonialWrapper, isPausedOnHover);
      }

      // Show more/less text functionality
      $(scope).find('.deensimc-tes-text').each(function() {
        let blockquoteElement = $(this);
        let fullText = blockquoteElement.text().replace('Show more', '').trim();
        let wordLimit = $(scope).find('.deensimc-tes').data('excerpt-length') || 50;
        let showMoreText = $(scope).find('.deensimc-tes').data('show-more') || 'Show more';
        let showLessText = $(scope).find('.deensimc-tes').data('show-less') || 'Show less';
        let quoteLeft = $(scope).find('.deensimc-tes').data('quote-left') || 'fa fa-quote-left';
        let quoteRight = $(scope).find('.deensimc-tes').data('quote-right') || 'fa fa-quote-right';
        
        // Store truncated and full text in the element for reuse
        const truncateText = (text, limit) => {
          let wordArray = text.split(' ');
          return wordArray.length > limit ? wordArray.slice(0, limit).join(' ') : text;
        };

        let truncatedText = truncateText(fullText, wordLimit);
        let isTextTruncated = fullText.split(' ').length > wordLimit;

        blockquoteElement.data({
          'full-text': fullText,
          'truncated-text': truncatedText,
          'show-more': showMoreText,
          'show-less': showLessText
        });

        blockquoteElement.html(`
          <div class="contents-wrapper">
            <span class="quote-left"><i class="${quoteLeft}"></i></span>
            <span class="deensimc-contents">${isTextTruncated ? truncatedText : fullText}</span>
            <span class="deensimc-toggle">${isTextTruncated ? showMoreText : ''}</span>
            <span class="quote-right"><i class="${quoteRight}"></i></span>
          </div>
        `);

        blockquoteElement.off('click', '.deensimc-toggle').on('click', '.deensimc-toggle', toggleBlockquote);
      });
    });

    // Initialize video marquee 
    elementorFrontend.hooks.addAction("frontend/element_ready/deensimc-video-marquee.default", (scope) => {
      let isAnimationEnabled = $(scope).find('.deensimc-marquee').data('animation-status') || 'no';
      let animationSpeed = $(scope).find('.deensimc-marquee').data('animation-speed') || 5000;

      if (animationSpeed && isAnimationEnabled === 'yes') {
        setupMarquee(scope, 'deensimc');
      } else {
        $(scope).find('.deensimc-marquee-group').addClass('deensimc-paused');
      }

      // Configure video start/end time and autoplay behavior
      $(scope).find("video").each(function() {
        let $video = $(this);
        let startTime = parseInt($video.data('start'), 10) || 0;
        let endTime = parseInt($video.data('end'), 10) || 0;

        $video.on('loadedmetadata', () => {
          if (startTime > 0) {
            this.currentTime = startTime;
          }
        });

        $video.on('timeupdate', () => {
          if (endTime > 0 && this.currentTime >= endTime) {
            this.pause();
          }
        });

        if ($video.attr('autoplay')) {
          $video[0].play();
        }
      });

      // Handle video placeholder click to start video
      $(scope).find('.deensimc-video-placeholder').on('click', function() {
        let videoItem = $(this).closest('.deensimc-video-item');
        let video = videoItem.find('video');
        let iframe = videoItem.find('iframe.deensimc-video-wrapper');
        $(this).hide();

        if (video.length > 0) {
          video.removeClass('deensimc-d-none');
          video.attr('autoplay', true).get(0).play();
        }

        if (iframe.length > 0) {
          iframe.removeClass('deensimc-d-none');
          let src = iframe.attr('src');
          if (src.includes('autoplay')) {
            src = src.replace(/autoplay=[01]/, 'autoplay=1');
          } else {
            src += src.indexOf('?') > -1 ? '&autoplay=1' : '?autoplay=1';
          }
          iframe.attr('src', src);
        }
      });
    });

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

    function handleMulti() {
      checkVisibility('.deensimc-wrapper', '.deensimc-marquee-group');
      checkVisibility('.deensimc-tes', '.deensimc-tes-content');
    }

    handleMulti();

    // Basic scroll/resize listeners
    $(window).on("scroll resize", handleMulti);

  });
})(jQuery, window._);