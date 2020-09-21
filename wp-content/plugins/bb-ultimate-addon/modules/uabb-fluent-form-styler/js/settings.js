(function ($) {
    FLBuilder.registerModuleHelper("uabb-fluent-form-styler", {
        init: function () {
            var form = $(".fl-builder-settings");
            this._hideDocs();
        },
        _hideDocs: function () {
            var form = $(".fl-builder-settings"),
                branding_selector = form.find(
                    "#fl-field-uabb_helpful_information .uabb-docs-list"
                );
            settings_tab = form.find(".fl-builder-settings-tabs");
            settings_tab_links = settings_tab.find("a");
            $(settings_tab_links).each(function () {
                if ("#fl-builder-settings-tab-uabb_docs" === $(this).attr("href")) {
                    if ("yes" === branding_selector.data("branding")) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                }
            });
        },
    });
})(jQuery);