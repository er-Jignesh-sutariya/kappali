"use strict";
$(document).ready(function() {
	var input = $("form").first().find(':input').first().attr('class');
  	$("."+input).first().focus();
    // $('.theme-loader').addClass('loaded');
    $('.theme-loader').animate({
        'opacity': '0',
    }, 1200);
    setTimeout(function() {
        $('.theme-loader').remove();
    }, 2000);
    // $('.pcoded').addClass('loaded');
});
