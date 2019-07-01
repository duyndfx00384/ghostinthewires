<?php
get_header();
educator_edge_get_title(); ?>
<div class="edgt-container edgt-default-page-template">
	<?php do_action('educator_edge_after_container_open'); ?>
	<div class="edgt-container-inner clearfix">
		<?php
			$edgt_taxonomy_id = get_queried_object_id();
			$edgt_taxonomy = !empty($edgt_taxonomy_id) ? get_category($edgt_taxonomy_id) : '';
			$edgt_taxonomy_slug = !empty($edgt_taxonomy) ? $edgt_taxonomy->slug : '';
		
			edgt_lms_get_instructor_category_list($edgt_taxonomy_slug);
		?>
	</div>
	<?php do_action('educator_edge_before_container_close'); ?>
</div>
<?php get_footer(); ?>
