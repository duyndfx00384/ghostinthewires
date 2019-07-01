<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Edgt_Comparison_Pricing_Table extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'edgt_core_add_comparison_pricing_table_shortcodes' ) ) {
    function edgt_core_add_comparison_pricing_table_shortcodes( $shortcodes_class_name ) {
        $shortcodes = array(
            'EdgeCore\CPT\Shortcodes\ComparisonPricingTable\ComparisonPricingTable',
            'EdgeCore\CPT\Shortcodes\ComparisonPricingTable\ComparisonPricingTableItem'
        );

        $shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );

        return $shortcodes_class_name;
    }

    add_filter( 'edgt_core_filter_add_vc_shortcode', 'edgt_core_add_comparison_pricing_table_shortcodes' );
}

if ( ! function_exists( 'edgt_core_set_comparison_pricing_table_icon_class_name_for_vc_shortcodes' ) ) {
    /**
     * Function that set custom icon class name for clients carousel shortcode to set our icon for Visual Composer shortcodes panel
     */
    function edgt_core_set_comparison_pricing_table_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
        $shortcodes_icon_class_array[] = '.icon-wpb-comparison-pricing-table';
        $shortcodes_icon_class_array[] = '.icon-wpb-comparison-pricing-table-item';

        return $shortcodes_icon_class_array;
    }

    add_filter( 'edgt_core_filter_add_vc_shortcodes_custom_icon_class', 'edgt_core_set_comparison_pricing_table_icon_class_name_for_vc_shortcodes' );
}