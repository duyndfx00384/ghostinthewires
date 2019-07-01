<div class="edgt-pli">
	<div class="edgt-pli-inner">
		<div class="edgt-pli-image">
			<?php educator_edge_get_module_template_part('templates/parts/image', 'woocommerce', '', $params); ?>
		</div>
		<div class="edgt-pli-text" <?php echo educator_edge_get_inline_style($shader_styles); ?>>
			<div class="edgt-pli-text-outer">
				<div class="edgt-pli-text-inner">
					<?php educator_edge_get_module_template_part('templates/parts/add-to-cart', 'woocommerce', '', $params); ?>
				</div>
			</div>
		</div>
		<a class="edgt-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
	<div class="edgt-pli-text-wrapper" <?php echo educator_edge_get_inline_style($text_wrapper_styles); ?>>
		<?php educator_edge_get_module_template_part('templates/parts/title', 'woocommerce', '', $params); ?>
		
		<?php educator_edge_get_module_template_part('templates/parts/category', 'woocommerce', '', $params); ?>
		
		<?php educator_edge_get_module_template_part('templates/parts/excerpt', 'woocommerce', '', $params); ?>
		
		<?php educator_edge_get_module_template_part('templates/parts/rating', 'woocommerce', '', $params); ?>
		
		<?php educator_edge_get_module_template_part('templates/parts/price', 'woocommerce', '', $params); ?>
	</div>
</div>