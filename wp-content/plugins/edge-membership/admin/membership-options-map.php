<?php
/**
 * Options map file
 */

if ( ! function_exists( 'edgt_membership_membership_options_map' ) ) {
	/**
	 * Map plugin options
     *
     * @param $page
	 */
	function edgt_membership_membership_options_map($page) {

		if ( edgt_membership_theme_installed() ) {

			$panel_social_login = educator_edge_add_admin_panel( array(
				'page'  => $page,
				'name'  => 'panel_social_login',
				'title' => esc_html__('Enable Social Login', 'edgt-membership')
			) );

			educator_edge_add_admin_field( array(
				'type'          => 'yesno',
				'name'          => 'enable_social_login',
				'default_value' => 'no',
				'label'         => esc_html__('Enable Social Login', 'edgt-membership'),
				'description'   => esc_html__('Enabling this option will allow login from social networks of your choice', 'edgt-membership'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgt_panel_enable_social_login'
				),
				'parent'        => $panel_social_login
			) );

			$panel_enable_social_login = educator_edge_add_admin_panel( array(
				'page'            => $page,
				'name'            => 'panel_enable_social_login',
				'title'           => esc_html__('Enable Login via', 'edgt-membership'),
				'hidden_property' => 'enable_social_login',
				'hidden_value'    => 'no'
			) );

			educator_edge_add_admin_field( array(
				'type'          => 'yesno',
				'name'          => 'enable_facebook_social_login',
				'default_value' => 'no',
				'label'         => esc_html__('Facebook', 'edgt-membership'),
				'description'   => esc_html__('Enabling this option will allow login via Facebook', 'edgt-membership'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgt_enable_facebook_social_login_container'
				),
				'parent'        => $panel_enable_social_login
			) );

			$enable_facebook_social_login_container = educator_edge_add_admin_container( array(
				'name'            => 'enable_facebook_social_login_container',
				'hidden_property' => 'enable_facebook_social_login',
				'hidden_value'    => 'no',
				'parent'          => $panel_enable_social_login
			) );

			educator_edge_add_admin_field( array(
				'type'          => 'text',
				'name'          => 'enable_facebook_login_fbapp_id',
				'default_value' => '',
				'label'         => esc_html__('Facebook App ID', 'edgt-membership'),
				'description'   => esc_html__('Copy your application ID form created Facebook Application', 'edgt-membership'),
				'parent'        => $enable_facebook_social_login_container
			) );

			educator_edge_add_admin_field( array(
				'type'          => 'yesno',
				'name'          => 'enable_google_social_login',
				'default_value' => 'no',
				'label'         => esc_html__('Google+', 'edgt-membership'),
				'description'   => esc_html__('Enabling this option will allow login via Google+', 'edgt-membership'),
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgt_enable_google_social_login_container'
				),
				'parent'        => $panel_enable_social_login
			) );

			$enable_google_social_login_container = educator_edge_add_admin_container( array(
				'name'            => 'enable_google_social_login_container',
				'hidden_property' => 'enable_google_social_login',
				'hidden_value'    => 'no',
				'parent'          => $panel_enable_social_login
			) );

			educator_edge_add_admin_field( array(
				'type'          => 'text',
				'name'          => 'enable_google_login_client_id',
				'default_value' => '',
				'label'         => esc_html__('Client ID', 'edgt-membership'),
				'description'   => esc_html__('Copy your Client ID form created Google Application', 'edgt-membership'),
				'parent'        => $enable_google_social_login_container
			) );

		}

	}

	add_action( 'educator_edge_social_options', 'edgt_membership_membership_options_map' );

}
