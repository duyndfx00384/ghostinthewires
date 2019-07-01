<?php do_action('educator_edge_before_mobile_header'); ?>

	<header class="edgt-mobile-header">
		<div class="edgt-mobile-header-inner">
			<?php do_action('educator_edge_after_mobile_header_html_open'); ?>
			<div class="edgt-mobile-header-holder">
				<div class="edgt-grid">
					<div class="edgt-vertical-align-containers">
						<div class="edgt-position-left">
							<div class="edgt-position-left-inner">
								<?php educator_edge_get_mobile_logo(); ?>
							</div>
						</div>
						<div class="edgt-position-right">
							<div class="edgt-position-right-inner">
								<?php if($show_navigation_opener) : ?>
									<div class="edgt-mobile-menu-opener">
										<a href="javascript:void(0)">
											<span class="edgt-mobile-menu-icon">
												<?php echo educator_edge_icon_collections()->renderIcon('icon_menu', 'font_elegant'); ?>
											</span>
											<?php if(!empty($mobile_menu_title)) { ?>
												<h5 class="edgt-mobile-menu-text"><?php echo esc_attr($mobile_menu_title); ?></h5>
											<?php } ?>
										</a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="edgt-mobile-side-area">
			<div class="edgt-close-mobile-side-area-holder">
				<span aria-hidden="true" class="icon_close"></span>
			</div>
			<div class="edgt-mobile-side-area-inner">
				<?php educator_edge_get_mobile_nav(); ?>
			</div>
			<?php if(is_active_sidebar('edgt-mobile-menu-bottom')) {
				dynamic_sidebar('edgt-mobile-menu-bottom');
			} ?>
		</div>
		<?php do_action('educator_edge_before_mobile_header_html_close'); ?>
	</header>

<?php do_action('educator_edge_after_mobile_header'); ?>