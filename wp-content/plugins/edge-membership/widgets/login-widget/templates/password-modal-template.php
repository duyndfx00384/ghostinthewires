<div class="edgt-password-holder edgt-modal-holder" data-modal="password">
    <div class="edgt-password-content edgt-modal-content">
        <div class="edgt-reset-pass-content-inner edgt-modal-content-inner" id="edgt-reset-pass-content">
            <h3><?php esc_html_e("Reset password", "edgt-membership") ?></h3>
            <div class="edgt-wp-reset-pass-holder">
                <?php echo edgt_membership_execute_shortcode( 'edgt_user_reset_password', array() ) ?>
            </div>
        </div>
    </div>
</div>