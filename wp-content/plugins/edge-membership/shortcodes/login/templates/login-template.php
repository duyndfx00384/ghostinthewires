<div class="edgt-social-login-holder">
    <div class="edgt-social-login-holder-outer">
        <div class="edgt-social-login-holder-inner">
            <form method="post" class="edgt-login-form">
                <?php
                $redirect = '';
                if ( isset( $_GET['redirect_uri'] ) ) {
                    $redirect = $_GET['redirect_uri'];
                } ?>
                <fieldset>
                    <div>
                        <label class="edgt-username-label"><?php esc_html_e( 'Username', 'edgt-membership' ) ?></label>
                        <input type="text" name="user_login_name" id="user_login_name"  value="" required pattern=".{3,}" title="<?php esc_html_e( 'Three or more characters', 'edgt-membership' ); ?>"/>
                    </div>
                    <div>
                        <label class="edgt-password-label"><?php esc_html_e( 'Password', 'edgt-membership' ) ?></label>
                        <input type="password" name="user_login_password" id="user_login_password" value="" required/>
                    </div>
                    <div class="edgt-lost-pass-remember-holder clearfix">
                        <div class="edgt-remember-holder">
                            <span class="edgt-login-remember">
                                <input name="rememberme" value="forever" id="rememberme" type="checkbox"/>
                                <label for="rememberme" class="edgt-checbox-label"><?php esc_html_e( 'Remember me', 'edgt-membership' ) ?></label>
                            </span>
                        </div>
                        <div class="edgt-lost-pass-holder">
                            <a href="#" class="edgt-modal-opener" data-modal="password"><?php esc_html_e( 'Lost your password?', 'edgt-membership' ); ?></a>
                        </div>
                    </div>
                    <input type="hidden" name="redirect" id="redirect" value="<?php echo esc_url( $redirect ); ?>">
                    <div class="edgt-login-button-holder">
                        <?php
                        if ( edgt_membership_theme_installed() ) {
                            echo educator_edge_get_button_html( array(
                                'html_type' => 'button',
                                'text'      => esc_html__( 'Login', 'edgt-membership' ),
                                'type'      => 'solid',
                                'size'      => 'large'
                            ) );
                        } else {
                            echo '<button type="submit">' . esc_html__( 'Login', 'edgt-membership' ) . '</button>';
                        }
                        ?>
                        <?php wp_nonce_field( 'edgt-ajax-login-nonce', 'edgt-login-security' ); ?>
                    </div>
                    <div class="edgt-register-link-holder">
                        <span class="edgt-register-label">
                            <?php esc_html_e( 'Not a member yet?', 'edgt-membership' ); ?>
                        </span>
                        <a href="#" class="edgt-modal-opener" data-modal="register"><?php esc_html_e( 'Register Now', 'edgt-membership' ); ?></a>
                    </div>
                </fieldset>
            </form>
        </div>
        <?php
        if(edgt_membership_theme_installed()) {
            //if social login enabled add social networks login
            $social_login_enabled = educator_edge_options()->getOptionValue('enable_social_login') == 'yes' ? true : false;
            if($social_login_enabled) { ?>
                <div class="edgt-login-form-social-login">
                    <div class="edgt-login-social-title">
                        <span><?php esc_html_e('Recommended', 'edgt-membership'); ?></span>
                    </div>
                    <div class="edgt-login-social-networks">
                        <?php do_action('edgt_membership_social_network_login'); ?>
                    </div>
                    <div class="edgt-login-social-info">
                        <?php esc_html_e('Connect with Social Networks', 'edgt-membership'); ?>
                    </div>
                </div>
            <?php }
        }
        ?>
    </div>
    <?php
    do_action( 'edgt_membership_action_login_ajax_response' );
    ?>
</div>