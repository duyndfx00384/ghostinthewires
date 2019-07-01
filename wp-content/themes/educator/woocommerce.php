<?php 
/*
Template Name: WooCommerce
*/ 
?>
<?php
$edgt_sidebar_layout  = educator_edge_sidebar_layout();

get_header();
educator_edge_get_title();
get_template_part('slider');

//Woocommerce content
if ( ! is_singular('product') ) { ?>
	<div class="edgt-container">
		<div class="edgt-container-inner clearfix">
			<div class="edgt-grid-row">
				<div <?php echo educator_edge_get_content_sidebar_class(); ?>>
					<?php educator_edge_woocommerce_content(); ?>
				</div>
				<?php if($edgt_sidebar_layout !== 'no-sidebar') { ?>
					<div <?php echo educator_edge_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>			
<?php } else { ?>
	<div class="edgt-container">
		<div class="edgt-container-inner clearfix">
			<?php educator_edge_woocommerce_content(); ?>
		</div>
	</div>
<?php } ?>
<?php get_footer(); ?>