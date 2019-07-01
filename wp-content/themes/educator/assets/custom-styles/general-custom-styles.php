<?php

if(!function_exists('educator_edge_design_styles')) {
    /**
     * Generates general custom styles
     */
    function educator_edge_design_styles() {
	    $font_family = educator_edge_options()->getOptionValue( 'google_fonts' );
	    if ( ! empty( $font_family ) && educator_edge_is_font_option_valid( $font_family ) ) {
		    $font_family_selector = array(
			    'body'
		    );
		    echo educator_edge_dynamic_css( $font_family_selector, array( 'font-family' => educator_edge_get_font_option_val( $font_family ) ) );
	    }

	    $page_background_color = educator_edge_options()->getOptionValue( 'page_background_color' );
	    if ( ! empty( $page_background_color ) ) {
		    $background_color_selector = array(
			    '.edgt-wrapper-inner',
			    '.edgt-content',
			    '.edgt-container'
		    );
		    echo educator_edge_dynamic_css( $background_color_selector, array( 'background-color' => $page_background_color ) );
	    }

		$page_background_image = educator_edge_options()->getOptionValue( 'page_background_image' );
	    if ( ! empty( $page_background_image ) ) {
		    $background_image_selector = array(
			    '.edgt-wrapper'
		    );
			$background_color_selector = array(
				'.edgt-content',
				'.edgt-container'
			);

		    echo educator_edge_dynamic_css( $background_image_selector, array( 'background-image' => 'url('. $page_background_image .');' ) );
		    echo educator_edge_dynamic_css( $background_color_selector, array( 'background-color' => 'transparent' ) );


	    }

	    $selection_color = educator_edge_options()->getOptionValue( 'selection_color' );
	    if ( ! empty( $selection_color ) ) {
		    echo educator_edge_dynamic_css( '::selection', array( 'background' => $selection_color ) );
		    echo educator_edge_dynamic_css( '::-moz-selection', array( 'background' => $selection_color ) );
	    }

	    $preload_background_styles = array();

	    if ( educator_edge_options()->getOptionValue( 'preload_pattern_image' ) !== "" ) {
		    $preload_background_styles['background-image'] = 'url(' . educator_edge_options()->getOptionValue( 'preload_pattern_image' ) . ') !important';
	    }

	    echo educator_edge_dynamic_css( '.edgt-preload-background', $preload_background_styles );
    }

    add_action('educator_edge_style_dynamic', 'educator_edge_design_styles');
}

if ( ! function_exists( 'educator_edge_content_styles' ) ) {
	function educator_edge_content_styles() {
		$content_style = array();
		
		$padding_top = educator_edge_options()->getOptionValue( 'content_top_padding' );
		if ( $padding_top !== '' ) {
			$content_style['padding-top'] = educator_edge_filter_px( $padding_top ) . 'px';
		}
		
		$content_selector = array(
			'.edgt-content .edgt-content-inner > .edgt-full-width > .edgt-full-width-inner',
		);
		
		echo educator_edge_dynamic_css( $content_selector, $content_style );
		
		$content_style_in_grid = array();
		
		$padding_top_in_grid = educator_edge_options()->getOptionValue( 'content_top_padding_in_grid' );
		if ( $padding_top_in_grid !== '' ) {
			$content_style_in_grid['padding-top'] = educator_edge_filter_px( $padding_top_in_grid ) . 'px';
		}
		
		$content_selector_in_grid = array(
			'.edgt-content .edgt-content-inner > .edgt-container > .edgt-container-inner',
		);
		
		echo educator_edge_dynamic_css( $content_selector_in_grid, $content_style_in_grid );
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_content_styles' );
}

if ( ! function_exists( 'educator_edge_h1_styles' ) ) {
	function educator_edge_h1_styles() {
		$margin_top    = educator_edge_options()->getOptionValue( 'h1_margin_top' );
		$margin_bottom = educator_edge_options()->getOptionValue( 'h1_margin_bottom' );
		
		$item_styles = educator_edge_get_typography_styles( 'h1' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = educator_edge_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = educator_edge_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h1'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo educator_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_h1_styles' );
}

if ( ! function_exists( 'educator_edge_h2_styles' ) ) {
	function educator_edge_h2_styles() {
		$margin_top    = educator_edge_options()->getOptionValue( 'h2_margin_top' );
		$margin_bottom = educator_edge_options()->getOptionValue( 'h2_margin_bottom' );
		
		$item_styles = educator_edge_get_typography_styles( 'h2' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = educator_edge_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = educator_edge_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h2'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo educator_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_h2_styles' );
}

if ( ! function_exists( 'educator_edge_h3_styles' ) ) {
	function educator_edge_h3_styles() {
		$margin_top    = educator_edge_options()->getOptionValue( 'h3_margin_top' );
		$margin_bottom = educator_edge_options()->getOptionValue( 'h3_margin_bottom' );
		
		$item_styles = educator_edge_get_typography_styles( 'h3' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = educator_edge_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = educator_edge_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h3'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo educator_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_h3_styles' );
}

if ( ! function_exists( 'educator_edge_h4_styles' ) ) {
	function educator_edge_h4_styles() {
		$margin_top    = educator_edge_options()->getOptionValue( 'h4_margin_top' );
		$margin_bottom = educator_edge_options()->getOptionValue( 'h4_margin_bottom' );
		
		$item_styles = educator_edge_get_typography_styles( 'h4' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = educator_edge_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = educator_edge_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h4'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo educator_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_h4_styles' );
}

if ( ! function_exists( 'educator_edge_h5_styles' ) ) {
	function educator_edge_h5_styles() {
		$margin_top    = educator_edge_options()->getOptionValue( 'h5_margin_top' );
		$margin_bottom = educator_edge_options()->getOptionValue( 'h5_margin_bottom' );
		
		$item_styles = educator_edge_get_typography_styles( 'h5' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = educator_edge_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = educator_edge_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h5'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo educator_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_h5_styles' );
}

if ( ! function_exists( 'educator_edge_h6_styles' ) ) {
	function educator_edge_h6_styles() {
		$margin_top    = educator_edge_options()->getOptionValue( 'h6_margin_top' );
		$margin_bottom = educator_edge_options()->getOptionValue( 'h6_margin_bottom' );
		
		$item_styles = educator_edge_get_typography_styles( 'h6' );
		
		if ( $margin_top !== '' ) {
			$item_styles['margin-top'] = educator_edge_filter_px( $margin_top ) . 'px';
		}
		if ( $margin_bottom !== '' ) {
			$item_styles['margin-bottom'] = educator_edge_filter_px( $margin_bottom ) . 'px';
		}
		
		$item_selector = array(
			'h6'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo educator_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_h6_styles' );
}

if ( ! function_exists( 'educator_edge_text_styles' ) ) {
	function educator_edge_text_styles() {
		$item_styles = educator_edge_get_typography_styles( 'text' );
		
		$item_selector = array(
			'p'
		);
		
		if ( ! empty( $item_styles ) ) {
			echo educator_edge_dynamic_css( $item_selector, $item_styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_text_styles' );
}

if ( ! function_exists( 'educator_edge_link_styles' ) ) {
	function educator_edge_link_styles() {
		$link_styles      = array();
		$link_color       = educator_edge_options()->getOptionValue( 'link_color' );
		$link_font_style  = educator_edge_options()->getOptionValue( 'link_fontstyle' );
		$link_font_weight = educator_edge_options()->getOptionValue( 'link_fontweight' );
		$link_decoration  = educator_edge_options()->getOptionValue( 'link_fontdecoration' );
		
		if ( ! empty( $link_color ) ) {
			$link_styles['color'] = $link_color;
		}
		if ( ! empty( $link_font_style ) ) {
			$link_styles['font-style'] = $link_font_style;
		}
		if ( ! empty( $link_font_weight ) ) {
			$link_styles['font-weight'] = $link_font_weight;
		}
		if ( ! empty( $link_decoration ) ) {
			$link_styles['text-decoration'] = $link_decoration;
		}
		
		$link_selector = array(
			'a',
			'p a'
		);
		
		if ( ! empty( $link_styles ) ) {
			echo educator_edge_dynamic_css( $link_selector, $link_styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_link_styles' );
}

if ( ! function_exists( 'educator_edge_link_hover_styles' ) ) {
	function educator_edge_link_hover_styles() {
		$link_hover_styles     = array();
		$link_hover_color      = educator_edge_options()->getOptionValue( 'link_hovercolor' );
		$link_hover_decoration = educator_edge_options()->getOptionValue( 'link_hover_fontdecoration' );
		
		if ( ! empty( $link_hover_color ) ) {
			$link_hover_styles['color'] = $link_hover_color;
		}
		if ( ! empty( $link_hover_decoration ) ) {
			$link_hover_styles['text-decoration'] = $link_hover_decoration;
		}
		
		$link_hover_selector = array(
			'a:hover',
			'p a:hover'
		);
		
		if ( ! empty( $link_hover_styles ) ) {
			echo educator_edge_dynamic_css( $link_hover_selector, $link_hover_styles );
		}
		
		$link_heading_hover_styles = array();
		
		if ( ! empty( $link_hover_color ) ) {
			$link_heading_hover_styles['color'] = $link_hover_color;
		}
		
		$link_heading_hover_selector = array(
			'h1 a:hover',
			'h2 a:hover',
			'h3 a:hover',
			'h4 a:hover',
			'h5 a:hover',
			'h6 a:hover'
		);
		
		if ( ! empty( $link_heading_hover_styles ) ) {
			echo educator_edge_dynamic_css( $link_heading_hover_selector, $link_heading_hover_styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_link_hover_styles' );
}

if ( ! function_exists( 'educator_edge_smooth_page_transition_styles' ) ) {
	function educator_edge_smooth_page_transition_styles( $style ) {
		$id            = educator_edge_get_page_id();
		$loader_style  = array();
		$current_style = '';
		
		$background_color = educator_edge_get_meta_field_intersect( 'smooth_pt_bgnd_color', $id );
		if ( ! empty( $background_color ) ) {
			$loader_style['background-color'] = $background_color;
		}
		
		$loader_selector = array(
			'.edgt-smooth-transition-loader'
		);
		
		if ( ! empty( $loader_style ) ) {
			$current_style .= educator_edge_dynamic_css( $loader_selector, $loader_style );
		}
		
		$spinner_style = array();
		$spinner_color = educator_edge_get_meta_field_intersect( 'smooth_pt_spinner_color', $id );
		if ( ! empty( $spinner_color ) ) {
			$spinner_style['background-color'] = $spinner_color;
		}
		
		$spinner_selectors = array(
			'.edgt-st-loader .edgt-rotate-circles > div',
			'.edgt-st-loader .pulse',
			'.edgt-st-loader .double_pulse .double-bounce1',
			'.edgt-st-loader .double_pulse .double-bounce2',
			'.edgt-st-loader .cube',
			'.edgt-st-loader .rotating_cubes .cube1',
			'.edgt-st-loader .rotating_cubes .cube2',
			'.edgt-st-loader .stripes > div',
			'.edgt-st-loader .wave > div',
			'.edgt-st-loader .two_rotating_circles .dot1',
			'.edgt-st-loader .two_rotating_circles .dot2',
			'.edgt-st-loader .five_rotating_circles .container1 > div',
			'.edgt-st-loader .five_rotating_circles .container2 > div',
			'.edgt-st-loader .five_rotating_circles .container3 > div',
			'.edgt-st-loader .atom .ball-1:before',
			'.edgt-st-loader .atom .ball-2:before',
			'.edgt-st-loader .atom .ball-3:before',
			'.edgt-st-loader .atom .ball-4:before',
			'.edgt-st-loader .clock .ball:before',
			'.edgt-st-loader .mitosis .ball',
			'.edgt-st-loader .lines .line1',
			'.edgt-st-loader .lines .line2',
			'.edgt-st-loader .lines .line3',
			'.edgt-st-loader .lines .line4',
			'.edgt-st-loader .fussion .ball',
			'.edgt-st-loader .fussion .ball-1',
			'.edgt-st-loader .fussion .ball-2',
			'.edgt-st-loader .fussion .ball-3',
			'.edgt-st-loader .fussion .ball-4',
			'.edgt-st-loader .wave_circles .ball',
			'.edgt-st-loader .pulse_circles .ball'
		);
		
		if ( ! empty( $spinner_style ) ) {
			$current_style .= educator_edge_dynamic_css( $spinner_selectors, $spinner_style );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'educator_edge_add_page_custom_style', 'educator_edge_smooth_page_transition_styles' );
}