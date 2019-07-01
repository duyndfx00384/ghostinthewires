<?php
/*
Plugin Name: Edge LMS
Description: Plugin that adds post types for LMS extension
Author: Edge Themes
Version: 1.0
*/

require_once 'load.php';

add_action('after_setup_theme', array(EdgefLMS\CPT\PostTypesRegister::getInstance(), 'register'));

if(!function_exists('edgt_lms_activation')) {
    /**
     * Triggers when plugin is activated. It calls flush_rewrite_rules
     * and defines educator_edge_lms_on_activate action
     */
    function edgt_lms_activation() {
        do_action('educator_edge_lms_on_activate');

        EdgefLMS\CPT\PostTypesRegister::getInstance()->register();
        flush_rewrite_rules();
    }

    register_activation_hook(__FILE__, 'edgt_lms_activation');
}

if(!function_exists('edgt_lms_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function edgt_lms_text_domain() {
        load_plugin_textdomain('edge-lms', false, EDGE_LMS_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'edgt_lms_text_domain');
}
if ( ! function_exists( 'edgt_lms_admin_scripts' ) ) {
    /**
     * Loads plugin scripts
     */
    function edgt_lms_admin_scripts() {
        $screen = get_current_screen();
        if(isset($screen->id) && !empty($screen->id) && $screen->id === 'course') {
            wp_enqueue_script( 'edgt_admin_course_script', plugins_url( EDGE_LMS_REL_PATH . '/assets/js/admin/course-sections-admin.js'), array('jquery', 'underscore'), false, true  );
        }
    }

    add_action( 'admin_enqueue_scripts', 'edgt_lms_admin_scripts' );
}

if(!function_exists('edgt_lms_version_class')) {
	/**
	 * Adds plugins version class to body
	 * @param $classes
	 * @return array
	 */
	function edgt_lms_version_class($classes) {
		$classes[] = 'edgt-lms-'.EDGE_LMS_VERSION;
		
		return $classes;
	}
	
	add_filter('body_class', 'edgt_lms_version_class');
}

if(!function_exists('edgt_lms_theme_installed')) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function edgt_lms_theme_installed() {
		return defined('EDGE_ROOT');
	}
}

if (!function_exists('edgt_lms_is_woocommerce_installed')) {
	/**
	 * Function that checks if woocommerce is installed
	 * @return bool
	 */
	function edgt_lms_is_woocommerce_installed() {
		return function_exists('is_woocommerce');
	}
}

if(!function_exists('edgt_lms_is_revolution_slider_installed')) {
	function edgt_lms_is_revolution_slider_installed() {
		return class_exists('RevSliderFront');
	}
}

if (!function_exists('edgt_lms_core_plugin_installed')) {
	//is Edge CPT installed?
	function edgt_lms_core_plugin_installed() {
		return defined('EDGE_CORE_VERSION');
	}
}

if (!function_exists('edgt_lms_bbpress_plugin_installed')) {
    //is BBPress installed?
    function edgt_lms_bbpress_plugin_installed() {
        return class_exists('bbPress');
    }
}

if(!function_exists('edgt_lms_theme_menu')) {
    /**
     * Function that generates admin menu for lms post types.
     */
    function edgt_lms_theme_menu() {
        if (edgt_lms_theme_installed()) {

            global $educator_edge_Framework;

            $page_hook_suffix = add_menu_page(
                'Edge LMS',      // The value used to populate the browser's title bar when the menu page is active
                'Edge LMS',      // The text of the menu in the administrator's sidebar
                'administrator',                  // What roles are able to access the menu
                'edgt_lms_menu',                // The ID used to bind submenu items to this menu
                '', // The callback function used to render this menu
                $educator_edge_Framework->getSkin()->getSkinURI().'/assets/img/admin-logo-icon.png',             // Icon For menu Item
                10           // Position
            );

            add_action('admin_print_scripts-'.$page_hook_suffix, 'educator_edge_enqueue_admin_scripts');
            add_action('admin_print_styles-'.$page_hook_suffix, 'educator_edge_enqueue_admin_styles');
        }
    }

    add_action( 'admin_menu', 'edgt_lms_theme_menu');
}