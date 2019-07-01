<?php

if (!function_exists('edgt_lms_map_lesson_meta')) {
    function edgt_lms_map_lesson_meta() {

        $meta_box = educator_edge_add_meta_box(array(
            'scope' => 'lesson',
            'title' => esc_html__('Lesson Settings', 'edge-lms'),
            'name'  => 'lesson_settings_meta_box'
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_lesson_description_meta',
            'type'        => 'textarea',
            'label'       => esc_html__('Lesson Description', 'edge-lms'),
            'description' => esc_html__('Add lesson description', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));


        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_lesson_duration_meta',
            'type'        => 'text',
            'label'       => esc_html__('Lesson Duration', 'edge-lms'),
            'description' => esc_html__('Set duration for lesson', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name' => 'edgt_lesson_duration_parameter_meta',
            'type' => 'select',
            'label' => esc_html__('Lesson Duration Parameter', 'edge-lms'),
            'description' => esc_html__('Choose parameter for lesson duration', 'edge-lms'),
            'default_value' => 'm',
            'parent' => $meta_box,
            'options' => array(
                '' => esc_html__('Default', 'edge-lms'),
                'm' => esc_html__('Minutes', 'edge-lms'),
                'h' => esc_html__('Hours', 'edge-lms'),
                'd' => esc_html__('Days', 'edge-lms'),
                'w' => esc_html__('Weeks', 'edge-lms'),
            )
        ));

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_lesson_free_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Free Lesson', 'edge-lms'),
                'description' => esc_html__('Enabling this option will set lesson to be free', 'edge-lms'),
                'parent'      => $meta_box,
                'options' => array(
                    '' => esc_html__('Default', 'edge-lms'),
                    'yes' => esc_html__('Yes', 'edge-lms'),
                    'no' => esc_html__('No', 'edge-lms')
                )
            )
        );

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_lesson_post_message_meta',
            'type'        => 'textarea',
            'label'       => esc_html__('Lesson Post Message', 'edge-lms'),
            'description' => esc_html__('Set message that will be displayed after the lesson is completed', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(
            array(
                'name' => 'edgt_lesson_type_meta',
                'type' => 'select',
                'default_value' => '',
                'label'       => esc_html__('Lesson Type', 'edge-lms'),
                'description' => esc_html__('Choose desired lesson type', 'edge-lms'),
                'parent'      => $meta_box,
                'options' => array(
                    'reading'  => esc_html__('Reading', 'edge-lms'),
                    'video' => esc_html__('Video', 'edge-lms'),
                    'audio' => esc_html__('Audio', 'edge-lms')
                ),
                'args' => array(
                    'dependence' => true,
                    'hide' => array(
                        'reading' => '#edgt_edgt_video_container, #edgt_edgt_audio_container',
                        'video' => '#edgt_edgt_audio_container',
                        'audio' => '#edgt_edgt_video_container'
                    ),
                    'show' => array(
                        'reading' => '',
                        'video' => '#edgt_edgt_video_container',
                        'audio' => '#edgt_edgt_audio_container'
                    )
                )
            )
        );

        //VIDEO TYPE
        $edgt_video_container = educator_edge_add_admin_container(
            array(
                'parent'          => $meta_box,
                'name'            => 'edgt_video_container',
                'hidden_property' => 'edgt_lesson_type_meta',
                'hidden_value'    => array('reading, audio')
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name'          => 'edgt_lesson_video_type_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Video Type', 'edge-lms' ),
                'description'   => esc_html__( 'Choose video type', 'edge-lms' ),
                'parent'        => $edgt_video_container,
                'default_value' => 'social_networks',
                'options'       => array(
                    'social_networks' => esc_html__( 'Video Service', 'edge-lms' ),
                    'self'            => esc_html__( 'Self Hosted', 'edge-lms' )
                ),
                'args'          => array(
                    'dependence' => true,
                    'hide'       => array(
                        'social_networks' => '#edgt_edgt_video_self_hosted_container',
                        'self'            => '#edgt_edgt_video_embedded_container'
                    ),
                    'show'       => array(
                        'social_networks' => '#edgt_edgt_video_embedded_container',
                        'self'            => '#edgt_edgt_video_self_hosted_container'
                    )
                )
            )
        );

        $edgt_video_embedded_container = educator_edge_add_admin_container(
            array(
                'parent'          => $edgt_video_container,
                'name'            => 'edgt_video_embedded_container',
                'hidden_property' => 'edgt_lesson_video_type_meta',
                'hidden_value'    => 'self'
            )
        );

        $edgt_video_self_hosted_container = educator_edge_add_admin_container(
            array(
                'parent'          => $edgt_video_container,
                'name'            => 'edgt_video_self_hosted_container',
                'hidden_property' => 'edgt_lesson_video_type_meta',
                'hidden_value'    => 'social_networks'
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name'        => 'edgt_lesson_video_link_meta',
                'type'        => 'text',
                'label'       => esc_html__( 'Video URL', 'edge-lms' ),
                'description' => esc_html__( 'Enter Video URL', 'edge-lms' ),
                'parent'      => $edgt_video_embedded_container,
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name'        => 'edgt_lesson_video_custom_meta',
                'type'        => 'text',
                'label'       => esc_html__( 'Video MP4', 'edge-lms' ),
                'description' => esc_html__( 'Enter video URL for MP4 format', 'edge-lms' ),
                'parent'      => $edgt_video_self_hosted_container,
            )
        );

        //AUDIO TYPE
        $edgt_audio_container = educator_edge_add_admin_container(
            array(
                'parent'          => $meta_box,
                'name'            => 'edgt_audio_container',
                'hidden_property' => 'edgt_lesson_type_meta',
                'hidden_value'    => array('reading, video')
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name'          => 'edgt_lesson_audio_type_meta',
                'type'          => 'select',
                'label'         => esc_html__( 'Audio Type', 'edge-lms' ),
                'description'   => esc_html__( 'Choose audio type', 'edge-lms' ),
                'parent'        => $edgt_audio_container,
                'default_value' => 'social_networks',
                'options'       => array(
                    'social_networks' => esc_html__( 'Audio Service', 'edge-lms' ),
                    'self'            => esc_html__( 'Self Hosted', 'edge-lms' )
                ),
                'args'          => array(
                    'dependence' => true,
                    'hide'       => array(
                        'social_networks' => '#edgt_edgt_audio_self_hosted_container',
                        'self'            => '#edgt_edgt_audio_embedded_container'
                    ),
                    'show'       => array(
                        'social_networks' => '#edgt_edgt_audio_embedded_container',
                        'self'            => '#edgt_edgt_audio_self_hosted_container'
                    )
                )
            )
        );

        $edgt_audio_embedded_container = educator_edge_add_admin_container(
            array(
                'parent'          => $edgt_audio_container,
                'name'            => 'edgt_audio_embedded_container',
                'hidden_property' => 'edgt_lesson_audio_type_meta',
                'hidden_value'    => 'self'
            )
        );

        $edgt_audio_self_hosted_container = educator_edge_add_admin_container(
            array(
                'parent'          => $edgt_audio_container,
                'name'            => 'edgt_audio_self_hosted_container',
                'hidden_property' => 'edgt_lesson_audio_type_meta',
                'hidden_value'    => 'social_networks'
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name'        => 'edgt_lesson_audio_link_meta',
                'type'        => 'text',
                'label'       => esc_html__( 'Audio URL', 'edge-lms' ),
                'description' => esc_html__( 'Enter audio URL', 'edge-lms' ),
                'parent'      => $edgt_audio_embedded_container,
            )
        );

        educator_edge_add_meta_box_field(
            array(
                'name'        => 'edgt_lesson_audio_custom_meta',
                'type'        => 'text',
                'label'       => esc_html__( 'Audio Link', 'edge-lms' ),
                'description' => esc_html__( 'Enter audio link', 'edge-lms' ),
                'parent'      => $edgt_audio_self_hosted_container,
            )
        );

    }

    add_action('educator_edge_meta_boxes_map', 'edgt_lms_map_lesson_meta', 5);
}