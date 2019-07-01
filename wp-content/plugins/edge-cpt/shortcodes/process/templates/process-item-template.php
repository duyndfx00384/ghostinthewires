<div <?php educator_edge_class_attribute($item_classes); ?>>
    <div class="edgt-pi-holder-inner">
        <?php if(!empty($image)) : ?>
            <div class="edgt-pi-image-holder">
                <?php echo wp_get_attachment_image($image, 'full'); ?>
            </div>
        <?php endif; ?>
        <div class="edgt-pi-content-holder">
            <?php if(!empty($title)) : ?>
                <div class="edgt-pi-title-holder">
                    <h3 class="edgt-pi-title"><?php echo esc_html($title); ?></h3>
                </div>
            <?php endif; ?>

            <?php if(!empty($text)) : ?>
                <div class="edgt-pi-text-holder">
                    <p><?php echo esc_html($text); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>