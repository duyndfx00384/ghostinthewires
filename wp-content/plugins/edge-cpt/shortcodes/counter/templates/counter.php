<div class="edgt-counter-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="edgt-counter-inner">
		<div class="edgt-counter-icon">
			<?php echo edgt_core_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
		</div>
		<?php if(!empty($digit)) { ?>
			<h1 class="edgt-counter <?php echo esc_attr($type) ?>" <?php echo educator_edge_get_inline_style($counter_styles); ?>><?php echo esc_html($digit); ?></h1>
		<?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="edgt-counter-title" <?php echo educator_edge_get_inline_style($counter_title_styles); ?>>
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="edgt-counter-text" <?php echo educator_edge_get_inline_style($counter_text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>