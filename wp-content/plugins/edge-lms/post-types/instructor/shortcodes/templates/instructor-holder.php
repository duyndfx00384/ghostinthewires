<div class="edgt-instructor-list-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="edgt-tl-inner <?php echo esc_attr($inner_classes); ?>" <?php echo educator_edge_get_inline_attrs($data_attrs); ?>>
		<?php
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					$params['instructor_id'] = get_the_ID();
					$params['image'] = get_the_post_thumbnail($params['instructor_id']);
					$params['title'] = get_the_title($params['instructor_id']);
					$params['position'] = get_post_meta($params['instructor_id'], 'edgt_instructor_title', true);
					$params['email'] = get_post_meta($params['instructor_id'], 'edgt_instructor_email', true);
					$params['social'] = get_post_meta($params['instructor_id'], 'edgt_instructor_social', true);
					$params['resume'] = get_post_meta($params['instructor_id'], 'edgt_instructor_resume', true);
					$params['excerpt'] = get_the_excerpt($params['instructor_id']);
					$params['background'] = $background;
					$params['instructor_social_icons'] = $this_object->getInstructorSocialIcons($params['instructor_id']);
					echo edgt_lms_get_cpt_shortcode_module_template_part('instructor', 'instructor-template', $instructor_layout, $params);
				endwhile;
			else:
				echo esc_html_e( 'Sorry, no posts matched your criteria.', 'edge-lms' );
			endif;
		
			wp_reset_postdata();
		?>
	</div>
</div>