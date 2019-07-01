<?php
get_header();
if ( edgt_membership_theme_installed() ) {
	educator_edge_get_title();
} else { ?>
	<div class="edgt-membership-title">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</div>
<?php }
?>
	<div class="edgt-container">
		<?php do_action( 'educator_edge_after_container_open' ); ?>
		<div class="edgt-container-inner clearfix">
            <div class="edgt-membership-main-wrapper clearfix">
                <?php if ( is_user_logged_in() ) { ?>
                    <div class="edgt-membership-dashboard-nav-holder clearfix">
                        <?php
                        //Include dashboard navigation
                        echo edgt_membership_get_dashboard_template_part( 'navigation' );
                        ?>
                    </div>
                    <div class="edgt-membership-dashboard-content-holder">
                        <?php echo edgt_membership_get_dashboard_pages(); ?>
                    </div>
                <?php } else { ?>
                    <div class="edgt-login-register-content edgt-user-not-logged-in">
                        <h3><?php esc_html_e('Login with your account', 'edgt-membership') ?></h3>
                        <div class="edgt-login-content-inner">
                            <div class="edgt-wp-login-holder">
                                <?php echo edgt_membership_execute_shortcode( 'edgt_user_login', array() ); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
		</div>
		<?php do_action( 'educator_edge_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>