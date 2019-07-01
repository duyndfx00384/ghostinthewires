<div class="edgt-pie-chart-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="edgt-pc-percentage" <?php echo educator_edge_get_inline_attrs($pie_chart_data); ?>>
		<span class="edgt-pc-percent" <?php echo educator_edge_get_inline_style($percent_styles); ?>><?php echo esc_html($percent); ?></span>
	</div>
	<?php if(!empty($title) || !empty($text)) { ?>
		<div class="edgt-pc-text-holder">
			<?php if(!empty($title)) { ?>
				<<?php echo esc_attr($title_tag); ?> class="edgt-pc-title" <?php echo educator_edge_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
			<?php } ?>
			<?php if(!empty($text)) { ?>
				<p class="edgt-pc-text" <?php echo educator_edge_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
			<?php } ?>
		</div>
	<?php } ?>
</div>