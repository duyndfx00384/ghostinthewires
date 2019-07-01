<div class="edgt-login-holder edgt-modal-holder" data-modal="login">
	<div class="edgt-login-content edgt-modal-content">
		<div class="edgt-login-content-inner edgt-modal-content-inner">
            <h3><?php esc_html_e("User login", "edgt-membership") ?></h3>
			<div class="edgt-wp-login-holder">
                <?php echo edgt_membership_execute_shortcode( 'edgt_user_login', array() ); ?>
            </div>
		</div>
	</div>
</div>