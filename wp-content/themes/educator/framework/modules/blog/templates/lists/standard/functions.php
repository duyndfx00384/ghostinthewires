<?php

if ( ! function_exists( 'educator_edge_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function educator_edge_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'educator' );
		
		return $templates;
	}
	
	add_filter( 'educator_edge_register_blog_templates', 'educator_edge_register_blog_standard_template_file' );
}

if ( ! function_exists( 'educator_edge_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function educator_edge_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'educator' );
		
		return $options;
	}
	
	add_filter( 'educator_edge_blog_list_type_global_option', 'educator_edge_set_blog_standard_type_global_option' );
}