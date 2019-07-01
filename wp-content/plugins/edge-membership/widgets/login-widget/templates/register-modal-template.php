<div class="edgt-register-holder edgt-modal-holder" data-modal="register">
    <div class="edgt-register-content edgt-modal-content">
        <div class="edgt-register-content-inner edgt-modal-content-inner" id="edgt-register-content">
            <h3><?php esc_html_e("User registration", "edgt-membership") ?></h3>
            <div class="edgt-wp-register-holder">
                <?php echo edgt_membership_execute_shortcode( 'edgt_user_register', array() ) ?>
            </div>
        </div>
    </div>
</div>