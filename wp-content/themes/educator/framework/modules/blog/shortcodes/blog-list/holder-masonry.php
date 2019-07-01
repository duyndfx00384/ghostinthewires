<div class="edgt-blog-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<div class="edgt-bl-wrapper">
		<ul class="edgt-blog-list">
			<div class="edgt-bl-grid-sizer"></div>
			<div class="edgt-bl-grid-gutter"></div>
			<?php
	            if($query_result->have_posts()):
	                while ($query_result->have_posts()) : $query_result->the_post();
	                    educator_edge_get_module_template_part('shortcodes/blog-list/layout-collections/post', 'blog', $type, $params);
	                endwhile;
	            else:
	                educator_edge_get_module_template_part('templates/parts/no-posts', 'blog', '', $params);
	            endif;
			
                wp_reset_postdata();
			?>
		</ul>
	</div>
	<?php educator_edge_get_module_template_part('templates/parts/pagination/'.$params['pagination_type'], 'blog', '', $params); ?>
</div>