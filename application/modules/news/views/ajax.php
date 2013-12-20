<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 12/12/13
 * Time: 9:38 AM
 */

echo "<script>
$(document).ready(function(){
    var inProgress = false;
    var startFrom = 2;
    var urlMemes='".HTTP_URL_PUB."news/index/memes"."';
    $(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height() - 200 && !inProgress) {
    $.ajax({
    url: urlMemes,
    method: 'POST',
    data: {'startFrom' : startFrom},
    beforeSend: function() {
    inProgress = true;}
    }).done(function(data){
    $(data).insertAfter('#nextMeme:last-child');
    inProgress = false;
    startFrom += 2;
    });
    }
    });
    });

 </script>";