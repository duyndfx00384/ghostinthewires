<?php

if(!function_exists('educator_edge_register_blog_list_widget')) {
	/**
	 * Function that register blog list widget
	 */
	function educator_edge_register_blog_list_widget($widgets) {
		$widgets[] = 'EducatorEdgeBlogListWidget';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'educator_edge_register_blog_list_widget');
}