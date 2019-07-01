(function($) {
	'use strict';
	
	var tabs = {};
	edgt.modules.tabs = tabs;
	
	tabs.edgtInitTabs = edgtInitTabs;
	
	
	tabs.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function edgtInitTabs(){
		var tabs = $('.edgt-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.edgt-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.edgt-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;
					
					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

				$('.edgt-tabs a.edgt-external-link').unbind('click');

				//animate tab content
				var tabContent = thisTabs.find('.edgt-tab-container');

				thisTabs.appear(function(){
					showTabContent(tabContent);
				});

				thisTabs.find('li').each(function(){
					var singleTab = $(this);
					singleTab.click(function(){
						setTimeout(function(){
							showTabContent(tabContent);
						},50);
					});
				});

				function showTabContent(tabContent) {
					tabContent.each(function(){
						var thisTabContent = $(this);
						if(thisTabContent.is(':visible')) {
							thisTabContent.addClass('edgt-visible');
						} else {
							thisTabContent.removeClass('edgt-visible');
						}
					});
				}
			});
		}
	}

})(jQuery);