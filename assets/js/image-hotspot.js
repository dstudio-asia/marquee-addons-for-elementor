(function ($, _) {
  "use strict";

  const initImageHotspot = ($scope) => {
    const $widgetElement = $scope;
    const isEditMode = window.elementorFrontend.isEditMode();
    
    // Helper to get all settings. The data-settings attribute is assumed to be updated on change in the editor.
    const getElementSettings = () => {
        return $widgetElement.data("settings") || {};
    };
    
    const settings = getElementSettings();

    const selectors = {
      hotspot: ".e-hotspot",
      tooltip: ".e-hotspot__tooltip",
    };

    const $hotspot = $widgetElement.find(selectors.hotspot);
    const $hotspotsExcludesLinks = $hotspot.filter(
      ":not(.e-hotspot--no-tooltip)"
    );
    const $tooltip = $widgetElement.find(selectors.tooltip);

    // --- Cleanup previous instances for editor ---
    $hotspotsExcludesLinks.off();
    const existingObserver = $widgetElement.data('hotspotObserver');
    if(existingObserver) {
        existingObserver.unobserve($widgetElement[0]);
    }
    // No need to unbind device mode listener as we are not using one. The script re-runs on device change in editor.

    // --- Helper for responsive control values ---
    const getResponsiveSetting = (key) => {
      const deviceMode = window.elementorFrontend.getCurrentDeviceMode();
      const desktopValue = settings[key];

      if (deviceMode === 'desktop') {
        return desktopValue;
      }
      
      const deviceKey = `${key}_${deviceMode}`;
      const deviceValue = settings[deviceKey];
    
      return typeof deviceValue !== 'undefined' ? deviceValue : desktopValue;
    };

    // --- Event handler for hotspot interaction ---
    const onHotspotTriggerEvent = (event) => {
        const $target = $(event.target);
        const isHotspotButton = $target.closest(".e-hotspot__button").length;
        const isTooltipMouseLeave =
            event.type === "mouseleave" &&
            ($target.is(".e-hotspot--tooltip-position") ||
            $target.parents(".e-hotspot--tooltip-position").length);
        const isMobile = window.elementorFrontend.getCurrentDeviceMode() === "mobile";
        const isLink = $target.closest(".e-hotspot--link").length;

        const shouldTriggerTooltip = !(isLink && isMobile && (event.type === 'mouseleave' || event.type === 'mouseenter'));

        if (shouldTriggerTooltip && (isHotspotButton || isTooltipMouseLeave)) {
            const $currentHotspot = $(event.currentTarget);
            $hotspot.not($currentHotspot).removeClass("e-hotspot--active");
            $currentHotspot.toggleClass("e-hotspot--active");
        }
    };

    // --- Bind events to hotspots ---
    const bindEvents = () => {
      const tooltipTrigger = getResponsiveSetting("tooltip_trigger");
      const triggerEvent =
        tooltipTrigger === "mouseenter"
          ? "mouseleave mouseenter"
          : tooltipTrigger;

      if (triggerEvent !== "none") {
        $hotspotsExcludesLinks.on(triggerEvent, onHotspotTriggerEvent);
      }
    };

    // --- Adjust tooltip position for directional animations ---
    const setTooltipPosition = () => {
      const animation = settings.tooltip_animation;
      const position = settings.tooltip_position;

      const isDirectionalAnimation =
        animation && animation.match(/^e-hotspot--(slide|fade)-direction/);

      if (isDirectionalAnimation) {
        $tooltip.removeClass(
          "e-hotspot--tooltip-animation-from-left e-hotspot--tooltip-animation-from-top e-hotspot--tooltip-animation-from-right e-hotspot--tooltip-animation-from-bottom"
        );
        $tooltip.addClass(`e-hotspot--tooltip-animation-from-${position}`);
      }
    };

    // --- Handle sequenced animation ---
    const runSequencedAnimation = () => {
      const isSequenced = settings.hotspot_sequenced_animation === 'yes';
      $hotspot.toggleClass('e-hotspot--sequenced', isSequenced);
      
      if (!isSequenced) return;

      if (isEditMode) return; // Don't run animation in editor, just add the class

      const hotspotObserver = elementorModules.utils.Scroll.scrollObserver({
        callback: (event) => {
          if (event.isInViewport) {
            hotspotObserver.unobserve($widgetElement[0]);

            $hotspot.each((index, element) => {
              if (index === 0) return;

              const duration = settings.hotspot_sequenced_animation_duration?.size || 1000;
              const delay = index * (duration / $hotspot.length);
              element.style.animationDelay = `${delay}ms`;
            });
          }
        },
      });
      hotspotObserver.observe($widgetElement[0]);

      $widgetElement.data('hotspotObserver', hotspotObserver); // Save for cleanup
    };

    // --- Main initialization ---
    bindEvents();
    setTooltipPosition();
    runSequencedAnimation();
  };

  // --- Register the handler with Elementor ---
  $(window).on("elementor/frontend/init", () => {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/deensimc-image-hotspot.default",
      initImageHotspot
    );
  });
})(jQuery, window._);