/**
 * Marquee Addons Admin JavaScript
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Tab Switching
        $('.marquee-tab-btn').on('click', function() {
            const tabId = $(this).data('tab');
            
            // Update active tab button
            $('.marquee-tab-btn').removeClass('active');
            $(this).addClass('active');
            
            // Update active tab content
            $('.marquee-tab-content').removeClass('active');
            $('#tab-' + tabId).addClass('active');
        });

        // Enable All Widgets
        $('#enable-all').on('click', function() {
            $('.marquee-widget-card input[type="checkbox"]').each(function() {
                // Only enable non-PRO widgets or if not disabled
                if (!$(this).is(':disabled')) {
                    $(this).prop('checked', true).trigger('change');
                }
            });
            showNotification('All available widgets enabled', 'success');
        });

        // Disable All Widgets
        $('#disable-all').on('click', function() {
            $('.marquee-widget-card input[type="checkbox"]').each(function() {
                // Only disable non-PRO locked widgets
                if (!$(this).is(':disabled')) {
                    $(this).prop('checked', false).trigger('change');
                }
            });
            showNotification('All available widgets disabled', 'info');
        });

        // Toggle Label Update
        $('.marquee-switch input').on('change', function() {
            // Skip if disabled (PRO locked)
            if ($(this).is(':disabled')) {
                return;
            }
            
            const label = $(this).closest('.widget-toggle').find('.toggle-label');
            
            if ($(this).is(':checked')) {
                label.text('Enabled').css('color', '#00a32a');
            } else {
                label.text('Disabled').css('color', '#d63638');
            }
        });

        // Initialize toggle labels
        $('.marquee-switch input').each(function() {
            const label = $(this).closest('.widget-toggle').find('.toggle-label');
            
            // If disabled (PRO locked), keep the locked label
            if ($(this).is(':disabled')) {
                label.text('Disabled').css('color', '#856404');
                return;
            }
            
            if ($(this).is(':checked')) {
                label.css('color', '#00a32a');
            } else {
                label.text('Disabled').css('color', '#d63638');
            }
        });

        // Form Submit Handler
        $('form').on('submit', function() {
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true).text('Saving...');
            
            // Re-enable after a delay (WordPress will handle the actual save)
            setTimeout(function() {
                submitBtn.prop('disabled', false).text('Save Changes');
            }, 2000);
        });

        // Search/Filter Widgets (Optional Enhancement)
        let searchTimeout;
        
        // Add search box dynamically if needed
        const addSearchBox = function() {
            if ($('#widget-search').length === 0) {
                const searchHtml = `
                    <div style="margin-bottom: 20px;">
                        <input 
                            type="text" 
                            id="widget-search" 
                            class="regular-text" 
                            placeholder="Search widgets..."
                            style="width: 300px;"
                        >
                    </div>
                `;
                $('.marquee-widgets-grid').before(searchHtml);
                
                // Search functionality
                $('#widget-search').on('keyup', function() {
                    clearTimeout(searchTimeout);
                    const searchTerm = $(this).val().toLowerCase();
                    
                    searchTimeout = setTimeout(function() {
                        if (searchTerm === '') {
                            $('.marquee-widget-card').show();
                        } else {
                            $('.marquee-widget-card').each(function() {
                                const title = $(this).find('h3').text().toLowerCase();
                                const description = $(this).find('.widget-description').text().toLowerCase();
                                
                                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                                    $(this).show();
                                } else {
                                    $(this).hide();
                                }
                            });
                        }
                    }, 300);
                });
            }
        };
        
        // Uncomment to enable search box
        // addSearchBox();

        // Widget Count Display
        const updateWidgetCount = function() {
            const totalWidgets = $('.marquee-widget-card').length;
            const enabledWidgets = $('.marquee-widget-card input:checked:not(:disabled)').length;
            const availableWidgets = $('.marquee-widget-card input:not(:disabled)').length;
            
            if ($('#widget-count').length === 0) {
                const countHtml = `
                    <div id="widget-count" style="margin-top: 15px; color: #646970; font-size: 13px;">
                        <strong>${enabledWidgets}</strong> of <strong>${availableWidgets}</strong> available widgets enabled
                    </div>
                `;
                $('.marquee-bulk-actions').after(countHtml);
            } else {
                $('#widget-count').html(
                    `<strong>${enabledWidgets}</strong> of <strong>${availableWidgets}</strong> available widgets enabled`
                );
            }
        };
        
        // Update count on page load
        updateWidgetCount();
        
        // Update count when toggles change
        $('.marquee-widget-card input').on('change', updateWidgetCount);

        // Keyboard Shortcuts
        $(document).on('keydown', function(e) {
            // Ctrl/Cmd + S to save
            if ((e.ctrlKey || e.metaKey) && e.which === 83) {
                e.preventDefault();
                $('form').submit();
            }
        });

        // Smooth Scroll to Section
        const scrollToSection = function(sectionId) {
            const section = $('#' + sectionId);
            if (section.length) {
                $('html, body').animate({
                    scrollTop: section.offset().top - 50
                }, 500);
            }
        };

        // Handle URL hash for deep linking
        if (window.location.hash) {
            const hash = window.location.hash.substring(1);
            if (hash === 'widgets' || hash === 'general') {
                $('.marquee-tab-btn[data-tab="' + hash + '"]').click();
            }
        }

        // Update URL hash on tab change
        $('.marquee-tab-btn').on('click', function() {
            const tabId = $(this).data('tab');
            window.location.hash = tabId;
        });

        /**
         * Show notification message
         */
        function showNotification(message, type) {
            type = type || 'success';
            
            // Remove existing notifications
            $('.marquee-notice').remove();
            
            const noticeClass = type === 'error' ? 'marquee-notice error' : 'marquee-notice';
            const notice = $('<div class="' + noticeClass + '">' + message + '</div>');
            
            $('.marquee-settings-container').prepend(notice);
            
            // Auto-hide after 3 seconds
            setTimeout(function() {
                notice.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 3000);
        }

        // Add loading state during save
        $('form').on('submit', function() {
            $('.marquee-settings-container').addClass('marquee-loading');
        });

        // Confirm before leaving with unsaved changes
        let formChanged = false;
        
        $('form input, form select, form textarea').on('change', function() {
            formChanged = true;
        });
        
        $('form').on('submit', function() {
            formChanged = false;
        });
        
        $(window).on('beforeunload', function() {
            if (formChanged) {
                return 'You have unsaved changes. Are you sure you want to leave?';
            }
        });

    });

})(jQuery);