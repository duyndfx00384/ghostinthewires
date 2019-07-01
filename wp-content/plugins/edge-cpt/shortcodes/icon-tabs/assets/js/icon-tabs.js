(function($) {
	'use strict';
	
	var tabs = {};
	edgt.modules.tabs = tabs;
	
	tabs.edgtInitTabs = edgtInitTabs;
	tabs.edgtInitTabIcons =edgtInitTabIcons;
	
	tabs.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitTabs();
		edgtInitTabIcons();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function edgtInitTabs(){
		var tabs = $('.edgt-icon-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.edgt-icon-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.edgt-icon-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;
					
					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

				//animate tab content
				var tabContent = thisTabs.find('.edgt-icon-tab-container');

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

	/*
	 **	Generate icons in tabs navigation
	 */
	function edgtInitTabIcons(){

		var tabContent = $('.edgt-icon-tab-container');
		if(tabContent.length){

			tabContent.each(function(){
				var thisTabContent = $(this);

				var id = thisTabContent.attr('id');
				var icon = '';
				if(typeof thisTabContent.data('icon-html') !== 'undefined' || thisTabContent.data('icon-html') !== 'false') {
					icon = thisTabContent.data('icon-html');
				}

				var tabNav = thisTabContent.parents('.edgt-icon-tabs').find('.edgt-icon-tabs-nav > li > a[href="#'+id+'"]');

				if(typeof(tabNav) !== 'undefined') {
					tabNav.prepend(icon);
				}
			});
		}
	}
	
})(jQuery);