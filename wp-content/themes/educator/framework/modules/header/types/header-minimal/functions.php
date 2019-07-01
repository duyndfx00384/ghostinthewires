<?php

if ( ! function_exists( 'educator_edge_register_header_minimal_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function educator_edge_register_header_minimal_type( $header_types ) {
		$header_type = array(
			'header-minimal' => 'EducatorEdge\Modules\Header\Types\HeaderMinimal'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'educator_edge_init_register_header_minimal_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function educator_edge_init_register_header_minimal_type() {
		add_filter( 'educator_edge_register_header_type_class', 'educator_edge_register_header_minimal_type' );
	}
	
	add_action( 'educator_edge_before_header_function_init', 'educator_edge_init_register_header_minimal_type' );
}

if ( ! function_exists( 'educator_edge_include_header_minimal_full_screen_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function educator_edge_include_header_minimal_full_screen_menu( $menus ) {
		$menus['popup-navigation'] = esc_html__( 'Full Screen Navigation', 'educator' );
		
		return $menus;
	}
	
	if ( educator_edge_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_filter( 'educator_edge_register_headers_menu', 'educator_edge_include_header_minimal_full_screen_menu' );
	}
}

if ( ! function_exists( 'educator_edge_register_header_minimal_full_screen_menu_widgets' ) ) {
	/**
	 * Registers additional widget areas for this header type
	 */
	function educator_edge_register_header_minimal_full_screen_menu_widgets() {
		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_above',
				'name'          => esc_html__( 'Fullscreen Menu Top', 'educator' ),
				'description'   => esc_html__( 'This widget area is rendered above full screen menu', 'educator' ),
				'before_widget' => '<div class="%2$s edgt-fullscreen-menu-above-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="edgt-widget-title">',
				'after_title'   => '</h5>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_below',
				'name'          => esc_html__( 'Fullscreen Menu Bottom', 'educator' ),
				'description'   => esc_html__( 'This widget area is rendered below full screen menu', 'educator' ),
				'before_widget' => '<div class="%2$s edgt-fullscreen-menu-below-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="edgt-widget-title">',
				'after_title'   => '</h5>'
			)
		);
	}
	
	if ( educator_edge_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_action( 'widgets_init', 'educator_edge_register_header_minimal_full_screen_menu_widgets' );
	}
}