<?php if($enable_image == 'yes') { ?>
    <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/image', $item_layout, $params); ?>
<?php } ?>

<div class="edgt-cli-text-holder">
    <div class="edgt-cli-text-wrapper">
        <div class="edgt-cli-text">
            <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/title', $item_layout, $params); ?>
            <?php if($enable_instructor == 'yes') { ?>
                <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/instructor-simple', $item_layout, $params); ?>
            <?php } ?>
            <?php if($enable_price == 'yes') { ?>
                <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/price', $item_layout, $params); ?>
            <?php } ?>
        </div>
    </div>
</div>