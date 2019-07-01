<?php

if(!function_exists('edgt_core_map_masonry_gallery_meta')) {
    function edgt_core_map_masonry_gallery_meta() {
        $masonry_gallery_meta_box = educator_edge_add_meta_box(
            array(
                'scope' => array('masonry-gallery'),
                'title' => esc_html__('Masonry Gallery General', 'edge-cpt'),
                'name' => 'masonry_gallery_meta'
            )
        );
	    
        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_masonry_gallery_item_title_tag',
                'type' => 'select',
                'default_value' => 'h4',
                'label' => esc_html__('Title Tag', 'edge-cpt'),
                'parent' => $masonry_gallery_meta_box,
                'options' => educator_edge_get_title_tag()
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_masonry_gallery_item_text',
                'type' => 'text',
                'label' => esc_html__('Text', 'edge-cpt'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_masonry_gallery_item_image',
                'type' => 'image',
                'label' => esc_html__('Custom Item Icon', 'edge-cpt'),
                'parent' => $masonry_gallery_meta_box
            )
        );


        $masonry_gallery_item_icon_container =  educator_edge_add_admin_container_no_style(array(
            'name' => 'masonry_gallery_icon_container',
            'parent' => $masonry_gallery_meta_box
        ));

        EducatorEdgeIconCollections::get_instance()->getMetaBoxOrOptionParamsArray($masonry_gallery_item_icon_container, 'edgt_masonry_gallery_item_icon', 'font_awesome', '', esc_html__('Icon', 'edge-cpt'), 'meta-box');

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_masonry_gallery_item_link',
                'type' => 'text',
                'label' => esc_html__('Link', 'edge-cpt'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_masonry_gallery_item_link_target',
                'type' => 'select',
                'default_value' => '_self',
                'label' => esc_html__('Link Target', 'edge-cpt'),
                'parent' => $masonry_gallery_meta_box,
                'options' => educator_edge_get_link_target_array()
            )
        );

        educator_edge_add_admin_section_title(array(
            'name'   => 'edgt_section_style_title',
            'parent' => $masonry_gallery_meta_box,
            'title'  => esc_html__('Masonry Gallery Item Style', 'edge-cpt')
        ));

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_masonry_gallery_item_size',
                'type' => 'select',
                'default_value' => 'square-small',
                'label' => esc_html__('Size', 'edge-cpt'),
                'parent' => $masonry_gallery_meta_box,
                'options' => array(
                    'square-small'			=> esc_html__('Square Small', 'edge-cpt'),
                    'square-big'			=> esc_html__('Square Big', 'edge-cpt'),
                    'rectangle-portrait'	=> esc_html__('Rectangle Portrait', 'edge-cpt'),
                    'rectangle-landscape'	=> esc_html__('Rectangle Landscape', 'edge-cpt')
                )
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_masonry_gallery_item_type',
                'type' => 'select',
                'default_value' => 'standard',
                'label' => esc_html__('Type', 'edge-cpt'),
                'parent' => $masonry_gallery_meta_box,
                'options' => array(
                    'standard'		=> esc_html__('Standard', 'edge-cpt'),
                    'extended'	=> esc_html__('Extended', 'edge-cpt'),
                    'simple'		=> esc_html__('Simple', 'edge-cpt')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'extended' => '#edgt_masonry_gallery_item_simple_type_container',
                        'simple' => '#edgt_masonry_gallery_item_button_type_container, #edgt_masonry_gallery_item_standard_type_container',
                        'standard' => '#edgt_masonry_gallery_item_button_type_container, #edgt_masonry_gallery_item_simple_type_container'
                    ),
                    'show' => array(
                        'extended' => '#edgt_masonry_gallery_item_button_type_container, #edgt_masonry_gallery_item_standard_type_container',
                        'simple' => '#edgt_masonry_gallery_item_simple_type_container',
                        'standard' => '#edgt_masonry_gallery_item_standard_type_container'
                    )
                )
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_masonry_gallery_button_label',
                'type' => 'text',
                'label' => esc_html__('Button Label', 'edge-cpt'),
                'parent' => $masonry_gallery_meta_box
            )
        );

        $masonry_gallery_item_button_type_container = educator_edge_add_admin_container_no_style(array(
            'name'				=> 'masonry_gallery_item_button_type_container',
            'parent'			=> $masonry_gallery_meta_box,
            'hidden_property'	=> 'edgt_masonry_gallery_item_type',
            'hidden_values'		=> array('standard', 'simple')
        ));

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_masonry_gallery_subtitle_label',
                'type' => 'text',
                'label' => esc_html__('Subtitle', 'edge-cpt'),
                'parent' => $masonry_gallery_item_button_type_container
            )
        );

        EducatorEdgeIconCollections::get_instance()->getMetaBoxOrOptionParamsArray($masonry_gallery_item_button_type_container, 'edgt_masonry_gallery_item_button_icon', 'font_awesome', '', esc_html__('Button Icon', 'edge-cpt'), 'meta-box');

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_masonry_gallery_subtitle_color',
                'type' => 'color',
                'label' => esc_html__('Subtitle Color', 'edge-cpt'),
                'parent' => $masonry_gallery_item_button_type_container
            )
        );

        $masonry_gallery_item_simple_type_container = educator_edge_add_admin_container_no_style(array(
            'name'				=> 'masonry_gallery_item_simple_type_container',
            'parent'			=> $masonry_gallery_meta_box,
            'hidden_property'	=> 'edgt_masonry_gallery_item_type',
            'hidden_values'		=> array('standard', 'extended')
        ));

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_masonry_gallery_simple_content_background_skin',
                'type' => 'select',
                'default_value' => '',
                'label' => esc_html__('Content Background Skin', 'edge-cpt'),
                'parent' => $masonry_gallery_item_simple_type_container,
                'options' => array(
                    'default' => esc_html__('Default', 'edge-cpt'),
                    'light'	=> esc_html__('Light', 'edge-cpt'),
                    'dark'	=> esc_html__('Dark', 'edge-cpt')
                )
            )
        );

        $masonry_gallery_item_standard_type_container = educator_edge_add_admin_container_no_style(array(
            'name'				=> 'masonry_gallery_item_standard_type_container',
            'parent'			=> $masonry_gallery_meta_box,
            'hidden_property'	=> 'edgt_masonry_gallery_item_type',
            'hidden_values'		=> array('simple')
        ));

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_masonry_gallery_standard_overlay_color',
                'type' => 'color',
                'default_value' => '',
                'label' => esc_html__('Image Overlay Color', 'edge-cpt'),
                'parent' => $masonry_gallery_item_standard_type_container
            )
        );
    }

    add_action('educator_edge_meta_boxes_map', 'edgt_core_map_masonry_gallery_meta', 45);
}