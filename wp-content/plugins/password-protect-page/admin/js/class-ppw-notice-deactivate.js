(function ($) {
    'use strict';
    $(function () {
        $('a[aria-label="Deactivate Password Protect WordPress Lite"]').click(function () {
            var message = ppw_deactivate_data.is_active_pro
                ? 'Password Protect WordPress will not working and all your password-protected content will become public once you deactivate our plugin. Are you sure you want to deactivate it?'
                : 'All your previously password protected pages and posts will become public once you deactivate our plugin. Are you sure you want to deactivate Password Protect WordPress Lite Plugin?';
            if (!confirm(message)) {
                return false;
            }
        });
    });
})(jQuery);
