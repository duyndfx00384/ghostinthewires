<?php

if(!function_exists('educator_edge_events_custom_styles')) {
	/**
	 * Outputs custom styles for events
	 */
	function educator_edge_events_custom_styles() {
	    if(educator_edge_options()->getOptionValue('first_color') !== "") {
		    $color_selector = array(
				'.edgt-tribe-events-single .edgt-events-single-meta .edgt-events-single-next-event a:hover',
				'.edgt-tribe-events-single .edgt-events-single-meta .edgt-events-single-prev-event a:hover',
				'#tribe-events-content-wrapper .tribe-bar-views-list li.tribe-bar-active a',
				'#tribe-events-content-wrapper .tribe-bar-views-list li a:hover',
		        '#tribe-events-content-wrapper .tribe-events-sub-nav .tribe-events-nav-previous a:hover',
				'#tribe-events-content-wrapper .tribe-events-sub-nav .tribe-events-nav-next a:hover',
				'#tribe-events-content-wrapper .tribe-events-calendar td div[id*=tribe-events-daynum-] a:hover'
		    );

		    $color_important_selector = array(

		    );

		    $background_color_selector = array(
				'.edgt-tribe-events-single .edgt-events-single-main-info .edgt-events-single-date-holder'
		    );

		    $background_color_important_selector = array(

		    );

		    $border_color_selector = array(
				'#tribe-events-content-wrapper .tribe-bar-filters input[type=text]:focus'
		    );

		    echo educator_edge_dynamic_css($color_selector, array('color' => educator_edge_options()->getOptionValue('first_color')));
		    echo educator_edge_dynamic_css($color_important_selector, array('color' => educator_edge_options()->getOptionValue('first_color').'!important'));
		    echo educator_edge_dynamic_css('::selection', array('background' => educator_edge_options()->getOptionValue('first_color')));
		    echo educator_edge_dynamic_css('::-moz-selection', array('background' => educator_edge_options()->getOptionValue('first_color')));
		    echo educator_edge_dynamic_css($background_color_selector, array('background-color' => educator_edge_options()->getOptionValue('first_color')));
		    echo educator_edge_dynamic_css($background_color_important_selector, array('background-color' => educator_edge_options()->getOptionValue('first_color').'!important'));
		    echo educator_edge_dynamic_css($border_color_selector, array('border-color' => educator_edge_options()->getOptionValue('first_color')));
	    }
    }

	add_action('educator_edge_style_dynamic', 'educator_edge_events_custom_styles');
}