<?php

if(!function_exists('edgt_lms_map_instructor_single_meta')) {
    function edgt_lms_map_instructor_single_meta() {

        $meta_box = educator_edge_add_meta_box(array(
            'scope' => 'instructor',
            'title' => esc_html__('Instructor Info', 'edge-lms'),
            'name'  => 'instructor_meta'
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_instructor_title',
            'type'        => 'text',
            'label'       => esc_html__('Title', 'edge-lms'),
            'description' => esc_html__('The members\'s title', 'edge-lms'),
            'parent'      => $meta_box
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_instructor_vita',
            'type'        => 'textarea',
            'label'       => esc_html__('Brief Vita', 'edge-lms'),
            'description' => esc_html__('The members\'s brief vita', 'edge-lms'),
            'parent'      => $meta_box
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_instructor_address',
            'type'        => 'text',
            'label'       => esc_html__('Address', 'edge-lms'),
            'description' => esc_html__('The members\'s address', 'edge-lms'),
            'parent'      => $meta_box
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_instructor_phone_number',
            'type'        => 'text',
            'label'       => esc_html__('Phone Number', 'edge-lms'),
            'description' => esc_html__('The members\'s phone number', 'edge-lms'),
            'parent'      => $meta_box
        ));


        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_instructor_email',
            'type'        => 'text',
            'label'       => esc_html__('Email', 'edge-lms'),
            'description' => esc_html__('The members\'s email', 'edge-lms'),
            'parent'      => $meta_box
        ));


        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_instructor_resume',
            'type'        => 'file',
            'label'       => esc_html__('Resume', 'edge-lms'),
            'description' => esc_html__('Upload members\'s resume', 'edge-lms'),
            'parent'      => $meta_box
        ));

        for($x = 1; $x < 6; $x++) {

            $social_icon_group = educator_edge_add_admin_group(array(
                'name'   => 'edgt_instructor_social_icon_group'.$x,
                'title'  => esc_html__('Social Link ', 'edge-lms').$x,
                'parent' => $meta_box
            ));

                $social_row1 = educator_edge_add_admin_row(array(
                    'name'   => 'edgt_instructor_social_icon_row1'.$x,
                    'parent' => $social_icon_group
                ));

                    EducatorEdgeIconCollections::get_instance()->getSocialIconsMetaBoxOrOption(array(
                        'label' => esc_html__('Icon ', 'edge-lms').$x,
                        'parent' => $social_row1,
                        'name' => 'edgt_instructor_social_icon_pack_'.$x,
                        'defaul_icon_pack' => '',
                        'type' => 'meta-box',
                        'field_type' => 'simple'
                    ));

                $social_row2 = educator_edge_add_admin_row(array(
                    'name'   => 'edgt_instructor_social_icon_row2'.$x,
                    'parent' => $social_icon_group
                ));

                    educator_edge_add_meta_box_field(array(
                        'type'            => 'textsimple',
                        'label'           => esc_html__('Link', 'edge-lms'),
                        'name'            => 'edgt_instructor_social_icon_'.$x.'_link',
                        'hidden_property' => 'edgt_instructor_social_icon_pack_'.$x,
                        'hidden_value'    => '',
                        'parent'          => $social_row2
                    ));
	
			        educator_edge_add_meta_box_field(array(
				        'type'          => 'selectsimple',
				        'label'         => esc_html__('Target', 'edge-lms'),
				        'name'          => 'edgt_instructor_social_icon_'.$x.'_target',
				        'options'       => educator_edge_get_link_target_array(),
				        'hidden_property' => 'edgt_instructor_social_icon_'.$x.'_link',
				        'hidden_value'    => '',
				        'parent'          => $social_row2
			        ));
        }
    }

    add_action('educator_edge_meta_boxes_map', 'edgt_lms_map_instructor_single_meta', 46);
}