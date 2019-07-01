<?php

if(!function_exists('educator_edge_register_icon_widget')) {
	/**
	 * Function that register icon widget
	 */
	function educator_edge_register_icon_widget($widgets) {
		$widgets[] = 'EducatorEdgeIconWidget';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'educator_edge_register_icon_widget');
}