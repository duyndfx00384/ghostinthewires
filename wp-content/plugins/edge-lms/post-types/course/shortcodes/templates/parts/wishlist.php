<?php
$icon = edgt_lms_is_course_in_wishlist() ? 'fa fa-heart' : 'fa fa-heart-o';
?>
<a href="javascript:void(0)" class="edgt-course-wishlist edgt-icon-only" data-course-id="<?php echo esc_attr(get_the_ID()); ?>">
    <i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
</a>