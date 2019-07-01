<div class="edgt-grid-row <?php echo esc_attr($holder_classes); ?>">
	<div <?php echo educator_edge_get_content_sidebar_class(); ?>>
		<div class="edgt-blog-holder edgt-blog-single <?php echo esc_attr($blog_single_classes); ?>">
			<?php educator_edge_get_blog_single_type($blog_single_type); ?>
		</div>
	</div>
	<?php if($sidebar_layout !== 'no-sidebar') { ?>
		<div <?php echo educator_edge_get_sidebar_holder_class(); ?>>
			<?php get_sidebar(); ?>
		</div>
	<?php } ?>
</div>