<div class="edgt-membership-dashboard-page">
	<div class="edgt-membership-dashboard-page-content">
		<div class="edgt-profile-image">
            <?php echo edgt_membership_kses_img( $profile_image ); ?>
        </div>
		<p>
			<span><?php esc_html_e( 'First Name', 'edgt-membership' ); ?>:</span>
			<?php echo esc_html($first_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Last Name', 'edgt-membership' ); ?>:</span>
			<?php echo esc_html($last_name); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Email', 'edgt-membership' ); ?>:</span>
			<?php echo esc_html($email); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Desription', 'edgt-membership' ); ?>:</span>
			<?php echo esc_html($description); ?>
		</p>
		<p>
			<span><?php esc_html_e( 'Website', 'edgt-membership' ); ?>:</span>
			<a href="<?php echo esc_url( $website ); ?>" target="_blank"><?php echo esc_html($website); ?></a>
		</p>
	</div>
</div>
