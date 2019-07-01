(function($) {
	'use strict';
	
	var counter = {};
	edgt.modules.counter = counter;
	
	counter.edgtInitCounter = edgtInitCounter;
	
	
	counter.edgtOnDocumentReady = edgtOnDocumentReady;
	
	$(document).ready(edgtOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function edgtInitCounter() {
		var counterHolder = $('.edgt-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.edgt-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('edgt-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
			});
		}
	}
	
})(jQuery);