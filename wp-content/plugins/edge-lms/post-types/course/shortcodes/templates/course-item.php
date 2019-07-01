<article class="edgt-cl-item <?php echo esc_attr($this_object->getArticleClasses($params)); ?>" <?php echo esc_attr($this_object->getArticleData($params)); ?>>
	<div class="edgt-cl-item-inner">
		<?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'layout-collections/'.$item_layout, '', $params); ?>
		<a itemprop="url" class="edgt-cli-link edgt-block-drag-link" href="<?php echo get_permalink(); ?>" target="<?php echo esc_attr("_self"); ?>"></a>
	</div>
</article>