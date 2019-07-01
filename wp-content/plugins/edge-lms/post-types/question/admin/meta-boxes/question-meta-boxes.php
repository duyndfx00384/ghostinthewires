<?php

if (!function_exists('edgt_lms_map_question_meta')) {
    function edgt_lms_map_question_meta() {

        $meta_box = educator_edge_add_meta_box(array(
            'scope' => 'question',
            'title' => esc_html__('Question Settings', 'edge-lms'),
            'name'  => 'question_settings_meta_box'
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_question_description_meta',
            'type'        => 'textarea',
            'label'       => esc_html__('Question Description', 'edge-lms'),
            'description' => esc_html__('Set duration for question', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name' => 'edgt_question_type_meta',
            'type' => 'select',
            'label' => esc_html__('Question Type', 'edge-lms'),
            'description' => esc_html__('Choose type for question', 'edge-lms'),
            'default_value' => 'multi_choice',
            'parent' => $meta_box,
            'options' => array(
                'multi_choice' => esc_html__('Multi Choice', 'edge-lms'),
                'single_choice' => esc_html__('Single Choice', 'edge-lms'),
                'text' => esc_html__('Text', 'edge-lms'),
            ),
            'args' => array(
                'dependence' => true,
                'hide' => array(
                    'multi_choice'  => '#edgt_answers_holder_text_section_container',
                    'single_choice' => '#edgt_answers_holder_text_section_container',
                    'text'          => '#edgt_answers_holder_choices_section_container'
                ),
                'show' => array(
                    'multi_choice'  => '#edgt_answers_holder_choices_section_container',
                    'single_choice' => '#edgt_answers_holder_choices_section_container',
                    'text'          => '#edgt_answers_holder_text_section_container'
                ),
                'use_as_switcher' => true,
                'switch_type'     => 'single_yesno',
                'switch_property' => 'edgt_question_answer_true_meta',
                'switch_enabled'  => 'single_choice'
            )
        ));


        //Choice Type
        $question_answers_single_container = educator_edge_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'answers_holder_choices_section_container',
            'parent'          => $meta_box,
            'hidden_property' => 'edgt_question_type_meta',
            'hidden_values'   => array('text')
        ));

        educator_edge_add_table_repeater_field(array(
                'name'        => 'edgt_answers_list_meta',
                'parent'      => $question_answers_single_container,
                'button_text' => '',
                'fields'      => array(
                    array(
                        'type'        => 'text',
                        'name'        => 'edgt_question_answer_title_meta',
                        'label'       => '',
                        'description' => '',
                        'th'          => esc_html__('Answer text', 'edge-lms')
                    ),
                    array(
                        'type'          => 'yesno',
                        'name'          => 'edgt_question_answer_true_meta',
                        'default_value' => 'no',
                        'label'         => '',
                        'description'   => '',
                        'th'            => esc_html__('Correct?', 'edge-lms')
                    )
                )
            )
        );

        //Text Type
        $question_answers_text_container = educator_edge_add_admin_container(array(
            'type'            => 'container',
            'name'            => 'answers_holder_text_section_container',
            'parent'          => $meta_box,
            'hidden_property' => 'edgt_question_type_meta',
            'hidden_values'   => array('single_choice', 'multi_choice')
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_answers_text_meta',
            'type'        => 'textarea',
            'label'       => esc_html__('Answer', 'edge-lms'),
            'description' => '',
            'parent'      => $question_answers_text_container,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_question_mark_meta',
            'type'        => 'text',
            'label'       => esc_html__('Question Mark', 'edge-lms'),
            'description' => esc_html__('Set mark that is given for correct answer', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

        educator_edge_add_meta_box_field(array(
            'name'        => 'edgt_question_hint_meta',
            'type'        => 'textarea',
            'label'       => esc_html__('Question Hint', 'edge-lms'),
            'description' => esc_html__('Set Hint that can be displayed to student', 'edge-lms'),
            'parent'      => $meta_box,
            'args'        => array(
                'col_width' => 3
            )
        ));

    }

    add_action('educator_edge_meta_boxes_map', 'edgt_lms_map_question_meta', 5);
}