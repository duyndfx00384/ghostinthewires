<?php

if (!function_exists('edgt_lms_get_dashboard_page_url')) {
	/**
	 * Function that returns dashboard page url
	 *
	 * @return string
	 */
	function edgt_lms_get_dashboard_page_url() {
		$url = '';
		$pages = get_all_page_ids();

		foreach ($pages as $page) {
			if (get_post_status( $page ) == 'publish' && get_page_template_slug($page) == 'user-dashboard.php') {
				$url = esc_url(get_the_permalink($page));
				break;
			}
		}

		return $url;
	}
}

if(!function_exists('edgt_lms_add_profile_navigation_item')) {

	function edgt_lms_add_profile_navigation_item($navigation) {

		$dashboard_url = edgt_lms_get_dashboard_page_url();
		$navigation['courses'] = array(
			'url'  => esc_url(add_query_arg( array( 'user-action' => 'courses' ), $dashboard_url)),
			'text' => esc_html__( 'Courses', 'edge-lms'),
			'user_action' => 'courses'
		);
        $navigation['course-favorites'] = array(
            'url'  => esc_url(add_query_arg( array( 'user-action' => 'course-favorites' ), $dashboard_url)),
            'text' => esc_html__( 'Courses Wishlist', 'edge-lms'),
            'user_action' => 'course-favorites'
        );

		return $navigation;
	}
	add_filter('edgt_membership_dashboard_navigation_pages', 'edgt_lms_add_profile_navigation_item');
}
if(!function_exists('edgt_lms_add_profile_navigation_pages')) {

	function edgt_lms_add_profile_navigation_pages($pages) {

		$pages['courses'] =  edgt_lms_cpt_single_module_template_part('profile/templates/courses-list', 'course');
        $pages['course-favorites'] =  edgt_lms_cpt_single_module_template_part('profile/templates/favorites-list', 'course');

		return $pages;
	}
	add_filter('edgt_membership_dashboard_pages', 'edgt_lms_add_profile_navigation_pages');
}
if(!function_exists('edgt_lms_get_user_orders')) {

	function edgt_lms_get_user_orders() {

        $customer_orders = array();
        if(get_current_user_id() > 0) {
            $customer_orders = wc_get_orders(
                array(
                    'customer' => get_current_user_id()
                )
            );
        }
        return $customer_orders;
	}
}

if(!function_exists('edgt_lms_get_product_id_from_name')) {
    function edgt_lms_get_product_id_from_name($item) {
        $page = get_page_by_title($item->get_name(), OBJECT, 'course');
        if($page) {
            return $page->ID;
        }

        return -1;
    }
}

if(!function_exists('edgt_lms_user_has_course')) {

	function edgt_lms_user_has_course($id = '') {

        $id = $id === '' ? get_the_ID() : $id;
        $customers_orders = edgt_lms_get_user_orders();
        foreach($customers_orders as $customer_order){
            $items = $customer_order->get_items();
            foreach($items as $item) {
                $order_status = $customer_order->get_status();
                $order_completed = $order_status == 'completed' ? true : false;
                if(edgt_lms_get_product_id_from_name($item) == $id && $order_completed){
                    return true;
                }
            }
        }
	}
}

if(!function_exists('edgt_lms_user_completed_prerequired_course')) {

    function edgt_lms_user_completed_prerequired_course($id = '') {

        $id = $id === '' ? get_the_ID() : $id;
        $user_courses = get_user_meta(get_current_user_id(), 'edgt_user_course_status', true);
        $prerequired_course = get_post_meta($id, 'edgt_course_prerequired_meta', true);

        if(isset($prerequired_course) && !empty($prerequired_course)) {
            if(isset($user_courses) && !empty($user_courses)) {
                if (!array_key_exists($prerequired_course, $user_courses)) {
                    return false;
                } else if ($user_courses[$prerequired_course] == 'completed') {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        return true;
    }
}

if(!function_exists('edgt_lms_get_user_profile_course_items')) {
    function edgt_lms_get_user_profile_course_items() {
        $customer_orders = edgt_lms_get_user_orders();

        $formatted_orders = array();
        if (!empty($customer_orders)) {
            foreach ($customer_orders as $customer_order) {
                $items = $customer_order->get_items();
                foreach ( $items as $item_id => $item ) {
                    $page = edgt_lms_get_product_id_from_name($item);
                    if($page !== -1) {
                        $item['id'] = $page;
                        $item['order_status'] = $customer_order->get_status();

                        array_push($formatted_orders, $item);
                    }
                }
            }
        }

        return $formatted_orders;
    }
}