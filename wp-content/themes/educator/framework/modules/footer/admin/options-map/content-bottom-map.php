<?php

if ( ! function_exists( 'educator_edge_content_bottom_options_map' ) ) {
	function educator_edge_content_bottom_options_map() {
		
		$panel_content_bottom = educator_edge_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content_bottom',
				'title' => esc_html__( 'Content Bottom Area Style', 'educator' )
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'enable_content_bottom_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'educator' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'educator' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgt_enable_content_bottom_area_container'
				),
				'parent'        => $panel_content_bottom
			)
		);
		
		$enable_content_bottom_area_container = educator_edge_add_admin_container(
			array(
				'parent'          => $panel_content_bottom,
				'name'            => 'enable_content_bottom_area_container',
				'hidden_property' => 'enable_content_bottom_area',
				'hidden_value'    => 'no'
			)
		);
		
		$educator_custom_sidebars = educator_edge_get_custom_sidebars();
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'selectblank',
				'name'          => 'content_bottom_sidebar_custom_display',
				'default_value' => '',
				'label'         => esc_html__( 'Widget Area to Display', 'educator' ),
				'description'   => esc_html__( 'Choose a Content Bottom widget area to display', 'educator' ),
				'options'       => $educator_custom_sidebars,
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Display in Grid', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will place Content Bottom in grid', 'educator' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'content_bottom_background_color',
				'label'       => esc_html__( 'Background Color', 'educator' ),
				'description' => esc_html__( 'Choose a background color for Content Bottom area', 'educator' ),
				'parent'      => $enable_content_bottom_area_container
			)
		);
	}
	
	add_action( 'educator_edge_additional_page_options_map', 'educator_edge_content_bottom_options_map' );
}