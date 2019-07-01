<?php

if(!function_exists('edgt_lms_include_instructor_shortcodes')) {
	function edgt_lms_include_instructor_shortcodes() {
		include_once EDGE_LMS_CPT_PATH.'/instructor/shortcodes/instructor-list.php';
		include_once EDGE_LMS_CPT_PATH.'/instructor/shortcodes/instructor.php';
		include_once EDGE_LMS_CPT_PATH.'/instructor/shortcodes/instructor-slider.php';
	}
	
	add_action('edgt_lms_action_include_shortcodes_file', 'edgt_lms_include_instructor_shortcodes');
}

if(!function_exists('edgt_lms_add_instructor_shortcodes')) {
	function edgt_lms_add_instructor_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
            'EdgefLMS\CPT\Shortcodes\Instructor\Instructor',
            'EdgefLMS\CPT\Shortcodes\Instructor\InstructorList',
			'EdgefLMS\CPT\Shortcodes\Instructor\InstructorSlider'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('edgt_lms_filter_add_vc_shortcode', 'edgt_lms_add_instructor_shortcodes');
}

if( !function_exists('edgt_lms_set_instructor_list_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for instructor shortcodes to set our icon for Visual Composer shortcodes panel
	 */
	function edgt_lms_set_instructor_list_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-instructor-list';
		$shortcodes_icon_class_array[] = '.icon-wpb-instructor';
		$shortcodes_icon_class_array[] = '.icon-wpb-instructor-slider';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter('edgt_lms_filter_add_vc_shortcodes_custom_icon_class', 'edgt_lms_set_instructor_list_icon_class_name_for_vc_shortcodes');
}