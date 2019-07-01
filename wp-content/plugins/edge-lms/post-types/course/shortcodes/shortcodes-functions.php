<?php

if(!function_exists('edgt_lms_include_portfolio_shortcodes')) {
	function edgt_lms_include_portfolio_shortcodes() {
        include_once EDGE_LMS_CPT_PATH.'/course/shortcodes/course-features.php';
        include_once EDGE_LMS_CPT_PATH.'/course/shortcodes/course-list.php';
        include_once EDGE_LMS_CPT_PATH.'/course/shortcodes/course-search.php';
		include_once EDGE_LMS_CPT_PATH.'/course/shortcodes/course-slider.php';
		include_once EDGE_LMS_CPT_PATH.'/course/shortcodes/course-table.php';
        include_once EDGE_LMS_CPT_PATH.'/course/shortcodes/course-category.php';
	}
	
	add_action('edgt_lms_action_include_shortcodes_file', 'edgt_lms_include_portfolio_shortcodes');
}

if(!function_exists('edgt_lms_add_portfolio_shortcodes')) {
	function edgt_lms_add_portfolio_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
            'EdgefLMS\CPT\Shortcodes\Course\CourseFeatures',
            'EdgefLMS\CPT\Shortcodes\Course\CourseList',
            'EdgefLMS\CPT\Shortcodes\Course\CourseSearch',
			'EdgefLMS\CPT\Shortcodes\Course\CourseSlider',
			'EdgefLMS\CPT\Shortcodes\Course\CourseTable',
            'EdgefLMS\CPT\Shortcodes\Course\CourseCategory'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('edgt_lms_filter_add_vc_shortcode', 'edgt_lms_add_portfolio_shortcodes');
}

if( !function_exists('edgt_lms_set_course_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for portfolio list shortcodes to set our icon for Visual Composer shortcodes panel
	 */
	function edgt_lms_set_course_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-course-features';
		$shortcodes_icon_class_array[] = '.icon-wpb-course-list';
		$shortcodes_icon_class_array[] = '.icon-wpb-course-search';
		$shortcodes_icon_class_array[] = '.icon-wpb-course-slider';
		$shortcodes_icon_class_array[] = '.icon-wpb-course-table';
        $shortcodes_icon_class_array[] = '.icon-wpb-course-category';

		return $shortcodes_icon_class_array;
	}
	
	add_filter('edgt_lms_filter_add_vc_shortcodes_custom_icon_class', 'edgt_lms_set_course_icon_class_name_for_vc_shortcodes');
}