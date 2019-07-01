<?php
/**
 * Plugin Name: Edge Membership - shared on wplocker.com
 * Description: Plugin that adds social login and user dashboard page
 * Author: Edge Themes
 * Version: 1.0
 */

require_once 'load.php';

if ( ! function_exists( 'edgt_membership_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function edgt_membership_text_domain() {
		load_plugin_textdomain( 'edgt-membership', false, EDGE_MEMBERSHIP_REL_PATH . '/languages' );
	}

	add_action( 'plugins_loaded', 'edgt_membership_text_domain' );
}

if ( ! function_exists( 'edgt_membership_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */
	function edgt_membership_scripts() {

		wp_enqueue_style( 'edgt_membership_style', plugins_url( EDGE_MEMBERSHIP_REL_PATH . '/assets/css/membership.min.css' ) );
		wp_enqueue_style( 'edgt_membership_responsive_style', plugins_url( EDGE_MEMBERSHIP_REL_PATH . '/assets/css/membership-responsive.min.css' ) );

        //include google+ api
        wp_enqueue_script('edgt_membership_google_plus_api', 'https://apis.google.com/js/platform.js', array(), null, false);

		$array_deps = array(
			'underscore',
			'jquery-ui-tabs'
		);
		if ( edgt_membership_theme_installed() ) {
			$array_deps[] = 'educator_edge_modules';
		}
		wp_enqueue_script( 'edgt_membership_script', plugins_url( EDGE_MEMBERSHIP_REL_PATH . '/assets/js/membership.min.js' ), $array_deps, false, true );
	}

	add_action( 'wp_enqueue_scripts', 'edgt_membership_scripts' );
}