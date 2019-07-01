<?php

if(!function_exists('educator_edge_footer_top_general_styles')) {
    /**
     * Generates general custom styles for footer top area
     */
    function educator_edge_footer_top_general_styles() {
        $item_styles = array();
        $background_color = educator_edge_options()->getOptionValue('footer_top_background_color');

        if(!empty($background_color)) {
            $item_styles['background-color'] = $background_color;
        }

        $background_color_selector = array(
            '.edgt-page-footer .edgt-footer-top-holder',
            '.edgt-page-footer .edgt-footer-top-holder.dark',
            '.edgt-page-footer .edgt-footer-top-holder.light',
        );

        echo educator_edge_dynamic_css($background_color_selector, $item_styles);
    }

    add_action('educator_edge_style_dynamic', 'educator_edge_footer_top_general_styles');
}

if(!function_exists('educator_edge_footer_bottom_general_styles')) {
    /**
     * Generates general custom styles for footer bottom area
     */
    function educator_edge_footer_bottom_general_styles() {
        $item_styles = array();
	    $background_color = educator_edge_options()->getOptionValue('footer_bottom_background_color');
	
	    if(!empty($background_color)) {
		    $item_styles['background-color'] = $background_color;
	    }

	    $background_color_selector = array(
            '.edgt-page-footer .edgt-footer-bottom-holder',
            '.edgt-page-footer .edgt-footer-bottom-holder.dark',
            '.edgt-page-footer .edgt-footer-bottom-holder.light'
        );

        echo educator_edge_dynamic_css($background_color_selector, $item_styles);
    }

    add_action('educator_edge_style_dynamic', 'educator_edge_footer_bottom_general_styles');
}