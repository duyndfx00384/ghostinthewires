<?php

if(!function_exists('educator_edge_map_woocommerce_meta')) {
    function educator_edge_map_woocommerce_meta() {
        $woocommerce_meta_box = educator_edge_add_meta_box(
            array(
                'scope' => array('product'),
                'title' => esc_html__('Product Meta', 'educator'),
                'name' => 'woo_product_meta'
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name'          => 'edgt_show_title_area_woo_meta',
                'type'          => 'select',
                'default_value' => '',
                'label'         => esc_html__('Show Title Area', 'educator'),
                'description'   => esc_html__('Disabling this option will turn off page title area', 'educator'),
                'parent'        => $woocommerce_meta_box,
                'options'       => educator_edge_get_yes_no_select_array()
            )
        );
    }
	
    add_action('educator_edge_meta_boxes_map', 'educator_edge_map_woocommerce_meta', 99);
}