<?php do_action('educator_edge_before_page_header'); ?>

<header class="edgt-page-header">
	<?php do_action('educator_edge_after_page_header_html_open'); ?>
	
	<?php if($show_fixed_wrapper) : ?>
		<div class="edgt-fixed-wrapper">
	<?php endif; ?>
			
	<div class="edgt-menu-area <?php echo esc_attr($menu_area_position_class); ?>">
		<?php do_action('educator_edge_after_header_menu_area_html_open') ?>
		
		<?php if($menu_area_in_grid) : ?>
			<div class="edgt-grid">
		<?php endif; ?>
				
			<div class="edgt-vertical-align-containers">
				<div class="edgt-position-left">
					<div class="edgt-position-left-inner">
						<?php if(!$hide_logo) {
							educator_edge_get_logo();
						} ?>
						<?php if($menu_area_position === 'left') : ?>
							<?php educator_edge_get_main_menu(); ?>
						<?php endif; ?>
					</div>
				</div>
				<?php if($menu_area_position === 'center') : ?>
					<div class="edgt-position-center">
						<div class="edgt-position-center-inner">
							<?php educator_edge_get_main_menu(); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="edgt-position-right">
					<div class="edgt-position-right-inner">
						<?php if($menu_area_position === 'right') : ?>
							<?php educator_edge_get_main_menu(); ?>
						<?php endif; ?>
						<?php educator_edge_get_header_widget_menu_area(); ?>
					</div>
				</div>
			</div>
			
		<?php if($menu_area_in_grid) : ?>
			</div>
		<?php endif; ?>
	</div>
			
	<?php if($show_fixed_wrapper) { ?>
		</div>
	<?php } ?>
	
	<?php if($show_sticky) {
		educator_edge_get_sticky_header();
	} ?>
	
	<?php do_action('educator_edge_before_page_header_html_close'); ?>
</header>

<?php do_action('educator_edge_after_page_header'); ?>