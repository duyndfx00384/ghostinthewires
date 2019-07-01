<?php
if(!function_exists('educator_edge_add_product_list_shortcode')) {
	function educator_edge_add_product_list_shortcode($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\ProductList\ProductList',
		);

		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

		return $shortcodes_class_name;
	}

	if(educator_edge_core_plugin_installed()) {
		add_filter('edgt_core_filter_add_vc_shortcode', 'educator_edge_add_product_list_shortcode');
	}
}