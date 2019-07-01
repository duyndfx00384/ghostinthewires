<?php

if(!function_exists('educator_edge_register_image_widget')) {
	/**
	 * Function that register image widget
	 */
	function educator_edge_register_image_widget($widgets) {
		$widgets[] = 'EducatorEdgeImageWidget';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'educator_edge_register_image_widget');
}