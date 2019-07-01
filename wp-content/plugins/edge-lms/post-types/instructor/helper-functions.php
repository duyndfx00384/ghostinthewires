<?php

if(!function_exists('edgt_lms_instructor_meta_box_functions')) {
	function edgt_lms_instructor_meta_box_functions($post_types) {
		$post_types[] = 'instructor';
		
		return $post_types;
	}
	
	add_filter('educator_edge_meta_box_post_types_save', 'edgt_lms_instructor_meta_box_functions');
	add_filter('educator_edge_meta_box_post_types_remove', 'edgt_lms_instructor_meta_box_functions');
}

if(!function_exists('edgt_lms_instructor_scope_meta_box_functions')) {
	function edgt_lms_instructor_scope_meta_box_functions($post_types) {
		$post_types[] = 'instructor';
		
		return $post_types;
	}
	
	add_filter('educator_edge_set_scope_for_meta_boxes', 'edgt_lms_instructor_scope_meta_box_functions');
}

if(!function_exists('edgt_lms_instructor_enqueue_meta_box_styles')) {
	function edgt_lms_instructor_enqueue_meta_box_styles() {
		global $post;
		
		if($post->post_type == 'instructor'){
			wp_enqueue_style('edgt-jquery-ui', get_template_directory_uri().'/framework/admin/assets/css/jquery-ui/jquery-ui.css');
		}
	}
	
	add_action('educator_edge_enqueue_meta_box_styles', 'edgt_lms_instructor_enqueue_meta_box_styles');
}

if(!function_exists('edgt_lms_register_instructor_cpt')) {
	function edgt_lms_register_instructor_cpt($cpt_class_name) {
		$cpt_class = array(
			'EdgefLMS\CPT\Instructor\InstructorRegister'
		);
		
		$cpt_class_name = array_merge($cpt_class_name, $cpt_class);
		
		return $cpt_class_name;
	}
	
	add_filter('edgt_lms_filter_register_custom_post_types', 'edgt_lms_register_instructor_cpt');
}

if(!function_exists('edgt_lms_get_single_instructor')) {
	/**
	 * Loads holder template for doctor single
	 */
	function edgt_lms_get_single_instructor() {
		$instructor_id = get_the_ID();
		
		$params = array(
			'sidebar_layout' => educator_edge_sidebar_layout(),
			'title'          => get_post_meta($instructor_id, 'edgt_instructor_title', true),
			'vita'           => get_post_meta($instructor_id, 'edgt_instructor_vita', true),
			'address'        => get_post_meta($instructor_id, 'edgt_instructor_address', true),
            'phone_number'   => get_post_meta($instructor_id, 'edgt_instructor_phone_number', true),
			'email'          => get_post_meta($instructor_id, 'edgt_instructor_email', true),
			'resume'         => get_post_meta($instructor_id, 'edgt_instructor_resume', true),
			'social_icons'   => edgt_lms_single_instructor_social_icons($instructor_id),
			'courses'        => edgt_lms_single_instructor_courses($instructor_id),
		);
		
		edgt_lms_get_cpt_single_module_template_part('templates/single/holder', 'instructor', '', $params);
	}
}

if(!function_exists('edgt_lms_single_instructor_social_icons')) {
	function edgt_lms_single_instructor_social_icons($id){
		$social_icons = array();
		
		for ($i = 1; $i < 6; $i++) {
			$instructor_icon_pack = get_post_meta($id, 'edgt_instructor_social_icon_pack_' . $i, true);
			if($instructor_icon_pack !== '') {
				$instructor_icon_collection = educator_edge_icon_collections()->getIconCollection(get_post_meta($id, 'edgt_instructor_social_icon_pack_' . $i, true));
				$instructor_social_icon     = get_post_meta($id, 'edgt_instructor_social_icon_pack_' . $i . '_' . $instructor_icon_collection->param, true);
				$instructor_social_link     = get_post_meta($id, 'edgt_instructor_social_icon_' . $i . '_link', true);
				$instructor_social_target   = get_post_meta($id, 'edgt_instructor_social_icon_' . $i . '_target', true);
				
				if ($instructor_social_icon !== '') {
					$instructor_icon_params = array();
					$instructor_icon_params['icon_pack']                  = $instructor_icon_pack;
					$instructor_icon_params[$instructor_icon_collection->param] = $instructor_social_icon;
					$instructor_icon_params['link']                       = !empty($instructor_social_link) ? $instructor_social_link : '';
					$instructor_icon_params['target']                     = !empty($instructor_social_target) ? $instructor_social_target : '_self';
					
					$social_icons[] = educator_edge_execute_shortcode('edgt_icon', $instructor_icon_params);
				}
			}
		}
		
		return $social_icons;
	}
}

if ( ! function_exists( 'edgt_lms_single_instructor_tabs' ) ) {

    /**
     * Add instructor tabs to single instructor pages.
     *
     * @param array $tabs
     * @return array
     */
    function edgt_lms_single_instructor_tabs( $tabs = array() ) {

        // Curriculum tab - shows instructor curriculum
        $tabs['curriculum'] = array(
            'title'    => __( 'Biography', 'edge-lms' ),
            'icon'     => '<i class="lnr lnr-license" aria-hidden="true"></i>',
            'priority' => 20,
            'template' => 'content'
        );

		// Course tab - shows instructor courses
		$tabs['courses'] = array(
			'title'    => __( 'Courses', 'edge-lms' ),
			'icon'     => '<i class="lnr lnr-book" aria-hidden="true"></i>',
			'priority' => 10,
			'template' => 'courses'
		);

        return $tabs;
    }

    add_filter( 'educator_edge_single_instructor_tabs', 'edgt_lms_single_instructor_tabs' );
}

if(!function_exists('edgt_lms_single_instructor_courses')) {
    function edgt_lms_single_instructor_courses($id){

        $args = array(
            'post_type'  => 'course',
            'meta_key'   => 'edgt_course_instructor_meta',
            'orderby'    => 'meta_value_num',
            'order'      => 'ASC',
            'meta_query' => array(
                array(
                    'key'     => 'edgt_course_instructor_meta',
                    'value'   => $id,
                    'compare' => '='
                ),
            ),
        );
        $query = new WP_Query( $args );
        $courses_array = array();
        if($query->have_posts()):
            while ($query->have_posts()) : $query->the_post();
                $courses_array[] = get_the_ID();
            endwhile;
        endif;

        wp_reset_postdata();

        $course_sc_params = array();
        $course_sc_params['type'] = 'gallery';
        $course_sc_params['number_of_columns'] = '3';
        $course_sc_params['selected_courses'] = implode(',', $courses_array);

        return $course_sc_params;
    }
}

if(!function_exists('edgt_lms_get_instructor_category_list')) {
	function edgt_lms_get_instructor_category_list($category = '') {
		$number_of_columns = 3;
		
		$params = array(
			'number_of_columns'   => $number_of_columns
		);
		
		if(!empty($category)) {
			$params['category'] = $category;
		}
		
		$html = educator_edge_execute_shortcode('edgt_instructor_list', $params);
		
		print $html;
	}
}

if(!function_exists('edgt_lms_add_instructor_to_search_types')) {
    function edgt_lms_add_instructor_to_search_types($post_types) {

        $post_types['instructor'] = 'Instructor';

        return $post_types;
    }

    add_filter('educator_edge_search_post_type_widget_params_post_type', 'edgt_lms_add_instructor_to_search_types');
}