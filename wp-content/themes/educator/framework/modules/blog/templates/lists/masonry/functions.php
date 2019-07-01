<?php

if ( ! function_exists( 'educator_edge_register_blog_masonry_template_file' ) ) {
	/**
	 * Function that register blog masonry template
	 */
	function educator_edge_register_blog_masonry_template_file( $templates ) {
		$templates['blog-masonry'] = esc_html__( 'Blog: Masonry', 'educator' );
		
		return $templates;
	}
	
	add_filter( 'educator_edge_register_blog_templates', 'educator_edge_register_blog_masonry_template_file' );
}

if ( ! function_exists( 'educator_edge_set_blog_masonry_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function educator_edge_set_blog_masonry_type_global_option( $options ) {
		$options['masonry'] = esc_html__( 'Blog: Masonry', 'educator' );
		
		return $options;
	}
	
	add_filter( 'educator_edge_blog_list_type_global_option', 'educator_edge_set_blog_masonry_type_global_option' );
}