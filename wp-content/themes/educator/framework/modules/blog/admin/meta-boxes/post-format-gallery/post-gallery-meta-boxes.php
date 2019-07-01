<?php

if ( ! function_exists( 'educator_edge_map_post_gallery_meta' ) ) {
	
	function educator_edge_map_post_gallery_meta() {
		$gallery_post_format_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'educator' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		educator_edge_add_multiple_images_field(
			array(
				'name'        => 'edgt_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'educator' ),
				'description' => esc_html__( 'Choose your gallery images', 'educator' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_map_post_gallery_meta', 21 );
}
