/*!  Plugin: treeNav (Tree View from HTML Nested List)
 *   Author: Asif Mughal
 *   URL: www.codehim.com
 *   License: MIT License
 *   Copyright (c) 2019 - Asif Mughal
 */
/* File: jquery.treenav.js */
(function ($) {
	$.fn.treeNav = function (options) {
	
		var setting = $.extend({
			 
		}, options);

		return this.each(function () {

			var target = $(this);
		   
var folders = $(target).find("li[data-type='folder']");

var folderIcon = document.createElement("span"); //creates span element for folder 

$(folderIcon).addClass("folder").prependTo(folders); //add to each li element that has data-type folder attribute 

$(".folder").click(function(){

 $(this).toggleClass("open");
  
 var subItems = $(this).siblings("ul");
 
 $(subItems).slideToggle();

});

		});
	};

})(jQuery);
