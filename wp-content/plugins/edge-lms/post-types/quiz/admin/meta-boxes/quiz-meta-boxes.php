<?php

if (!function_exists('edgt_lms_map_quiz_meta')) {
    function edgt_lms_map_quiz_meta() {

        $meta_box = educator_edge_add_meta_box(array(
            'scope' => 'quiz',
            'title' => esc_html__('Quiz Settings', 'edge-lms'),
            'name'  => 'quiz_settings_meta_box'
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_quiz_description_meta',
            'type'        => 'textarea',
            'label'       => esc_html__('Quiz Description', 'edge-lms'),
            'description' => esc_html__('Set duration for quiz', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));


        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_quiz_duration_meta',
            'type'        => 'text',
            'label'       => esc_html__('Quiz Duration', 'edge-lms'),
            'description' => esc_html__('Set duration for quiz', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name' => 'edgt_quiz_duration_parameter_meta',
            'type' => 'select',
            'label' => esc_html__('Quiz Duration Parameter', 'edge-lms'),
            'description' => esc_html__('Choose parameter for quiz duration', 'edge-lms'),
            'default_value' => 'm',
            'parent' => $meta_box,
            'options' => array(
                's' => esc_html__('Seconds', 'edge-lms'),
                'm' => esc_html__('Minutes', 'edge-lms'),
                'h' => esc_html__('Hours', 'edge-lms')
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_quiz_number_retakes_meta',
            'type'        => 'text',
            'label'       => esc_html__('Number of Retakes', 'edge-lms'),
            'description' => esc_html__('Set allowed number of quiz retakes.', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_quiz_passing_percentage_meta',
            'type'        => 'text',
            'label'       => esc_html__('Passing Percentage', 'edge-lms'),
            'description' => esc_html__('Set value required to pass the quiz', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_quiz_post_message_meta',
            'type'        => 'textarea',
            'label'       => esc_html__('Quiz Post Message', 'edge-lms'),
            'description' => esc_html__('Set message that will be displayed after the quiz is completed', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

    }

    add_action('educator_edge_meta_boxes_map', 'edgt_lms_map_quiz_meta', 5);
}