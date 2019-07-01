<?php do_action('educator_edge_before_page_header'); ?>

<header class="edgt-page-header">
	<?php do_action('educator_edge_after_page_header_html_open'); ?>
	
	<?php if($show_fixed_wrapper) : ?>
		<div class="edgt-fixed-wrapper">
	<?php endif; ?>
			
	<div class="edgt-menu-area">
		<?php do_action('educator_edge_after_header_menu_area_html_open'); ?>
		
		<?php if($menu_area_in_grid) : ?>
			<div class="edgt-grid">
		<?php endif; ?>
				
			<div class="edgt-vertical-align-containers">
				<div class="edgt-position-left">
					<div class="edgt-position-left-inner">
						<?php if(!$hide_logo) {
							educator_edge_get_logo();
						} ?>
					</div>
				</div>
				<div class="edgt-position-right">
					<div class="edgt-position-right-inner">
						<a href="javascript:void(0)" class="edgt-fullscreen-menu-opener">
							<span class="edgt-opener fa fa-bars"></span>
                            <span class="edgt-closer fa fa-times"></span>
						</a>
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
		educator_edge_get_sticky_header('minimal', 'header/types/header-minimal');
	} ?>
	
	<?php do_action('educator_edge_before_page_header_html_close'); ?>
</header>

<?php educator_edge_get_mobile_header('minimal', 'header/types/header-minimal'); ?>