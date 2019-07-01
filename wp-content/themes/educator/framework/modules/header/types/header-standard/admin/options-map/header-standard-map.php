<?php

if ( ! function_exists( 'educator_edge_get_hide_dep_for_header_standard_options' ) ) {
	function educator_edge_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'educator_edge_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'educator_edge_header_standard_map' ) ) {
	function educator_edge_header_standard_map( $parent ) {
		$hide_dep_options = educator_edge_get_hide_dep_for_header_standard_options();
		
		educator_edge_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'educator' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'educator' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'educator' ),
					'left'   => esc_html__( 'Left', 'educator' ),
					'center' => esc_html__( 'Center', 'educator' )
				),
				'hidden_property' => 'header_type',
				'hidden_values'   => $hide_dep_options
			)
		);
	}
	
	add_action( 'educator_edge_additional_header_menu_area_options_map', 'educator_edge_header_standard_map' );
}