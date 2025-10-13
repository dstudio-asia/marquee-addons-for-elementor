(function($){
    $(function () {
        var $document = $(document),
            $deactivationPopUp = $('.deensimc-deactivation-popup'),
            plugin_slug = 'marquee-addons-for-elementor';

        if ($deactivationPopUp.length < 1)
            return;

        // Get the deactivate link
        var plugin_deactivate_link = $('tr[data-slug="' + plugin_slug + '"] .deactivate a').attr('href');

        // Open modal when deactivate link is clicked
        $(document).on('click', 'tr[data-slug="' + plugin_slug + '"] .deactivate a', function (event) {
            event.preventDefault();
            $deactivationPopUp.removeClass('deensimc-hidden');
            $('body').addClass('deensimc-modal-open');
        });

        // Close modal
        $document.on('click', '.deensimc-deactivation-popup .deensimc-close, .deensimc-deactivation-popup .dashicons, .deensimc-deactivation-popup', function (event) {
            if (this === event.target) {
                $deactivationPopUp.addClass('deensimc-hidden');
                $('body').removeClass('deensimc-modal-open');
            }
        });

        // Handle radio button changes
        $document.on('change', '.deensimc-deactivation-popup .deensimc-radio', function () {
            var $this = $(this);
            var value = $this.val();
            var name = $this.attr('name');

            value = typeof value === 'string' && value !== '' ? value : undefined;
            name = typeof name === 'string' && name !== '' ? name : undefined;

            if (value === undefined || name === undefined) {
                return;
            }

            var $targetedMessage = $('p[data-' + name + '="' + value + '"]'),
                $relatedSections = $this.parents('.deensimc-body').find('div[data-' + name + ']'),
                $relatedMessages = $this.parents('.deensimc-body').find('p[data-' + name + ']:not(p[data-' + name + '="' + value + '"])');

            $relatedMessages.addClass('deensimc-hidden');
            $targetedMessage.removeClass('deensimc-hidden');
            $relatedSections.removeClass('deensimc-hidden');
        });

        // Handle Skip & Deactivate button
        $document.on('click', '.deensimc-deactivation-popup .deensimc-skip-btn', function (event) {
            event.preventDefault();
            
            // Simply redirect to deactivation URL without sending feedback
            if (plugin_deactivate_link) {
                window.location.href = plugin_deactivate_link;
            }
        });

        // Handle Submit & Deactivate button
        $document.on('click', '.deensimc-deactivation-popup .deensimc-submit-btn', function (event) {
            event.preventDefault();

            var $this = $(this),
                $body = $this.parents('.deensimc-body'),
                $selectedReason = $body.find('.deensimc-radio:checked'),
                $suggestionsField = $body.find('.deensimc-textarea'),
                $anonymousCheckbox = $body.find('.deensimc-checkbox');

            var reason = $selectedReason.length ? $selectedReason.val() : 'other';
            var message = $suggestionsField.length ? $suggestionsField.val().trim() : 'N/A';
            var anonymous = $anonymousCheckbox.is(':checked');

            // Submit feedback
            $.ajax({
                url: ajaxurl,
                method: 'POST',
                data: {
                    'action': plugin_slug + '_deensimc_submit_deactivation_response',
                    '_wpnonce': deensimc_ajax.nonce,
                    'reason': reason,
                    'message': message,
                    'anonymous': anonymous ? '1' : '0'
                },
                beforeSend: function () {
                    $this.prop('disabled', true).text('Deactivating...');
                    $('.deensimc-skip-btn').prop('disabled', true);
                },
                success: function(response) {
                    if (plugin_deactivate_link) {
                        window.location.href = plugin_deactivate_link;
                    }
                },
                error: function(error) {
                    if (plugin_deactivate_link) {
                        window.location.href = plugin_deactivate_link;
                    }
                }
            });
        });

    });
})(jQuery);