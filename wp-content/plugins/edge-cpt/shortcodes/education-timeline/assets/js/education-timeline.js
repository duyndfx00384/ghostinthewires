(function($) {
	'use strict';

	var timeline = {};
	edgt.modules.timeline = timeline;

	timeline.edgtTimeline = edgtTimeline;


	timeline.edgtOnDocumentReady = edgtOnDocumentReady;

	$(document).ready(edgtOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function edgtOnDocumentReady() {
		edgtTimeline();
	}

	/**
	 * Timeline animation
	 * @type {Function}
	 */
	function edgtTimeline(){

		var itemTimeline = $('.edgt-tml-item-holder');
		if(itemTimeline.length){


			itemTimeline.each(function(){

				var thisTimeline = $(this);


				setTimeout(function(){

					thisTimeline.appear(function(){
						thisTimeline.addClass('edgt-appeared');
					},{accX: 0, accY: edgtGlobalVars.vars.edgtElementAppearAmount});
				},500*thisTimeline.index());

			});
		}
	}

})(jQuery);