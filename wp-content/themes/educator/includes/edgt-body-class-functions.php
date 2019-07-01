<?php

if ( ! function_exists( 'educator_edge_theme_version_class' ) ) {
	/**
	 * Function that adds classes on body for version of theme
	 */
	function educator_edge_theme_version_class( $classes ) {
		$current_theme = wp_get_theme();
		
		//is child theme activated?
		if ( $current_theme->parent() ) {
			//add child theme version
			$classes[] = strtolower( $current_theme->get( 'Name' ) ) . '-child-ver-' . $current_theme->get( 'Version' );
			
			//get parent theme
			$current_theme = $current_theme->parent();
		}
		
		if ( $current_theme->exists() && $current_theme->get( 'Version' ) != '' ) {
			$classes[] = strtolower( $current_theme->get( 'Name' ) ) . '-ver-' . $current_theme->get( 'Version' );
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'educator_edge_theme_version_class' );
}

if ( ! function_exists( 'educator_edge_boxed_class' ) ) {
	/**
	 * Function that adds classes on body for boxed layout
	 */
	function educator_edge_boxed_class( $classes ) {
		$allow_boxed_layout = true;
		$allow_boxed_layout = apply_filters( 'educator_edge_allow_content_boxed_layout', $allow_boxed_layout );
		
		if ( $allow_boxed_layout && educator_edge_get_meta_field_intersect( 'boxed' ) === 'yes' ) {
			$classes[] = 'edgt-boxed';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'educator_edge_boxed_class' );
}

if ( ! function_exists( 'educator_edge_paspartu_class' ) ) {
	/**
	 * Function that adds classes on body for paspartu layout
	 */
	function educator_edge_paspartu_class( $classes ) {
		$id = educator_edge_get_page_id();
		
		//is paspartu layout turned on?
		if ( educator_edge_get_meta_field_intersect( 'paspartu', $id ) === 'yes' ) {
			$classes[] = 'edgt-paspartu-enabled';
			
			if ( educator_edge_get_meta_field_intersect( 'disable_top_paspartu', $id ) === 'yes' ) {
				$classes[] = 'edgt-top-paspartu-disabled';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'educator_edge_paspartu_class' );
}

if ( ! function_exists( 'educator_edge_page_smooth_scroll_class' ) ) {
	/**
	 * Function that adds classes on body for page smooth scroll
	 */
	function educator_edge_page_smooth_scroll_class( $classes ) {
		//is smooth scroll enabled enabled?
		if ( educator_edge_options()->getOptionValue( 'page_smooth_scroll' ) == 'yes' ) {
			$classes[] = 'edgt-smooth-scroll';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'educator_edge_page_smooth_scroll_class' );
}

if ( ! function_exists( 'educator_edge_smooth_page_transitions_class' ) ) {
	/**
	 * Function that adds classes on body for smooth page transitions
	 */
	function educator_edge_smooth_page_transitions_class( $classes ) {
		$id = educator_edge_get_page_id();
		
		if ( educator_edge_get_meta_field_intersect( 'smooth_page_transitions', $id ) == 'yes' ) {
			$classes[] = 'edgt-smooth-page-transitions';
			
			if ( educator_edge_get_meta_field_intersect( 'page_transition_preloader', $id ) == 'yes' ) {
				$classes[] = 'edgt-smooth-page-transitions-preloader';
			}
			
			if ( educator_edge_get_meta_field_intersect( 'page_transition_fadeout', $id ) == 'yes' ) {
				$classes[] = 'edgt-smooth-page-transitions-fadeout';
			}
			
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'educator_edge_smooth_page_transitions_class' );
}

if ( ! function_exists( 'educator_edge_content_initial_width_body_class' ) ) {
	/**
	 * Function that adds transparent content class to body.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with transparent content body class added
	 */
	function educator_edge_content_initial_width_body_class( $classes ) {
		$initial_content_width = educator_edge_get_meta_field_intersect( 'initial_content_width', educator_edge_get_page_id() );
		
		if ( ! empty( $initial_content_width ) ) {
			$classes[] = $initial_content_width;
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'educator_edge_content_initial_width_body_class' );
}

if ( ! function_exists( 'educator_edge_set_content_behind_header_class' ) ) {
	function educator_edge_set_content_behind_header_class( $classes ) {
		$id = educator_edge_get_page_id();
		
		if ( get_post_meta( $id, 'edgt_page_content_behind_header_meta', true ) === 'yes' ) {
			$classes[] = 'edgt-content-is-behind-header';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'educator_edge_set_content_behind_header_class' );
}

if ( ! function_exists('educator_edge_custom_font_class')){
	function educator_edge_custom_font_class($classes){
		$id = educator_edge_get_page_id();

		$classes[] = get_post_meta($id, 'edgt_predefined_font_type_meta', true);

		return $classes;
	}

	add_filter( 'body_class', 'educator_edge_custom_font_class' );
}