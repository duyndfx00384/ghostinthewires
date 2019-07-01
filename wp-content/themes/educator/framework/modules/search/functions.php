<?php

if( !function_exists('educator_edge_load_search') ) {
    function educator_edge_load_search() {
        $search_type_meta = educator_edge_options()->getOptionValue('search_type');
	    $search_type = !empty($search_type_meta) ? $search_type_meta : 'covers-header';
	    
        if ( educator_edge_active_widget( false, false, 'edgt_search_opener' ) ) {
            include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/search/types/' . $search_type . '.php';
        }
    }

    add_action('init', 'educator_edge_load_search');
}

if ( ! function_exists( 'educator_edge_get_holder_params_search' ) ) {
    /**
     * Function which return holder class and holder inner class for blog pages
     */
    function educator_edge_get_holder_params_search() {
        $params_list = array();

        $layout = educator_edge_options()->getOptionValue('search_page_layout');
        if($layout == 'in-grid') {
            $params_list['holder'] = 'edgt-container';
            $params_list['inner'] = 'edgt-container-inner clearfix';
        } else {
            $params_list['holder'] = 'edgt-full-width';
            $params_list['inner'] = 'edgt-full-width-inner';
        }

        /**
         * Available parameters for holder params
         * -holder
         * -inner
         */
        return apply_filters( 'educator_edge_search_holder_params', $params_list );
    }
}


if( !function_exists('educator_edge_get_search_page') ) {
    function educator_edge_get_search_page() {
        $sidebar_layout = educator_edge_sidebar_layout();

        $params = array(
            'sidebar_layout' => $sidebar_layout
        );

        educator_edge_get_module_template_part( 'templates/holder', 'search', '', $params );
    }
}

if ( ! function_exists( 'educator_edge_get_search_page_layout' ) ) {
    /**
     * Function which create query for blog lists
     *
     */
    function educator_edge_get_search_page_layout() {
        global $wp_query;
        $path   = apply_filters('educator_edge_search_page_path', 'templates/page');
        $type   = apply_filters('educator_edge_search_page_layout', 'default');
        $module = apply_filters('educator_edge_search_page_module', 'search');
        $plugin = apply_filters('educator_edge_search_page_plugin_override', false);

        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        } elseif ( get_query_var('page') ) {
            $paged = get_query_var('page');
        } else { $paged = 1; }

        $params = array(
            'type'          => $type,
            'query'         => $wp_query,
            'paged'         => $paged,
            'max_num_pages' => educator_edge_get_max_number_of_pages(),
        );

        $params = apply_filters('educator_edge_search_page_params', $params);

        educator_edge_get_module_template_part( $path . '/' . $type, $module, '', $params, $plugin );
    }
}