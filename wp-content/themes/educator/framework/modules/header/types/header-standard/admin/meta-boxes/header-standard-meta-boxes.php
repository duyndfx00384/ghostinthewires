<?php

if ( ! function_exists( 'educator_edge_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function educator_edge_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'educator_edge_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'educator_edge_header_standard_meta_map' ) ) {
	function educator_edge_header_standard_meta_map( $parent ) {
		$hide_dep_options = educator_edge_get_hide_dep_for_header_standard_meta_boxes();
		
		educator_edge_add_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'edgt_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'educator' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'educator' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'educator' ),
					'left'   => esc_html__( 'Left', 'educator' ),
					'right'  => esc_html__( 'Right', 'educator' ),
					'center' => esc_html__( 'Center', 'educator' )
				),
				'hidden_property' => 'edgt_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
	}
	
	add_action( 'educator_edge_additional_header_area_meta_boxes_map', 'educator_edge_header_standard_meta_map' );
}

