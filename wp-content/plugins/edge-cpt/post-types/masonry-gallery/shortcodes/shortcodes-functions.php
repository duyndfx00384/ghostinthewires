<?php

if(!function_exists('edgt_core_include_masonry_gallery_shortcodes')) {
	function edgt_core_include_masonry_gallery_shortcodes() {
		include_once EDGE_CORE_CPT_PATH.'/masonry-gallery/shortcodes/masonry-gallery.php';
	}
	
	add_action('edgt_core_action_include_shortcodes_file', 'edgt_core_include_masonry_gallery_shortcodes');
}

if(!function_exists('edgt_core_add_masonry_gallery_shortcodes')) {
	function edgt_core_add_masonry_gallery_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\MasonryGallery\MasonryGallery'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('edgt_core_filter_add_vc_shortcode', 'edgt_core_add_masonry_gallery_shortcodes');
}

if( !function_exists('edgt_core_set_masonry_gallery_icon_class_name_for_vc_shortcodes') ) {
	/**
	 * Function that set custom icon class name for masonry gallery shortcodes to set our icon for Visual Composer shortcodes panel
	 */
	function edgt_core_set_masonry_gallery_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
		$shortcodes_icon_class_array[] = '.icon-wpb-masonry-gallery';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter('edgt_core_filter_add_vc_shortcodes_custom_icon_class', 'edgt_core_set_masonry_gallery_icon_class_name_for_vc_shortcodes');
}