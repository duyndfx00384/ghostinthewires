<div class="edgt-info-card">
    <div class="edgt-info-card-inner">
        <?php if(!empty($image)) { ?>
            <div class="edgt-ic-image-holder">
                <?php echo wp_get_attachment_image($image,'full');?>
            </div>
        <?php } ?>
        <div class="edgt-ic-text-holder">
            <<?php echo esc_html($title_tag); ?> class="edgt-ic-title">
                <?php echo esc_html($title) ?>
            </<?php echo esc_html($title_tag); ?>>
            <div class="edgt-ic-description">
                <?php echo esc_html($description) ?>
            </div>
            <?php if($additional_tag !== '') { ?>
                <div class="edgt-ic-tag">
                    <?php echo esc_html($additional_tag) ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>