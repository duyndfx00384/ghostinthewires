<?php
    $term = get_term_by('slug', $category, 'course-category');
    $term_count = $term->count;
?>

<div class="edgt-cc-holder <?php echo esc_html($holder_classes) ?>">
    <a href='<?php echo get_term_link($category, 'course-category') ?>' >
        <div class="edgt-cc-image">
            <?php echo wp_get_attachment_image($category_image, 'full'); ?>
        </div>
        <div class="edgt-cc-text-wrapper">
            <div class="edgt-cc-text-holder">
                <div class="edgt-cc-text">
                    <<?php echo esc_html($title_tag);?> class="edgt-cc-category-title"> <?php echo esc_html($category);?> </<?php echo esc_html($title_tag);?>>
                    <div class="edgt-cc-number"> <?php echo esc_html($term_count) . esc_html__(' courses', 'edge-lms')?> </div>
                </div>
            </div>
        </div>
    </a>
</div>