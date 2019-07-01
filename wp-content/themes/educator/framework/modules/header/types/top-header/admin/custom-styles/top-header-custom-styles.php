<?php

if ( ! function_exists( 'educator_edge_header_top_bar_styles' ) ) {
	/**
	 * Generates styles for header top bar
	 */
	function educator_edge_header_top_bar_styles() {
		$top_header_height = educator_edge_options()->getOptionValue( 'top_bar_height' );
		
		if ( ! empty( $top_header_height ) ) {
			echo educator_edge_dynamic_css( '.edgt-top-bar', array( 'height' => educator_edge_filter_px( $top_header_height ) . 'px' ) );
			echo educator_edge_dynamic_css( '.edgt-top-bar .edgt-logo-wrapper a', array( 'max-height' => educator_edge_filter_px( $top_header_height ) . 'px' ) );
		}
		
		echo educator_edge_dynamic_css( '.edgt-top-bar-background', array( 'height' => educator_edge_get_top_bar_background_height() . 'px' ) );
		
		if ( educator_edge_options()->getOptionValue( 'top_bar_in_grid' ) == 'yes' ) {
			$top_bar_grid_selector                = '.edgt-top-bar .edgt-grid .edgt-vertical-align-containers';
			$top_bar_grid_styles                  = array();
			$top_bar_grid_background_color        = educator_edge_options()->getOptionValue( 'top_bar_grid_background_color' );
			$top_bar_grid_background_transparency = educator_edge_options()->getOptionValue( 'top_bar_grid_background_transparency' );
			
			if ( !empty($top_bar_grid_background_color) ) {
				$grid_background_color        = $top_bar_grid_background_color;
				$grid_background_transparency = 1;
				
				if ( $top_bar_grid_background_transparency !== '' ) {
					$grid_background_transparency = $top_bar_grid_background_transparency;
				}
				
				$grid_background_color                   = educator_edge_rgba_color( $grid_background_color, $grid_background_transparency );
				$top_bar_grid_styles['background-color'] = $grid_background_color;
			}
			
			echo educator_edge_dynamic_css( $top_bar_grid_selector, $top_bar_grid_styles );
		}
		
		$top_bar_styles   = array();
		$background_color = educator_edge_options()->getOptionValue( 'top_bar_background_color' );
		$border_color     = educator_edge_options()->getOptionValue( 'top_bar_border_color' );
		
		if ( $background_color !== '' ) {
			$background_transparency = 1;
			if ( educator_edge_options()->getOptionValue( 'top_bar_background_transparency' ) !== '' ) {
				$background_transparency = educator_edge_options()->getOptionValue( 'top_bar_background_transparency' );
			}
			
			$background_color                   = educator_edge_rgba_color( $background_color, $background_transparency );
			$top_bar_styles['background-color'] = $background_color;
			
			echo educator_edge_dynamic_css( '.edgt-top-bar-background', array( 'background-color' => $background_color ) );
		}
		
		if ( educator_edge_options()->getOptionValue( 'top_bar_border' ) == 'yes' && $border_color != '' ) {
			$top_bar_styles['border-bottom'] = '1px solid ' . $border_color;
		}
		
		echo educator_edge_dynamic_css( '.edgt-top-bar', $top_bar_styles );
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_header_top_bar_styles' );
}