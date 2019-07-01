<?php

class EdgefMembershipLoginRegister extends WP_Widget {
	protected $params;

	public function __construct() {
		parent::__construct(
			'edgt_login_register_widget', // Base ID
			'Edge Login',
			array( 'description' => esc_html__( 'Login and register wordpress widget', 'edgt-membership' ), )
		);
	}

	public function widget( $args, $instance ) {
		$additional_class = '';
		if(is_user_logged_in()){
			$additional_class .= 'edgt-user-logged-in';
		}  else {
            $additional_class .= 'edgt-user-not-logged-in';
        }

		echo '<div class="widget edgt-login-register-widget '.$additional_class.'">';
		if ( ! is_user_logged_in() ) {
			echo '<a href="#" class="edgt-modal-opener edgt-login-opener" data-modal="login">' . esc_html__( 'Login', 'edgt-membership' ) . '</a>';
			echo '<a href="#" class="edgt-modal-opener edgt-register-opener" data-modal="register">' . esc_html__( 'Register', 'edgt-membership' ) . '</a>';

			add_action( 'wp_footer', array( $this, 'edgt_membership_render_login_form' ) );
			add_action( 'wp_footer', array( $this, 'edgt_membership_render_register_form' ) );
			add_action( 'wp_footer', array( $this, 'edgt_membership_render_password_form' ) );

		} else {
			echo edgt_membership_get_widget_template_part( 'login-widget', 'login-widget-template' );
		}
		echo '</div>';

	}

	public function edgt_membership_render_login_form() {

		//Render modal with login and register forms
		echo edgt_membership_get_widget_template_part( 'login-widget', 'login-modal-template' );
	}

    public function edgt_membership_render_register_form() {

        //Render modal with login and register forms
        echo edgt_membership_get_widget_template_part( 'login-widget', 'register-modal-template' );
    }

    public function edgt_membership_render_password_form() {

        //Render modal with login and register forms
        echo edgt_membership_get_widget_template_part( 'login-widget', 'password-modal-template' );
    }
}

function edgt_membership_login_widget_load() {
	register_widget( 'EdgefMembershipLoginRegister' );
}

add_action( 'widgets_init', 'edgt_membership_login_widget_load' );