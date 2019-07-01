<?php

if(!function_exists('educator_edge_register_image_gallery_widget')) {
	/**
	 * Function that register image gallery widget
	 */
	function educator_edge_register_image_gallery_widget($widgets) {
		$widgets[] = 'EducatorEdgeImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'educator_edge_register_image_gallery_widget');
}