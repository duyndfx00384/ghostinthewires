<?php
if($show_header_top) {
	do_action('educator_edge_before_header_top');
	?>
	
	<?php if($show_header_top_background_div){ ?>
		<div class="edgt-top-bar-background"></div>
	<?php } ?>
	
	<div class="edgt-top-bar">
		<?php do_action( 'educator_edge_after_header_top_html_open' ); ?>
		
		<?php if($top_bar_in_grid) : ?>
			<div class="edgt-grid">
		<?php endif; ?>
				
			<div class="edgt-vertical-align-containers">
				<div class="edgt-position-left">
					<div class="edgt-position-left-inner">
						<?php if(is_active_sidebar('edgt-top-bar-left')) : ?>
							<?php dynamic_sidebar('edgt-top-bar-left'); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="edgt-position-right">
					<div class="edgt-position-right-inner">
						<?php if(is_active_sidebar('edgt-top-bar-right')) : ?>
							<?php dynamic_sidebar('edgt-top-bar-right'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
				
		<?php if($top_bar_in_grid) : ?>
			</div>
		<?php endif; ?>
		
		<?php do_action( 'educator_edge_before_header_top_html_close' ); ?>
	</div>
	
	<?php do_action('educator_edge_after_header_top');
}