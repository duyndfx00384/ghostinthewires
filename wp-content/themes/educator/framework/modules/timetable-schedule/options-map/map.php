<?php

if(educator_edge_visual_composer_installed()) {
    if(!function_exists('educator_edge_ttsingle_hours_vc_map')) {
        function educator_edge_ttsingle_hours_vc_map() {
            vc_map(array(
                'name'                      => esc_html__( 'Timetable Event Hours','educator'),
                'icon'                      => 'icon-wpb-tt-event-hours extended-custom-icon',
                'base'                      => 'tt_event_hours',
                'category'                  => esc_html__('by EDGE', 'educator'),
                'allowed_container_element' => 'vc_row'
            ));
        }

        add_action('vc_before_init', 'educator_edge_ttsingle_hours_vc_map');
    }

    if ( ! function_exists( 'educator_edge_set_tt_event_hours_icon_class_name_for_vc_shortcodes' ) ) {
        /**
         * Function that set custom icon class name for banner shortcode to set our icon for Visual Composer shortcodes panel
         */
        function educator_edge_set_tt_event_hours_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
            $shortcodes_icon_class_array[] = '.icon-wpb-tt-event-hours';

            return $shortcodes_icon_class_array;
        }

        add_filter( 'edgt_core_filter_add_vc_shortcodes_custom_icon_class', 'educator_edge_set_tt_event_hours_icon_class_name_for_vc_shortcodes' );
    }

    class WPBakeryShortCode_Tt_Items_List extends WPBakeryShortCodesContainer {
    }
}

