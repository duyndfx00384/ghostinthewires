<?php

if(!function_exists('educator_edge_404_header_general_styles')) {
    /**
     * Generates general custom styles for 404 header area
     */
    function educator_edge_404_header_general_styles() {
    	$background_color        = educator_edge_options()->getOptionValue('404_menu_area_background_color_header');
	    $background_transparency = educator_edge_options()->getOptionValue('404_menu_area_background_transparency_header');
	    
        $header_styles = array();
	    $menu_selector = array(
		    '.edgt-404-page .edgt-page-header .edgt-menu-area'
	    );

        if(!empty($background_color)) {
            $header_styles['background-color'] = $background_color;
            $header_styles['background-transparency'] = 1;

            if($background_transparency !== '') {
                $header_styles['background-transparency'] = $background_transparency;
            }

            echo educator_edge_dynamic_css($menu_selector, array('background-color' => educator_edge_rgba_color($header_styles['background-color'], $header_styles['background-transparency']) . ' !important'));
        }

        if(empty($background_color) && $background_transparency !== '') {
            $header_styles['background-color'] = '#fff';
            $header_styles['background-transparency'] = $background_transparency;

            echo educator_edge_dynamic_css($menu_selector, array('background-color' => educator_edge_rgba_color($header_styles['background-color'], $header_styles['background-transparency']) . ' !important'));
        }
	
	    $border_color = educator_edge_options()->getOptionValue('404_menu_area_border_color_header');

        $menu_styles = array();

        if(!empty($border_color)) {
            $menu_styles['border-color'] = $border_color;
        }

        echo educator_edge_dynamic_css($menu_selector, $menu_styles);
    }

    add_action('educator_edge_style_dynamic', 'educator_edge_404_header_general_styles');
}

if(!function_exists('educator_edge_404_footer_top_general_styles')) {
    /**
     * Generates general custom styles for footer top area
     */
    function educator_edge_404_footer_top_general_styles() {
        $background_color         = educator_edge_options()->getOptionValue('404_page_background_color');
	    $background_image         = educator_edge_options()->getOptionValue('404_page_background_image');
	    $pattern_background_image = educator_edge_options()->getOptionValue('404_page_background_pattern_image');
    	
    	$item_styles = array();
        if(!empty($background_color)) {
            $item_styles['background-color'] = $background_color;
        }

        if (!empty($background_image)) {
            $item_styles['background-image'] = 'url('.$background_image.')';
            $item_styles['background-position'] = 'center 0';
            $item_styles['background-size'] = 'cover';
            $item_styles['background-repeat'] = 'no-repeat';
        }

        if (!empty($pattern_background_image)) {
            $item_styles['background-image'] = 'url('.$pattern_background_image.')';
            $item_styles['background-position'] = '0 0';
            $item_styles['background-repeat'] = 'repeat';
        }
	
	    $item_selector = array(
		    '.edgt-404-page .edgt-content'
	    );

        echo educator_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('educator_edge_style_dynamic', 'educator_edge_404_footer_top_general_styles');
}

if(!function_exists('educator_edge_404_title_styles')) {
    /**
     * Generates styles for 404 page title
     */
    function educator_edge_404_title_styles() {
	    $item_styles = educator_edge_get_typography_styles('404_title');
	
	    $item_selector = array(
		    '.edgt-404-page .edgt-page-not-found .edgt-404-title'
	    );
	
	    echo educator_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('educator_edge_style_dynamic', 'educator_edge_404_title_styles');
}

if(!function_exists('educator_edge_404_subtitle_styles')) {
    /**
     * Generates styles for 404 page subtitle
     */
    function educator_edge_404_subtitle_styles() {
	    $item_styles = educator_edge_get_typography_styles('404_subtitle');
	
	    $item_selector = array(
		    '.edgt-404-page .edgt-page-not-found .edgt-404-subtitle'
	    );
	
	    echo educator_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('educator_edge_style_dynamic', 'educator_edge_404_subtitle_styles');
}

if(!function_exists('educator_edge_404_text_styles')) {
    /**
     * Generates styles for 404 page text
     */
    function educator_edge_404_text_styles() {
	    $item_styles = educator_edge_get_typography_styles('404_text');
	
	    $item_selector = array(
		    '.edgt-404-page .edgt-page-not-found .edgt-404-text'
	    );
	
	    echo educator_edge_dynamic_css($item_selector, $item_styles);
    }

    add_action('educator_edge_style_dynamic', 'educator_edge_404_text_styles');
}