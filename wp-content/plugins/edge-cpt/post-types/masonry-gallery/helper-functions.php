<?php

if(!function_exists('edgt_core_masonry_gallery_meta_box_functions')) {
	function edgt_core_masonry_gallery_meta_box_functions($post_types) {
		$post_types[] = 'masonry-gallery';
		
		return $post_types;
	}
	
	add_filter('educator_edge_meta_box_post_types_save', 'edgt_core_masonry_gallery_meta_box_functions');
	add_filter('educator_edge_meta_box_post_types_remove', 'edgt_core_masonry_gallery_meta_box_functions');
}

if(!function_exists('edgt_core_register_masonry_gallery_cpt')) {
	function edgt_core_register_masonry_gallery_cpt($cpt_class_name) {
		$cpt_class = array(
			'EdgeCore\CPT\MasonryGallery\MasonryGalleryRegister'
		);
		
		$cpt_class_name = array_merge($cpt_class_name, $cpt_class);
		
		return $cpt_class_name;
	}
	
	add_filter('edgt_core_filter_register_custom_post_types', 'edgt_core_register_masonry_gallery_cpt');
}

if(!function_exists('edgt_core_add_proofing_gallery_to_search_types')) {
    function edgt_core_add_proofing_gallery_to_search_types($post_types) {

        $post_types['masonry-gallery'] = 'Masonry Gallery';

        return $post_types;
    }

    add_filter('educator_edge_search_post_type_widget_params_post_type', 'edgt_core_add_proofing_gallery_to_search_types');
}