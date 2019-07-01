<div class="edgt-tab-container" id="tab-<?php echo sanitize_title($tab_title); ?>">
    <?php if(isset($tab_content_title) && $tab_content_title != '') { ?>
        <<?php echo esc_attr($content_title_tag); ?> class="edgt-tab-title">
            <?php echo esc_html($tab_content_title); ?>
        </<?php echo esc_attr($content_title_tag); ?>>
    <?php } ?>
    <?php if(isset($tab_content_description) && $tab_content_description != '') { ?>
    <div class="edgt-tab-description">
        <?php echo esc_html($tab_content_description); ?>
    </div>
    <?php } ?>
    <div class="edgt-tab-content-holder">
        <div class="edgt-tab-content">
            <?php echo do_shortcode($content); ?>
        </div>
        <div class="edgt-tab-image">
            <?php echo wp_get_attachment_image($tab_image, 'full'); ?>
        </div>
    </div>
</div>