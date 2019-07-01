<?php

if ( ! function_exists( 'educator_edge_get_title_types_options' ) ) {
	function educator_edge_get_title_types_options() {
		$title_type_options = apply_filters( 'educator_edge_title_type_global_option', $title_type_options = array() );
		
		return $title_type_options;
	}
}

if ( ! function_exists( 'educator_edge_get_title_type_default_options' ) ) {
	function educator_edge_get_title_type_default_options() {
		$title_type_option = apply_filters( 'educator_edge_default_title_type_global_option', $title_type_option = '' );
		
		return $title_type_option;
	}
}

foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/options-map/*.php' ) as $options_load ) {
	include_once $options_load;
}

if ( ! function_exists('educator_edge_title_options_map') ) {
	function educator_edge_title_options_map() {
		$title_type_options        = educator_edge_get_title_types_options();
		$title_type_default_option = educator_edge_get_title_type_default_options();

		educator_edge_add_admin_page(
			array(
				'slug' => '_title_page',
				'title' => esc_html__('Title', 'educator'),
				'icon' => 'fa fa-list-alt'
			)
		);

		$panel_title = educator_edge_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title',
				'title' => esc_html__('Title Settings', 'educator')
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'show_title_area',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Title Area', 'educator' ),
				'description'   => esc_html__( 'This option will enable/disable Title Area', 'educator' ),
				'parent'        => $panel_title,
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgt_show_title_area_container'
				)
			)
		);
		
			$show_title_area_container = educator_edge_add_admin_container(
				array(
					'parent'          => $panel_title,
					'name'            => 'show_title_area_container',
					'hidden_property' => 'show_title_area',
					'hidden_value'    => 'no'
				)
			);
		
				educator_edge_add_admin_field(
					array(
						'name'          => 'title_area_type',
						'type'          => 'select',
						'default_value' => $title_type_default_option,
						'label'         => esc_html__( 'Title Area Type', 'educator' ),
						'description'   => esc_html__( 'Choose title type', 'educator' ),
						'parent'        => $show_title_area_container,
						'options'       => $title_type_options
					)
				);
		
					educator_edge_add_admin_field(
						array(
							'name'        => 'title_area_height',
							'type'        => 'text',
							'label'       => esc_html__( 'Height', 'educator' ),
							'description' => esc_html__( 'Set a height for Title Area', 'educator' ),
							'parent'      => $show_title_area_container,
							'args'        => array(
								'col_width' => 2,
								'suffix'    => 'px'
							)
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'name'        => 'title_area_background_color',
							'type'        => 'color',
							'label'       => esc_html__( 'Background Color', 'educator' ),
							'description' => esc_html__( 'Choose a background color for Title Area', 'educator' ),
							'parent'      => $show_title_area_container
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'name'        => 'title_area_background_image',
							'type'        => 'image',
							'label'       => esc_html__( 'Background Image', 'educator' ),
							'description' => esc_html__( 'Choose an Image for Title Area', 'educator' ),
							'parent'      => $show_title_area_container
						)
					);
		
					educator_edge_add_admin_field(
						array(
							'name'          => 'title_area_background_image_behavior',
							'type'          => 'select',
							'default_value' => '',
							'label'         => esc_html__( 'Background Image Behavior', 'educator' ),
							'description'   => esc_html__( 'Choose title area background image behavior', 'educator' ),
							'parent'        => $show_title_area_container,
							'options'       => array(
								''                  => esc_html__( 'Default', 'educator' ),
								'responsive'        => esc_html__( 'Enable Responsive Image', 'educator' ),
								'parallax'          => esc_html__( 'Enable Parallax Image', 'educator' ),
								'parallax-zoom-out' => esc_html__( 'Enable Parallax With Zoom Out Image', 'educator' )
							)
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'name'          => 'title_area_vertical_alignment',
							'type'          => 'select',
							'default_value' => 'header_bottom',
							'label'         => esc_html__( 'Vertical Alignment', 'educator' ),
							'description'   => esc_html__( 'Specify title vertical alignment', 'educator' ),
							'parent'        => $show_title_area_container,
							'options'       => array(
								'header_bottom' => esc_html__( 'From Bottom of Header', 'educator' ),
								'window_top'    => esc_html__( 'From Window Top', 'educator' )
							)
						)
					);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'educator_edge_additional_title_area_options_map', $show_title_area_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
		
		$panel_typography = educator_edge_add_admin_panel(
			array(
				'page'  => '_title_page',
				'name'  => 'panel_title_typography',
				'title' => esc_html__( 'Typography', 'educator' )
			)
		);
		
			educator_edge_add_admin_section_title(
				array(
					'name'   => 'type_section_title',
					'title'  => esc_html__( 'Title', 'educator' ),
					'parent' => $panel_typography
				)
			);
		
			$group_page_title_styles = educator_edge_add_admin_group(
				array(
					'name'        => 'group_page_title_styles',
					'title'       => esc_html__( 'Title', 'educator' ),
					'description' => esc_html__( 'Define styles for page title', 'educator' ),
					'parent'      => $panel_typography
				)
			);
		
				$row_page_title_styles_1 = educator_edge_add_admin_row(
					array(
						'name'   => 'row_page_title_styles_1',
						'parent' => $group_page_title_styles
					)
				);
		
					educator_edge_add_admin_field(
						array(
							'name' => 'title_area_title_tag',
							'type' => 'selectsimple',
							'default_value' => 'h3',
							'label' => esc_html__('Title Tag', 'educator'),
							'parent' => $row_page_title_styles_1,
							'options' => educator_edge_get_title_tag()
						)
					);
		
				$row_page_title_styles_2 = educator_edge_add_admin_row(
					array(
						'name'   => 'row_page_title_styles_2',
						'parent' => $group_page_title_styles
					)
				);
		
					educator_edge_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'page_title_color',
							'default_value' => '',
							'label'         => esc_html__( 'Text Color', 'educator' ),
							'parent'        => $row_page_title_styles_2
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_title_font_size',
							'default_value' => '',
							'label'         => esc_html__( 'Font Size', 'educator' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_title_styles_2
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_title_line_height',
							'default_value' => '',
							'label'         => esc_html__( 'Line Height', 'educator' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_title_styles_2
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_title_text_transform',
							'default_value' => '',
							'label'         => esc_html__( 'Text Transform', 'educator' ),
							'options'       => educator_edge_get_text_transform_array(),
							'parent'        => $row_page_title_styles_2
						)
					);
		
				$row_page_title_styles_3 = educator_edge_add_admin_row(
					array(
						'name'   => 'row_page_title_styles_3',
						'parent' => $group_page_title_styles,
						'next'   => true
					)
				);
		
					educator_edge_add_admin_field(
						array(
							'type'          => 'fontsimple',
							'name'          => 'page_title_google_fonts',
							'default_value' => '-1',
							'label'         => esc_html__( 'Font Family', 'educator' ),
							'parent'        => $row_page_title_styles_3
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_title_font_style',
							'default_value' => '',
							'label'         => esc_html__( 'Font Style', 'educator' ),
							'options'       => educator_edge_get_font_style_array(),
							'parent'        => $row_page_title_styles_3
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_title_font_weight',
							'default_value' => '',
							'label'         => esc_html__( 'Font Weight', 'educator' ),
							'options'       => educator_edge_get_font_weight_array(),
							'parent'        => $row_page_title_styles_3
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_title_letter_spacing',
							'default_value' => '',
							'label'         => esc_html__( 'Letter Spacing', 'educator' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_title_styles_3
						)
					);
		
			educator_edge_add_admin_section_title(
				array(
					'name'   => 'type_section_subtitle',
					'title'  => esc_html__( 'Subtitle', 'educator' ),
					'parent' => $panel_typography
				)
			);
		
			$group_page_subtitle_styles = educator_edge_add_admin_group(
				array(
					'name'        => 'group_page_subtitle_styles',
					'title'       => esc_html__( 'Subtitle', 'educator' ),
					'description' => esc_html__( 'Define styles for page subtitle', 'educator' ),
					'parent'      => $panel_typography
				)
			);
		
				$row_page_subtitle_styles_1 = educator_edge_add_admin_row(
					array(
						'name'   => 'row_page_subtitle_styles_1',
						'parent' => $group_page_subtitle_styles
					)
				);
		
					educator_edge_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'page_subtitle_color',
							'default_value' => '',
							'label'         => esc_html__( 'Text Color', 'educator' ),
							'parent'        => $row_page_subtitle_styles_1
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_subtitle_font_size',
							'default_value' => '',
							'label'         => esc_html__( 'Font Size', 'educator' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_subtitle_styles_1
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_subtitle_line_height',
							'default_value' => '',
							'label'         => esc_html__( 'Line Height', 'educator' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_subtitle_styles_1
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_subtitle_text_transform',
							'default_value' => '',
							'label'         => esc_html__( 'Text Transform', 'educator' ),
							'options'       => educator_edge_get_text_transform_array(),
							'parent'        => $row_page_subtitle_styles_1
						)
					);
		
				$row_page_subtitle_styles_2 = educator_edge_add_admin_row(
					array(
						'name'   => 'row_page_subtitle_styles_2',
						'parent' => $group_page_subtitle_styles,
						'next'   => true
					)
				);
		
					educator_edge_add_admin_field(
						array(
							'type'          => 'fontsimple',
							'name'          => 'page_subtitle_google_fonts',
							'default_value' => '-1',
							'label'         => esc_html__( 'Font Family', 'educator' ),
							'parent'        => $row_page_subtitle_styles_2
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_subtitle_font_style',
							'default_value' => '',
							'label'         => esc_html__( 'Font Style', 'educator' ),
							'options'       => educator_edge_get_font_style_array(),
							'parent'        => $row_page_subtitle_styles_2
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'selectblanksimple',
							'name'          => 'page_subtitle_font_weight',
							'default_value' => '',
							'label'         => esc_html__( 'Font Weight', 'educator' ),
							'options'       => educator_edge_get_font_weight_array(),
							'parent'        => $row_page_subtitle_styles_2
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'textsimple',
							'name'          => 'page_subtitle_letter_spacing',
							'default_value' => '',
							'label'         => esc_html__( 'Letter Spacing', 'educator' ),
							'args'          => array(
								'suffix' => 'px'
							),
							'parent'        => $row_page_subtitle_styles_2
						)
					);
		
		/***************** Additional Title Typography Layout - start *****************/
		
		do_action( 'educator_edge_additional_title_typography_options_map', $panel_typography );
		
		/***************** Additional Title Typography Layout - end *****************/
    }

	add_action( 'educator_edge_options_map', 'educator_edge_title_options_map', 6);
}