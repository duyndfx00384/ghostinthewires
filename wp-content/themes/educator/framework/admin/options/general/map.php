<?php

if ( ! function_exists( 'educator_edge_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function educator_edge_general_options_map() {
		
		educator_edge_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'educator' ),
				'icon'  => 'fa fa-institution'
			)
		);


		$panel_design_style = educator_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Appearance', 'educator' )
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'educator' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'educator' ),
				'parent'        => $panel_design_style
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'educator' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edgt_additional_google_fonts_container"
				)
			)
		);
		
		$additional_google_fonts_container = educator_edge_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'additional_google_fonts_container',
				'hidden_property' => 'additional_google_fonts',
				'hidden_value'    => 'no'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'educator' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'educator' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'educator' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'educator' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'educator' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'educator' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'educator' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'educator' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'educator' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'educator' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'educator' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'educator' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'100'       => esc_html__( '100 Thin', 'educator' ),
					'100italic' => esc_html__( '100 Thin Italic', 'educator' ),
					'200'       => esc_html__( '200 Extra-Light', 'educator' ),
					'200italic' => esc_html__( '200 Extra-Light Italic', 'educator' ),
					'300'       => esc_html__( '300 Light', 'educator' ),
					'300italic' => esc_html__( '300 Light Italic', 'educator' ),
					'400'       => esc_html__( '400 Regular', 'educator' ),
					'400italic' => esc_html__( '400 Regular Italic', 'educator' ),
					'500'       => esc_html__( '500 Medium', 'educator' ),
					'500italic' => esc_html__( '500 Medium Italic', 'educator' ),
					'600'       => esc_html__( '600 Semi-Bold', 'educator' ),
					'600italic' => esc_html__( '600 Semi-Bold Italic', 'educator' ),
					'700'       => esc_html__( '700 Bold', 'educator' ),
					'700italic' => esc_html__( '700 Bold Italic', 'educator' ),
					'800'       => esc_html__( '800 Extra-Bold', 'educator' ),
					'800italic' => esc_html__( '800 Extra-Bold Italic', 'educator' ),
					'900'       => esc_html__( '900 Ultra-Bold', 'educator' ),
					'900italic' => esc_html__( '900 Ultra-Bold Italic', 'educator' )
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'educator' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'educator' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'educator' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'educator' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'educator' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'educator' ),
					'greek'        => esc_html__( 'Greek', 'educator' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'educator' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'educator' )
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'educator' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #2d76b2', 'educator' ),
				'parent'      => $panel_design_style
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'educator' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'educator' ),
				'parent'      => $panel_design_style
			)
		);

		educator_edge_add_admin_field(
			array(
				'name'        => 'page_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Page Background Image', 'educator' ),
				'description' => esc_html__( 'Choose the background image for page content. ', 'educator' ),
				'parent'      => $panel_design_style
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'educator' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'educator' ),
				'parent'      => $panel_design_style
			)
		);
		
		/***************** Passepartout Layout - begin **********************/
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'educator' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edgt_boxed_container"
				)
			)
		);
		
			$boxed_container = educator_edge_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'boxed_container',
					'hidden_property' => 'boxed',
					'hidden_value'    => 'no'
				)
			);
		
				educator_edge_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'educator' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'educator' ),
						'parent'      => $boxed_container
					)
				);
				
				educator_edge_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'educator' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'educator' ),
						'parent'      => $boxed_container
					)
				);
				
				educator_edge_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'educator' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'educator' ),
						'parent'      => $boxed_container
					)
				);
				
				educator_edge_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'educator' ),
						'description'   => esc_html__( 'Choose background image attachment', 'educator' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'educator' ),
							'fixed'  => esc_html__( 'Fixed', 'educator' ),
							'scroll' => esc_html__( 'Scroll', 'educator' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'educator' ),
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edgt_paspartu_container"
				)
			)
		);
		
			$paspartu_container = educator_edge_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'paspartu_container',
					'hidden_property' => 'paspartu',
					'hidden_value'    => 'no'
				)
			);
		
				educator_edge_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'educator' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'educator' ),
						'parent'      => $paspartu_container
					)
				);
				
				educator_edge_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'educator' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'educator' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				educator_edge_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'educator' )
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'educator' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'educator' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'edgt-grid-1300' => esc_html__( '1300px - default', 'educator' ),
					'edgt-grid-1100' => esc_html__( '1100px', 'educator' ),
					'edgt-grid-1200' => esc_html__( '1200px', 'educator' ),
					'edgt-grid-1000' => esc_html__( '1000px', 'educator' ),
					'edgt-grid-800'  => esc_html__( '800px', 'educator' )
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'preload_pattern_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Preload Pattern Image', 'educator' ),
				'description'   => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'educator' ),
				'parent'        => $panel_design_style
			)
		);
		
		/***************** Content Layout - end **********************/
		
		$panel_settings = educator_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Behavior', 'educator' )
			)
		);
		
		/***************** Smooth Scroll Layout - begin **********************/
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'educator' ),
				'parent'        => $panel_settings
			)
		);
		
		/***************** Smooth Scroll Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'educator' ),
				'parent'        => $panel_settings,
				'args'          => array(
					"dependence"             => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edgt_page_transitions_container"
				)
			)
		);
		
			$page_transitions_container = educator_edge_add_admin_container(
				array(
					'parent'          => $panel_settings,
					'name'            => 'page_transitions_container',
					'hidden_property' => 'smooth_page_transitions',
					'hidden_value'    => 'no'
				)
			);
		
				educator_edge_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'educator' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'educator' ),
						'parent'        => $page_transitions_container,
						'args'          => array(
							"dependence"             => true,
							"dependence_hide_on_yes" => "",
							"dependence_show_on_yes" => "#edgt_page_transition_preloader_container"
						)
					)
				);
				
				$page_transition_preloader_container = educator_edge_add_admin_container(
					array(
						'parent'          => $page_transitions_container,
						'name'            => 'page_transition_preloader_container',
						'hidden_property' => 'page_transition_preloader',
						'hidden_value'    => 'no'
					)
				);
		
		
					educator_edge_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'educator' ),
							'parent' => $page_transition_preloader_container
						)
					);
					
					$group_pt_spinner_animation = educator_edge_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'educator' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'educator' ),
							'parent'      => $page_transition_preloader_container
						)
					);
					
					$row_pt_spinner_animation = educator_edge_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'educator' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'educator' ),
								'pulse'                 => esc_html__( 'Pulse', 'educator' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'educator' ),
								'cube'                  => esc_html__( 'Cube', 'educator' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'educator' ),
								'stripes'               => esc_html__( 'Stripes', 'educator' ),
								'wave'                  => esc_html__( 'Wave', 'educator' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'educator' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'educator' ),
								'atom'                  => esc_html__( 'Atom', 'educator' ),
								'clock'                 => esc_html__( 'Clock', 'educator' ),
								'mitosis'               => esc_html__( 'Mitosis', 'educator' ),
								'lines'                 => esc_html__( 'Lines', 'educator' ),
								'fussion'               => esc_html__( 'Fussion', 'educator' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'educator' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'educator' )
							)
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'educator' ),
							'parent'        => $row_pt_spinner_animation
						)
					);
					
					educator_edge_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'educator' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'educator' ),
							'parent'        => $page_transitions_container
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'educator' ),
				'parent'        => $panel_settings
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'educator' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = educator_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'educator' )
			)
		);
		
		
		educator_edge_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'educator' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'educator' ),
				'parent'      => $panel_custom_code
			)
		);
		
		$panel_google_api = educator_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'educator' )
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'educator' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'educator' ),
				'parent'      => $panel_google_api
			)
		);
	}
	
	add_action( 'educator_edge_options_map', 'educator_edge_general_options_map', 1 );
}

if ( ! function_exists( 'educator_edge_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function educator_edge_page_general_style( $style ) {
		$current_style = '';
		$page_id       = educator_edge_get_page_id();
		$class_prefix  = educator_edge_get_unique_page_class( $page_id );
		
		$boxed_background_style = array();
		
		$boxed_page_background_color = educator_edge_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
		
		$boxed_page_background_image = educator_edge_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}
		
		$boxed_page_background_pattern_image = educator_edge_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}
		
		$boxed_page_background_attachment = educator_edge_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}
		
		$boxed_background_selector = $class_prefix . '.edgt-boxed .edgt-wrapper';
		
		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= educator_edge_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}
		
		$paspartu_style = array();
		
		$paspartu_color = educator_edge_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}
		
		$paspartu_width = educator_edge_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( educator_edge_string_ends_with( $paspartu_width, '%' ) || educator_edge_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';
			}
		}
		
		$paspartu_selector = $class_prefix . '.edgt-paspartu-enabled .edgt-wrapper';
		
		if ( ! empty( $paspartu_style ) ) {
			$current_style .= educator_edge_dynamic_css( $paspartu_selector, $paspartu_style );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'educator_edge_add_page_custom_style', 'educator_edge_page_general_style' );
}