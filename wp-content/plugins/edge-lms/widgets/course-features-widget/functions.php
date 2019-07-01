<?php

if(!function_exists('edgt_lms_register_course_features_widget')) {
	/**
	 * Function that register course features widget
	 */
	function edgt_lms_register_course_features_widget($widgets) {
		$widgets[] = 'EducatorEdgeCourseFeaturesWidget';
		
		return $widgets;
	}
	
	add_filter('educator_edge_register_widgets', 'edgt_lms_register_course_features_widget');
}