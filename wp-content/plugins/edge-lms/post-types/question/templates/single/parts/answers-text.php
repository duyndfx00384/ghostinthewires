<?php
$value = isset($question_params['answers']) && $question_params['answers'] != '' ? $question_params['answers'] : '';
?>
<div class="edgt-question-answers">
    <div class="edgt-answer-wrapper edgt-answer-text">
        <input type="text" title="question_answer" name="question_answer" value="<?php echo esc_attr($value); ?>"/>
    </div>
</div>
