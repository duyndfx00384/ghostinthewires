<form action='' method='post' class="edgt-lms-finish-quiz-form">
    <input type='hidden' name='edgt_lms_questions' value='<?php echo esc_attr($questions); ?>' />
    <input type='hidden' name='edgt_lms_question_id' value='<?php echo esc_attr($question_id); ?>' />
    <input type='hidden' name='edgt_lms_quiz_id' value='<?php echo esc_attr($quiz_id); ?>' />
    <input type='hidden' name='edgt_lms_course_id' value='<?php echo esc_attr($course_id); ?>' />
    <input type='hidden' name='edgt_lms_retake_id' value='<?php echo esc_attr($retake); ?>' />
    <input type='hidden' name='edgt_lms_question_answer' value='<?php echo esc_attr($value); ?>' />
    <div class="edgt-question-actions">
        <?php
        echo educator_edge_get_button_html(
            array(
                'custom_class' => 'edgt-quiz-finish',
                'html_type' => 'input',
                'input_name' => 'submit',
                'size' => 'small',
                'text' => esc_html__('Finish', 'edge-lms')
            )
        );
        ?>
    </div>
</form>