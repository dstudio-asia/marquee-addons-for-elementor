(function($) {
    $(window).on("elementor/editor/init", function() {
        // 1. Handle widget dragging
        elementor.hooks.addFilter('elementor/editor/widget/drag', function(shouldDrag, widgetModel) {
            alert(shouldDrag+" "+widgetModel);
            const widgetType = widgetModel.attributes.widgetType;
            const proData = window.deensimcProData && window.deensimcProData[widgetType];
            
            if (proData && !proData.isProActive) {
                elementor.promotion.show({
                    title: proData.promotion.title,
                    content: proData.promotion.content,
                    actionButton: {
                        text: proData.promotion.upgrade_text,
                        url: proData.promotion.upgrade_url,
                        action: function() {
                            // Optional: Add tracking or special handling
                        }
                    }
                });
                return false;
            }
            return shouldDrag;
        });
        
        // 2. Handle widget panel clicks
        elementor.hooks.addAction('panel/open_editor/widget', function(panel, model) {
            const widgetType = model.attributes.widgetType;
            const proData = window.deensimcProData && window.deensimcProData[widgetType];
            
            if (proData && !proData.isProActive) {
                elementor.promotion.show({
                    title: proData.promotion.title,
                    content: proData.promotion.content,
                    actionButton: {
                        text: proData.promotion.upgrade_text,
                        url: proData.promotion.upgrade_url,
                        action: function() {
                            // Optional: Add tracking or special handling
                        }
                    }
                });
                
                // Prevent default panel behavior
                setTimeout(() => panel.close(), 10);
                return false;
            }
        });
        
        // 3. Add CSS class to Pro widgets
        elementor.hooks.addFilter('elementor/editor/widget/attributes', function(attributes, widgetModel) {
            const widgetType = widgetModel.attributes.widgetType;
            const proData = window.deensimcProData && window.deensimcProData[widgetType];
            
            if (proData && !proData.isProActive) {
                attributes.classes = (attributes.classes || '') + ' deensimc-pro-widget-locked';
            }
            return attributes;
        });
    });
})(jQuery);