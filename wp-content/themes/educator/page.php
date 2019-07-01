<?php
$edgt_sidebar_layout = educator_edge_sidebar_layout();

get_header();
educator_edge_get_title();
get_template_part('slider');
?>
<div class="edgt-container edgt-default-page-template">
	<?php do_action('educator_edge_after_container_open'); ?>
	<div class="edgt-container-inner clearfix">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="edgt-grid-row">
				<div <?php echo educator_edge_get_content_sidebar_class(); ?>>
					<?php
						the_content();
						do_action('educator_edge_page_after_content');
					?>
				</div>
				<?php if($edgt_sidebar_layout !== 'no-sidebar') { ?>
					<div <?php echo educator_edge_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
	<?php do_action('educator_edge_before_container_close'); ?>
</div>
<?php get_footer(); ?>