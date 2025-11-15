(function ($, _, window) {
  "use strict";
  window.MarqueeAddonsEditor = window.MarqueeAddonsEditor || {};

  if (typeof window.MarqueeAddonsEditor.getTranslated === "undefined") {
    window.MarqueeAddonsEditor.getTranslated = function (
      stringKey,
      templateArgs
    ) {
      return elementorCommon.translate(
        stringKey,
        null,
        templateArgs,
        window.MarqueeAddonsEditor.i18n
      );
    };
  }

  if (typeof elementor !== "undefined" && elementor.hooks) {
    elementor.hooks.addFilter(
      "panel/elements/regionViews",
      function (regionViews) {
        const MAE = window.MarqueeAddonsEditor;
        if (!MAE || MAE.hasPro || _.isEmpty(MAE.placeholder_widgets)) {
          return regionViews;
        }

        const CATEGORY_NAME = "marquee_addons_pro";
        const prevElementsView = regionViews.elements.view;
        const prevCategoriesView = regionViews.categories.view;
        const elementsCollection = regionViews.elements.options.collection;
        const categoriesCollection = regionViews.categories.options.collection;

        _.each(MAE.placeholder_widgets, function (widget, name) {
          elementsCollection.add({
            name: "ma-" + name,
            title: widget.title,
            icon: widget.icon,
            categories: [CATEGORY_NAME],
            editable: false,
          });
        });

        const proWidgets = elementsCollection.filter(function (el) {
          return (el.get("categories") || [])[0] === CATEGORY_NAME;
        });

        const freeCategoryIndex = categoriesCollection.findIndex({
          name: "deensimc_smooth_marquee",
        });

        if (freeCategoryIndex >= 0) {
          categoriesCollection.add(
            {
              name: CATEGORY_NAME,
              title: "Marquee Addons Pro",
              defaultActive: false,
              sort: true,
              hideIfEmpty: true,
              items: proWidgets,
            },
            { at: freeCategoryIndex + 1 }
          );
        }

        // ✅ Protect from double extension
        if (prevElementsView.__MAExtended) return regionViews;

        const BaseElementChildView = prevElementsView.prototype.childView;
        const BaseCategoryChildView = prevCategoriesView.prototype.childView;

        const ElementViewExtension = {
          className: function () {
            let baseClassName = "";
            const proto = Object.getPrototypeOf(this);
            if (proto && proto.className) {
              try {
                baseClassName = proto.className.call(this);
              } catch (err) {
                baseClassName = "";
              }
            }

            if (!this.isEditable?.() && this.isMAWidget?.()) {
              baseClassName += " ma-element--promotion";
            }
            return baseClassName.trim();
          },

          isMAWidget: function () {
            const name = this.model?.get("name");
            return name && name.startsWith("ma-");
          },

          onMouseDown: function (evt) {
            if (!this.isMAWidget?.()) {
              const proto = Object.getPrototypeOf(this);
              if (proto && proto.onMouseDown) {
                return proto.onMouseDown.call(this, evt);
              }
              return;
            }

            elementor.promotion.showDialog({
              title: MAE.getTranslated("promotionDialogHeader", [
                this.model.get("title"),
              ]),
              content: MAE.getTranslated("promotionDialogMessage", [
                this.model.get("title"),
              ]),
              targetElement: this.el,
              position: { blockStart: "-7" },
              actionButton: {
                url: "https://marqueeaddons.com/pricing",
                text: MAE.i18n?.promotionDialogBtnTxt || "Get Pro",
                classes: ["elementor-button", "go-pro"],
              },
            });
          },
        };

        regionViews.elements.view = prevElementsView.extend({
          childView: BaseElementChildView.extend(ElementViewExtension),
        });

        regionViews.elements.view.__MAExtended = true;

        const NestedCategoryChildView =
          BaseCategoryChildView?.prototype?.childView || null;

        if (NestedCategoryChildView) {
          const ExtendedCategoryChild = BaseCategoryChildView.extend({
            childView: NestedCategoryChildView.extend(ElementViewExtension),
          });

          regionViews.categories.view = prevCategoriesView.extend({
            childView: ExtendedCategoryChild,
          });
        }

        return regionViews;
      }
    );
  }
})(jQuery, window._, window);
