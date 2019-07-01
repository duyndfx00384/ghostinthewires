<article class="<?php echo esc_attr($item_classes) ?>">
	<div class="edgt-mg-content">
		<?php if (has_post_thumbnail()) { ?>
			<div class="edgt-mg-image-overlay" <?php echo educator_edge_inline_style($image_overlay_styles);?>></div>
			<div class="edgt-mg-image">
				<?php the_post_thumbnail($image_size); ?>
			</div>
		<?php } ?>
		<div class="edgt-mg-item-outer">
			<div class="edgt-mg-item-inner">
				<div class="edgt-mg-item-content">
					<?php if(!empty($item_image)) { ?>
						<img itemprop="image" class="edgt-mg-item-icon" src="<?php echo esc_url($item_image['url'])?>" alt="<?php echo esc_attr($item_image['alt']); ?>" />
					<?php } ?>
					<?php if (!empty($item_subtitle)) { ?>
						<h4 class="edgt-mg-item-subtitle" <?php echo educator_edge_inline_style($item_subtitle_color);?>><?php echo esc_html($item_subtitle); ?></h4>
					<?php } ?>
					<?php if (!empty($item_title)) { ?>
						<<?php echo esc_attr($item_title_tag); ?> itemprop="name" class="edgt-mg-item-title entry-title"><?php echo esc_html($item_title); ?></<?php echo esc_attr($item_title_tag); ?>>
					<?php } ?>
					<?php if (!empty($item_text)) { ?>
						<p class="edgt-mg-item-text"><?php echo esc_html($item_text); ?></p>
					<?php } ?>
					<?php if (!empty($item_link)) { ?>
						<a itemprop="url" href="<?php echo esc_url($item_link); ?>" target="<?php echo esc_attr($item_link_target); ?>" class="edgt-mg-link-over"></a>
					<?php } ?>
					<?php if(!empty($item_button_label) && !empty($item_link)) : ?>
						<a itemprop="url" href="<?php echo esc_url($item_link); ?>" class="edgt-btn edgt-btn-solid edgt-btn-medium edgt-mg-item-button" target="<?php echo esc_attr($item_link_target); ?>">
							<?php print $button_icon_html; ?><span class="edgt-button-text"><?php echo esc_html($item_button_label); ?></span>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</article>
