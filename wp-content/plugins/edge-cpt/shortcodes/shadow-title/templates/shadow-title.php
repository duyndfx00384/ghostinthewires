<div class="edgt-shadow-title-holder <?php echo esc_attr($holder_classes); ?>" <?php echo educator_edge_get_inline_style($holder_styles); ?>>
	<div class="edgt-st-inner">
		<?php if(!empty($title)) { ?>
			<span class="edgt-st-title" <?php echo educator_edge_get_inline_style($title_styles); ?>>
				<?php echo wp_kses($title, array('br' => true, 'span' => array('class' => true))); ?>
			</span>
		<?php } ?>
	</div>
</div>