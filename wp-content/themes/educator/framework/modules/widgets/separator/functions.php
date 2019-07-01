<?php

if(!function_exists('educator_edge_register_separator_widget')) {
	/**
	 * Function that register separator widget
	 */
	function educator_edge_register_separator_widget($widgets) {
		$widgets[] = 'EducatorEdgeSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'educator_edge_register_separator_widget');
}