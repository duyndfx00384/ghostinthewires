<?php

if(!function_exists('educator_edge_register_sidearea_opener_widget')) {
	/**
	 * Function that register sidearea opener widget
	 */
	function educator_edge_register_sidearea_opener_widget($widgets) {
		$widgets[] = 'EducatorEdgeSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'educator_edge_register_sidearea_opener_widget');
}