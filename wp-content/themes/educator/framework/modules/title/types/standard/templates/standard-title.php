<?php do_action('educator_edge_before_page_title'); ?>

<div class="edgt-title-holder <?php echo esc_attr($holder_classes); ?>" <?php educator_edge_inline_style($holder_styles); ?> <?php echo educator_edge_get_inline_attrs($holder_data); ?>>
	<?php if(!empty($title_image)) { ?>
		<div class="edgt-title-image">
			<img itemprop="image" src="<?php echo esc_url($title_image['src']); ?>" alt="<?php echo esc_html($title_image['alt']); ?>" />
		</div>
	<?php } ?>
	<div class="edgt-title-wrapper" <?php educator_edge_inline_style($wrapper_styles); ?>>
		<div class="edgt-title-inner">
			<div class="edgt-grid">
				<?php if(!empty($title)) { ?>
					<<?php echo esc_attr($title_tag); ?> class="edgt-page-title entry-title" <?php educator_edge_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
				<?php } ?>
				<?php if($subtitle){ ?>
					<p class="edgt-page-subtitle" <?php educator_edge_inline_style($subtitle_styles); ?>><?php echo esc_html($subtitle); ?></p>
				<?php } ?>
			</div>
	    </div>
	</div>
</div>

<?php do_action('educator_edge_after_page_title'); ?>
