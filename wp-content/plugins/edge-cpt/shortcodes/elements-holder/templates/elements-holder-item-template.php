<div class="edgt-eh-item <?php echo esc_attr($holder_classes); ?>" <?php echo educator_edge_get_inline_style($holder_styles); ?> <?php echo educator_edge_get_inline_attrs($holder_data); ?>>
	<div class="edgt-eh-item-inner">
		<div class="edgt-eh-item-content <?php echo esc_attr($holder_rand_class); ?>" <?php echo educator_edge_get_inline_style($content_styles); ?>>
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
</div>