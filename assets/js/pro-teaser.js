// assets/js/pro-teaser.js
(function($) {
    $(window).on('elementor:init', function() {
        // 1. Prevent dragging Pro widgets
        elementor.hooks.addFilter('elementor/editor/widget/drag', function(shouldDrag, widgetModel) {
            const widgetType = widgetModel.attributes.widgetType;
            const proData = window['deensimcProData_' + widgetType];
            
            if (proData && !proData.isProActive) {
                // Show promotion modal
                elementor.promotion.show({
                    title: proData.promotion.title,
                    content: proData.promotion.content,
                    actionButton: {
                        text: proData.promotion.upgrade_text,
                        url: proData.promotion.upgrade_url
                    }
                });
                
                // Prevent dragging
                return false;
            }
            
            return shouldDrag;
        });
        
        // 2. Handle widget panel clicks
        elementor.hooks.addAction('panel/open_editor/widget', function(panel, model) {
            const widgetType = model.attributes.widgetType;
            const proData = window['deensimcProData_' + widgetType];
            
            if (proData && !proData.isProActive) {
                elementor.promotion.show({
                    title: proData.promotion.title,
                    content: proData.promotion.content,
                    actionButton: {
                        text: proData.promotion.upgrade_text,
                        url: proData.promotion.upgrade_url
                    }
                });
                
                // Close the widget panel immediately
                panel.setPage('promotion').open();
                return false;
            }
        });
        
        // 3. Add CSS class to Pro widgets in the panel
        elementor.hooks.addFilter('elementor/editor/widget/attributes', function(attributes, widgetModel) {
            const widgetType = widgetModel.attributes.widgetType;
            const proData = window['deensimcProData_' + widgetType];
            
            if (proData && !proData.isProActive) {
                attributes.classes += ' deensimc-pro-widget-locked';
            }
            
            return attributes;
        });
    });
})(jQuery);