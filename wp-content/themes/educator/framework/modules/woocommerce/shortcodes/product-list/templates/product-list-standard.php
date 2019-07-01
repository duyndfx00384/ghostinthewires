<div class="edgt-pl-holder <?php echo esc_attr($holder_classes) ?>">
	<div class="edgt-pl-outer">
		<?php if($query_result->have_posts()): while ($query_result->have_posts()) : $query_result->the_post();
			echo educator_edge_get_woo_shortcode_module_template_part('templates/parts/info-below-image', 'product-list', '', $params);
		endwhile; else:
			educator_edge_get_module_template_part('templates/parts/no-posts', 'woocommerce', '', $params);
		endif;
			wp_reset_postdata();
		?>
	</div>
</div>