<?php

if (!function_exists('edgt_lms_map_quiz_questions_meta')) {
    function edgt_lms_map_quiz_questions_meta() {

        $edgt_questions = array();
        $questions = get_posts(
            array(
                'numberposts' => -1,
                'post_type' => 'question',
                'post_status' => 'publish'
            )
        );
        foreach ($questions as $question) {
            $edgt_questions[$question->ID] = $question->post_title;
        }

        $meta_box = educator_edge_add_meta_box(array(
            'scope' => 'quiz',
            'title' => esc_html__('Quiz Questions', 'edge-lms'),
            'name'  => 'quiz_questions_meta_box'
        ));

        educator_edge_add_table_repeater_field(array(
                'name'        => 'edgt_quiz_question_list_meta',
                'parent'      => $meta_box,
                'button_text' => esc_html__('Add Question', 'edge-lms'),
                'fields'      => array(
                    array(
                        'name'        => 'edgt_quiz_question_meta',
                        'type'        => 'select',
                        'label'       => '',
                        'description' => '',
                        'parent'      => $meta_box,
                        'options'     => $edgt_questions,
                        'args' => array(
                            'select2' => true,
                            'colWidth'=> 12
                        ),
                        'th'          => esc_html__('Question', 'edge-lms')
                    )
                )
            )
        );
    }

    add_action('educator_edge_meta_boxes_map', 'edgt_lms_map_quiz_questions_meta', 4);
}