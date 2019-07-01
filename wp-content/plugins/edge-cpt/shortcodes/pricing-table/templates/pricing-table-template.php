<div class="edgt-price-table <?php echo esc_attr($holder_classes); ?>">
	<div class="edgt-pt-inner" <?php echo educator_edge_get_inline_style($holder_styles); ?>>
		<?php if ($active == 'yes') { ?>
			<div class="edgt-active-pt-label">
				<div class="edgt-active-pt-label-inner">
				</div>
			</div>
		<?php } ?>
		<ul>
			<li class="edgt-pt-title-holder">
				<h3 class="edgt-pt-title" <?php echo educator_edge_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></h3>
			</li>
			<li class="edgt-pt-prices">
				<h2 class="edgt-pt-value" <?php echo educator_edge_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></h2>
				<h2 class="edgt-pt-price" <?php echo educator_edge_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></h2>
			</li>
			<li class="edgt-pt-content">
				<?php echo do_shortcode($content); ?>
			</li>
			<?php 
			if(!empty($button_text)) { ?>
				<li class="edgt-pt-button">
					<?php echo educator_edge_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'type' => $button_type,
                        'size' => 'medium'
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>