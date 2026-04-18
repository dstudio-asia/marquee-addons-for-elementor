(function ($, _) {
  "use strict";

  const DEFAULT_MAX_DUPLICATION_ROUNDS = 50;
  const IMAGE_LOAD_MARQUEE_CLASSES = ["deensimc-image-marquee"];
  const trackFillRegistry = new Map();
  let resizeTimer = null;
  let isResizeBound = false;

  function scheduleTrackFillRecalculation() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(recalculateTrackFills, 100);
  }

  function shouldWaitForMedia(element) {
    return IMAGE_LOAD_MARQUEE_CLASSES.some((className) =>
      element.classList.contains(className),
    );
  }

  function bindPendingMediaRecalculation(element) {
    if (!shouldWaitForMedia(element)) {
      return false;
    }

 
    const $media = $(element).find("img");
    let hasPendingMedia = false;

    $media.each((_, media) => {
      const $mediaItem = $(media);
      if (media.complete) {
        return;
      }

      hasPendingMedia = true;

      const events = "load.deensimcTrackFill error.deensimcTrackFill";

      $mediaItem.off(".deensimcTrackFill").one(events, () => {
        scheduleTrackFillRecalculation();
      });
    });

    return hasPendingMedia;
  }

  function getTrackSize(track, isVertical) {
    return isVertical ? track.scrollHeight : track.scrollWidth;
  }

  function markDuplicate(item) {
    item.setAttribute("aria-hidden", "true");
  }

  function cloneItems(items, isDuplicateBatch) {
    return items.map((item) => {
      const clone = item.cloneNode(true);
      if (isDuplicateBatch) {
        markDuplicate(clone);
      }
      return clone;
    });
  }

  function getSourceItems($track, itemSelector) {
    return $track
      .children(itemSelector)
      .filter((_, item) => item.getAttribute("aria-hidden") !== "true")
      .toArray()
      .map((item) => item.cloneNode(true));
  }

  function getContainerMeasuredSize($container, isVertical) {
    const baseSize = isVertical
      ? $container.outerHeight()
      : $container.outerWidth();
    const fallback = isVertical ? 1440 : 2560;
    const isScrollMode = $container.hasClass("deensimc-marquee-on-scroll");

    const measuredSize = baseSize * (isScrollMode ? 2 : 1.1);

    return Number.isFinite(measuredSize) && measuredSize > 0
      ? measuredSize
      : fallback;
  }

  function getContainerOptions(element) {
    const $container = $(element);
    const isVertical = $container.hasClass("deensimc-marquee-vertical");
    const horizontalTarget = Number($container.data("track-target-horizontal"));
    const verticalTarget = Number($container.data("track-target-vertical"));
    const containerMeasuredSize = getContainerMeasuredSize(
      $container,
      isVertical,
    );
    const verticalBaseSize =
      Number($container.data("track-vertical-base-size")) ||
      containerMeasuredSize;
    const targetSize = isVertical
      ? verticalTarget > 0
        ? (verticalTarget / 100) * verticalBaseSize
        : verticalBaseSize
      : horizontalTarget || containerMeasuredSize;

    return {
      itemSelector: $container.data("track-item-selector"),
      targetSize,
      maxDuplicationRounds:
        Number($container.data("track-max-duplication-rounds")) ||
        DEFAULT_MAX_DUPLICATION_ROUNDS,
      isVertical,
    };
  }

  function mirrorTrack($tracks) {
    const $firstTrack = $tracks.eq(0);
    const $secondTrack = $tracks.eq(1);

    if (!$firstTrack.length || !$secondTrack.length) {
      return;
    }

    const mirroredItems = $firstTrack
      .children()
      .toArray()
      .map((item) => {
        const clone = item.cloneNode(true);
        markDuplicate(clone);
        return clone;
      });

    $secondTrack.empty().append(mirroredItems);
  }

  function fillTrack($track, options) {
    const track = $track.get(0);
    const sourceItems = getSourceItems($track, options.itemSelector);

    if (!track || !sourceItems.length) {
      return;
    }

    $track.empty().append(cloneItems(sourceItems, false));

    const trackSize = getTrackSize(track, options.isVertical);

    if (
      !trackSize ||
      trackSize <= 0 ||
      !options.targetSize ||
      options.targetSize <= 0
    ) {
      return;
    }

    let rounds = 0;
    while (
      getTrackSize(track, options.isVertical) < options.targetSize &&
      rounds < options.maxDuplicationRounds
    ) {
      $track.append(cloneItems(sourceItems, true));
      rounds += 1;
    }
  }

  function fillContainerTrack(element) {
    const options = getContainerOptions(element);
    const $container = $(element);
    const $tracks = $(element).find(".deensimc-marquee-track");
    const $firstTrack = $tracks.eq(0);

    if (
      !$tracks.length ||
      !options.itemSelector ||
      $container.hasClass("deensimc-marquee-stop")
    ) {
      return;
    }

    if (bindPendingMediaRecalculation(element)) {
      return;
    }

    fillTrack($firstTrack, options);

    if ($tracks.length > 1) {
      mirrorTrack($tracks);
    }

    if (typeof window.initTextLengthToggle === "function") {
      window.initTextLengthToggle($(element));
    }
  }

  function recalculateTrackFills() {
    trackFillRegistry.forEach((_, element) => {
      if (!document.body.contains(element)) {
        trackFillRegistry.delete(element);
        return;
      }

      fillContainerTrack(element);

      if (typeof window.handleAnimationDuration === "function") {
        window.handleAnimationDuration($(element));
      }
    });
  }

  function bindResizeHandler() {
    if (isResizeBound) {
      return;
    }

    $(window).on("resize", () => {
      scheduleTrackFillRecalculation();
    });

    isResizeBound = true;
  }

  function autoRegisterTrackFillFromScope($scope) {
    const $containers = $scope
      .filter('.deensimc-marquee-main-container[data-track-fill="yes"]')
      .add(
        $scope.find('.deensimc-marquee-main-container[data-track-fill="yes"]'),
      );

    if (!$containers.length) {
      return;
    }

    $containers.each((_, element) => {
      trackFillRegistry.set(element, true);
      fillContainerTrack(element);
    });

    bindResizeHandler();
  }

  window.autoRegisterTrackFillFromScope = autoRegisterTrackFillFromScope;
})(jQuery, window._);
