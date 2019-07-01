<?php

if(!function_exists('educator_edge_include_woocommerce_shortcodes')) {
	function educator_edge_include_woocommerce_shortcodes() {
		foreach(glob(EDGE_FRAMEWORK_MODULES_ROOT_DIR.'/woocommerce/shortcodes/*/load.php') as $shortcode_load) {
			include_once $shortcode_load;
		}
	}
	
	if(educator_edge_core_plugin_installed()) {
		add_action('edgt_core_action_include_shortcodes_file', 'educator_edge_include_woocommerce_shortcodes');
	}
}

if ( ! function_exists( 'educator_edge_set_events_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for product shortcodes to set our icon for Visual Composer shortcodes panel
	 */
	function educator_edge_set_events_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-product-list';
		
		return $shortcodes_icon_class_array;
	}
	
	if ( educator_edge_core_plugin_installed() ) {
		add_filter( 'edgt_core_filter_add_vc_shortcodes_custom_icon_class', 'educator_edge_set_events_icon_class_name_for_vc_shortcodes' );
	}
}