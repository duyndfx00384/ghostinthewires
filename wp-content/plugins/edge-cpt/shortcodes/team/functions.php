<?php

if(!function_exists('edgt_core_add_team_shortcodes')) {
    function edgt_core_add_team_shortcodes($shortcodes_class_name) {
        $shortcodes = array(
            'EdgeCore\CPT\Shortcodes\Team\Team'
        );

        $shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);

        return $shortcodes_class_name;
    }

    add_filter('edgt_core_filter_add_vc_shortcode', 'edgt_core_add_team_shortcodes');
}

if( !function_exists('edgt_core_set_team_icon_class_name_for_vc_shortcodes') ) {
    /**
     * Function that set custom icon class name for video button shortcode to set our icon for Visual Composer shortcodes panel
     */
    function edgt_core_set_team_icon_class_name_for_vc_shortcodes($shortcodes_icon_class_array) {
        $shortcodes_icon_class_array[] = '.icon-wpb-team';

        return $shortcodes_icon_class_array;
    }

    add_filter('edgt_core_filter_add_vc_shortcodes_custom_icon_class', 'edgt_core_set_team_icon_class_name_for_vc_shortcodes');
}