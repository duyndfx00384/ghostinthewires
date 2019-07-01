<?php if($next_question !== -1) {
    $value = isset($question_params['answers']) && $question_params['answers'] != '' ? $question_params['answers'] : '';
?>
<form action='' method='post' class="edgt-lms-question-next-form">
    <input type='hidden' name='edgt_lms_questions' value='<?php echo esc_attr($questions); ?>' />
    <input type='hidden' name='edgt_lms_question_id' value='<?php echo esc_attr($question_id); ?>' />
    <input type='hidden' name='edgt_lms_course_id' value='<?php echo esc_attr($course_id); ?>' />
    <input type='hidden' name='edgt_lms_quiz_id' value='<?php echo esc_attr($quiz_id); ?>' />
    <input type='hidden' name='edgt_lms_change_question' value='<?php echo esc_attr($next_question); ?>' />
    <input type='hidden' name='edgt_lms_question_answer' value='<?php echo esc_attr($value); ?>' />
    <div class="edgt-question-actions">
        <?php
        echo educator_edge_get_button_html(
            array(
                'custom_class' => 'edgt-next-question',
                'html_type' => 'input',
                'input_name' => 'submit',
                'size' => 'small',
                'text' => esc_html__('Next >', 'edge-lms')
            )
        );
        ?>
    </div>
</form>
<?php } ?>