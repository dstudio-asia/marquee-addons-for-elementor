(function ($, _) {
  "use strict";

  const DEFAULT_TRACK_TARGET_SIZE = 2560;
  const DEFAULT_MAX_DUPLICATION_ROUNDS = 50;
  const DEFAULT_VERTICAL_BASE_SIZE = 1440;
  const trackFillRegistry = new Map();
  let resizeTimer = null;
  let isResizeBound = false;

  function getTrackSize(track, isVertical) {
    return isVertical ? track.scrollHeight : track.scrollWidth;
  }

  function markDuplicate(item) {
    item.setAttribute("aria-hidden", "true");

    $(item)
      .find("a, button, input, select, textarea, [tabindex]")
      .each((_, interactiveEl) => {
        interactiveEl.setAttribute("tabindex", "-1");
        interactiveEl.setAttribute("aria-hidden", "true");
      });
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

  function getContainerOptions(element) {
    const $container = $(element);
    const isVertical = $container.hasClass("deensimc-marquee-vertical");
    const horizontalTarget = Number($container.data("track-target-horizontal"));
    const verticalTarget = Number($container.data("track-target-vertical"));
    const verticalBaseSize =
      Number($container.data("track-vertical-base-size")) ||
      DEFAULT_VERTICAL_BASE_SIZE;

    return {
      itemSelector: $container.data("track-item-selector"),
      targetSize:
        (isVertical
          ? (verticalTarget / 100) * verticalBaseSize
          : horizontalTarget) ||
        DEFAULT_TRACK_TARGET_SIZE,
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

    const mirroredItems = $firstTrack.children().toArray().map((item) => {
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

    if (getTrackSize(track, options.isVertical) === 0) {
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
    const $tracks = $(element).find(".deensimc-marquee-track");

    if (!$tracks.length || $tracks.length < 2 || !options.itemSelector) {
      return;
    }

    fillTrack($tracks.eq(0), options);
    mirrorTrack($tracks);
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
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(recalculateTrackFills, 100);
    });

    isResizeBound = true;
  }

  function autoRegisterTrackFillFromScope($scope) {
    const $containers = $scope
      .filter('.deensimc-marquee-main-container[data-track-fill="yes"]')
      .add(
        $scope.find('.deensimc-marquee-main-container[data-track-fill="yes"]')
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
