<?php

if ( ! function_exists( 'educator_edge_map_sidebar_meta' ) ) {
	function educator_edge_map_sidebar_meta() {
		$edgt_sidebar_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => apply_filters( 'educator_edge_set_scope_for_meta_boxes', array( 'page' ) ),
				'title' => esc_html__( 'Sidebar', 'educator' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Layout', 'educator' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'educator' ),
				'parent'      => $edgt_sidebar_meta_box,
				'options'     => array(
					''                 => esc_html__( 'Default', 'educator' ),
					'no-sidebar'       => esc_html__( 'No Sidebar', 'educator' ),
					'sidebar-33-right' => esc_html__( 'Sidebar 1/3 Right', 'educator' ),
					'sidebar-25-right' => esc_html__( 'Sidebar 1/4 Right', 'educator' ),
					'sidebar-33-left'  => esc_html__( 'Sidebar 1/3 Left', 'educator' ),
					'sidebar-25-left'  => esc_html__( 'Sidebar 1/4 Left', 'educator' )
				)
			)
		);
		
		$edgt_custom_sidebars = educator_edge_get_custom_sidebars();
		if ( count( $edgt_custom_sidebars ) > 0 ) {
			educator_edge_add_meta_box_field(
				array(
					'name'        => 'edgt_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'educator' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'educator' ),
					'parent'      => $edgt_sidebar_meta_box,
					'options'     => $edgt_custom_sidebars,
					'args'        => array(
						'select2'	=> true
					)
				)
			);
		}
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_map_sidebar_meta', 31 );
}