(function ($) {
    $(document).ready(function () {
        $(".nav-tabs").on("click", "li", function (e) {
            $(this).parent().find('li').removeClass('active');
            $(this).addClass('active');
        });
    });
})(jQuery);