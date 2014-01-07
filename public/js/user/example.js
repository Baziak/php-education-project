$(document).ready(function () {
    $('.password-condition').hide();
    $('.password-input').bind('focus', function () {
        $('.password-condition').show('slow');
    });
    $('.password-input').bind('blur', function () {
        $('.password-condition').hide('slow');
    });

    $('img.avatar').bind('click', function () {
        var darkDiv = $('<div></div>').addClass('loading');
        $('div.user-profile').append(darkDiv);
        var src = $(this).attr('src');
        $('body').append("<img src='"+src+"' class='centreImg'>");
        $('.closeAvatar').show();
    });

    $('img.closeAvatar').bind('click', function() {
        $('.loading').remove();
        $('.centreImg').remove();
        $('.closeAvatar').hide();
    });
});