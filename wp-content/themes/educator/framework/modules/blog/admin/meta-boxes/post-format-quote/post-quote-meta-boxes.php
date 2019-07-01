<?php

if ( ! function_exists( 'educator_edge_map_post_quote_meta' ) ) {
	function educator_edge_map_post_quote_meta() {
		$quote_post_format_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'educator' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'educator' ),
				'description' => esc_html__( 'Enter Quote text', 'educator' ),
				'parent'      => $quote_post_format_meta_box,
			
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'educator' ),
				'description' => esc_html__( 'Enter Quote author', 'educator' ),
				'parent'      => $quote_post_format_meta_box,
			)
		);
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_map_post_quote_meta', 25 );
}