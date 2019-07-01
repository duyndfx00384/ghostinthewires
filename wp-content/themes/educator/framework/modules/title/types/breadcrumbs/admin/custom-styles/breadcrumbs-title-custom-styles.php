<?php

if ( ! function_exists( 'educator_edge_breadcrumbs_title_area_typography_style' ) ) {
	function educator_edge_breadcrumbs_title_area_typography_style() {
		
		$item_styles = educator_edge_get_typography_styles( 'page_breadcrumb' );
		
		$item_selector = array(
			'.edgt-title-holder .edgt-title-wrapper .edgt-breadcrumbs'
		);
		
		echo educator_edge_dynamic_css( $item_selector, $item_styles );
		
		
		$breadcrumb_hover_color = educator_edge_options()->getOptionValue( 'page_breadcrumb_hovercolor' );
		
		$breadcrumb_hover_styles = array();
		if ( ! empty( $breadcrumb_hover_color ) ) {
			$breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
		}
		
		$breadcrumb_hover_selector = array(
			'.edgt-title-holder .edgt-title-wrapper .edgt-breadcrumbs a:hover'
		);
		
		echo educator_edge_dynamic_css( $breadcrumb_hover_selector, $breadcrumb_hover_styles );
	}
	
	add_action( 'educator_edge_style_dynamic', 'educator_edge_breadcrumbs_title_area_typography_style' );
}