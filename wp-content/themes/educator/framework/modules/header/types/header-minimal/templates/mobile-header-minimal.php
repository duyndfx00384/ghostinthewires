<?php do_action('educator_edge_before_mobile_header'); ?>

<header class="edgt-mobile-header">
	<?php do_action('educator_edge_after_mobile_header_html_open'); ?>
	
	<div class="edgt-mobile-header-inner">
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
							<a href="javascript:void(0)" class="edgt-fullscreen-menu-opener">
                                <span class="edgt-opener fa fa-bars"></span>
                                <span class="edgt-closer fa fa-times"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php do_action('educator_edge_before_mobile_header_html_close'); ?>
</header>

<?php do_action('educator_edge_after_mobile_header'); ?>