<?php

if(!function_exists('edgt_lms_register_course_list_widget')) {
	/**
	 * Function that register course list widget
	 */
	function edgt_lms_register_course_list_widget($widgets) {
		$widgets[] = 'EducatorEdgeCourseListWidget';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'edgt_lms_register_course_list_widget');
}