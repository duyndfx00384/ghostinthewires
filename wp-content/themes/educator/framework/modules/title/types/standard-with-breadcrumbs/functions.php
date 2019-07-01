<?php

if ( ! function_exists( 'educator_edge_set_title_standard_with_breadcrumbs_type_for_options' ) ) {
	/**
	 * This function set standard with breadcrumbs title type value for title options map and meta boxes
	 */
	function educator_edge_set_title_standard_with_breadcrumbs_type_for_options( $type ) {
		$type['standard-with-breadcrumbs'] = esc_html__( 'Standard With Breadcrumbs', 'educator' );
		
		return $type;
	}
	
	add_filter( 'educator_edge_title_type_global_option', 'educator_edge_set_title_standard_with_breadcrumbs_type_for_options' );
	add_filter( 'educator_edge_title_type_meta_boxes', 'educator_edge_set_title_standard_with_breadcrumbs_type_for_options' );
}