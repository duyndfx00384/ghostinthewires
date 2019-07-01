<?php

if ( ! function_exists( 'educator_edge_fixed_header_styles' ) ) {
	/**
	 * Generates styles for fixed haeder
	 */
	function educator_edge_fixed_header_styles() {
		$background_color        = educator_edge_options()->getOptionValue( 'fixed_header_background_color' );
		$background_transparency = educator_edge_options()->getOptionValue( 'fixed_header_transparency' );
		$border_color            = educator_edge_options()->getOptionValue( 'fixed_header_border_bottom_color' );
		
		$fixed_area_styles = array();
		if ( ! empty( $background_color ) ) {
			$fixed_header_background_color              = $background_color;
			$fixed_header_background_color_transparency = 1;
			
			if ( $background_transparency !== '' ) {
				$fixed_header_background_color_transparency = $background_transparency;
			}
			
			$fixed_area_styles['background-color'] = educator_edge_rgba_color( $fixed_header_background_color, $fixed_header_background_color_transparency ) . '!important';
		}
		
		if ( empty( $background_color ) && $background_transparency !== '' ) {
			$fixed_header_background_color              = '#fff';
			$fixed_header_background_color_transparency = $background_transparency;
			
			$fixed_area_styles['background-color'] = educator_edge_rgba_color( $fixed_header_background_color, $fixed_header_background_color_transparency ) . '!important';
		}
		
		$selector = array(
			'.edgt-page-header .edgt-fixed-wrapper.fixed .edgt-menu-area'
		);
		
		echo educator_edge_dynamic_css( $selector, $fixed_area_styles );
		
		$fixed_area_holder_styles = array();
		
		if ( ! empty( $border_color ) ) {
			$fixed_area_holder_styles['border-bottom-color'] = $border_color;
		}
		
		$selector_holder = array(
			'.edgt-page-header .edgt-fixed-wrapper.fixed'
		);
		
		echo educator_edge_dynamic_css( $selector_holder, $fixed_area_holder_styles );
		
		// fixed menu style
		
		$menu_item_styles = educator_edge_get_typography_styles( 'fixed' );
		
		$menu_item_selector = array(
			'.edgt-fixed-wrapper.fixed .edgt-main-menu > ul > li > a'
		);
		
		echo educator_edge_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		
		$hover_color = educator_edge_options()->getOptionValue( 'fixed_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.edgt-fixed-wrapper.fixed .edgt-main-menu > ul > li:hover > a',
			'.edgt-fixed-wrapper.fixed .edgt-main-menu > ul > li.edgt-active-item > a'
		);
		
		echo educator_edge_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_fixed_header_styles' );
}