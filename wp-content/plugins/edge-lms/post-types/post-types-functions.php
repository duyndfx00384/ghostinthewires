<?php

if(!function_exists('edgt_lms_include_custom_post_types_files')) {
	/**
	 * Loads all custom post types by going through all folders that are placed directly in post types folder
	 */
	function edgt_lms_include_custom_post_types_files() {
		if(edgt_lms_theme_installed()) {
			foreach (glob(EDGE_LMS_CPT_PATH . '/*/load.php') as $shortcode_load) {
				include_once $shortcode_load;
			}
		}
	}
	
	add_action('after_setup_theme', 'edgt_lms_include_custom_post_types_files', 1);
}

if(!function_exists('edgt_lms_include_custom_post_types_meta_boxes')) {
	/**
	 * Loads all meta boxes functions for custom post types by going through all folders that are placed directly in post types folder
	 */
	function edgt_lms_include_custom_post_types_meta_boxes() {
		if(edgt_lms_theme_installed()) {
			foreach(glob(EDGE_LMS_CPT_PATH . '/*/admin/meta-boxes/*.php') as $meta_boxes_map) {
				include_once $meta_boxes_map;
			}
		}
	}
	
	add_action('educator_edge_before_meta_boxes_map', 'edgt_lms_include_custom_post_types_meta_boxes');
}

if(!function_exists('edgt_lms_include_custom_post_types_global_options')) {
	/**
	 * Loads all global otpions functions for custom post types by going through all folders that are placed directly in post types folder
	 */
	function edgt_lms_include_custom_post_types_global_options() {
		if(edgt_lms_theme_installed()) {
			foreach(glob(EDGE_LMS_CPT_PATH . '/*/admin/options/*.php') as $global_options) {
				include_once $global_options;
			}
		}
	}
	
	add_action('educator_edge_before_options_map', 'edgt_lms_include_custom_post_types_global_options', 1);
}

if(!function_exists('edgt_lms_include_taxonomy_custom_fields')) {
	/**
	 * Loads all custom fields for taxonomy by going through all folders that are placed directly in post types folder
	 */
	function edgt_lms_include_taxonomy_custom_fields() {
		if(edgt_lms_theme_installed()) {
			foreach(glob(EDGE_LMS_CPT_PATH . '/*/admin/taxonomy-meta-fields/*.php') as $global_options) {
				include_once $global_options;
			}
		}
	}

	add_action('admin_init', 'edgt_lms_include_taxonomy_custom_fields', 1);
}

if ( ! function_exists( 'edgt_lms_enqueue_scripts_for_quiz' ) ) {
    /**
     * Function that includes all necessary 3rd party scripts for this post type
     */
    function edgt_lms_enqueue_scripts_for_quiz() {
        wp_enqueue_script('simple-countdown', EDGE_LMS_CPT_URL_PATH .'/quiz/assets/js/plugins/jquery.vtimer.min.js', array('jquery'), false, true);
    }

    add_action('educator_edge_enqueue_third_party_scripts', 'edgt_lms_enqueue_scripts_for_quiz');
}