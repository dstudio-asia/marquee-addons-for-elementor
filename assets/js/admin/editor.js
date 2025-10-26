(function ($, _) {
  "use strict";
  window.haGetTranslated = function (stringKey, templateArgs) {
    return elementorCommon.translate(
      stringKey,
      null,
      templateArgs,
      MarqueeAddonsEditor.i18n
    );
  };

  if (typeof elementor !== "undefined" && elementor.hooks) {
    elementor.hooks.addFilter(
      "panel/elements/regionViews",
      function (regionViews) {
        console.log({ MarqueeAddonsEditor });
        console.log({ regionViews });
        if (
          MarqueeAddonsEditor.hasPro ||
          _.isEmpty(MarqueeAddonsEditor.placeholder_widgets)
        ) {
          return regionViews;
        }
        var CATEGORY_NAME = "marquee_addons_pro",
          elementsView = regionViews.elements.view,
          categoriesView = regionViews.categories.view,
          elementsCollection = regionViews.elements.options.collection,
          categoriesCollection = regionViews.categories.options.collection,
          proWidgets = [],
          ElementView,
          freeCategoryIndex;
        _.each(
          MarqueeAddonsEditor.placeholder_widgets,
          function (widget, name) {
            elementsCollection.add({
              name: "ha-" + name,
              title: widget.title,
              icon: widget.icon,
              categories: [CATEGORY_NAME],
              editable: false,
            });
          }
        );
        elementsCollection.each(function (element) {
          if (element.get("categories")[0] === CATEGORY_NAME) {
            proWidgets.push(element);
          }
        });
        freeCategoryIndex = categoriesCollection.findIndex({
          name: "happy_addons_category",
        });
        if (freeCategoryIndex) {
          categoriesCollection.add(
            {
              name: "marquee_addons_pro",
              title: "Happy Addons Pro",
              icon: "hm hm-happyaddons",
              defaultActive: false,
              sort: true,
              hideIfEmpty: true,
              items: proWidgets,
              promotion: false,
            },
            {
              at: freeCategoryIndex + 1,
            }
          );
        }
        ElementView = {
          className: function className() {
            var className = this.constructor.__super__.className.call(this);
            if (!this.isEditable() && this.isHappyWidget()) {
              className += " ha-element--promotion";
            }
            return className;
          },
          isHappyWidget: function isHappyWidget() {
            var widgetName = this.model.get("name");
            return widgetName != undefined && widgetName.indexOf("ha-") === 0;
          },
          onMouseDown: function onMouseDown() {
            if (!this.isHappyWidget()) {
              this.constructor.__super__.onMouseDown.call(this);
              return;
            }
            elementor.promotion.showDialog({
              title: haGetTranslated("promotionDialogHeader", [
                this.model.get("title"),
              ]),
              content: haGetTranslated("promotionDialogMessage", [
                this.model.get("title"),
              ]),
              targetElement: this.el,
              position: {
                blockStart: "-7",
              },
              actionButton: {
                url: "https://marqueeaddons.com/pricing/?utm_source=ma-editor-pro-widgets&utm_medium=wp-elementor-editor&utm_campaign=ma-upgrade-pro",
                text: MarqueeAddonsEditor.i18n.promotionDialogBtnTxt,
                classes: ["elementor-button", "ha-btn--promotion", "go-pro"],
              },
            });
          },
        };
        regionViews.elements.view = elementsView.extend({
          childView: elementsView.prototype.childView.extend(ElementView),
        });
        regionViews.categories.view = categoriesView.extend({
          childView: categoriesView.prototype.childView.extend({
            childView:
              categoriesView.prototype.childView.prototype.childView.extend(
                ElementView
              ),
          }),
        });
        return regionViews;
      }
    );
  }
})(jQuery, window._);
