<?php

if ( ! function_exists( 'educator_edge_register_sidebars' ) ) {
	/**
	 * Function that registers theme's sidebars
	 */
	function educator_edge_register_sidebars() {
		
		register_sidebar(
			array(
				'id'            => 'sidebar',
				'name'          => esc_html__( 'Sidebar', 'educator' ),
				'description'   => esc_html__( 'Default Sidebar', 'educator' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgt-widget-title-holder"><h4 class="edgt-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'educator_edge_register_sidebars', 1 );
}

if ( ! function_exists( 'educator_edge_add_support_custom_sidebar' ) ) {
	/**
	 * Function that adds theme support for custom sidebars. It also creates EducatorEdgeSidebar object
	 */
	function educator_edge_add_support_custom_sidebar() {
		add_theme_support( 'EducatorEdgeSidebar' );
		
		if ( get_theme_support( 'EducatorEdgeSidebar' ) ) {
			new EducatorEdgeSidebar();
		}
	}
	
	add_action( 'after_setup_theme', 'educator_edge_add_support_custom_sidebar' );
}