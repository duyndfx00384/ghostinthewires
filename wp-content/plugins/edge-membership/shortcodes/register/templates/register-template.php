<div class="edgt-social-register-holder">
	<form method="post" class="edgt-register-form">
		<fieldset>
			<div>
				<input type="text" name="user_register_name" id="user_register_name" placeholder="<?php esc_html_e( 'User Name', 'edgt-membership' ) ?>" value="" required
				       pattern=".{3,}" title="<?php esc_html_e( 'Three or more characters', 'edgt-membership' ); ?>"/>
			</div>
			<div>
				<input type="email" name="user_register_email" id="user_register_email" placeholder="<?php esc_html_e( 'Email', 'edgt-membership' ) ?>" value="" required />
			</div>
            <div>
                <input type="password" name="user_register_password" id="user_register_password" placeholder="<?php esc_html_e('Password','edgt-membership') ?>" value="" required />
            </div>
            <div>
                <input type="password" name="user_register_confirm_password" id="user_register_confirm_password" placeholder="<?php esc_html_e('Repeat Password','edgt-membership') ?>" value="" required />
            </div>
			<div class="edgt-register-button-holder">
				<?php
				if ( edgt_membership_theme_installed() ) {
					echo educator_edge_get_button_html( array(
						'html_type' => 'button',
						'text'      => esc_html__( 'REGISTER', 'edgt-membership' ),
						'type'      => 'solid',
						'size'      => 'small'
					) );
				} else {
					echo '<button type="submit">' . esc_html__( 'REGISTER', 'edgt-membership' ) . '</button>';
				}
				wp_nonce_field( 'edgt-ajax-register-nonce', 'edgt-register-security' ); ?>
			</div>
		</fieldset>
	</form>
	<?php do_action( 'edgt_membership_action_login_ajax_response' ); ?>
</div>