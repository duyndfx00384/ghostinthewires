<div <?php educator_edge_class_attribute( $holder_class ); ?> >
    <div class="edgt-linked-images-list-inner clearfix">
        <?php if(!empty($category_items)) { ?>
            <?php foreach($category_items as $category_item):?>
                <div class="edgt-linked-images-item">
                    <div class="edgt-linked-images-item-inner">
                        <?php if(isset($category_item['image'])) { ?>
                            <div class="edgt-linked-images-item-image">
                                <?php echo wp_get_attachment_image($category_item['image'], 'full'); ?>
                            </div>
                            <div class="edgt-linked-images-item-title">
                                <h5 class="edgt-corse-category-title-text">  <?php echo esc_html($category_item['title']);?></h5>

                            </div>
                            <a class="edgt-linked-images-item-link" itemprop="url" target="<?php echo esc_attr($target); ?>" href="<?php echo esc_url($category_item['link']) ?>"></a>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php }?>
    </div>
</div>