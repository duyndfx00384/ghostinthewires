<?php

if(!function_exists('educator_edge_register_raw_html_widget')) {
	/**
	 * Function that register raw html widget
	 */
	function educator_edge_register_raw_html_widget($widgets) {
		$widgets[] = 'EducatorEdgeRawHTMLWidget';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'educator_edge_register_raw_html_widget');
}