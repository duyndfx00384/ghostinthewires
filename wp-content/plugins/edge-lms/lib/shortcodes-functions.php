<?php

if(!function_exists('edgt_lms_include_shortcodes_file')) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function edgt_lms_include_shortcodes_file() {
		foreach(glob(EDGE_LMS_SHORTCODES_PATH.'/*/load.php') as $shortcode_load) {
			include_once $shortcode_load;
		}
		
		do_action('edgt_lms_action_include_shortcodes_file');
	}
	
	add_action('init', 'edgt_lms_include_shortcodes_file', 6); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if(!function_exists('edgt_lms_load_shortcodes')) {
	function edgt_lms_load_shortcodes() {
		include_once EDGE_LMS_ABS_PATH.'/lib/shortcode-loader.php';
		
		EdgefLMS\Lib\ShortcodeLoader::getInstance()->load();
	}
	
	add_action('init', 'edgt_lms_load_shortcodes', 7); // permission 7 is set to be before vc_before_init hook that has permission 9 and after edgt_lms_include_shortcodes_file hook
}

if ( ! function_exists( 'edgt_lms_add_admin_shortcodes_styles' ) ) {
	/**
	 * Function that includes shortcodes core styles for admin
	 */
	function edgt_lms_add_admin_shortcodes_styles() {
		
		//include shortcode styles for Visual Composer
		wp_enqueue_style( 'edgt_lms_vc_shortcodes', EDGE_LMS_ASSETS_URL_PATH . '/css/admin/edgt-vc-shortcodes.css' );
	}
	
	add_action( 'educator_edge_admin_scripts_init', 'edgt_lms_add_admin_shortcodes_styles' );
}

if ( ! function_exists( 'edgt_lms_add_admin_shortcodes_custom_styles' ) ) {
	/**
	 * Function that print custom vc shortcodes style
	 */
	function edgt_lms_add_admin_shortcodes_custom_styles() {
		$style                  = apply_filters( 'edgt_lms_filter_add_vc_shortcodes_custom_style', $style = '' );
		$shortcodes_icon_styles = array();
		$shortcode_icon_size    = 32;
		$shortcode_position     = 0;
		
		$shortcodes_icon_class_array = apply_filters( 'edgt_lms_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
		sort( $shortcodes_icon_class_array );

		if ( ! empty( $shortcodes_icon_class_array ) ) {
			foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {
				$mark = $shortcode_position != 0 ? '-' : '';
				
				$shortcodes_icon_styles[] = '.vc_element-icon.extended-custom-lms-icon' . esc_attr( $shortcode_icon_class ) . ' {
					background-position: ' . $mark . esc_attr( $shortcode_position * $shortcode_icon_size ) . 'px 0;
				}';
				
				$shortcode_position ++;
			}
		}
		
		if ( ! empty( $shortcodes_icon_styles ) ) {
			$style .= implode( ' ', $shortcodes_icon_styles );
		}
		
		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'edgt_lms_vc_shortcodes', $style );
		}
	}
	
	add_action( 'educator_edge_admin_scripts_init', 'edgt_lms_add_admin_shortcodes_custom_styles' );
}