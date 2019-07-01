<?php

/*** Post Settings ***/

if ( ! function_exists( 'educator_edge_map_post_meta' ) ) {
	function educator_edge_map_post_meta() {
		
		$post_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'educator' ),
				'name'  => 'post-meta'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'educator' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'educator' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
				'options'       => array(
					''                 => esc_html__( 'Default', 'educator' ),
					'no-sidebar'       => esc_html__( 'No Sidebar', 'educator' ),
					'sidebar-33-right' => esc_html__( 'Sidebar 1/3 Right', 'educator' ),
					'sidebar-25-right' => esc_html__( 'Sidebar 1/4 Right', 'educator' ),
					'sidebar-33-left'  => esc_html__( 'Sidebar 1/3 Left', 'educator' ),
					'sidebar-25-left'  => esc_html__( 'Sidebar 1/4 Left', 'educator' )
				)
			)
		);
		
		$educator_custom_sidebars = educator_edge_get_custom_sidebars();
		if ( count( $educator_custom_sidebars ) > 0 ) {
			educator_edge_add_meta_box_field( array(
				'name'        => 'edgt_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'educator' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'educator' ),
				'parent'      => $post_meta_box,
				'options'     => educator_edge_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'educator' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'educator' ),
				'parent'      => $post_meta_box
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_blog_masonry_gallery_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Fixed Proportion', 'educator' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in fixed proportion', 'educator' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'            => esc_html__( 'Default', 'educator' ),
					'large-width'        => esc_html__( 'Large Width', 'educator' ),
					'large-height'       => esc_html__( 'Large Height', 'educator' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'educator' )
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_blog_masonry_gallery_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Original Proportion', 'educator' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in original proportion', 'educator' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'educator' ),
					'large-width' => esc_html__( 'Large Width', 'educator' )
				)
			)
		);

	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_map_post_meta', 20 );
}
