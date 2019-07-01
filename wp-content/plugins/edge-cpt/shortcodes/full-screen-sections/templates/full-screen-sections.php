<div class="edgt-full-screen-sections <?php echo esc_attr($holder_classes); ?>" <?php echo educator_edge_get_inline_attrs($holder_data); ?>>
	<div class="edgt-fss-wrapper">
		<?php echo do_shortcode($content); ?>
	</div>
	<?php if($enable_navigation === 'yes') { ?>
		<div class="edgt-fss-nav-holder">
			<a id="edgt-fss-nav-up" href="#" target="_self"><span class='icon-arrows-up'></span></a>
			<a id="edgt-fss-nav-down" href="#" target="_self"><span class='icon-arrows-down'></span></a>
		</div>
	<?php } ?>
</div>