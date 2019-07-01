<?php

if(!function_exists('edgt_membership_add_login_shortcodes')) {
    function edgt_membership_add_login_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'EdgefMembership\Shortcodes\EdgefUserLogin\EdgefUserLogin'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('edgt_membership_filter_add_vc_shortcode', 'edgt_membership_add_login_shortcodes');
}