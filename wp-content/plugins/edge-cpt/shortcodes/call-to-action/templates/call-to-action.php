<div class="edgt-call-to-action-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="edgt-cta-inner <?php echo esc_attr($inner_classes); ?>">
		<div class="edgt-cta-text-holder">
			<div class="edgt-cta-text"><?php echo do_shortcode($content); ?></div>
		</div>
		<div class="edgt-cta-button-holder" <?php echo educator_edge_get_inline_style($button_holder_styles); ?>>
			<div class="edgt-cta-button"><?php echo educator_edge_get_button_html($button_parameters); ?></div>
		</div>
	</div>
</div>