<?php

if ( ! function_exists( 'educator_edge_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function educator_edge_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'educator' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'educator' ),
				'parent'      => $show_title_area_meta_container
			)
		);
	}
	
	add_action( 'educator_edge_additional_title_area_meta_boxes', 'educator_edge_breadcrumbs_title_type_options_meta_boxes' );
}