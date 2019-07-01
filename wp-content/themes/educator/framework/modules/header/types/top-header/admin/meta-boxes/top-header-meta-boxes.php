<?php

if ( ! function_exists( 'educator_edge_get_hide_dep_for_top_header_area_meta_boxes' ) ) {
	function educator_edge_get_hide_dep_for_top_header_area_meta_boxes() {
		$hide_dep_options = apply_filters( 'educator_edge_top_header_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'educator_edge_header_top_area_meta_options_map' ) ) {
	function educator_edge_header_top_area_meta_options_map( $header_meta_box ) {
		$hide_dep_options = educator_edge_get_hide_dep_for_top_header_area_meta_boxes();
		
		$top_header_container = educator_edge_add_admin_container_no_style(
			array(
				'type'            => 'container',
				'name'            => 'top_header_container',
				'parent'          => $header_meta_box,
				'hidden_property' => 'edgt_header_type_meta',
				'hidden_values'   => $hide_dep_options
			)
		);
		
		educator_edge_add_admin_section_title(
			array(
				'parent' => $top_header_container,
				'name'   => 'top_area_style',
				'title'  => esc_html__( 'Top Area', 'educator' )
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_top_bar_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Top Bar', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will show header top bar area', 'educator' ),
				'parent'        => $top_header_container,
				'options'       => educator_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#edgt_top_bar_container_no_style',
						'no'  => '#edgt_top_bar_container_no_style',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#edgt_top_bar_container_no_style'
					)
				)
			)
		);
		
		$top_bar_container = educator_edge_add_admin_container_no_style(
			array(
				'name'            => 'top_bar_container_no_style',
				'parent'          => $top_header_container,
				'hidden_property' => 'edgt_top_bar_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_top_bar_in_grid_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar In Grid', 'educator' ),
				'description'   => esc_html__( 'Set top bar content to be in grid', 'educator' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => educator_edge_get_yes_no_select_array()
			)
		);

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_top_bar_skin_meta',
                'type' => 'select',
                'label' => esc_html__('Top Bar Skin', 'educator'),
                'options' => array(
                    '' => esc_html__('Default', 'educator'),
                    'light' => esc_html__('Light', 'educator'),
                    'dark' => esc_html__('Dark', 'educator')
                ),
                'parent' => $top_bar_container
            )
        );
		
		educator_edge_add_meta_box_field(
			array(
				'name'   => 'edgt_top_bar_background_color_meta',
				'type'   => 'color',
				'label'  => esc_html__( 'Top Bar Background Color', 'educator' ),
				'parent' => $top_bar_container
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_top_bar_background_transparency_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Top Bar Background Color Transparency', 'educator' ),
				'description' => esc_html__( 'Set top bar background color transparenct. Value should be between 0 and 1', 'educator' ),
				'parent'      => $top_bar_container,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_top_bar_border_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Top Bar Border', 'educator' ),
				'description'   => esc_html__( 'Set border on top bar', 'educator' ),
				'parent'        => $top_bar_container,
				'default_value' => '',
				'options'       => educator_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#edgt_top_bar_border_container',
						'no'  => '#edgt_top_bar_border_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#edgt_top_bar_border_container'
					)
				)
			)
		);
		
		$top_bar_border_container = educator_edge_add_admin_container(
			array(
				'type'            => 'container',
				'name'            => 'top_bar_border_container',
				'parent'          => $top_bar_container,
				'hidden_property' => 'edgt_top_bar_border_meta',
				'hidden_value'    => 'no',
				'hidden_values'   => array( '', 'no' )
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_top_bar_border_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Border Color', 'educator' ),
				'description' => esc_html__( 'Choose color for top bar border', 'educator' ),
				'parent'      => $top_bar_border_container
			)
		);
	}
	
	add_action( 'educator_edge_additional_header_area_meta_boxes_map', 'educator_edge_header_top_area_meta_options_map', 10, 1 );
}