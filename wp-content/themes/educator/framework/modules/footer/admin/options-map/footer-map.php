<?php

if ( ! function_exists( 'educator_edge_footer_options_map' ) ) {
	function educator_edge_footer_options_map() {
		
		educator_edge_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'educator' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);
		
		$footer_panel = educator_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'educator' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'educator' ),
				'parent'        => $footer_panel,
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'educator' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgt_show_footer_top_container'
				),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_top_container = educator_edge_add_admin_container(
			array(
				'name'            => 'show_footer_top_container',
				'hidden_property' => 'show_footer_top',
				'hidden_value'    => 'no',
				'parent'          => $footer_panel
			)
		);

        educator_edge_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_top_skin',
                'default_value' => '',
                'label'         => esc_html__('Footer Top Skin', 'educator'),
                'description'   => esc_html__('Choose a footer top style to make footer top widgets in that predefined style', 'educator'),
                'options'       => array(
                    ''         => esc_html__('Default', 'educator'),
                    'dark'     => esc_html__('Dark', 'educator'),
                    'light'    => esc_html__('Light', 'educator'),
                ),
                'parent'        => $show_footer_top_container,
            )
        );
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '4',
				'label'         => esc_html__( 'Footer Top Columns', 'educator' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'educator' ),
				'options'       => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'educator' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'educator' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'educator' ),
					'left'   => esc_html__( 'Left', 'educator' ),
					'center' => esc_html__( 'Center', 'educator' ),
					'right'  => esc_html__( 'Right', 'educator' )
				),
				'parent'        => $show_footer_top_container,
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'educator' ),
				'description' => esc_html__( 'Set background color for top footer area', 'educator' ),
				'parent'      => $show_footer_top_container
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'educator' ),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgt_show_footer_bottom_container'
				),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_bottom_container = educator_edge_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'hidden_property' => 'show_footer_bottom',
				'hidden_value'    => 'no',
				'parent'          => $footer_panel
			)
		);

        educator_edge_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'footer_bottom_skin',
                'default_value' => '',
                'label'         => esc_html__('Footer Bottom Skin', 'educator'),
                'description'   => esc_html__('Choose a footer bottom style to make footer bottom widgets in that predefined style', 'educator'),
                'options'       => array(
                    ''         => esc_html__('Default', 'educator'),
                    'dark'     => esc_html__('Dark', 'educator'),
                    'light'    => esc_html__('Light', 'educator'),
                ),
                'parent'        => $show_footer_bottom_container,
            )
        );
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '4',
				'label'         => esc_html__( 'Footer Bottom Columns', 'educator' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'educator' ),
				'options'       => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'educator' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'educator' ),
				'parent'      => $show_footer_bottom_container
			)
		);

        educator_edge_add_admin_field(
            array(
                'type'          => 'image',
                'name'          => 'footer_background_image',
                'default_value' => '',
                'label'         => esc_html__( 'Footer Background Image', 'educator' ),
                'parent'        => $footer_panel,
            )
        );

        educator_edge_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'footer_transparency',
                'default_value' => 'no',
                'label'         => esc_html__( 'Transparent Footer?', 'educator' ),
                'description'   => esc_html__( 'Enabling this option will make footer background transparent', 'educator' ),
                'parent'        => $footer_panel,
            )
        );
	}
	
	add_action( 'educator_edge_options_map', 'educator_edge_footer_options_map', 11 );
}