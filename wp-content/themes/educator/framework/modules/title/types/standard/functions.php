<?php

if ( ! function_exists( 'educator_edge_set_title_standard_type_for_options' ) ) {
	/**
	 * This function set standard title type value for title options map and meta boxes
	 */
	function educator_edge_set_title_standard_type_for_options( $type ) {
		$type['standard'] = esc_html__( 'Standard', 'educator' );
		
		return $type;
	}
	
	add_filter( 'educator_edge_title_type_global_option', 'educator_edge_set_title_standard_type_for_options' );
	add_filter( 'educator_edge_title_type_meta_boxes', 'educator_edge_set_title_standard_type_for_options' );
}

if ( ! function_exists( 'educator_edge_set_title_standard_type_for_options' ) ) {
	/**
	 * This function set default title type value for global title option map
	 */
	function educator_edge_set_title_standard_type_for_options( $type ) {
		$type = 'standard';
		
		return $type;
	}
	
	add_filter( 'educator_edge_default_title_type_global_option', 'educator_edge_set_title_standard_type_for_options' );
}