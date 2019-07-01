<?php if (!$first_attempt) { ?>
    <div class="edgt-quiz-results">
        <?php if(isset($post_message) && !empty($post_message)) { ?>
        <div class="edgt-results-message">
            <?php echo esc_html($post_message); ?>
        </div>
        <?php } ?>
        <div class="edgt-results-caption">
            <?php echo esc_html__('You have reached ', 'edge-lms') . $points .  esc_html__(' of ', 'edge-lms') . $points_t .  esc_html__(' points ', 'edge-lms') . '(' . $points_p . '%)'; ?>
        </div>
        <div class="edgt-results-values">
            <div class="edgt-results-correct"><?php echo esc_html__('Correct', 'edge-lms') . ' ' . $correct ?></div>
            <div class="edgt-results-wrong"><?php echo esc_html__('Wrong', 'edge-lms') . ' ' . $wrong ?></div>
            <div class="edgt-results-empty"><?php echo esc_html__('Empty', 'edge-lms') . ' ' . $empty ?></div>
            <div class="edgt-results-points"><?php echo esc_html__('Points', 'edge-lms') . ' ' . $points . '/' . $points_t ?></div>
            <div class="edgt-results-time"><?php echo esc_html__('Time', 'edge-lms') . ' ' . $time ?></div>
        </div>
    </div>
    <div class="edgt-quiz-message">
        <?php if($points_p < $required_p) { ?>
            <div class="edgt-message-error">
                <?php echo esc_html__('Your quiz grade - failed. Quiz requirement', 'edge-lms') . ' ' . esc_attr($required_p) . '%'; ?>
            </div>
        <?php } else { ?>
            <div class="edgt-message-error">
                <?php echo esc_html__('Your quiz grade - success.', 'edge-lms'); ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>
