<?php
$instructor = get_post_meta(get_the_ID(), 'edgt_course_instructor_meta', true);
?>
<a itemprop="url" href="<?php echo get_permalink($instructor); ?>" target="_self">
    <span class="edgt-instructor-name">
       <?php echo get_the_title($instructor); ?>
    </span>
</a>
