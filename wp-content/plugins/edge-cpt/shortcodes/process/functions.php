<?php

if ( ! function_exists( 'edgt_core_enqueue_scripts_for_process_shortcodes' ) ) {
    /**
     * Function that includes all necessary 3rd party scripts for this shortcode
     */
    function edgt_core_enqueue_scripts_for_process_shortcodes() {
        wp_enqueue_script( 'tweenLite', EDGE_CORE_SHORTCODES_URL_PATH . '/process/assets/js/plugins/TweenLite.min.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'timelineLite', EDGE_CORE_SHORTCODES_URL_PATH . '/process/assets/js/plugins/TimelineLite.min.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'cssPlugin', EDGE_CORE_SHORTCODES_URL_PATH . '/process/assets/js/plugins/CSSPlugin.min.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'easePack', EDGE_CORE_SHORTCODES_URL_PATH . '/process/assets/js/plugins/EasePack.min.js', array( 'jquery' ), false, true );
    }

    add_action( 'educator_edge_enqueue_third_party_scripts', 'edgt_core_enqueue_scripts_for_process_shortcodes' );
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Edgt_Process extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'edgt_core_add_process_shortcodes' ) ) {
    function edgt_core_add_process_shortcodes( $shortcodes_class_name ) {
        $shortcodes = array(
            'EdgeCore\CPT\Shortcodes\Process\Process',
            'EdgeCore\CPT\Shortcodes\Process\ProcessItem'
        );

        $shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

        return $shortcodes_class_name;
    }

    add_filter( 'edgt_core_filter_add_vc_shortcode', 'edgt_core_add_process_shortcodes' );
}

if ( ! function_exists( 'edgt_core_set_process_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for process shortcode to set our icon for Visual Composer shortcodes panel
     */
    function edgt_core_set_process_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-process';
        $shortcodes_icon_class_array[] = '.icon-wpb-process-item';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'edgt_core_filter_add_vc_shortcodes_custom_icon_class', 'edgt_core_set_process_icon_class_name_for_vc_shortcodes' );
}