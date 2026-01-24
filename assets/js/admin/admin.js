/**
 * Marquee Addons Admin JavaScript
 */
(function ($) {
  "use strict";

  /**
   *Helper function to show notification message
   */
  function showNotification(message, type = "info") {
    // Remove existing notifications
    $(".deensimc-notice").remove();

    const noticeClass = `deensimc-notice ${type}`;

    const notice = $('<div class="' + noticeClass + '">' + message + "</div>");

    $("body").prepend(notice);

    // Auto-hide after 3 seconds
    setTimeout(function () {
      notice.fadeOut(300, function () {
        $(this).remove();
      });
    }, 3000);
  }

  // Expose the notification function to the window object
  window.marqueeAddonsAdmin = window.marqueeAddonsAdmin || {};
  window.marqueeAddonsAdmin.showNotification = showNotification;

  $(document).ready(function () {
    $(".deensimc-see-demo-btn").on("click", function (e) {
      e.stopPropagation();
    });
    // Tab Switching
    $(".deensimc-tab-btn").on("click", function () {
      const tabId = $(this).data("tab");

      // Update active tab button
      $(".deensimc-tab-btn").removeClass("active");
      $(this).addClass("active");

      // Update active tab content
      $(".deensimc-tab-content").removeClass("active");
      $("#tab-" + tabId).addClass("active");
    });

    // PRO Widget Click - Redirect to upgrade page
    $(".deensimc-widget-card").on("click", function (e) {
      const $card = $(this);

      // Only handle PRO locked cards
      if (!$card.hasClass("deensimc-pro-locked")) {
        return;
      }

      // Don't redirect if clicking on the toggle/checkbox area
      const $target = $(e.target);
      if (
        $target.closest(".deensimc-widget-toggle").length > 0 ||
        $target.is("input") ||
        $target.is("label") ||
        $target.hasClass("deensimc-slider") ||
        $target.hasClass("deensimc-toggle-label")
      ) {
        return;
      }

      const proUrl = $card.attr("data-pro-url");

      if (proUrl && proUrl !== "" && proUrl !== "undefined") {
        window.open(proUrl, "_blank");
      } else {
      }
    });

    // Add visual feedback for PRO cards
    $(".deensimc-widget-card.pro-locked")
      .css({
        cursor: "pointer",
        transition: "all 0.3s ease",
      })
      .attr("title", "Click to upgrade to PRO");

    // Enhanced hover effect
    $(".deensimc-widget-card.pro-locked").hover(
      function () {
        $(this).css("transform", "translateY(-2px)");
      },
      function () {
        $(this).css("transform", "translateY(0)");
      },
    );

    // Prevent toggle clicks from bubbling
    $(".deensimc-widget-card.pro-locked .deensimc-widget-toggle").on(
      "click",
      function (e) {
        e.stopPropagation();
      },
    );

    // Enable All Widgets
    $("#enable-all").on("click", function () {
      $('.deensimc-widget-card input[type="checkbox"]').each(function () {
        // Only enable non-PRO widgets or if not disabled
        if (!$(this).is(":disabled")) {
          $(this).prop("checked", true).trigger("change");
        }
      });
      showNotification("All available widgets are enabled now", "success");
    });

    // Disable All Widgets
    $("#disable-all").on("click", function () {
      $('.deensimc-widget-card input[type="checkbox"]').each(function () {
        if (!$(this).is(":disabled")) {
          $(this).prop("checked", false).trigger("change");
        }
      });
      showNotification("All available widgets are disabled now!", "info");
    });

    // Toggle Label Update
    $(".deensimc-switch input").on("change", function () {
      if ($(this).is(":disabled")) {
        return;
      }

      const label = $(this)
        .closest(".deensimc-widget-toggle")
        .find(".deensimc-toggle-label");

      if ($(this).is(":checked")) {
        label.text("Enabled").css("color", "#00a32a");
      } else {
        label.text("Disabled").css("color", "#d63638");
      }
    });

    // Initialize toggle labels
    $(".deensimc-switch input").each(function () {
      const label = $(this)
        .closest(".deensimc-widget-toggle")
        .find(".deensimc-toggle-label");

      // If disabled (PRO locked), keep the locked label
      if ($(this).is(":disabled")) {
        label.text("Locked").css("color", "#856404");
        return;
      }

      if ($(this).is(":checked")) {
        label.css("color", "#00a32a");
      } else {
        label.text("Disabled").css("color", "#d63638");
      }
    });

    // Form Submit Handler
    $(".deensimc-addons-settings form").on("submit", function (e) {
      const submitBtn = $(this).find("#submit");
      submitBtn.prop("disabled", true).val("Saving...");
    });

    // Check for success parameter in URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("settings-updated") === "true") {
      showNotification("Settings saved successfully!", "success");

      // Remove the parameter from URL without reload
      const newUrl =
        window.location.pathname +
        window.location.search
          .replace(/[?&]settings-updated=true/, "")
          .replace(/^&/, "?");
      window.history.replaceState({}, "", newUrl || window.location.pathname);
    }

    // Widget Count Display
    const updateWidgetCount = function () {
      const enabledWidgets = $(
        ".deensimc-widget-card input:checked:not(:disabled)",
      ).length;
      const availableWidgets = $(".deensimc-widget-card").length;

      if ($("#widget-count").length === 0) {
        const countHtml = `
                    <div id="widget-count" style="margin-top: 15px; color: #646970; font-size: 13px;">
                        <strong>${enabledWidgets}</strong> of <strong>${availableWidgets}</strong> available widgets enabled
                    </div>
                `;
        $(".deensimc-description").after(countHtml);
      } else {
        $("#widget-count").html(
          `<strong>${enabledWidgets}</strong> of <strong>${availableWidgets}</strong> available widgets enabled`,
        );
      }
    };

    // Update count on page load
    updateWidgetCount();

    // Update count when toggles change
    $(".deensimc-widget-card input").on("change", updateWidgetCount);

    // Keyboard Shortcuts
    $(document).on("keydown", function (e) {
      // Ctrl/Cmd + S to save
      if ((e.ctrlKey || e.metaKey) && e.which === 83) {
        e.preventDefault();
        $("form").submit();
      }
    });

    // Handle URL hash for deep linking
    if (window.location.hash) {
      const hash = window.location.hash.substring(1);
      if (hash === "widgets" || hash === "general") {
        $('.deensimc-tab-btn[data-tab="' + hash + '"]').click();
      }
    }

    // Update URL hash on tab change
    $(".deensimc-tab-btn").on("click", function () {
      const tabId = $(this).data("tab");
      window.location.hash = tabId;
    });

    // Add loading state during save
    $("form").on("submit", function () {
      $(".deensimc-settings-container").addClass("deensimc-loading");
    });

    // Confirm before leaving with unsaved changes
    let formChanged = false;

    $("form input, form select, form textarea").on("change", function () {
      formChanged = true;
    });

    $("form").on("submit", function () {
      formChanged = false;
    });

    $(window).on("beforeunload", function () {
      if (formChanged) {
        return "You have unsaved changes. Are you sure you want to leave?";
      }
    });
  });

  $(".deensimc-enable-category").on("click", function () {
    const category = $(this).data("category");
    $(
      `.deensimc-widget-card[data-category="${category}"] input[type="checkbox"]`,
    ).each(function () {
      if (!$(this).is(":disabled")) {
        $(this).prop("checked", true).trigger("change");
      }
    });
    showNotification(`All ${category} items enabled successfully!`, "success");
  });

  $(".deensimc-disable-category").on("click", function () {
    const category = $(this).data("category");
    $(
      `.deensimc-widget-card[data-category="${category}"] input[type="checkbox"]`,
    ).each(function () {
      if (!$(this).is(":disabled")) {
        $(this).prop("checked", false).trigger("change");
      }
    });
    showNotification(`All ${category} items disabled successfully!`, "info");
  });
})(jQuery);
