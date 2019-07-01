<?php

if ( ! function_exists( 'educator_edge_register_search_post_type_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function educator_edge_register_search_post_type_widget( $widgets ) {
		$widgets[] = 'EducatorEdgeSearchPostType';
		
		return $widgets;
	}
	
	add_filter( 'educator_edge_register_widgets', 'educator_edge_register_search_post_type_widget' );
}

if ( ! function_exists( 'educator_edge_search_post_types' ) ) {
	function educator_edge_search_post_types() {
		$user_id = get_current_user_id();
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			edgt_lms_ajax_status( 'error', esc_html__( 'All fields are empty', 'educator' ) );
		} else {
			$args = array(
				'post_type'      => $_POST['postType'],
				'post_status'    => 'publish',
				'order'          => 'DESC',
				'orderby'        => 'date',
				's'              => $_POST['term'],
				'posts_per_page' => 5
			);
			
			$html  = '';
			$query = new WP_Query( $args );
			
			if ( $query->have_posts() ) {
				$html .= '<ul>';
				while ( $query->have_posts() ) {
					$query->the_post();
					$html .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
				}
				$html              .= '</ul>';
				$json_data['html'] = $html;
				edgt_lms_ajax_status( 'success', '', $json_data );
			} else {
				$html              .= '<ul>';
				$html              .= '<li>' . esc_html__( 'No posts found.', 'educator' ) . '</li>';
				$html              .= '</ul>';
				$json_data['html'] = $html;
				edgt_lms_ajax_status( 'success', '', $json_data );
			}
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_educator_edge_search_post_types', 'educator_edge_search_post_types' );
}