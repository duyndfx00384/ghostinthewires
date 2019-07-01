<?php
/*
Template Name: Coming Soon Page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
	    <?php
	    /**
	     * educator_edge_header_meta hook
	     *
	     * @see educator_edge_header_meta() - hooked with 10
	     * @see educator_edge_user_scalable_meta() - hooked with 10
	     */
	    do_action('educator_edge_header_meta');

	    wp_head(); ?>
    </head>
	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
		<?php
		/**
		 * educator_edge_after_body_tag hook
		 *
		 * @see educator_edge_get_side_area() - hooked with 10
		 * @see educator_edge_smooth_page_transitions() - hooked with 10
		 */
		do_action('educator_edge_after_body_tag'); ?>

		<div class="edgt-wrapper">
			<div class="edgt-wrapper-inner">
				<div class="edgt-content">
		            <div class="edgt-content-inner">
						<div class="edgt-full-width">
							<div class="edgt-full-width-inner">
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									<?php the_content(); ?>
								<?php endwhile; endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>