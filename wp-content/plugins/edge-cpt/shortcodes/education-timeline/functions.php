<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Edgt_Education_Timeline_Holder extends WPBakeryShortCodesContainer {}
    class WPBakeryShortCode_Edgt_Education_Timeline_Item extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'edgt_core_add_education_timeline_shortcodes' ) ) {
    function edgt_core_add_education_timeline_shortcodes( $shortcodes_class_name ) {
        $shortcodes = array(
            'EdgeCore\CPT\Shortcodes\EducationTimeline\EducationTimelineHolder',
            'EdgeCore\CPT\Shortcodes\EducationTimeline\EducationTimelineItem'
        );

        $shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

        return $shortcodes_class_name;
    }

    add_filter( 'edgt_core_filter_add_vc_shortcode', 'edgt_core_add_education_timeline_shortcodes' );
}

if ( ! function_exists( 'edgt_core_set_education_timeline_custom_style_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom css style for education_timeline shortcode
     */
    function edgt_core_set_education_timeline_custom_style_for_vc_shortcodes( $style ) {
        $current_style = '.vc_shortcodes_container.wpb_edgt_education_timeline_item {
			background-color: #f4f4f4; 
		}';

        $style .= $current_style;

        return $style;
    }

    add_filter( 'edgt_core_filter_add_vc_shortcodes_custom_style', 'edgt_core_set_education_timeline_custom_style_for_vc_shortcodes' );
}

if ( ! function_exists( 'edgt_core_set_education_timeline_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for education_timeline shortcode to set our icon for Visual Composer shortcodes panel
     */
    function edgt_core_set_education_timeline_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-education-timeline-holder';
        $shortcodes_icon_class_array[] = '.icon-wpb-education-timeline-item';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'edgt_core_filter_add_vc_shortcodes_custom_icon_class', 'edgt_core_set_education_timeline_icon_class_name_for_vc_shortcodes' );
}