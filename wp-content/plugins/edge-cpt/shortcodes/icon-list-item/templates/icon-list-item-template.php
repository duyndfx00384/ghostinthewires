<?php $icon_html = educator_edge_icon_collections()->renderIcon($icon, $icon_pack, $params); ?>
<div class="edgt-icon-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo educator_edge_get_inline_style($holder_styles); ?>>
	<div class="edgt-il-icon-holder">
		<?php echo wp_kses_post($icon_html); ?>
	</div>
	<p class="edgt-il-text" <?php echo educator_edge_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></p>
</div>