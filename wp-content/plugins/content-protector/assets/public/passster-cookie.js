(function ($) {

    function escapeRegExp(str) {
        return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
    }

    $(document).ready(function () {

        let cookieName = 'passster';

        $('#passster_password').on("input", function () {
            passster_pwd = $(this).val();

        });

        $('#passster_submit').click(function () {
            cookie.remove(cookieName);

            let sanitized = escapeRegExp(passster_pwd);

            cookie.set(cookieName, sanitized, {
                expires: parseInt(passster_cookie['days']), // Expires in 999 days
                path: '/',
            });

        });
    });


}(jQuery));