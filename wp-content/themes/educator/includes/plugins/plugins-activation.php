<?php

if(!function_exists('educator_edge_register_required_plugins')) {
    /**
     * Registers theme required and optional plugins. Hooks to tgmpa_register hook
     */
    function educator_edge_register_required_plugins() {
        $plugins = array(
            array(
                'name'               => esc_html__('WPBakery Visual Composer', 'educator'),
                'slug'               => 'js_composer',
                'source'             => get_template_directory().'/includes/plugins/js_composer.zip',
                'version'            => '5.2.1',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Revolution Slider', 'educator'),
                'slug'               => 'revslider',
                'source'             => get_template_directory().'/includes/plugins/revslider.zip',
                'version'            => '5.4.5.2',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Timetable Responsive Schedule For WordPress', 'educator'),
                'slug'               => 'timetable',
                'source'             => get_template_directory().'/includes/plugins/timetable.zip',
                'version'            => '4.0',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Edge CPT', 'educator'),
                'slug'               => 'edge-cpt',
                'source'             => get_template_directory().'/includes/plugins/edge-cpt.zip',
                'version'            => '1.0',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Edge LMS', 'educator'),
                'slug'               => 'edge-lms',
                'source'             => get_template_directory().'/includes/plugins/edge-lms.zip',
                'version'            => '1.0',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Edge Woocommerce Checkout Integration', 'educator'),
                'slug'               => 'edge-checkout',
                'source'             => get_template_directory().'/includes/plugins/edge-checkout.zip',
                'required'           => true,
                'version'            => '1.0',
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Edge Membership', 'educator'),
                'slug'               => 'edge-membership',
                'source'             => get_template_directory().'/includes/plugins/edge-membership.zip',
                'required'           => true,
                'version'            => '1.0',
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Edge Instagram Feed', 'educator'),
                'slug'               => 'edge-instagram-feed',
                'source'             => get_template_directory().'/includes/plugins/edge-instagram-feed.zip',
                'version'            => '1.0',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
            array(
                'name'               => esc_html__('Edge Twitter Feed', 'educator'),
                'slug'               => 'edge-twitter-feed',
                'source'             => get_template_directory().'/includes/plugins/edge-twitter-feed.zip',
                'version'            => '1.0',
                'required'           => true,
                'force_activation'   => false,
                'force_deactivation' => false
            ),
	        array(
		        'name'         => esc_html__( 'WooCommerce', 'educator' ),
		        'slug'         => 'woocommerce',
		        'external_url' => 'https://wordpress.org/plugins/woocommerce/',
		        'required'     => false
	        ),
	        array(
		        'name'         => esc_html__( 'Contact Form 7', 'educator' ),
		        'slug'         => 'contact-form-7',
		        'external_url' => 'https://wordpress.org/plugins/contact-form-7/',
		        'required'     => false
	        ),
            array(
		        'name'         => esc_html__( 'The Events Calendar', 'educator' ),
		        'slug'         => 'the-events-calendar',
		        'external_url' => 'https://wordpress.org/plugins/the-events-calendar/',
		        'required'     => false
	        )
        );

        $config = array(
            'domain'           => 'educator',
            'default_path'     => '',
            'parent_slug' 	   => 'themes.php',
            'capability' 	   => 'edit_theme_options',
            'menu'             => 'install-required-plugins',
            'has_notices'      => true,
            'is_automatic'     => false,
            'message'          => '',
            'strings'          => array(
                'page_title'                      => esc_html__('Install Required Plugins', 'educator'),
                'menu_title'                      => esc_html__('Install Plugins', 'educator'),
                'installing'                      => esc_html__('Installing Plugin: %s', 'educator'),
                'oops'                            => esc_html__('Something went wrong with the plugin API.', 'educator'),
                'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'educator'),
                'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'educator'),
                'notice_cannot_install'           => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'educator'),
                'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'educator'),
                'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'educator'),
                'notice_cannot_activate'          => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'educator'),
                'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'educator'),
                'notice_cannot_update'            => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'educator'),
                'install_link'                    => _n_noop('Begin installing plugin', 'Begin installing plugins', 'educator'),
                'activate_link'                   => _n_noop('Activate installed plugin', 'Activate installed plugins', 'educator'),
                'return'                          => esc_html__('Return to Required Plugins Installer', 'educator'),
                'plugin_activated'                => esc_html__('Plugin activated successfully.', 'educator'),
                'complete'                        => esc_html__('All plugins installed and activated successfully. %s', 'educator'),
                'nag_type'                        => 'updated'
            )
        );

        tgmpa($plugins, $config);
    }

    add_action('tgmpa_register', 'educator_edge_register_required_plugins');
}