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

    // Toggle Label Update and Form Submission
    $(".deensimc-switch input").on("change", function () {
      setTimeout(() => {
        $("#submit").click();
        $(".deensimc-widget-card").css({
          opacity: "0.5",
          "pointer-events": "none",
        });
      }, 100);
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


    const jsonCache = new Map();

    function showToast(message, isError = false) {
        let toast = document.querySelector('.deensimc-toast');
        if (!toast) {
            toast = document.createElement('div');
            toast.className = 'deensimc-toast';
            document.body.appendChild(toast);
        }
        toast.textContent = message;
        toast.style.backgroundColor = isError ? '#dc2626' : '#1e293b';
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2000);
    }

    async function copyToClipboard(text, button) {
        try {
            await navigator.clipboard.writeText(text);
            // Show "Copied!" on button, then revert after 1.5s
            const originalText = button.getAttribute('data-original-text') || 'Copy JSON';
            button.textContent = '✓ Copied!';
            button.classList.add('copied');
            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('copied');
                button.disabled = false;
            }, 1500);
            showToast('✅ Template copied to clipboard');
        } catch (err) {
            // Fallback
            const textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            const originalText = button.getAttribute('data-original-text') || 'Copy JSON';
            button.textContent = '✓ Copied!';
            button.classList.add('copied');
            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('copied');
                button.disabled = false;
            }, 1500);
            showToast('📋 Copied (fallback)');
        }
    }

    async function fetchTemplateJson(templateId, nonce, button) {
        const originalText = button.textContent;
        button.setAttribute('data-original-text', originalText);
        button.textContent = '⏳ Loading...';
        button.disabled = true;

        try {
            const ajaxUrl = (typeof ajaxurl !== 'undefined') ? ajaxurl : '/wp-admin/admin-ajax.php';
            const response = await fetch(ajaxUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    action: 'deensimc_get_template_json',
                    template_id: templateId,
                    nonce: nonce
                })
            });
            const data = await response.json();
            if (data.success) {
                jsonCache.set(templateId, data.data);
                await copyToClipboard(data.data, button);
            } else {
                showToast('❌ ' + (data.data || 'Failed to load template'), true);
                button.textContent = originalText;
                button.disabled = false;
            }
        } catch (error) {
            console.error('AJAX error:', error);
            showToast('❌ Network error. Please try again.', true);
            button.textContent = originalText;
            button.disabled = false;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const copyButtons = document.querySelectorAll('.deensimc-btn-copy');
        copyButtons.forEach(button => {
            button.addEventListener('click', async function(e) {
                e.preventDefault();
                const card = this.closest('.deensimc-card');
                if (!card) {
                    showToast('❌ Template card not found', true);
                    return;
                }
                const templateId = card.getAttribute('data-template-id');
                const nonce = this.getAttribute('data-nonce');
                if (!templateId || !nonce) {
                    showToast('❌ Missing template ID or nonce', true);
                    return;
                }
                if (jsonCache.has(templateId)) {
                    await copyToClipboard(jsonCache.get(templateId), this);
                } else {
                    await fetchTemplateJson(templateId, nonce, this);
                }
            });
        });
    });

})(jQuery);
