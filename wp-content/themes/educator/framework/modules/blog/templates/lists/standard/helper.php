<?php

if( !function_exists('educator_edge_get_blog_holder_params') ) {
    /**
     * Function that generates params for holders on blog templates
     */
    function educator_edge_get_blog_holder_params($params) {
        $params_list = array();

        $params_list['holder'] = 'edgt-container';
        $params_list['inner'] = 'edgt-container-inner clearfix';

        return $params_list;
    }

    add_filter( 'educator_edge_blog_holder_params', 'educator_edge_get_blog_holder_params' );
}

if( !function_exists('educator_edge_get_blog_holder_classes') ) {
	/**
	 * Function that generates blog holder classes for blog page
	 */
	function educator_edge_get_blog_holder_classes($classes) {
		$sidebar_classes   = array();
		$sidebar_classes[] = 'edgt-grid-normal-gutter';
		
		return implode(' ', $sidebar_classes);
	}
	
	add_filter( 'educator_edge_blog_holder_classes', 'educator_edge_get_blog_holder_classes' );
}

if( !function_exists('educator_edge_blog_part_params') ) {
    function educator_edge_blog_part_params($params) {

        $part_params = array();
        $part_params['title_tag'] = 'h3';
        $part_params['link_tag'] = 'h3';
        $part_params['quote_tag'] = 'h3';

        return array_merge($params, $part_params);
    }

    add_filter( 'educator_edge_blog_part_params', 'educator_edge_blog_part_params' );
}