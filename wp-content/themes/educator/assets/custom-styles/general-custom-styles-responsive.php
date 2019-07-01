<?php

if ( ! function_exists( 'educator_edge_content_responsive_styles' ) ) {
	/**
	 * Generates content responsive custom styles
	 */
	function educator_edge_content_responsive_styles() {
		$content_style = array();
		
		$padding_top_mobile = educator_edge_options()->getOptionValue( 'content_top_padding_mobile' );
		if ( $padding_top_mobile !== '' ) {
			$content_style['padding-top'] = educator_edge_filter_px( $padding_top_mobile ) . 'px!important';
		}
		
		$content_selector = array(
			'.edgt-content .edgt-content-inner > .edgt-container > .edgt-container-inner',
			'.edgt-content .edgt-content-inner > .edgt-full-width > .edgt-full-width-inner',
		);
		
		echo educator_edge_dynamic_css( $content_selector, $content_style );
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_1024', 'educator_edge_content_responsive_styles' );
}

if ( ! function_exists( 'educator_edge_h1_responsive_styles3' ) ) {
	function educator_edge_h1_responsive_styles3() {
		$selector = array(
			'h1'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h1_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_768_1024', 'educator_edge_h1_responsive_styles3' );
}

if ( ! function_exists( 'educator_edge_h2_responsive_styles3' ) ) {
	function educator_edge_h2_responsive_styles3() {
		$selector = array(
			'h2'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h2_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_768_1024', 'educator_edge_h2_responsive_styles3' );
}

if ( ! function_exists( 'educator_edge_h3_responsive_styles3' ) ) {
	function educator_edge_h3_responsive_styles3() {
		$selector = array(
			'h3'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h3_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_768_1024', 'educator_edge_h3_responsive_styles3' );
}

if ( ! function_exists( 'educator_edge_h4_responsive_styles3' ) ) {
	function educator_edge_h4_responsive_styles3() {
		$selector = array(
			'h4'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h4_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_768_1024', 'educator_edge_h4_responsive_styles3' );
}

if ( ! function_exists( 'educator_edge_h5_responsive_styles3' ) ) {
	function educator_edge_h5_responsive_styles3() {
		$selector = array(
			'h5'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h5_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_768_1024', 'educator_edge_h5_responsive_styles3' );
}

if ( ! function_exists( 'educator_edge_h6_responsive_styles3' ) ) {
	function educator_edge_h6_responsive_styles3() {
		$selector = array(
			'h6'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h6_responsive', '_3' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_768_1024', 'educator_edge_h6_responsive_styles3' );
}

if ( ! function_exists( 'educator_edge_h1_responsive_styles' ) ) {
	function educator_edge_h1_responsive_styles() {
		$selector = array(
			'h1'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h1_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680_768', 'educator_edge_h1_responsive_styles' );
}

if ( ! function_exists( 'educator_edge_h2_responsive_styles' ) ) {
	function educator_edge_h2_responsive_styles() {
		$selector = array(
			'h2'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h2_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680_768', 'educator_edge_h2_responsive_styles' );
}

if ( ! function_exists( 'educator_edge_h3_responsive_styles' ) ) {
	function educator_edge_h3_responsive_styles() {
		$selector = array(
			'h3'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h3_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680_768', 'educator_edge_h3_responsive_styles' );
}

if ( ! function_exists( 'educator_edge_h4_responsive_styles' ) ) {
	function educator_edge_h4_responsive_styles() {
		$selector = array(
			'h4'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h4_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680_768', 'educator_edge_h4_responsive_styles' );
}

if ( ! function_exists( 'educator_edge_h5_responsive_styles' ) ) {
	function educator_edge_h5_responsive_styles() {
		$selector = array(
			'h5'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h5_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680_768', 'educator_edge_h5_responsive_styles' );
}

if ( ! function_exists( 'educator_edge_h6_responsive_styles' ) ) {
	function educator_edge_h6_responsive_styles() {
		$selector = array(
			'h6'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h6_responsive' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680_768', 'educator_edge_h6_responsive_styles' );
}

if ( ! function_exists( 'educator_edge_text_responsive_styles' ) ) {
	function educator_edge_text_responsive_styles() {
		$selector = array(
			'body',
			'p'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'text', '_res1' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680_768', 'educator_edge_text_responsive_styles' );
}

if ( ! function_exists( 'educator_edge_h1_responsive_styles2' ) ) {
	function educator_edge_h1_responsive_styles2() {
		$selector = array(
			'h1'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h1_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680', 'educator_edge_h1_responsive_styles2' );
}

if ( ! function_exists( 'educator_edge_h2_responsive_styles2' ) ) {
	function educator_edge_h2_responsive_styles2() {
		$selector = array(
			'h2'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h2_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680', 'educator_edge_h2_responsive_styles2' );
}

if ( ! function_exists( 'educator_edge_h3_responsive_styles2' ) ) {
	function educator_edge_h3_responsive_styles2() {
		$selector = array(
			'h3'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h3_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680', 'educator_edge_h3_responsive_styles2' );
}

if ( ! function_exists( 'educator_edge_h4_responsive_styles2' ) ) {
	function educator_edge_h4_responsive_styles2() {
		$selector = array(
			'h4'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h4_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680', 'educator_edge_h4_responsive_styles2' );
}

if ( ! function_exists( 'educator_edge_h5_responsive_styles2' ) ) {
	function educator_edge_h5_responsive_styles2() {
		$selector = array(
			'h5'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h5_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680', 'educator_edge_h5_responsive_styles2' );
}

if ( ! function_exists( 'educator_edge_h6_responsive_styles2' ) ) {
	function educator_edge_h6_responsive_styles2() {
		$selector = array(
			'h6'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'h6_responsive', '_2' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680', 'educator_edge_h6_responsive_styles2' );
}

if ( ! function_exists( 'educator_edge_text_responsive_styles2' ) ) {
	function educator_edge_text_responsive_styles2() {
		$selector = array(
			'body',
			'p'
		);
		
		$styles = educator_edge_get_responsive_typography_styles( 'text', '_res2' );
		
		if ( ! empty( $styles ) ) {
			echo educator_edge_dynamic_css( $selector, $styles );
		}
	}
	
	add_action( 'educator_edge_style_dynamic_responsive_680', 'educator_edge_text_responsive_styles2' );
}