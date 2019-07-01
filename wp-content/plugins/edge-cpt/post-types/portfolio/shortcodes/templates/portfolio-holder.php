<div class="edgt-portfolio-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php echo edgt_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/filter', '', $params); ?>
	
	<div class="edgt-pl-inner <?php echo esc_attr($holder_inner_classes); ?> clearfix">
		<?php
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					echo edgt_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-item', $item_type, $params);
				endwhile;
			else:
				echo edgt_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/posts-not-found');
			endif;
		
			wp_reset_postdata();
		?>
	</div>
	
	<?php echo edgt_core_get_cpt_shortcode_module_template_part('portfolio', 'pagination/'.$pagination_type, '', $params, $additional_params); ?>
</div>