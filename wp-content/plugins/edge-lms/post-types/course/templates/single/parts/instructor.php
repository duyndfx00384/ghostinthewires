<?php if (isset($instructor) & !empty($instructor)) { ?>
<div class="edgt-grid-col-6 edgt-course-info-wrapper">
    <div class="edgt-course-instructor">
        <div class="edgt-instructor-image">
            <?php echo get_the_post_thumbnail($instructor, array(55,55)); ?>
        </div>
        <div class="edgt-instructor-info">
            <span class="edgt-instructor-label">
                <?php esc_html_e('Instructor:', 'edge-lms') ?>
            </span>
            <a itemprop="url" href="<?php echo get_permalink($instructor); ?>" target="_self">
                <span class="edgt-instructor-name">
                    <?php echo get_the_title($instructor); ?>
                </span>
            </a>
        </div>
    </div>
</div>
<?php } ?>