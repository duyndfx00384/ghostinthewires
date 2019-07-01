<div class="edgt-membership-dashboard-page">
	<div>
		<form method="post" id="edgt-membership-update-profile-form">
			<div class="edgt-membership-input-holder">
				<label for="first_name"><?php esc_html_e( 'First Name', 'edgt-membership' ); ?></label>
				<input class="edgt-membership-input" type="text" name="first_name" id="first_name"
				       value="<?php echo esc_html($first_name); ?>">
			</div>
			<div class="edgt-membership-input-holder">
				<label for="last_name"><?php esc_html_e( 'Last Name', 'edgt-membership' ); ?></label>
				<input class="edgt-membership-input" type="text" name="last_name" id="last_name"
				       value="<?php echo esc_html($last_name); ?>">
			</div>
			<div class="edgt-membership-input-holder">
				<label for="email"><?php esc_html_e( 'Email', 'edgt-membership' ); ?></label>
				<input class="edgt-membership-input" type="email" name="email" id="email"
				       value="<?php echo esc_html($email); ?>">
			</div>
			<div class="edgt-membership-input-holder">
				<label for="url"><?php esc_html_e( 'Website', 'edgt-membership' ); ?></label>
				<input class="edgt-membership-input" type="text" name="url" id="url" value="<?php echo esc_html($website); ?>">
			</div>
			<div class="edgt-membership-input-holder">
				<label for="description"><?php esc_html_e( 'Description', 'edgt-membership' ); ?></label>
				<input class="edgt-membership-input" type="text" name="description" id="description"
				       value="<?php echo esc_html($description); ?>">
			</div>
			<div class="edgt-membership-input-holder">
				<label for="password"><?php esc_html_e( 'Password', 'edgt-membership' ); ?></label>
				<input class="edgt-membership-input" type="password" name="password" id="password" value="">
			</div>
			<div class="edgt-membership-input-holder">
				<label for="password2"><?php esc_html_e( 'Repeat Password', 'edgt-membership' ); ?></label>
				<input class="edgt-membership-input" type="password" name="password2" id="password2" value="">
			</div>
			<?php
			if ( edgt_membership_theme_installed() ) {
				echo educator_edge_get_button_html( array(
					'text'      => esc_html__( 'UPDATE PROFILE', 'edgt-membership' ),
					'html_type' => 'button',
					'custom_attrs' => array(
						'data-updating-text' => esc_html__('UPDATING PROFILE', 'edgt-membership'),
						'data-updated-text' => esc_html__('PROFILE UPDATED', 'edgt-membership'),
					)
				) );
			} else {
				echo '<button type="submit">' . esc_html__( 'UPDATE PROFILE', 'edgt-membership' ) . '</button>';
			}
			wp_nonce_field( 'edgt_validate_edit_profile', 'edgt_nonce_edit_profile' )
			?>
		</form>
		<?php
		do_action( 'edgt_membership_action_login_ajax_response' );
		?>
	</div>
</div>