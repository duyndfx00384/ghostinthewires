<?php

if ( ! function_exists( 'educator_edge_centered_title_type_options_meta_boxes' ) ) {
	function educator_edge_centered_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_subtitle_side_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Side Padding', 'educator' ),
				'description' => esc_html__( 'Set left/right padding for subtitle area', 'educator' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);
	}
	
	add_action( 'educator_edge_additional_title_area_meta_boxes', 'educator_edge_centered_title_type_options_meta_boxes', 5 );
}