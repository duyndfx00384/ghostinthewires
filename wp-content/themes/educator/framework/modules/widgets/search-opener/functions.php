<?php

if(!function_exists('educator_edge_register_search_opener_widget')) {
	/**
	 * Function that register search opener widget
	 */
	function educator_edge_register_search_opener_widget($widgets) {
		$widgets[] = 'EducatorEdgeSearchOpener';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'educator_edge_register_search_opener_widget');
}