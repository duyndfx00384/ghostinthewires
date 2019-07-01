<?php

if(!function_exists('educator_edge_register_button_widget')) {
	/**
	 * Function that register button widget
	 */
	function educator_edge_register_button_widget($widgets) {
		$widgets[] = 'EducatorEdgeButtonWidget';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'educator_edge_register_button_widget');
}