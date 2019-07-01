<?php

if ( ! function_exists( 'educator_edge_map_general_meta' ) ) {
	function educator_edge_map_general_meta() {
		
		$general_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => apply_filters( 'educator_edge_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'General', 'educator' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'educator' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'educator' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'educator' ),
				'parent'        => $general_meta_box,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$edgt_content_padding_group = educator_edge_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Style', 'educator' ),
				'description' => esc_html__( 'Define styles for Content area', 'educator' ),
				'parent'      => $general_meta_box
			)
		);
		
			$edgt_content_padding_row = educator_edge_add_admin_row(
				array(
					'name'   => 'edgt_content_padding_row',
					'next'   => true,
					'parent' => $edgt_content_padding_group
				)
			);
		
				educator_edge_add_meta_box_field(
					array(
						'name'   => 'edgt_page_content_top_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Top Padding', 'educator' ),
						'parent' => $edgt_content_padding_row,
						'args'   => array(
							'suffix' => 'px'
						)
					)
				);
				
				educator_edge_add_meta_box_field(
					array(
						'name'    => 'edgt_page_content_top_padding_mobile',
						'type'    => 'selectsimple',
						'label'   => esc_html__( 'Set this top padding for mobile header', 'educator' ),
						'parent'  => $edgt_content_padding_row,
						'options' => educator_edge_get_yes_no_select_array( false )
					)
				);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_page_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'educator' ),
				'description' => esc_html__( 'Choose background color for page content', 'educator' ),
				'parent'      => $general_meta_box
			)
		);

		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_page_background_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Page Background Image', 'educator' ),
				'description' => esc_html__( 'Choose background image for page content', 'educator' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		educator_edge_add_meta_box_field(
			array(
				'name'    => 'edgt_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'educator' ),
				'parent'  => $general_meta_box,
				'options' => educator_edge_get_yes_no_select_array(),
				'args'    => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#edgt_boxed_container_meta',
						'no'  => '#edgt_boxed_container_meta',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#edgt_boxed_container_meta'
					)
				)
			)
		);
		
			$boxed_container_meta = educator_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'hidden_property' => 'edgt_boxed_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				educator_edge_add_meta_box_field(
					array(
						'name'        => 'edgt_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'educator' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'educator' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				educator_edge_add_meta_box_field(
					array(
						'name'        => 'edgt_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'educator' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'educator' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				educator_edge_add_meta_box_field(
					array(
						'name'        => 'edgt_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'educator' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'educator' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				educator_edge_add_meta_box_field(
					array(
						'name'          => 'edgt_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => 'fixed',
						'label'         => esc_html__( 'Background Image Attachment', 'educator' ),
						'description'   => esc_html__( 'Choose background image attachment', 'educator' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'educator' ),
							'fixed'  => esc_html__( 'Fixed', 'educator' ),
							'scroll' => esc_html__( 'Scroll', 'educator' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'educator' ),
				'parent'        => $general_meta_box,
				'options'       => educator_edge_get_yes_no_select_array(),
				'args'    => array(
					'dependence'    => true,
					'hide'          => array(
						''    => '#edgt_edgt_paspartu_container_meta',
						'no'  => '#edgt_edgt_paspartu_container_meta',
						'yes' => ''
					),
					'show'          => array(
						''    => '',
						'no'  => '',
						'yes' => '#edgt_edgt_paspartu_container_meta'
					)
				)
			)
		);
		
			$paspartu_container_meta = educator_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'edgt_paspartu_container_meta',
					'hidden_property' => 'edgt_paspartu_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				educator_edge_add_meta_box_field(
					array(
						'name'        => 'edgt_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'educator' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'educator' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				educator_edge_add_meta_box_field(
					array(
						'name'        => 'edgt_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'educator' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'educator' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				educator_edge_add_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'edgt_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'educator' ),
						'options'       => educator_edge_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Width Layout - begin **********************/
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'educator' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'educator' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'educator' ),
					'edgt-grid-1100' => esc_html__( '1100px', 'educator' ),
					'edgt-grid-1300' => esc_html__( '1300px', 'educator' ),
					'edgt-grid-1200' => esc_html__( '1200px', 'educator' ),
					'edgt-grid-1000' => esc_html__( '1000px', 'educator' ),
					'edgt-grid-800'  => esc_html__( '800px', 'educator' )
				)
			)
		);
		
		/***************** Content Width Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'educator' ),
				'parent'        => $general_meta_box,
				'options'       => educator_edge_get_yes_no_select_array(),
				'args'          => array(
					'dependence' => true,
					'hide'       => array(
						''    => '#edgt_page_transitions_container_meta',
						'no'  => '#edgt_page_transitions_container_meta',
						'yes' => ''
					),
					'show'       => array(
						''    => '',
						'no'  => '',
						'yes' => '#edgt_page_transitions_container_meta'
					)
				)
			)
		);
		
			$page_transitions_container_meta = educator_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'page_transitions_container_meta',
					'hidden_property' => 'edgt_smooth_page_transitions_meta',
					'hidden_values'   => array(
						'',
						'no'
					)
				)
			);
		
				educator_edge_add_meta_box_field(
					array(
						'name'        => 'edgt_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'educator' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'educator' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => educator_edge_get_yes_no_select_array(),
						'args'        => array(
							'dependence' => true,
							'hide'       => array(
								''    => '#edgt_page_transition_preloader_container_meta',
								'no'  => '#edgt_page_transition_preloader_container_meta',
								'yes' => ''
							),
							'show'       => array(
								''    => '',
								'no'  => '',
								'yes' => '#edgt_page_transition_preloader_container_meta'
							)
						)
					)
				);
				
				$page_transition_preloader_container_meta = educator_edge_add_admin_container(
					array(
						'parent'          => $page_transitions_container_meta,
						'name'            => 'page_transition_preloader_container_meta',
						'hidden_property' => 'edgt_page_transition_preloader_meta',
						'hidden_values'   => array(
							'',
							'no'
						)
					)
				);
				
					educator_edge_add_meta_box_field(
						array(
							'name'   => 'edgt_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'educator' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = educator_edge_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'educator' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'educator' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = educator_edge_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					educator_edge_add_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'edgt_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'educator' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'educator' ),
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
					
					educator_edge_add_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'edgt_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'educator' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					educator_edge_add_meta_box_field(
						array(
							'name'        => 'edgt_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'educator' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'educator' ),
							'options'     => educator_edge_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'educator' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'educator' ),
				'parent'      => $general_meta_box,
				'options'     => educator_edge_get_yes_no_select_array()
			)
		);

		/***************** Page First Main Color - begin **********************/

		educator_edge_add_meta_box_field(
				array(
						'name'        => 'edgt_first_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'First Main Color', 'educator' ),
						'description' => esc_html__( 'Choose a default first main color for this page page', 'educator' ),
						'parent'      => $general_meta_box,
				)
		);

		/***************** Page First Main Color - end **********************/
		
		/***************** Comments Layout - end **********************/

		/***************** Page Fonts - begin **********************/

		educator_edge_add_meta_box_field(
				array(
						'name'        => 'edgt_predefined_font_type_meta',
						'type'        => 'selectblank',
						'label'       => esc_html__( 'Predefined Font Type', 'educator' ),
						'description' => esc_html__( 'Choose a default font type for your page', 'educator' ),
						'parent'      => $general_meta_box,
						'options'       => array(
							'edgt-predefined-font-type-1'  => esc_html__( 'Montserrat', 'educator' ),
							'edgt-predefined-font-type-2'  => esc_html__( 'Nunito', 'educator' ),
							'edgt-predefined-font-type-3'  => esc_html__( 'Lora', 'educator' ),
						),
				)
		);

		/***************** Page Fonts - end **********************/
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_map_general_meta', 10 );
}