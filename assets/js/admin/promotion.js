(function ($, _, window) {
  "use strict";

  // Handle Pro Widget Promotion Modal (Following Essential Addons pattern)
  elementor.on("panel:init", function () {
    if (typeof parent.document === "undefined") {
      return;
    }

    parent.document.addEventListener("mousedown", function (e) {
      const widgets = parent.document.querySelectorAll(
        ".elementor-element--promotion"
      );

      if (widgets.length === 0) {
        return;
      }

      for (let i = 0; i < widgets.length; i++) {
        if (widgets[i].contains(e.target)) {
          const dialog = parent.document.querySelector(
            "#elementor-element--promotion__dialog"
          );
          if (!dialog) {
            continue;
          }

          const icon = widgets[i].querySelector(".icon > i");
          const defaultButton = dialog.querySelector(
            "button.elementor-button.go-pro.dialog-button.dialog-action.dialog-buttons-action"
          );
          let maButton = dialog.querySelector(".ma-dialog-buttons-action");

          // Check if the widget belongs to Marquee Addons by its icon class.
          if (icon && icon.classList.toString().includes("deensimc-pro")) {
            // It's a Marquee widget.
            e.stopImmediatePropagation();

            // Hide default button.
            if (defaultButton) {
              defaultButton.style.display = "none";
              console.log(defaultButton);
            }

            // Create or show the Marquee button.
            if (!maButton) {
              maButton = document.createElement("a");
              maButton.textContent = "Upgrade to Marquee Addons Pro";
              maButton.setAttribute(
                "href",
                "https://marqueeaddons.com/pricing/"
              );
              maButton.setAttribute("target", "_blank");
              maButton.classList.add(
                "dialog-button",
                "dialog-action",
                "dialog-buttons-action",
                "elementor-button",
                "go-pro",
                "elementor-button-success",
                "ma-dialog-buttons-action"
              );

              if (defaultButton) {
                defaultButton.insertAdjacentElement("afterend", maButton);
              } else {
                dialog.querySelector(".dialog-buttons").appendChild(maButton);
              }
            }

            maButton.style.display = "block";
          } else {
            // It's not a Marquee widget, so ensure our button is hidden and the default is shown.
            console.log(defaultButton);
            if (defaultButton) {
              defaultButton.style.display = "block";
            }

            if (maButton) {
              maButton.style.display = "none";
            }
          }

          // We found the clicked widget, so stop the loop.
          break;
        }
      }
    });
  });
})(jQuery, window._, window);
