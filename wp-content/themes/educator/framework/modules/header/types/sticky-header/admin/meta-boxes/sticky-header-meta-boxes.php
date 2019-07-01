<?php

if ( ! function_exists( 'educator_edge_sticky_header_meta_boxes_options_map' ) ) {
	function educator_edge_sticky_header_meta_boxes_options_map( $header_meta_box ) {
		
		$sticky_amount_container = educator_edge_add_admin_container(
			array(
				'parent'          => $header_meta_box,
				'name'            => 'sticky_amount_container_meta_container',
				'hidden_property' => 'edgt_header_behaviour_meta',
				'hidden_values'   => array(
					'',
					'no-behavior',
					'fixed-on-scroll',
					'sticky-header-on-scroll-up'
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_scroll_amount_for_sticky_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Scroll amount for sticky header appearance', 'educator' ),
				'description' => esc_html__( 'Define scroll amount for sticky header appearance', 'educator' ),
				'parent'      => $sticky_amount_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px'
				)
			)
		);
	}
	
	add_action( 'educator_edge_additional_header_area_meta_boxes_map', 'educator_edge_sticky_header_meta_boxes_options_map', 10, 1 );
}