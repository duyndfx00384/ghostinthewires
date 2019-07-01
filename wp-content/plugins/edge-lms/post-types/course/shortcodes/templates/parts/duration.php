<?php if ($enable_duration === 'yes') {
    $duration_value = get_post_meta(get_the_ID(), 'edgt_course_duration_meta', true);
    $duration_unit = get_post_meta(get_the_ID(), 'edgt_course_duration_parameter_meta', true);

    if(!empty($duration_value && $duration_unit)) { ?>
        <div class="edgt-cli-duration-holder">
            <span class="edgt-duration-icon icon_clock_alt"></span>
            <span class="edgt-duration-period"><?php echo esc_html($duration_value . ' ' .$duration_unit) ?></span>
        </div>
    <?php } ?>
<?php } ?>