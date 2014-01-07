/**
 * Created by anna on 22.12.13.
 */
$(document).ready(function(){
      //$("a").css("color","red");
      var newsTabs=$(".news .nav");
      //newsTabs.find("a").css("color","red");
    var action = window.action;
    newsTabs.find("li#"+action).addClass('active');
});
