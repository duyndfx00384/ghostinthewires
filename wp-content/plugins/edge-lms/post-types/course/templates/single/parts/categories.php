<?php
$categories   = wp_get_post_terms(get_the_ID(), 'course-category');
if(is_array($categories) && count($categories)) :
?>
<div class="edgt-grid-col-6 edgt-course-info-wrapper">
    <div class="edgt-course-categories">
        <div class="edgt-course-categories-wrapper">
            <div class="edgt-course-category-label">
                <?php esc_html_e('Categories:', 'edge-lms') ?>
            </div>
            <div class="edgt-course-category-items">
                <?php foreach($categories as $cat) { ?>
                    <a itemprop="url" class="edgt-course-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php endif;