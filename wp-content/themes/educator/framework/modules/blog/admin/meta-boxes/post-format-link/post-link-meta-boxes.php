<?php

if ( ! function_exists( 'educator_edge_map_post_link_meta' ) ) {
	function educator_edge_map_post_link_meta() {
		$link_post_format_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'educator' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'educator' ),
				'description' => esc_html__( 'Enter link', 'educator' ),
				'parent'      => $link_post_format_meta_box,
			
			)
		);
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_map_post_link_meta', 24 );
}