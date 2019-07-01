<?php

if ( ! function_exists( 'educator_edge_header_minimal_full_screen_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different full screen menu types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function educator_edge_header_minimal_full_screen_menu_body_class( $classes ) {
		$classes[] = 'edgt-' . educator_edge_options()->getOptionValue( 'fullscreen_menu_animation_style' );
		
		return $classes;
	}
	
	if ( educator_edge_check_is_header_type_enabled( 'header-minimal', educator_edge_get_page_id() ) ) {
		add_filter( 'body_class', 'educator_edge_header_minimal_full_screen_menu_body_class' );
	}
}

if ( ! function_exists( 'educator_edge_get_header_minimal_full_screen_menu' ) ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function educator_edge_get_header_minimal_full_screen_menu() {
		$parameters = array(
			'fullscreen_menu_in_grid' => educator_edge_options()->getOptionValue( 'fullscreen_in_grid' ) === 'yes' ? true : false
		);
		
		educator_edge_get_module_template_part( 'templates/full-screen-menu', 'header/types/header-minimal', '', $parameters );
	}
	
	if ( educator_edge_check_is_header_type_enabled( 'header-minimal', educator_edge_get_page_id() ) ) {
		add_action( 'educator_edge_after_header_area', 'educator_edge_get_header_minimal_full_screen_menu', 10 );
	}
}