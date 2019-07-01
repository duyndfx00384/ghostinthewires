<?php
$media = edgt_core_get_portfolio_single_media();

?>

<article class="edgt-pl-item <?php echo esc_attr($this_object->getArticleClasses($params)); ?>">
    <div class="edgt-pl-item-inner">
        <?php echo edgt_core_get_cpt_shortcode_module_template_part('portfolio', 'layout-collections/'.$item_style, '', $params); ?>

        <?php if(is_array($media) && count($media) > 0) : ?>
            <?php echo edgt_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/image-gallery', '', $params); ?>
        <?php endif; ?>

    </div>
</article>