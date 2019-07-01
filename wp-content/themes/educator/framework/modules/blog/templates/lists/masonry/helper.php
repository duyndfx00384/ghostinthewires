<?php

if( !function_exists('educator_edge_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function educator_edge_get_blog_holder_params($params) {
        $params_list = array();

        $masonry_layout = educator_edge_get_meta_field_intersect('blog_masonry_layout');
        if($masonry_layout === 'in-grid') {
            $params_list['holder'] = 'edgt-container';
            $params_list['inner'] = 'edgt-container-inner clearfix';
        }
        else {
            $params_list['holder'] = 'edgt-full-width';
            $params_list['inner'] = 'edgt-full-width-inner';
        }

        return $params_list;
    }

    add_filter( 'educator_edge_blog_holder_params', 'educator_edge_get_blog_holder_params' );
}

if( !function_exists('educator_edge_get_blog_list_classes') ) {
	/**
	 * Function that generates blog list holder classes for blog list templates
	 */
	function educator_edge_get_blog_list_classes($classes) {
		$list_classes   = array();
		$list_classes[] = 'edgt-blog-type-masonry';
		
		$number_of_columns = educator_edge_get_meta_field_intersect('blog_masonry_number_of_columns');
		if(!empty($number_of_columns)) {
			$list_classes[] = 'edgt-blog-' . $number_of_columns . '-columns';
		}
		
		$space_between_items = educator_edge_get_meta_field_intersect('blog_masonry_space_between_items');
		if(!empty($space_between_items)) {
			$list_classes[] = 'edgt-blog-' . $space_between_items . '-space';
		}

        $masonry_layout = educator_edge_get_meta_field_intersect('blog_masonry_layout');
        $list_classes[] = 'edgt-blog-masonry-' . $masonry_layout;
		
		$classes = array_merge($classes, $list_classes);
		
		return $classes;
	}
	
	add_filter( 'educator_edge_blog_list_classes', 'educator_edge_get_blog_list_classes' );
}

if( !function_exists('educator_edge_blog_part_params') ) {
    function educator_edge_blog_part_params($params) {

        $part_params = array();
        $part_params['title_tag'] = 'h4';
        $part_params['link_tag'] = 'h4';
        $part_params['quote_tag'] = 'h4';

        return array_merge($params, $part_params);
    }

    add_filter( 'educator_edge_blog_part_params', 'educator_edge_blog_part_params' );
}