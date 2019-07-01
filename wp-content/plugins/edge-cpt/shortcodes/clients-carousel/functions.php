<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Edgt_Clients_Carousel extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'edgt_core_add_clients_carousel_shortcodes' ) ) {
	function edgt_core_add_clients_carousel_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\ClientsCarousel\ClientsCarousel',
			'EdgeCore\CPT\Shortcodes\ClientsCarouselItem\ClientsCarouselItem'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'edgt_core_filter_add_vc_shortcode', 'edgt_core_add_clients_carousel_shortcodes' );
}

if ( ! function_exists( 'edgt_core_set_clients_carousel_custom_style_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom css style for clients carousel shortcode
	 */
	function edgt_core_set_clients_carousel_custom_style_for_vc_shortcodes( $style ) {
		$current_style = '.wpb_content_element.wpb_edgt_clients_carousel_item > .wpb_element_wrapper {
			background-color: #f4f4f4; 
		}';

		$style .= $current_style;

		return $style;
	}

	add_filter( 'edgt_core_filter_add_vc_shortcodes_custom_style', 'edgt_core_set_clients_carousel_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'edgt_core_set_clients_carousel_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for clients carousel shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function edgt_core_set_clients_carousel_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-clients-carousel';
		$shortcodes_icon_class_array[] = '.icon-wpb-clients-carousel-item';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'edgt_core_filter_add_vc_shortcodes_custom_icon_class', 'edgt_core_set_clients_carousel_icon_class_name_for_vc_shortcodes' );
}