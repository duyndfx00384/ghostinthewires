<?php

if ( ! function_exists( 'educator_edge_page_options_map' ) ) {
	function educator_edge_page_options_map() {
		
		educator_edge_add_admin_page(
			array(
				'slug'  => '_page_page',
				'title' => esc_html__( 'Page', 'educator' ),
				'icon'  => 'fa fa-file-text-o'
			)
		);
		
		/***************** Page Layout - begin **********************/
		
		$panel_sidebar = educator_edge_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_sidebar',
				'title' => esc_html__( 'Page Style', 'educator' )
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'page_show_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'educator' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'educator' ),
				'default_value' => 'yes',
				'parent'        => $panel_sidebar
			)
		);
		
		/***************** Page Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		$panel_content = educator_edge_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content',
				'title' => esc_html__( 'Content Style', 'educator' )
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_top_padding',
				'default_value' => '0',
				'label'         => esc_html__( 'Content Top Padding for Template in Full Width', 'educator' ),
				'description'   => esc_html__( 'Enter top padding for content area for templates in full width. If you set this value then it\'s important to set also Content top padding for mobile header value', 'educator' ),
				'args'          => array(
					'suffix'    => 'px',
					'col_width' => 3
				),
				'parent'        => $panel_content
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_top_padding_in_grid',
				'default_value' => '40',
				'label'         => esc_html__( 'Content Top Padding for Templates in Grid', 'educator' ),
				'description'   => esc_html__( 'Enter top padding for content area for Templates in grid. If you set this value then it\'s important to set also Content top padding for mobile header value', 'educator' ),
				'args'          => array(
					'suffix'    => 'px',
					'col_width' => 3
				),
				'parent'        => $panel_content
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'content_top_padding_mobile',
				'default_value' => '40',
				'label'         => esc_html__( 'Content Top Padding for Mobile Header', 'educator' ),
				'description'   => esc_html__( 'Enter top padding for content area for Mobile Header', 'educator' ),
				'args'          => array(
					'suffix'    => 'px',
					'col_width' => 3
				),
				'parent'        => $panel_content
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Additional Page Layout - start *****************/
		
		do_action( 'educator_edge_additional_page_options_map' );
		
		/***************** Additional Page Layout - end *****************/

		/***************** Sidebar Page Layout - start *****************/

		do_action( 'educator_edge_page_sidebar_options_map' );

		/***************** Sidebar Page Layout - end *****************/
	}
	
	add_action( 'educator_edge_options_map', 'educator_edge_page_options_map', 7 );
}