<article class="edgt-pl-item <?php echo esc_attr($this_object->getArticleClasses($params)); ?>">
	<div class="edgt-pl-item-inner">
		<?php echo edgt_core_get_cpt_shortcode_module_template_part('portfolio', 'layout-collections/'.$item_style, '', $params); ?>
		
		<a itemprop="url" class="edgt-pli-link edgt-block-drag-link" href="<?php echo esc_url($this_object->getItemLink()); ?>" target="<?php echo esc_attr($this_object->getItemLinkTarget()); ?>"></a>
	</div>
</article>