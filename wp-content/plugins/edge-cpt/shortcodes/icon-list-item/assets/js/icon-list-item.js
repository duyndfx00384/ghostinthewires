(function($) {
	'use strict';
	
	var iconListItem = {};
	edgt.modules.iconListItem = iconListItem;
	
	iconListItem.edgtInitIconList = edgtInitIconList;
	
	
	iconListItem.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var edgtInitIconList = function() {
		var iconList = $('.edgt-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('edgt-appeared');
				},{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);