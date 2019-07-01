<?php
$page_id = educator_edge_get_page_id();
?>

<div class="edgt-footer-top-holder <?php echo esc_attr($footer_top_transparency_class) .' '. esc_attr($footer_top_skin); ?>">
	<div class="edgt-footer-top-inner <?php echo esc_attr($footer_top_grid_class); ?>">
		<div class="edgt-grid-row <?php echo esc_attr($footer_top_classes); ?>">
			<?php for($i = 1; $i <= $footer_top_columns; $i++) { ?>
				<div class="edgt-column-content edgt-grid-col-<?php echo esc_attr(12 / $footer_top_columns); ?>">
					<?php
						if(is_active_sidebar('footer_top_column_'.$i)) {
							$custom_area = get_post_meta($page_id, 'edgt_footer_top_meta_' . $i, true);
							$widget_area = $custom_area !== '' && $use_custom_widgets == 'yes' ? $custom_area : 'footer_top_column_' . $i;
							dynamic_sidebar($widget_area);
						}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>