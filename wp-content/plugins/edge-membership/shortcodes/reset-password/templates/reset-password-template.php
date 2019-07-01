<div class="edgt-social-reset-password-holder">
	<form action="<?php echo site_url( 'wp-login.php?action=lostpassword' ); ?>" method="post" id="edgt-lost-password-form" class="edgt-reset-pass-form">
		<div>
			<input type="text" name="user_reset_password_login" class="edgt-input-field" id="user_reset_password_login" placeholder="<?php esc_html_e( 'Enter username or email', 'edgt-membership' ) ?>" value="" size="20" required>
		</div>
		<?php do_action( 'lostpassword_form' ); ?>
		<div class="edgt-reset-password-button-holder">
			<?php
			if ( edgt_membership_theme_installed() ) {
				echo educator_edge_get_button_html( array(
					'html_type' => 'button',
					'text'      => esc_html__( 'NEW PASSWORD', 'edgt-membership' ),
					'type'      => 'solid',
					'size'      => 'small'
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'NEW PASSWORD', 'edgt-membership' ) . '</button>';
			}
			?>
		</div>
	</form>
	<?php do_action( 'edgt_membership_action_login_ajax_response' ); ?>
</div>