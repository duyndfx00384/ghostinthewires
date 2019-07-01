<?php

if ( ! function_exists( 'educator_edge_register_header_standard_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function educator_edge_register_header_standard_type( $header_types ) {
		$header_type = array(
			'header-standard' => 'EducatorEdge\Modules\Header\Types\HeaderStandard'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'educator_edge_init_register_header_standard_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function educator_edge_init_register_header_standard_type() {
		add_filter( 'educator_edge_register_header_type_class', 'educator_edge_register_header_standard_type' );
	}
	
	add_action( 'educator_edge_before_header_function_init', 'educator_edge_init_register_header_standard_type' );
}