<?php

if(!function_exists('educator_edge_disable_wpml_css')) {
    function educator_edge_disable_wpml_css() {
	    define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
    }

	add_action('after_setup_theme', 'educator_edge_disable_wpml_css');
}