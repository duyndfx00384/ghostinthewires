<?php
$students = get_post_meta(get_the_ID(), 'edgt_course_users_attended', true);
$students_number = count($students);
?>

<div class="edgt-students-number-holder">
    <span aria-hidden="true" class="lnr lnr-users edgt-student-icon"></span>
    <span>
    <?php echo esc_html($students_number); ?>
    </span>
</div>
