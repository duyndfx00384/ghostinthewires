<div class="edgt-showcase-item-holder">
	<div class="edgt-showcase-icon">
		<?php echo educator_edge_execute_shortcode('edgt_icon', $icon_params); ?>
	</div>
	<div class="edgt-showcase-content">
		<div class="edgt-showcase-content-table">
			<div class="edgt-showcase-content-cell">
				<?php if ($title !== '') { ?>
					<<?php echo esc_attr($title_tag);?> class='edgt-showcase-title'><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag);?>>
				<?php } ?>
				<?php if ($content !== '') { ?>
					<div class="edgt-showcase-content-inner">
						<?php echo wp_kses_post($content); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>