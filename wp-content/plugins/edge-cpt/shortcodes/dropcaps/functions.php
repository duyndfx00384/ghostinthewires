<?php

if ( ! function_exists( 'edgt_core_add_dropcaps_shortcodes' ) ) {
	function edgt_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'EdgeCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'edgt_core_filter_add_vc_shortcode', 'edgt_core_add_dropcaps_shortcodes' );
}