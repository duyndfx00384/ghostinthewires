<?php

if ( ! function_exists( 'educator_edge_get_title_types_meta_boxes' ) ) {
	function educator_edge_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'educator_edge_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'educator' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'educator_edge_map_title_meta' ) ) {
	function educator_edge_map_title_meta() {
		$title_type_meta_boxes = educator_edge_get_title_types_meta_boxes();
		
		$title_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => apply_filters( 'educator_edge_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Title', 'educator' ),
				'name'  => 'title_meta'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'educator' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'educator' ),
				'parent'        => $title_meta_box,
				'options'       => educator_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '',
						'no'  => '#edgt_edgt_show_title_area_meta_container',
						'yes' => ''
					),
					'show'       => array(
						''    => '#edgt_edgt_show_title_area_meta_container',
						'no'  => '',
						'yes' => '#edgt_edgt_show_title_area_meta_container'
					)
				)
			)
		);
		
			$show_title_area_meta_container = educator_edge_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'edgt_show_title_area_meta_container',
					'hidden_property' => 'edgt_show_title_area_meta',
					'hidden_value'    => 'no'
				)
			);
		
				educator_edge_add_meta_box_field(
					array(
						'name'          => 'edgt_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'educator' ),
						'description'   => esc_html__( 'Choose title type', 'educator' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				educator_edge_add_meta_box_field(
					array(
						'name'        => 'edgt_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'educator' ),
						'description' => esc_html__( 'Set a height for Title Area', 'educator' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				educator_edge_add_meta_box_field(
					array(
						'name'        => 'edgt_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'educator' ),
						'description' => esc_html__( 'Choose a background color for title area', 'educator' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				educator_edge_add_meta_box_field(
					array(
						'name'        => 'edgt_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'educator' ),
						'description' => esc_html__( 'Choose an Image for title area', 'educator' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				educator_edge_add_meta_box_field(
					array(
						'name'          => 'edgt_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'educator' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'educator' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'educator' ),
							'hide'                => esc_html__( 'Hide Image', 'educator' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'educator' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'educator' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'educator' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'educator' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'educator' )
						)
					)
				);
				
				educator_edge_add_meta_box_field(
					array(
						'name'          => 'edgt_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'educator' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'educator' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'educator' ),
							'header_bottom' => esc_html__( 'From Bottom of Header', 'educator' ),
							'window_top'    => esc_html__( 'From Window Top', 'educator' )
						)
					)
				);
				
				educator_edge_add_meta_box_field(
					array(
						'name'          => 'edgt_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'educator' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => educator_edge_get_title_tag( true )
					)
				);
				
				educator_edge_add_meta_box_field(
					array(
						'name'        => 'edgt_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'educator' ),
						'description' => esc_html__( 'Choose a color for title text', 'educator' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				educator_edge_add_meta_box_field(
					array(
						'name'          => 'edgt_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'educator' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'educator' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
				
				educator_edge_add_meta_box_field(
					array(
						'name'        => 'edgt_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'educator' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'educator' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'educator_edge_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_map_title_meta', 60 );
}