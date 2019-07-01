<?php

if( ! function_exists( 'educator_edge_override_bbpress_breadcrumbs_home_link' ) ) {
    function educator_edge_override_bbpress_breadcrumbs_home_link($use_home_link) {
        if(function_exists(('is_bbpress')) && is_bbpress()) {
            $use_home_link = false;
        }

        return $use_home_link;
    }
    add_filter('educator_edge_breadcrumbs_title_use_home_link', 'educator_edge_override_bbpress_breadcrumbs_home_link');
}

if( ! function_exists( 'educator_edge_override_bbpress_breadcrumbs' ) ) {

    function educator_edge_override_bbpress_breadcrumbs($childContent, $delimiter, $before, $after) {
        if(function_exists(('is_bbpress')) && is_bbpress()) {

            $childContent = bbp_get_breadcrumb(
                array (
                    'sep' => '&nbsp; / &nbsp;'
                )
            );
        }

        return $childContent;
    }

    add_filter('educator_edge_breadcrumbs_title_child_output', 'educator_edge_override_bbpress_breadcrumbs', 10, 4);
}