$(document).ready(function() {
	"use strict";
	//===============Mobile nav Function============
	var menu = $('#menu');
	var navigation = $('.navigation');
	menu.on('click', function() {
		if ($(window).width() <= 991) {
			navigation.slideToggle('normal');
		}
		return false;
	});
	//===============Submenu Function============
	var navigationLink = $('.navigation>ul> li>a');
	var navigationLi = $('.navigation>ul> li');
	var navigationUl = $('.navigation>ul> li>ul');
	navigationLink.on('click', function() {
		if ($(window).width() <= 991) {
			navigationLi.removeClass('on');
			navigationUl.slideUp('normal');
			if ($(this).next().next('ul').is(':hidden') == true) {
				$(this).parent('li').addClass('on');
				$(this).next().next('ul').slideDown('normal');
			}
		}
		//return false;
	});
	

});

