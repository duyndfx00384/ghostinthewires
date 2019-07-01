<?php

if ( ! function_exists( 'educator_edge_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function educator_edge_reset_options_map() {
		
		educator_edge_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'educator' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = educator_edge_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'educator' )
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'educator' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'educator' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'educator_edge_options_map', 'educator_edge_reset_options_map', 100 );
}