<?php

if(!function_exists('edgt_core_testimonials_meta_box_functions')) {
	function edgt_core_testimonials_meta_box_functions($post_types) {
		$post_types[] = 'testimonials';
		
		return $post_types;
	}
	
	add_filter('educator_edge_meta_box_post_types_save', 'edgt_core_testimonials_meta_box_functions');
	add_filter('educator_edge_meta_box_post_types_remove', 'edgt_core_testimonials_meta_box_functions');
}

if(!function_exists('edgt_core_register_testimonials_cpt')) {
	function edgt_core_register_testimonials_cpt($cpt_class_name) {
		$cpt_class = array(
			'EdgeCore\CPT\Testimonials\TestimonialsRegister'
		);
		
		$cpt_class_name = array_merge($cpt_class_name, $cpt_class);
		
		return $cpt_class_name;
	}
	
	add_filter('edgt_core_filter_register_custom_post_types', 'edgt_core_register_testimonials_cpt');
}