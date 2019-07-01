<?php

if ( ! function_exists( 'educator_edge_map_footer_meta' ) ) {
	function educator_edge_map_footer_meta() {

		$edgt_custom_widgets = educator_edge_get_custom_sidebars();

		$footer_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => apply_filters( 'educator_edge_set_scope_for_meta_boxes', array( 'page', 'post' ) ),
				'title' => esc_html__( 'Footer', 'educator' ),
				'name'  => 'footer_meta'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_disable_footer_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Footer for this Page', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'educator' ),
				'parent'        => $footer_meta_box
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_show_footer_top_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Top', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'educator' ),
				'parent'        => $footer_meta_box,
				'options'       => educator_edge_get_yes_no_select_array()
			)
		);

        educator_edge_add_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'edgt_footer_top_skin_meta',
                'default_value' => '',
                'label'         => esc_html__('Footer Top Skin', 'educator'),
                'description'   => esc_html__('Choose a footer top style to make footer top widgets in that predefined style', 'educator'),
                'options'       => array(
                    ''         => '',
                    'light'    => esc_html__('Light', 'educator'),
                    'dark'     => esc_html__('Dark', 'educator')
                ),
                'parent'        => $footer_meta_box,
            )
        );
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_show_footer_bottom_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Footer Bottom', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'educator' ),
				'parent'        => $footer_meta_box,
				'options'       => educator_edge_get_yes_no_select_array()
			)
		);

        educator_edge_add_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'edgt_footer_bottom_skin_meta',
                'default_value' => '',
                'label'         => esc_html__('Footer Bottom Skin', 'educator'),
                'description'   => esc_html__('Choose a footer bottom style to make footer top widgets in that predefined style', 'educator'),
                'options'       => array(
                    ''         => '',
                    'light'    => esc_html__('Light', 'educator'),
                    'dark'     => esc_html__('Dark', 'educator')
                ),
                'parent'        => $footer_meta_box,
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'type'          => 'image',
                'name'          => 'edgt_footer_background_image_meta',
                'default_value' => '',
                'label'         => esc_html__( 'Footer Background Image', 'educator' ),
                'parent'        => $footer_meta_box,
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'type'          => 'select',
                'name'          => 'edgt_footer_transparency_meta',
                'default_value' => '',
                'label'         => esc_html__( 'Transparent Footer?', 'educator' ),
                'description'   => esc_html__( 'Enabling this option will make footer background transparent', 'educator' ),
                'options'       => array(
                    ''         => '',
                    'yes'    => esc_html__('Yes', 'educator'),
                    'no'     => esc_html__('No', 'educator')
                ),
                'parent'        => $footer_meta_box,
            )
        );

		educator_edge_add_meta_box_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_custom_widget_areas',
				'default_value' => 'no',
				'label'         => esc_html__('Use Custom Widget Areas in Footer', 'educator'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgt_footer_custom_widget_areas'
				),
				'parent'        => $footer_meta_box,
			)
		);

		$show_footer_custom_widget_areas = educator_edge_add_admin_container(
			array(
				'name'            => 'footer_custom_widget_areas',
				'hidden_property' => 'show_footer_custom_widget_areas',
				'hidden_value'    => 'no',
				'parent'          => $footer_meta_box
			)
		);

		$top_cols_num = 4;

		for ($i = 1; $i <= $top_cols_num; $i++) {

			educator_edge_add_meta_box_field(array(
				'name'        => 'edgt_footer_top_meta_' . $i,
				'type'        => 'selectblank',
				'label'       => esc_html__('Choose Widget Area in Footer Top Column ', 'educator') . $i,
				'description' => esc_html__('Choose Custom Widget area to display in Footer Top Column ', 'educator') . $i,
				'parent'      => $show_footer_custom_widget_areas,
				'options'     => $edgt_custom_widgets
			));

		}
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_map_footer_meta', 70 );
}