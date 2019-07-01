<?php

foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/custom-styles/*.php' ) as $options_load ) {
	include_once $options_load;
}

if ( ! function_exists( 'educator_edge_title_area_typography_style' ) ) {
	function educator_edge_title_area_typography_style() {
		
		// title default/small style
		
		$item_styles = educator_edge_get_typography_styles( 'page_title' );
		
		$item_selector = array(
			'.edgt-title-holder .edgt-title-wrapper .edgt-page-title'
		);
		
		echo educator_edge_dynamic_css( $item_selector, $item_styles );
		
		// subtitle style
		
		$item_styles = educator_edge_get_typography_styles( 'page_subtitle' );
		
		$item_selector = array(
			'.edgt-title-holder .edgt-title-wrapper .edgt-page-subtitle'
		);
		
		echo educator_edge_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_title_area_typography_style' );
}