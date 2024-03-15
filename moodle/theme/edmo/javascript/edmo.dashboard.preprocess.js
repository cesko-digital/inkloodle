(function($) {
    $(document).ready(function() {
      // Custom Select Search w/ Icons
      $("div[id$='edmo_icon_class'], div[id^='edmo_icon_class'], .edmo_icon_class").each(function() {
        $(this).find(".custom-select").each(function() {
          $(this).wrap("<div class='ui_kit_select_search'></div>");
          $(this).find("option").each(function() {
            var $edmoIcon = $(this).attr("value");
            $(this).attr("data-tokens", $edmoIcon).attr("data-icon", $edmoIcon).attr("data-subtext", $edmoIcon);
          });
          $(this).addClass("selectpicker").attr("data-live-search", "true").attr("data-width", "100%").removeClass("custom-select");
        });
      });
    });

  }(jQuery));
