<?php

if ( ! function_exists('educator_edge_sidebar_options_map') ) {

	function educator_edge_sidebar_options_map() {


		$sidebar_panel = educator_edge_add_admin_panel(
			array(
				'title' => esc_html__('Sidebar Area', 'educator'),
				'name' => 'sidebar',
				'page' => '_page_page'
			)
		);
		
		educator_edge_add_admin_field(array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__('Sidebar Layout', 'educator'),
			'description'   => esc_html__('Choose a sidebar layout for pages', 'educator'),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
			'options'       => array(
				'no-sidebar'        => esc_html__('No Sidebar', 'educator'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'educator'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'educator'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'educator'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'educator')
			)
		));
		
		$educator_custom_sidebars = educator_edge_get_custom_sidebars();
		if(count($educator_custom_sidebars) > 0) {
			educator_edge_add_admin_field(array(
				'name' => 'custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'educator'),
				'description' => esc_html__('Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'educator'),
				'parent' => $sidebar_panel,
				'options' => $educator_custom_sidebars,
				'args'        => array(
					'select2'	=> true
				)
			));
		}
	}

	add_action('educator_edge_page_sidebar_options_map', 'educator_edge_sidebar_options_map', 9);
}