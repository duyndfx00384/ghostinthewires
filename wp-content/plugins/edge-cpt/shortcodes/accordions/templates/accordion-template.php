<<?php echo esc_attr($title_tag); ?> class="edgt-accordion-title">
    <span class="edgt-accordion-mark">
		<span class="edgt_icon_plus arrow_carrot-right"></span>
		<span class="edgt_icon_minus arrow_carrot-down"></span>
	</span>
	<span class="edgt-tab-title"><?php echo esc_html($title); ?></span>
</<?php echo esc_attr($title_tag); ?>>
<div class="edgt-accordion-content">
	<div class="edgt-accordion-content-inner">
		<?php echo do_shortcode($content); ?>
	</div>
</div>