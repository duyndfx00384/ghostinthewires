<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="edgt-search-cover" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="edgt-container">
		<div class="edgt-container-inner clearfix">
	<?php } ?>
			<div class="edgt-form-holder-outer">
				<div class="edgt-form-holder">
					<div class="edgt-form-holder-inner">
						<input type="text" placeholder="<?php esc_html_e( 'Search', 'educator' ); ?>" name="s" class="edgt_search_field" autocomplete="off" />
						<div class="edgt-search-close">
							<a href="#">
								<?php echo wp_kses( $search_icon_close, array(
									'span' => array(
										'aria-hidden' => true,
										'class'       => true
									),
									'i'    => array(
										'class' => true
									)
								) ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
	<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>