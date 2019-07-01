<?php

if(!function_exists('edgt_lms_register_course_categories_widget')) {
	/**
	 * Function that register course list widget
	 */
	function edgt_lms_register_course_categories_widget($widgets) {
		$widgets[] = 'EducatorEdgeCourseCategoriesWidget';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'edgt_lms_register_course_categories_widget');
}