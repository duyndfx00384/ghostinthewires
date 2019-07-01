<?php

if(!function_exists('educator_edge_register_social_icon_widget')) {
	/**
	 * Function that register social icon widget
	 */
	function educator_edge_register_social_icon_widget($widgets) {
		$widgets[] = 'EducatorEdgeSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'educator_edge_register_social_icon_widget');
}