<div class="edgt-quiz-info-top">
    <div class="edgt-quiz-questions-number">
        <i class="icon_folder-alt" aria-hidden="true"></i>
        <span class="edgt-question-number-completed"><?php echo esc_html($question_position); ?></span> /
        <span class="edgt-question-number-total"><?php echo esc_html($questions_number); ?></span>
    </div>
    <?php if($time_remaining != "") { ?>
    <div class="edgt-quiz-duration">
        <i class=" icon_clock_alt" aria-hidden="true"></i>
        <span class="edgt-duration-value" id="edgt-quiz-timer" data-duration="<?php echo esc_attr($time_remaining) ?>"><?php echo esc_html($time_remaining_formatted); ?></span>
        <span class="edgt-duration-parameter"><?php esc_html_e('(mm:ss)', 'edge-lms'); ?></span>
    </div>
    <input type='hidden' name='edgt_lms_time_remaining' value='' />
    <?php } ?>
</div>