<?php
do_action('educator_edge_before_slider_action');

$edgt_slider_shortcode = get_post_meta(educator_edge_get_page_id(), 'edgt_page_slider_meta', true);
if (!empty($edgt_slider_shortcode)) { ?>
	<div class="edgt-slider">
		<div class="edgt-slider-inner">
			<?php echo do_shortcode(wp_kses_post($edgt_slider_shortcode)); // XSS OK ?>
		</div>
	</div>
<?php }

do_action('educator_edge_after_slider_action');
?>