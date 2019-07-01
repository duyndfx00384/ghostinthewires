<?php
/**
 * Functions for Google login
 */

if ( ! function_exists( 'edgt_membership_get_google_social_login' ) ) {
	/**
	 * Render form for google login
	 */
	function edgt_membership_get_google_social_login() {

		$social_login_enabled = educator_edge_options()->getOptionValue( 'enable_social_login' ) == 'yes' ? true : false;
		$google_login_enabled = educator_edge_options()->getOptionValue( 'enable_google_social_login' ) == 'yes' ? true : false;
		$enabled              = ( $social_login_enabled && $google_login_enabled ) ? true : false;

		if ( ! is_user_logged_in() && $enabled ) {

			$html = '<form class="edgt-google-login-holder">'
			        . wp_nonce_field( 'edgt_validate_googleplus_login', 'edgt_nonce_google_login_'.rand(), true, false ) .
			        educator_edge_get_button_html( array(
				        'html_type'    => 'button',
				        'custom_class' => 'edgt-google-login',
				        'icon_pack'    => 'font_awesome',
				        'fa_icon'      => 'fa-google-plus',
				        'size'         => 'small',
				        'text'         => 'GOOGLE',
				        'background_color' => '#dd4b39',
				        'border_color' => '#dd4b39',
						'hover_background_color' => '#d53622',
						'hover_border_color' => '#d53622'
			        ) ) .
			        '</form>';
			print $html;

		}

	}

	add_action( 'edgt_membership_social_network_login', 'edgt_membership_get_google_social_login' );

}

if ( ! function_exists( 'edgt_membership_check_google_user' ) ) {
	/**
	 * Function for getting google user data.
	 * Checks for user mail and register or log in user
	 */
	function edgt_membership_check_google_user() {

		if ( isset( $_POST['response'] ) ) {
			$response            = $_POST['response'];
			$user_email          = $response['email'];
			$network             = 'googleplus';
			$response['network'] = $network;
			$nonce               = $response['nonce'];

			if ( email_exists( $user_email ) ) {
				//User already exist, log in user
				edgt_membership_login_user_from_social_network( $user_email, $nonce, $network );
			} else {
				//Register new user
				edgt_membership_register_user_from_social_network( $response );
			}
			$url = edgt_membership_get_dashboard_page_url();
			if ( $url == '' ) {
				$url = esc_url( home_url( '/' ) );
			}
			edgt_membership_ajax_response( 'success', esc_html__( 'Login successful, redirecting...', 'edgt-membership' ), $url );
		}
		wp_die();

	}

	add_action( 'wp_ajax_edgt_membership_check_google_user', 'edgt_membership_check_google_user' );
	add_action( 'wp_ajax_nopriv_edgt_membership_check_google_user', 'edgt_membership_check_google_user' );

}