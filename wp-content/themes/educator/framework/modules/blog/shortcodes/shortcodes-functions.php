<?php

if(!function_exists('educator_edge_include_blog_shortcodes')) {
	function educator_edge_include_blog_shortcodes() {
		include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR.'/blog/shortcodes/blog-list/blog-list.php';
	}
	
	if(educator_edge_core_plugin_installed()) {
		add_action('edgt_core_action_include_shortcodes_file', 'educator_edge_include_blog_shortcodes');
	}
}

if(!function_exists('educator_edge_add_blog_shortcodes')) {
	function educator_edge_add_blog_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\BlogList\BlogList'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	if(educator_edge_core_plugin_installed()) {
		add_filter('edgt_core_filter_add_vc_shortcode', 'educator_edge_add_blog_shortcodes');
	}
}

if ( ! function_exists( 'educator_edge_set_blog_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for blog shortcodes to set our icon for Visual Composer shortcodes panel
	 */
	function educator_edge_set_blog_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-blog-list';

		return $shortcodes_icon_class_array;
	}
	
	if ( educator_edge_core_plugin_installed() ) {
		add_filter( 'edgt_core_filter_add_vc_shortcodes_custom_icon_class', 'educator_edge_set_blog_list_icon_class_name_for_vc_shortcodes' );
	}
}