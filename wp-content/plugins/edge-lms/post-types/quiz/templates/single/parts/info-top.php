<div class="edgt-quiz-info-top">
    <div class="edgt-quiz-questions-number">
        <i class="icon_folder-alt" aria-hidden="true"></i>
        <span class="edgt-question-number"><?php echo esc_html($questions_number); ?></span>
        <span class="edgt-question-label"><?php echo esc_html($questions_label); ?></span>
    </div>
    <?php if($quiz_duration_value != "") { ?>
    <div class="edgt-quiz-duration">
        <i class=" icon_clock_alt" aria-hidden="true"></i>
        <span class="edgt-duration-value"><?php echo esc_html($quiz_duration_value); ?></span>
        <span class="edgt-duration-parameter"><?php echo esc_html($quiz_duration_parameter); ?></span>
    </div>
    <?php } ?>
</div>