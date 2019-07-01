(function($) {
	'use strict';
	
	var animationHolder = {};
	edgt.modules.animationHolder = animationHolder;
	
	animationHolder.edgtInitAnimationHolder = edgtInitAnimationHolder;
	
	
	animationHolder.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function edgtInitAnimationHolder(){
		var elements = $('.edgt-grow-in, .edgt-fade-in-down, .edgt-element-from-fade, .edgt-element-from-left, .edgt-element-from-right, .edgt-element-from-top, .edgt-element-from-bottom, .edgt-flip-in, .edgt-x-rotate, .edgt-z-rotate, .edgt-y-translate, .edgt-fade-in, .edgt-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
			});
		}
	}
	
})(jQuery);