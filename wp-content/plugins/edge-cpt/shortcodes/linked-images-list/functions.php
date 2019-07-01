<?php

if ( ! function_exists( 'edgt_core_add_course_linked_images_list_shortcodes' ) ) {
    function edgt_core_add_course_linked_images_list_shortcodes( $shortcodes_class_name ) {
        $shortcodes = array(
            'EdgeCore\CPT\Shortcodes\LinkedImagesList\LinkedImagesList'
        );

        $shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

        return $shortcodes_class_name;
    }

    add_filter( 'edgt_core_filter_add_vc_shortcode', 'edgt_core_add_course_linked_images_list_shortcodes' );
}

if ( ! function_exists( 'edgt_core_set_course_linked_images_list_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for icon list item shortcode to set our icon for Visual Composer shortcodes panel
     */
    function edgt_core_set_course_linked_images_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-linked-image-list';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'edgt_core_filter_add_vc_shortcodes_custom_icon_class', 'edgt_core_set_course_linked_images_list_icon_class_name_for_vc_shortcodes' );
}