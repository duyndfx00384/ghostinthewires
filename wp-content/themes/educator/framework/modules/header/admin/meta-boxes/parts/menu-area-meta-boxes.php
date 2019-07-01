<?php

if ( ! function_exists( 'educator_edge_get_hide_dep_for_header_menu_area_meta_boxes' ) ) {
	function educator_edge_get_hide_dep_for_header_menu_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'educator_edge_header_menu_area_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'educator_edge_header_menu_area_meta_options_map' ) ) {
	function educator_edge_header_menu_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = educator_edge_get_hide_dep_for_header_menu_area_meta_boxes();
		
		$menu_area_container = educator_edge_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'menu_area_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'edgt_header_type_meta',
				'hidden_values'   => $hide_dep_options,
				'args'            => array(
					'enable_panels_for_default_value' => true
				)
			)
		);
		
		educator_edge_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Menu Area Style', 'educator' )
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_disable_header_widget_menu_area_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Header Menu Area Widget', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will hide widget area from the menu area', 'educator' ),
				'parent'        => $menu_area_container
			)
		);
		
		$educator_custom_sidebars = educator_edge_get_custom_sidebars();
		if ( count( $educator_custom_sidebars ) > 0 ) {
			educator_edge_add_meta_box_field(
				array(
					'name'        => 'edgt_custom_menu_area_sidebar_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Custom Widget Area In Menu Area', 'educator' ),
					'description' => esc_html__( 'Choose custom widget area to display in header menu area"', 'educator' ),
					'parent'      => $menu_area_container,
					'options'     => $educator_custom_sidebars
				)
			);
		}
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_menu_area_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Menu Area In Grid', 'educator' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'educator' ),
				'parent'        => $menu_area_container,
				'default_value' => '',
				'options'       => educator_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#edgt_menu_area_in_grid_container',
						'no'  => '#edgt_menu_area_in_grid_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#edgt_menu_area_in_grid_container'
					)
				)
			)
		);

        educator_edge_add_meta_box_field(
            array(
                'name'          => 'edgt_sticky_header_in_grid_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Sticky Header In Grid', 'educator' ),
                'description'   => esc_html__( 'Set sticky header content to be in grid', 'educator' ),
                'parent'        => $menu_area_container,
                'default_value' => '',
                'options'       => educator_edge_get_yes_no_select_array(),
            )
        );
		
		$menu_area_in_grid_container = educator_edge_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'menu_area_in_grid_container',
				'parent'          => $menu_area_container,
				'hidden_property' => 'edgt_menu_area_in_grid_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_menu_area_grid_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Grid Background Color', 'educator' ),
				'description' => esc_html__( 'Set grid background color for menu area', 'educator' ),
				'parent'      => $menu_area_in_grid_container
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_menu_area_grid_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Grid Background Transparency', 'educator' ),
				'description' => esc_html__( 'Set grid background transparency for menu area (0 = fully transparent, 1 = opaque)', 'educator' ),
				'parent'      => $menu_area_in_grid_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_menu_area_in_grid_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Grid Area Shadow', 'educator' ),
				'description'   => esc_html__( 'Set shadow on grid menu area', 'educator' ),
				'parent'        => $menu_area_in_grid_container,
				'default_value' => '',
				'options'       => educator_edge_get_yes_no_select_array()
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_menu_area_in_grid_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Grid Area Border', 'educator' ),
				'description'   => esc_html__( 'Set border on grid menu area', 'educator' ),
				'parent'        => $menu_area_in_grid_container,
				'default_value' => '',
				'options'       => educator_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#edgt_menu_area_in_grid_border_container',
						'no'  => '#edgt_menu_area_in_grid_border_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#edgt_menu_area_in_grid_border_container'
					)
				)
			)
		);
		
		$menu_area_in_grid_border_container = educator_edge_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'menu_area_in_grid_border_container',
				'parent'          => $menu_area_in_grid_container,
				'hidden_property' => 'edgt_menu_area_in_grid_border_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_menu_area_in_grid_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'educator' ),
				'description' => esc_html__( 'Set border color for grid area', 'educator' ),
				'parent'      => $menu_area_in_grid_border_container
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_menu_area_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'educator' ),
				'description' => esc_html__( 'Choose a background color for menu area', 'educator' ),
				'parent'      => $menu_area_container
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_menu_area_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Transparency', 'educator' ),
				'description' => esc_html__( 'Choose a transparency for the menu area background color (0 = fully transparent, 1 = opaque)', 'educator' ),
				'parent'      => $menu_area_container,
				'args'        => array(
					'col_width' => 2
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_menu_area_shadow_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Menu Area Shadow', 'educator' ),
				'description'   => esc_html__( 'Set shadow on menu area', 'educator' ),
				'parent'        => $menu_area_container,
				'default_value' => '',
				'options'       => educator_edge_get_yes_no_select_array()
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_menu_area_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Menu Area Border', 'educator' ),
				'description'   => esc_html__( 'Set border on menu area', 'educator' ),
				'parent'        => $menu_area_container,
				'default_value' => '',
				'options'       => educator_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#edgt_menu_area_border_bottom_color_container',
						'no'  => '#edgt_menu_area_border_bottom_color_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#edgt_menu_area_border_bottom_color_container'
					)
				)
			)
		);
		
		$menu_area_border_bottom_color_container = educator_edge_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'menu_area_border_bottom_color_container',
				'parent'          => $menu_area_container,
				'hidden_property' => 'edgt_menu_area_border_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_menu_area_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'educator' ),
				'description' => esc_html__( 'Choose color of header bottom border', 'educator' ),
				'parent'      => $menu_area_border_bottom_color_container
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'text',
				'name'          => 'edgt_dropdown_top_position_meta',
				'label'         => esc_html__( 'Dropdown Position', 'educator' ),
				'description'   => esc_html__( 'Enter value in percentage of entire header height', 'educator' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => '%'
				)
			)
		);
		
		do_action( 'educator_edge_header_menu_area_additional_meta_boxes_map', $menu_area_container );
	}
	
	add_action( 'educator_edge_header_menu_area_meta_boxes_map', 'educator_edge_header_menu_area_meta_options_map', 10, 1 );
}