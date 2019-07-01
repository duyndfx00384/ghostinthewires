<?php

if ( ! function_exists( 'educator_edge_map_content_bottom_meta' ) ) {
	function educator_edge_map_content_bottom_meta() {
		
		$content_bottom_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => apply_filters( 'educator_edge_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Content Bottom', 'educator' ),
				'name'  => 'content_bottom_meta'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_enable_content_bottom_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'educator' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'educator' ),
				'parent'        => $content_bottom_meta_box,
				'options'       => educator_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''   => '#edgt_edgt_show_content_bottom_meta_container',
						'no' => '#edgt_edgt_show_content_bottom_meta_container'
					),
					'show'       => array(
						'yes' => '#edgt_edgt_show_content_bottom_meta_container'
					)
				)
			)
		);
		
		$show_content_bottom_meta_container = educator_edge_add_admin_container(
			array(
				'parent'          => $content_bottom_meta_box,
				'name'            => 'edgt_show_content_bottom_meta_container',
				'hidden_property' => 'edgt_enable_content_bottom_area_meta',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_content_bottom_sidebar_custom_display_meta',
				'type'          => 'selectblank',
				'default_value' => '',
				'label'         => esc_html__( 'Sidebar to Display', 'educator' ),
				'description'   => esc_html__( 'Choose a content bottom sidebar to display', 'educator' ),
				'options'       => educator_edge_get_custom_sidebars(),
				'parent'        => $show_content_bottom_meta_container,
				'args'          => array(
					'select2' => true
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'type'          => 'select',
				'name'          => 'edgt_content_bottom_in_grid_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Display in Grid', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will place content bottom in grid', 'educator' ),
				'options'       => educator_edge_get_yes_no_select_array(),
				'parent'        => $show_content_bottom_meta_container
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'type'        => 'color',
				'name'        => 'edgt_content_bottom_background_color_meta',
				'label'       => esc_html__( 'Background Color', 'educator' ),
				'description' => esc_html__( 'Choose a background color for content bottom area', 'educator' ),
				'parent'      => $show_content_bottom_meta_container
			)
		);
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_map_content_bottom_meta', 71 );
}