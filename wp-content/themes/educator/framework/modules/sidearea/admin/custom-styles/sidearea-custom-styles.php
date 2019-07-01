<?php

if (!function_exists('educator_edge_side_area_slide_from_right_type_style')) {

	function educator_edge_side_area_slide_from_right_type_style()	{
		$width = educator_edge_options()->getOptionValue('side_area_width');
		
		if ($width !== '') {
			echo educator_edge_dynamic_css('.edgt-side-menu-slide-from-right .edgt-side-menu', array(
				'right' => '-'.educator_edge_filter_px($width) . 'px',
				'width' => educator_edge_filter_px($width) . 'px'
			));
		}
	}

	add_action('educator_edge_style_dynamic', 'educator_edge_side_area_slide_from_right_type_style');
}

if (!function_exists('educator_edge_side_area_icon_color_styles')) {

	function educator_edge_side_area_icon_color_styles() {
		$icon_color             = educator_edge_options()->getOptionValue('side_area_icon_color');
		$icon_hover_color       = educator_edge_options()->getOptionValue('side_area_icon_hover_color');
		$close_icon_color       = educator_edge_options()->getOptionValue('side_area_close_icon_color');
		$close_icon_hover_color = educator_edge_options()->getOptionValue('side_area_close_icon_hover_color');
		
		$icon_hover_selector    = array(
			'.edgt-side-menu-button-opener:hover',
			'.edgt-side-menu-button-opener.opened'
		);
		
		if (!empty($icon_color)) {
			echo educator_edge_dynamic_css('.edgt-side-menu-button-opener', array(
				'color' => $icon_color
			));
		}

		if (!empty($icon_hover_color)) {
			echo educator_edge_dynamic_css($icon_hover_selector, array(
				'color' => $icon_hover_color . '!important'
			));
		}

		if (!empty($close_icon_color)) {
			echo educator_edge_dynamic_css('.edgt-side-menu a.edgt-close-side-menu', array(
				'color' => $close_icon_color
			));
		}

		if (!empty($close_icon_hover_color)) {
			echo educator_edge_dynamic_css('.edgt-side-menu a.edgt-close-side-menu:hover', array(
				'color' => $close_icon_hover_color
			));
		}
	}

	add_action('educator_edge_style_dynamic', 'educator_edge_side_area_icon_color_styles');
}

if (!function_exists('educator_edge_side_area_styles')) {
	function educator_edge_side_area_styles() {
		
		$side_area_styles = array();
		$background_color = educator_edge_options()->getOptionValue('side_area_background_color');
		$padding          = educator_edge_options()->getOptionValue('side_area_padding');
		$text_alignment   = educator_edge_options()->getOptionValue('side_area_aligment');

		if (!empty($background_color)) {
			$side_area_styles['background-color'] = $background_color;
		}

		if (!empty($padding)) {
			$side_area_styles['padding'] = esc_attr($padding);
		}
		
		if (!empty($text_alignment)) {
			$side_area_styles['text-align'] = $text_alignment;
		}

		if (!empty($side_area_styles)) {
			echo educator_edge_dynamic_css('.edgt-side-menu', $side_area_styles);
		}
		
		if($text_alignment === 'center') {
			echo educator_edge_dynamic_css('.edgt-side-menu .widget img', array(
				'margin' => '0 auto'
			));
		}
	}

	add_action('educator_edge_style_dynamic', 'educator_edge_side_area_styles');
}