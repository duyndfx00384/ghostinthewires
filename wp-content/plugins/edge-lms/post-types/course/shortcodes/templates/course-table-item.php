<tr class="edgt-ct-item">
    <td class="edgt-tc-course-field">
        <a href="<?php echo get_the_permalink(); ?>" class="edgt-cli-title-holder"><?php echo esc_attr(get_the_title()); ?></a>
        <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/price', '', $params); ?>
    </td>
    <?php if($enable_category == 'yes') { ?>
    <td class="edgt-tc-category-field">
        <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/category', '', $params); ?>
    </td>
    <?php } ?>
    <?php if($enable_instructor == 'yes') { ?>
    <td class="edgt-tc-instructor-field">
        <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/instructor', '', $params); ?>
    </td>
    <?php } ?>
    <?php if($enable_students == 'yes') { ?>
    <td class="edgt-tc-students-field">
        <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/students', '', $params); ?>
    </td>
    <?php } ?>
    <?php if($enable_price == 'yes') { ?>
    <td class="edgt-tc-price-field">
        <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/price', '', $params); ?>
    </td>
    <?php } ?>
    <td class="edgt-tc-button-field">
        <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/button', '', $params); ?>
    </td>
</tr>