<?php

if ( ! function_exists( 'educator_edge_register_footer_sidebar' ) ) {
	function educator_edge_register_footer_sidebar() {
		
		register_sidebar(
			array(
				'id'            => 'footer_top_column_1',
				'name'          => esc_html__( 'Footer Top Column 1', 'educator' ),
				'description'   => esc_html__( 'Widgets added here will appear in the first column of top footer area', 'educator' ),
				'before_widget' => '<div id="%1$s" class="widget edgt-footer-column-1 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgt-widget-title-holder"><h4 class="edgt-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'footer_top_column_2',
				'name'          => esc_html__( 'Footer Top Column 2', 'educator' ),
				'description'   => esc_html__( 'Widgets added here will appear in the second column of top footer area', 'educator' ),
				'before_widget' => '<div id="%1$s" class="widget edgt-footer-column-2 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgt-widget-title-holder"><h4 class="edgt-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'footer_top_column_3',
				'name'          => esc_html__( 'Footer Top Column 3', 'educator' ),
				'description'   => esc_html__( 'Widgets added here will appear in the third column of top footer area', 'educator' ),
				'before_widget' => '<div id="%1$s" class="widget edgt-footer-column-3 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgt-widget-title-holder"><h4 class="edgt-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'footer_top_column_4',
				'name'          => esc_html__( 'Footer Top Column 4', 'educator' ),
				'description'   => esc_html__( 'Widgets added here will appear in the fourth column of top footer area', 'educator' ),
				'before_widget' => '<div id="%1$s" class="widget edgt-footer-column-4 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgt-widget-title-holder"><h4 class="edgt-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'footer_bottom_column_1',
				'name'          => esc_html__( 'Footer Bottom Column 1', 'educator' ),
				'description'   => esc_html__( 'Widgets added here will appear in the first column of bottom footer area', 'educator' ),
				'before_widget' => '<div id="%1$s" class="widget edgt-footer-bottom-column-1 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgt-widget-title-holder"><h4 class="edgt-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'footer_bottom_column_2',
				'name'          => esc_html__( 'Footer Bottom Column 2', 'educator' ),
				'description'   => esc_html__( 'Widgets added here will appear in the second column of bottom footer area', 'educator' ),
				'before_widget' => '<div id="%1$s" class="widget edgt-footer-bottom-column-2 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgt-widget-title-holder"><h4 class="edgt-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
		
		register_sidebar(
			array(
				'id'            => 'footer_bottom_column_3',
				'name'          => esc_html__( 'Footer Bottom Column 3', 'educator' ),
				'description'   => esc_html__( 'Widgets added here will appear in the third column of bottom footer area', 'educator' ),
				'before_widget' => '<div id="%1$s" class="widget edgt-footer-bottom-column-3 %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgt-widget-title-holder"><h4 class="edgt-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'educator_edge_register_footer_sidebar' );
}

if ( ! function_exists( 'educator_edge_get_footer' ) ) {
	/**
	 * Loads footer HTML
	 */
	function educator_edge_get_footer() {
		$parameters          = array();
		$page_id             = educator_edge_get_page_id();
		$disable_footer_meta = get_post_meta( $page_id, 'edgt_disable_footer_meta', true );
		
		$parameters['display_footer']        = $disable_footer_meta === 'yes' ? false : true;
		$parameters['display_footer_top']    = educator_edge_show_footer_top();
		$parameters['display_footer_bottom'] = educator_edge_show_footer_bottom();
		
		educator_edge_get_module_template_part( 'templates/footer', 'footer', '', $parameters );
	}
	
	add_action( 'educator_edge_get_footer_template', 'educator_edge_get_footer' );
}

if ( ! function_exists( 'educator_edge_show_footer_top' ) ) {
	/**
	 * Check footer top showing
	 * Function check value from options and checks if footer columns are empty.
	 * return bool
	 */
	function educator_edge_show_footer_top() {
		$footer_top_flag = false;
		
		//check value from options and meta field on current page
		$option_flag = ( educator_edge_get_meta_field_intersect( 'show_footer_top' ) === 'yes' ) ? true : false;
		
		//check footer columns.If they are empty, disable footer top
		$columns_flag = false;
		for ( $i = 1; $i <= 4; $i ++ ) {
			$footer_columns_id = 'footer_top_column_' . $i;
			if ( is_active_sidebar( $footer_columns_id ) ) {
				$columns_flag = true;
				break;
			}
		}
		
		if ( $option_flag && $columns_flag ) {
			$footer_top_flag = true;
		}
		
		return $footer_top_flag;
	}
}

if ( ! function_exists( 'educator_edge_show_footer_bottom' ) ) {
	/**
	 * Check footer bottom showing
	 * Function check value from options and checks if footer columns are empty.
	 * return bool
	 */
	function educator_edge_show_footer_bottom() {
		$footer_bottom_flag = false;
		
		//check value from options and meta field on current page
		$option_flag = ( educator_edge_get_meta_field_intersect( 'show_footer_bottom' ) === 'yes' ) ? true : false;
		
		//check footer columns.If they are empty, disable footer bottom
		$columns_flag = false;
		for ( $i = 1; $i <= 3; $i ++ ) {
			$footer_columns_id = 'footer_bottom_column_' . $i;
			if ( is_active_sidebar( $footer_columns_id ) ) {
				$columns_flag = true;
				break;
			}
		}
		
		if ( $option_flag && $columns_flag ) {
			$footer_bottom_flag = true;
		}
		
		return $footer_bottom_flag;
	}
}

if ( ! function_exists( 'educator_edge_get_content_bottom_area' ) ) {
	/**
	 * Loads content bottom area HTML with all needed parameters
	 */
	function educator_edge_get_content_bottom_area() {
		$parameters = array();
		
		//Current page id
		$id = educator_edge_get_page_id();
		
		//is content bottom area enabled for current page?
		$parameters['content_bottom_area'] = educator_edge_get_meta_field_intersect( 'enable_content_bottom_area', $id );
		
		if ( $parameters['content_bottom_area'] === 'yes' ) {
			
			//Sidebar for content bottom area
			$parameters['content_bottom_area_sidebar'] = educator_edge_get_meta_field_intersect( 'content_bottom_sidebar_custom_display', $id );
			//Content bottom area in grid
			$parameters['grid_class'] = ( educator_edge_get_meta_field_intersect( 'content_bottom_in_grid', $id ) ) === 'yes' ? 'edgt-grid' : 'edgt-full-width';
			
			$parameters['content_bottom_style'] = array();
			
			//Content bottom area background color
			$background_color = educator_edge_get_meta_field_intersect( 'content_bottom_background_color', $id );
			if ( $background_color !== '' ) {
				$parameters['content_bottom_style'][] = 'background-color: ' . $background_color . ';';
			}
			
			if ( is_active_sidebar( $parameters['content_bottom_area_sidebar'] ) ) {
				educator_edge_get_module_template_part( 'templates/parts/content-bottom-area', 'footer', '', $parameters );
			}
		}
	}
}

if ( ! function_exists( 'educator_edge_get_footer_top' ) ) {
	/**
	 * Return footer top HTML
	 */
	function educator_edge_get_footer_top() {

        //Current page id
        $id = educator_edge_get_page_id();

		$parameters = array();
		
		//get number of top footer columns
		$parameters['footer_top_columns'] = educator_edge_options()->getOptionValue( 'footer_top_columns' );
		
		//get footer top grid/full width class
		$parameters['footer_top_grid_class'] = educator_edge_options()->getOptionValue( 'footer_in_grid' ) === 'yes' ? 'edgt-grid ' : 'edgt-full-width ';

		$parameters['footer_top_skin'] = educator_edge_get_meta_field_intersect('footer_top_skin', $id) !== '' ? educator_edge_get_meta_field_intersect('footer_top_skin', $id) : '';

		
		//get footer top other classes
		$footer_top_classes = array();
		
		//footer alignment
		$footer_top_alignment = educator_edge_options()->getOptionValue( 'footer_top_columns_alignment' );
		$footer_top_classes[] = ! empty( $footer_top_alignment ) ? 'edgt-footer-top-alignment-' . esc_attr( $footer_top_alignment ) : '';


        //Footer Top transparency
        $footer_top_transparency = educator_edge_get_meta_field_intersect('footer_transparency', $id);

        $footer_top_transparency_class = '';
        if ($footer_top_transparency == 'yes') {
            $footer_top_transparency_class = 'edgt-transparent-footer-top';
        }

        $parameters['footer_top_transparency_class'] = $footer_top_transparency_class;
		
		$footer_top_classes = apply_filters( 'educator_edge_footer_top_classes', $footer_top_classes );
		
		$parameters['footer_top_classes'] = implode( ' ', $footer_top_classes );

		$parameters['use_custom_widgets'] = get_post_meta($id, 'show_footer_custom_widget_areas', true);
		
		educator_edge_get_module_template_part( 'templates/parts/footer-top', 'footer', '', $parameters );
	}
}

if ( ! function_exists( 'educator_edge_get_footer_bottom' ) ) {
	/**
	 * Return footer bottom HTML
	 */
	function educator_edge_get_footer_bottom() {

        //Current page id
        $id = educator_edge_get_page_id();

		$parameters = array();
		
		//get number of bottom footer columns
		$parameters['footer_bottom_columns'] = educator_edge_options()->getOptionValue( 'footer_bottom_columns' );
		
		//get footer top grid/full width class
		$parameters['footer_bottom_grid_class'] = educator_edge_options()->getOptionValue( 'footer_in_grid' ) === 'yes' ? 'edgt-grid' : 'edgt-full-width';

		$parameters['footer_bottom_skin'] = educator_edge_get_meta_field_intersect('footer_bottom_skin', $id) !== '' ? educator_edge_get_meta_field_intersect('footer_bottom_skin', $id) : '';
		
		//get footer top other classes
		$footer_bottom_classes = array();
		$footer_bottom_classes = apply_filters( 'educator_edge_footer_bottom_classes', $footer_bottom_classes );

        //Footer Top transparency
        $footer_bottom_transparency = educator_edge_get_meta_field_intersect('footer_transparency', $id);

        $footer_bottom_transparency_class = '';
        if ($footer_bottom_transparency == 'yes') {
            $footer_bottom_transparency_class = 'edgt-transparent-footer-bottom';
        }

        $parameters['footer_bottom_transparency_class'] = $footer_bottom_transparency_class;
		
		$parameters['footer_bottom_classes'] = implode( ' ', $footer_bottom_classes );
		
		educator_edge_get_module_template_part( 'templates/parts/footer-bottom', 'footer', '', $parameters );
	}
}

if ( ! function_exists( 'educator_edge_footer_background_image' ) ) {
    /**
     * Function that return container style
     */
    function educator_edge_footer_background_image($style) {
        $page_id      = educator_edge_get_page_id();
        $class_prefix = educator_edge_get_unique_page_class( $page_id, true );
        $container_selector_img = $class_prefix . ' .edgt-page-footer';
        $container_class_inner = array();

        $container_selector_inner = array(
            $class_prefix . ' .edgt-page-footer .edgt-footer-top-holder',
            $class_prefix . ' .edgt-page-footer .edgt-footer-bottom-holder',
        );

        $container_class_img      = array();
        $page_backgorund_image = educator_edge_get_meta_field_intersect('footer_background_image', $page_id );

        if ( $page_backgorund_image ) {
            $container_class_img['background-image'] = 'url('.$page_backgorund_image.')';
            $container_class_img['background-size'] = 'cover';
            $container_class_inner['background-color'] = 'transparent';
        }

        $current_style_img = educator_edge_dynamic_css( $container_selector_img, $container_class_img );
        $current_style_inner = educator_edge_dynamic_css($container_selector_inner, $container_class_inner);
        $current_style = $current_style_img . $current_style_inner;

        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter( 'educator_edge_add_page_custom_style', 'educator_edge_footer_background_image' );
}