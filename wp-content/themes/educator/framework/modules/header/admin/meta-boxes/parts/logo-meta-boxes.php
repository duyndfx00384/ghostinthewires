<?php

if ( ! function_exists( 'educator_edge_logo_meta_box_map' ) ) {
	function educator_edge_logo_meta_box_map() {
		
		$logo_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => apply_filters( 'educator_edge_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Logo', 'educator' ),
				'name'  => 'logo_meta'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'educator' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'educator' ),
				'parent'      => $logo_meta_box
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'educator' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'educator' ),
				'parent'      => $logo_meta_box
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'educator' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'educator' ),
				'parent'      => $logo_meta_box
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'educator' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'educator' ),
				'parent'      => $logo_meta_box
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'educator' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'educator' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_logo_meta_box_map', 47 );
}