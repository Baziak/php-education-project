/*urlMemes=window.urlMemes;
window.alert('url='+urlMemes);*/
$(document).ready(function(){
    var inProgress = false;
    var startFrom = 2;
    var urlMemes=window.urlMemes;
    var urlButtons=window.urlButtons;
    var action=window.action;
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height() - 200 && !inProgress) {
            $.ajax({
                url: urlMemes,
                method: 'POST',
                data: {'startFrom' : startFrom,'action':action},
                beforeSend: function() {
                    inProgress = true;}
            }).done(function(data){
                    $(data).insertAfter('.nextMeme:last-child');
                    inProgress = false;
                    startFrom += 2;
                });
        }
    });
    $(document).on('click','button',function() {
        var buttonName=$(this).attr('name');
        var buttonValue=$(this).attr('value');
        var divId=$('div .rating').attr('id');
        if (!inProgress){
        $.ajax({
            url: urlButtons,
            method: 'POST',
            data: {'buttonName' : buttonName,'buttonValue':buttonValue},
            beforeSend: function() {
                inProgress = true;}
        }).done(function(data){
                $('.rating#'+buttonValue).html(data);
                $('.likes_dislikes#'+buttonValue).html("<div class='likes_dislikes alert alert-info'>Thank You!<div>");
                inProgress = false;

            });

        }
        //alert('hello '+ buttonValue);
        //alert($(this).attr('id'));
    });

});