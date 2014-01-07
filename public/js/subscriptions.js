/**
 * Created by student on 12/17/13.
 */
(function ($) {
    $(document).ready(function () {
        $('.unsub').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/subscriptions/subscriptions/unsubscribefromuser',
                type: 'POST',
                data: {'targetId': $(this).data('unsubid')},
                success: function () {
                    location.reload();
                }
            });
        });
    });
})(jQuery);
(function ($) {
    $(document).ready(function () {
        $('.sub').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/subscriptions/subscriptions/subscribefromuser',
                type: 'POST',
                data: {'targetId': $(this).data('subid')},
                success: function () {
                    location.reload();
                }
            });
        });
    });
})(jQuery);