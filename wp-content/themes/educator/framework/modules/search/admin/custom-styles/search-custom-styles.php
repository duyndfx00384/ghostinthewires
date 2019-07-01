<?php

if (!function_exists('educator_edge_search_opener_icon_size')) {
	function educator_edge_search_opener_icon_size() {
		$icon_size = educator_edge_options()->getOptionValue('header_search_icon_size');
		
		if (!empty($icon_size)) {
			echo educator_edge_dynamic_css('.edgt-search-opener', array(
				'font-size' => educator_edge_filter_px($icon_size) . 'px'
			));
		}
	}

	add_action('educator_edge_style_dynamic', 'educator_edge_search_opener_icon_size');
}

if (!function_exists('educator_edge_search_opener_icon_colors')) {
	function educator_edge_search_opener_icon_colors() {
		$icon_color       = educator_edge_options()->getOptionValue('header_search_icon_color');
		$icon_hover_color = educator_edge_options()->getOptionValue('header_search_icon_hover_color');
		
		if (!empty($icon_color)) {
			echo educator_edge_dynamic_css('.edgt-search-opener', array(
				'color' => $icon_color
			));
		}

		if (!empty($icon_hover_color)) {
			echo educator_edge_dynamic_css('.edgt-search-opener:hover', array(
				'color' => $icon_hover_color
			));
		}
	}

	add_action('educator_edge_style_dynamic', 'educator_edge_search_opener_icon_colors');
}

if (!function_exists('educator_edge_search_opener_text_styles')) {
	function educator_edge_search_opener_text_styles() {
		$item_styles = educator_edge_get_typography_styles('search_icon_text');
		
		$item_selector = array(
			'.edgt-search-icon-text'
		);
		
		echo educator_edge_dynamic_css($item_selector, $item_styles);
		
		$text_hover_color = educator_edge_options()->getOptionValue('search_icon_text_color_hover');
		
		if (!empty($text_hover_color)) {
			echo educator_edge_dynamic_css('.edgt-search-opener:hover .edgt-search-icon-text', array(
				'color' => $text_hover_color
			));
		}
	}

	add_action('educator_edge_style_dynamic', 'educator_edge_search_opener_text_styles');
}