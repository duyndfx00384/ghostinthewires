<div class="edgt-progress-bar rating <?php echo esc_attr($holder_classes); ?>">
	<<?php echo esc_attr($title_tag); ?> class="edgt-pb-title-holder" <?php echo educator_edge_inline_style($title_styles); ?>>
		<span class="edgt-pb-title"><?php echo esc_html($title); ?></span>
	</<?php echo esc_attr($title_tag); ?>>
	<div class="edgt-pb-content-holder" <?php echo educator_edge_inline_style($inactive_bar_style); ?>>
		<div data-percentage=<?php echo esc_attr($percent); ?> class="edgt-pb-content" <?php echo educator_edge_inline_style($active_bar_style); ?>></div>
	</div>
    <span class="edgt-pb-number-of-ratings"><?php echo esc_html($number_of_ratings) ?></span>
</div>