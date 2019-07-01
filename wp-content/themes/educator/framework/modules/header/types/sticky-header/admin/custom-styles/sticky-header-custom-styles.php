<?php

if ( ! function_exists( 'educator_edge_sticky_header_styles' ) ) {
	/**
	 * Generates styles for sticky haeder
	 */
	function educator_edge_sticky_header_styles() {
		$background_color        = educator_edge_options()->getOptionValue( 'sticky_header_background_color' );
		$background_transparency = educator_edge_options()->getOptionValue( 'sticky_header_transparency' );
		$border_color            = educator_edge_options()->getOptionValue( 'sticky_header_border_color' );
		$header_height           = educator_edge_options()->getOptionValue( 'sticky_header_height' );
		
		if ( ! empty( $background_color ) ) {
			$header_background_color              = $background_color;
			$header_background_color_transparency = 1;
			
			if ( $background_transparency !== '' ) {
				$header_background_color_transparency = $background_transparency;
			}
			
			echo educator_edge_dynamic_css( '.edgt-page-header .edgt-sticky-header .edgt-sticky-holder', array( 'background-color' => educator_edge_rgba_color( $header_background_color, $header_background_color_transparency ) ) );
		}
		
		if ( ! empty( $border_color ) ) {
			echo educator_edge_dynamic_css( '.edgt-page-header .edgt-sticky-header .edgt-sticky-holder', array( 'border-color' => $border_color ) );
		}
		
		if ( ! empty( $header_height ) ) {
			$height = educator_edge_filter_px( $header_height ) . 'px';
			
			echo educator_edge_dynamic_css( '.edgt-page-header .edgt-sticky-header', array( 'height' => $height ) );
			echo educator_edge_dynamic_css( '.edgt-page-header .edgt-sticky-header .edgt-logo-wrapper a', array( 'max-height' => $height ) );
		}
		
		// sticky menu style
		
		$menu_item_styles = educator_edge_get_typography_styles( 'sticky' );
		
		$menu_item_selector = array(
			'.edgt-main-menu.edgt-sticky-nav > ul > li > a'
		);
		
		echo educator_edge_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		
		$hover_color = educator_edge_options()->getOptionValue( 'sticky_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.edgt-main-menu.edgt-sticky-nav > ul > li:hover > a',
			'.edgt-main-menu.edgt-sticky-nav > ul > li.edgt-active-item > a'
		);
		
		echo educator_edge_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_sticky_header_styles' );
}