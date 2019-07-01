<?php
    if(edgt_lms_user_has_course()) {
        $user_current_course_status = edgt_lms_user_current_course_status();
        if ($user_current_course_status == 'completed') {
            $button_text = esc_html__('Retake', 'edge-lms');
        } else if ($user_current_course_status == 'in-progress') {
            $button_text = esc_html__('Resume', 'edge-lms');
        } else {
            $button_text = esc_html__('Start ', 'edge-lms');
        }
    } else {
        $button_text = esc_html__('Enroll', 'edge-lms');
    }
?>
<?php if(edgt_lms_core_plugin_installed()) {
    ?>
    <?php echo educator_edge_get_button_html(array(
        'text'			=> $button_text,
        'link'			=> get_the_permalink(),
        'size'          => 'small',
        'type'          => 'solid',
    )); ?>
<?php } else { ?>
    <a href="<?php echo get_the_permalink(); ?>" class="edgt-btn edgt-btn-small edgt-btn-solid"><?php echo esc_html($button_text); ?></a>
<?php } ?>