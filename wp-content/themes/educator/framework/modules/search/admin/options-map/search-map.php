<?php

if ( ! function_exists('educator_edge_search_options_map') ) {

	function educator_edge_search_options_map() {

		educator_edge_add_admin_page(
			array(
				'slug' => '_search_page',
				'title' => esc_html__('Search', 'educator'),
				'icon' => 'fa fa-search'
			)
		);

		$search_page_panel = educator_edge_add_admin_panel(
			array(
				'title' => esc_html__('Search Page', 'educator'),
				'name' => 'search_template',
				'page' => '_search_page'
			)
		);

        educator_edge_add_admin_field(array(
            'name'        => 'search_page_layout',
            'type'        => 'select',
            'label'       => esc_html__('Layout', 'educator'),
            'default_value' => 'in-grid',
            'description' => esc_html__('Set layout. Default is in grid.', 'educator'),
            'parent'      => $search_page_panel,
            'options'     => array(
                'in-grid'    => esc_html__('In Grid', 'educator'),
                'full-width' => esc_html__('Full Width', 'educator')
            )
        ));

		educator_edge_add_admin_field(array(
			'name'        => 'search_page_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'educator'),
            'description' 	=> esc_html__("Choose a sidebar layout for search page", 'educator'),
            'default_value' => 'no-sidebar',
            'options'       => array(
                'no-sidebar'        => esc_html__('No Sidebar', 'educator'),
                'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'educator'),
                'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'educator'),
                'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'educator'),
                'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'educator')
            ),
			'parent'      => $search_page_panel
		));

        $educator_custom_sidebars = educator_edge_get_custom_sidebars();
        if(count($educator_custom_sidebars) > 0) {
            educator_edge_add_admin_field(array(
                'name' => 'search_custom_sidebar_area',
                'type' => 'selectblank',
                'label' => esc_html__('Sidebar to Display', 'educator'),
                'description' => esc_html__('Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'educator'),
                'parent' => $search_page_panel,
                'options' => $educator_custom_sidebars,
				'args' => array(
					'select2' => true
				)
            ));
        }

		$search_panel = educator_edge_add_admin_panel(
			array(
				'title' => esc_html__('Search', 'educator'),
				'name' => 'search',
				'page' => '_search_page'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_icon_pack',
				'default_value'	=> 'font_awesome',
				'label'			=> esc_html__('Search Icon Pack', 'educator'),
				'description'	=> esc_html__('Choose icon pack for search icon', 'educator'),
				'options'		=> educator_edge_icon_collections()->getIconCollectionsExclude(array('linea_icons'))
			)
		);
		
		educator_edge_add_admin_section_title(
			array(
				'parent' 	=> $search_panel,
				'name'		=> 'initial_header_icon_title',
				'title'		=> esc_html__('Initial Search Icon in Header', 'educator')
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'text',
				'name'			=> 'header_search_icon_size',
				'default_value'	=> '',
				'label'			=> esc_html__('Icon Size', 'educator'),
				'description'	=> esc_html__('Set size for icon', 'educator'),
				'args'			=> array(
					'col_width' => 3,
					'suffix'	=> 'px'
				)
			)
		);
		
		$search_icon_color_group = educator_edge_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title'		=> esc_html__('Icon Colors', 'educator'),
				'description' => esc_html__('Define color style for icon', 'educator'),
				'name'		=> 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = educator_edge_add_admin_row(
			array(
				'parent'	=> $search_icon_color_group,
				'name'		=> 'search_icon_color_row'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'	=> $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_color',
				'label'		=> esc_html__('Color', 'educator')
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'		=> 'colorsimple',
				'name'		=> 'header_search_icon_hover_color',
				'label'		=> esc_html__('Hover Color', 'educator')
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'yesno',
				'name'			=> 'enable_search_icon_text',
				'default_value'	=> 'no',
				'label'			=> esc_html__('Enable Search Icon Text', 'educator'),
				'description'	=> esc_html__("Enable this option to show 'Search' text next to search icon in header", 'educator'),
				'args'			=> array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgt_enable_search_icon_text_container'
				)
			)
		);
		
		$enable_search_icon_text_container = educator_edge_add_admin_container(
			array(
				'parent'			=> $search_panel,
				'name'				=> 'enable_search_icon_text_container',
				'hidden_property'	=> 'enable_search_icon_text',
				'hidden_value'		=> 'no'
			)
		);
		
		$enable_search_icon_text_group = educator_edge_add_admin_group(
			array(
				'parent'	=> $enable_search_icon_text_container,
				'title'		=> esc_html__('Search Icon Text', 'educator'),
				'name'		=> 'enable_search_icon_text_group',
				'description'	=> esc_html__('Define style for search icon text', 'educator')
			)
		);
		
		$enable_search_icon_text_row = educator_edge_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_text_color',
				'label'			=> esc_html__('Text Color', 'educator')
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'colorsimple',
				'name'			=> 'search_icon_text_color_hover',
				'label'			=> esc_html__('Text Hover Color', 'educator')
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_font_size',
				'label'			=> esc_html__('Font Size', 'educator'),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_line_height',
				'label'			=> esc_html__('Line Height', 'educator'),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = educator_edge_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row2',
				'next'		=> true
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_text_transform',
				'label'			=> esc_html__('Text Transform', 'educator'),
				'default_value'	=> '',
				'options'		=> educator_edge_get_text_transform_array()
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'fontsimple',
				'name'			=> 'search_icon_text_google_fonts',
				'label'			=> esc_html__('Font Family', 'educator'),
				'default_value'	=> '-1',
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_font_style',
				'label'			=> esc_html__('Font Style', 'educator'),
				'default_value'	=> '',
				'options'		=> educator_edge_get_font_style_array(),
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row2,
				'type'			=> 'selectblanksimple',
				'name'			=> 'search_icon_text_font_weight',
				'label'			=> esc_html__('Font Weight', 'educator'),
				'default_value'	=> '',
				'options'		=> educator_edge_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = educator_edge_add_admin_row(
			array(
				'parent'	=> $enable_search_icon_text_group,
				'name'		=> 'enable_search_icon_text_row3',
				'next'		=> true
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent'		=> $enable_search_icon_text_row3,
				'type'			=> 'textsimple',
				'name'			=> 'search_icon_text_letter_spacing',
				'label'			=> esc_html__('Letter Spacing', 'educator'),
				'default_value'	=> '',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);
	}

	add_action('educator_edge_options_map', 'educator_edge_search_options_map', 16);
}