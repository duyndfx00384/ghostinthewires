<?php
if ( ! function_exists( 'educator_edge_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function educator_edge_register_side_area_sidebar() {
		register_sidebar(
			array(
				'id'            => 'sidearea',
				'name'          => esc_html__( 'Side Area', 'educator' ),
				'description'   => esc_html__( 'Side Area', 'educator' ),
				'before_widget' => '<div id="%1$s" class="widget edgt-sidearea %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgt-widget-title-holder"><h5 class="edgt-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);

        register_sidebar(
            array(
                'id'            => 'sidearea-bottom',
                'name'          => esc_html__( 'Side Area Bottom', 'educator' ),
                'description'   => esc_html__( 'Side Area Bottom', 'educator' ),
                'before_widget' => '<div id="%1$s" class="widget edgt-sidearea %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<div class="edgt-widget-title-holder"><h5 class="edgt-widget-title">',
                'after_title'   => '</h5></div>'
            )
        );
	}
	
	add_action( 'widgets_init', 'educator_edge_register_side_area_sidebar' );
}

if ( ! function_exists( 'educator_edge_side_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different side menu styles
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function educator_edge_side_menu_body_class( $classes ) {
		
		if ( is_active_widget( false, false, 'edgt_side_area_opener' ) ) {
			
			$classes[] = 'edgt-side-menu-slide-from-right';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'educator_edge_side_menu_body_class' );
}

if ( ! function_exists( 'educator_edge_get_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function educator_edge_get_side_area() {
		
		if ( is_active_widget( false, false, 'edgt_side_area_opener' ) ) {
			
			educator_edge_get_module_template_part( 'templates/sidearea', 'sidearea' );
		}
	}
	
	add_action( 'educator_edge_after_body_tag', 'educator_edge_get_side_area', 10 );
}