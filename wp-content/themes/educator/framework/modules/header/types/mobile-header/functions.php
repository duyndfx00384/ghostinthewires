<?php

if ( ! function_exists( 'educator_edge_include_mobile_header_menu' ) ) {
	function educator_edge_include_mobile_header_menu( $menus ) {
		$menus['mobile-navigation'] = esc_html__( 'Mobile Navigation', 'educator' );
		
		return $menus;
	}
	
	add_filter( 'educator_edge_register_headers_menu', 'educator_edge_include_mobile_header_menu' );
}

if ( ! function_exists( 'educator_edge_register_mobile_header_areas' ) ) {
	/**
	 * Registers widget areas for mobile header
	 */
	function educator_edge_register_mobile_header_areas() {
		if ( educator_edge_is_responsive_on() ) {
			register_sidebar(
				array(
					'id'            => 'edgt-mobile-menu-bottom',
					'name'          => esc_html__( 'Mobile Header Widget Area', 'educator' ),
					'description'   => esc_html__( 'Widgets added here will appear on the bottom of mobile menu area', 'educator' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s edgt-mobile-menu-bottom">',
					'after_widget'  => '</div>'
				)
			);
		}
	}
	
	add_action( 'widgets_init', 'educator_edge_register_mobile_header_areas' );
}

if ( ! function_exists( 'educator_edge_mobile_header_class' ) ) {
	function educator_edge_mobile_header_class( $classes ) {
		$classes[] = 'edgt-default-mobile-header';
		
		$classes[] = 'edgt-sticky-up-mobile-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'educator_edge_mobile_header_class' );
}

if ( ! function_exists( 'educator_edge_get_mobile_header' ) ) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 */
	function educator_edge_get_mobile_header( $slug = '', $module = '' ) {
		if ( educator_edge_is_responsive_on() ) {
			$mobile_menu_title = educator_edge_options()->getOptionValue( 'mobile_menu_title' );
			$has_navigation    = has_nav_menu( 'main-navigation' ) || has_nav_menu( 'mobile-navigation' ) ? true : false;
			
			$parameters = array(
				'show_navigation_opener' => $has_navigation,
				'mobile_menu_title'      => $mobile_menu_title
			);
			
			$module = ! empty( $module ) ? $module : 'header/types/mobile-header';
			
			educator_edge_get_module_template_part( 'templates/mobile-header', $module, $slug, $parameters );
		}
	}
	
	add_action( 'educator_edge_after_page_header', 'educator_edge_get_mobile_header' );
}

if ( ! function_exists( 'educator_edge_get_mobile_logo' ) ) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 */
	function educator_edge_get_mobile_logo() {
		$show_logo_image = educator_edge_options()->getOptionValue( 'hide_logo' ) === 'yes' ? false : true;
		
		if ( $show_logo_image ) {
			$mobile_logo_image = educator_edge_get_meta_field_intersect( 'logo_image_mobile', educator_edge_get_page_id() );
			
			//check if mobile logo has been set and use that, else use normal logo
			$logo_image = ! empty( $mobile_logo_image ) ? $mobile_logo_image : educator_edge_get_meta_field_intersect( 'logo_image', educator_edge_get_page_id() );
			
			//get logo image dimensions and set style attribute for image link.
			$logo_dimensions = educator_edge_get_image_dimensions( $logo_image );
			
			$logo_height = '';
			$logo_styles = '';
			if ( is_array( $logo_dimensions ) && array_key_exists( 'height', $logo_dimensions ) ) {
				$logo_height = $logo_dimensions['height'];
				$logo_styles = 'height: ' . intval( $logo_height / 2 ) . 'px'; //divided with 2 because of retina screens
			}
			
			//set parameters for logo
			$parameters = array(
				'logo_image'      => $logo_image,
				'logo_dimensions' => $logo_dimensions,
				'logo_height'     => $logo_height,
				'logo_styles'     => $logo_styles
			);
			
			educator_edge_get_module_template_part( 'templates/mobile-logo', 'header/types/mobile-header', '', $parameters );
		}
	}
}

if ( ! function_exists( 'educator_edge_get_mobile_nav' ) ) {
	/**
	 * Loads mobile navigation HTML
	 */
	function educator_edge_get_mobile_nav() {
		educator_edge_get_module_template_part( 'templates/mobile-navigation', 'header/types/mobile-header' );
	}
}