<div class="edgt-footer-bottom-holder <?php echo esc_attr($footer_bottom_transparency_class).' '. esc_attr($footer_bottom_skin);; ?>">
	<div class="edgt-footer-bottom-inner <?php echo esc_attr($footer_bottom_grid_class); ?>">
		<div class="edgt-grid-row <?php echo esc_attr($footer_bottom_classes); ?>">
			<?php for($i = 1; $i <= $footer_bottom_columns; $i++) { ?>
				<div class="edgt-grid-col-<?php echo esc_attr(12 / $footer_bottom_columns); ?>">
					<?php
					if(is_active_sidebar('footer_bottom_column_'.$i)) {
						dynamic_sidebar('footer_bottom_column_'.$i);
					}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>