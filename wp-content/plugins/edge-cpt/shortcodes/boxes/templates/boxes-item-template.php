<div class="edgt-boxes-item <?php echo esc_attr($boxes_item_class); ?>" <?php echo educator_edge_get_inline_style($boxes_item_style); ?>>
    <?php if(!empty($item_link)) : ?>
        <a itemprop="url" class="edgt-boxes-item-link" href="<?php echo esc_url($item_link); ?>" target="<?php echo esc_attr($item_target); ?>"></a>
    <?php endif; ?>
    <div class="edgt-boxes-item-inner">
        <div class="edgt-boxes-item-content <?php echo esc_attr($boxes_item_content_class); ?>" <?php echo educator_edge_get_inline_style($boxes_item_content_style); ?>>
            <?php echo do_shortcode($content); ?>
        </div>
        <?php if(!empty($item_link)) : ?>
            <div class="edgt-boxes-item-content-overlay"></div>
        <?php endif; ?>
    </div>
</div>