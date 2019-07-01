<?php

if ( ! function_exists( 'educator_edge_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function educator_edge_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'educator' );
		
		return $type;
	}
	
	add_filter( 'educator_edge_title_type_global_option', 'educator_edge_set_title_centered_type_for_options' );
	add_filter( 'educator_edge_title_type_meta_boxes', 'educator_edge_set_title_centered_type_for_options' );
}