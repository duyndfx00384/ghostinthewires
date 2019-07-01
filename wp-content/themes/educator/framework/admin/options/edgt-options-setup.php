<?php

if ( ! function_exists( 'educator_edge_admin_map_init' ) ) {
	function educator_edge_admin_map_init() {
		do_action( 'educator_edge_before_options_map' );
		
		require_once EDGE_FRAMEWORK_ROOT_DIR . '/admin/options/fonts/map.php';
		require_once EDGE_FRAMEWORK_ROOT_DIR . '/admin/options/general/map.php';
		require_once EDGE_FRAMEWORK_ROOT_DIR . '/admin/options/page/map.php';
		require_once EDGE_FRAMEWORK_ROOT_DIR . '/admin/options/social/map.php';
		require_once EDGE_FRAMEWORK_ROOT_DIR . '/admin/options/reset/map.php';
		
		do_action( 'educator_edge_options_map' );
		
		do_action( 'educator_edge_after_options_map' );
	}
	
	add_action( 'after_setup_theme', 'educator_edge_admin_map_init', 1 );
}