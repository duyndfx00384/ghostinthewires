<?php

class EducatorEdgeCourseListWidget extends EducatorEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edgt_course_list_widget',
            esc_html__('Edge Course List Widget', 'edge-lms'),
            array( 'description' => esc_html__( 'Display list of your course', 'edge-lms'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'edge-lms' )
			),
            array(
                'type'  => 'textfield',
                'name'  => 'number_of_items',
                'title' => esc_html__( 'Number of Posts', 'edge-lms' )
            ),
            array(
                'type'  => 'textfield',
                'name'  => 'category',
                'title'       => esc_html__( 'Category Slug', 'edge-lms' ),
                'description' => esc_html__( 'Leave empty for all or use comma for list', 'edge-lms' )
            ),
			array(
                'type'    => 'dropdown',
                'name'    => 'order_by',
                'title'   => esc_html__( 'Order By', 'edge-lms' ),
                'options' => educator_edge_get_query_order_by_array()
            ),
			array(
                'type'    => 'dropdown',
                'name'    => 'order',
                'title'   => esc_html__( 'Order', 'edge-lms' ),
                'options' => educator_edge_get_query_order_array()
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'title_tag',
                'title'   => esc_html__( 'Title Tag', 'edge-lms' ),
                'options' => educator_edge_get_title_tag( true )
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'title_text_transform',
                'title'   => esc_html__( 'Title Text Transform', 'edge-lms' ),
                'options' => educator_edge_get_text_transform_array( true )
            ),
            array(
                'name'    => 'show_instructor',
                'type'    => 'dropdown',
                'title'   => esc_html__( 'Show Course Instructor', 'edge-lms' ),
                'options' => array(
                    'yes' => esc_html__( 'Yes', 'edge-lms' ),
                    'no'  => esc_html__( 'No', 'edge-lms' )
                )
            ),
            array(
                'name'    => 'show_price',
                'type'    => 'dropdown',
                'title'   => esc_html__( 'Show Course Price', 'edge-lms' ),
                'options' => array(
                    'yes' => esc_html__( 'Yes', 'edge-lms' ),
                    'no'  => esc_html__( 'No', 'edge-lms' )
                )
            ),
            array(
                'name'    => 'image_proportions',
                'type'    => 'dropdown',
                'title'   => esc_html__( 'Image Proportions', 'edge-lms' ),
                'options' => array(
                     'full' => esc_html__( 'Original', 'edge-lms' ) ,
                     'square' =>esc_html__( 'Square', 'edge-lms' ),
                     'landscape' => esc_html__( 'Landscape', 'edge-lms' ),
                     'small_landscape' => esc_html__( 'Small Landscape', 'edge-lms' ),
                     'portrait'=> esc_html__( 'Portrait', 'edge-lms' ),
                     'thumbnail'=>esc_html__( 'Thumbnail', 'edge-lms' ),
                     'medium'=>esc_html__( 'Medium', 'edge-lms' ),
                     'large'=> esc_html__( 'Large', 'edge-lms' )
                )
            ),
            array(
                'name'    => 'show_image',
                'type'    => 'dropdown',
                'title'   => esc_html__( 'Show Course Featured Image', 'edge-lms' ),
                'options' => array(
                    'yes' => esc_html__( 'Yes', 'edge-lms' ),
                    'no'  => esc_html__( 'No', 'edge-lms' )
                )
            ),
		);
	}

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        if (!is_array($instance)) { $instance = array(); }

        $instance['item_layout']            = 'minimal';
        $instance['space_between_items']    = 'normal';
        $instance['number_of_columns']      = '1';

        // Filter out all empty params
        $instance         = array_filter($instance, function($array_value) { return trim($array_value) != ''; });
	    
	    $params = '';
        //generate shortcode params
        foreach($instance as $key => $value) {
            $params .= " $key='$value' ";
        }

        $params .= " enable_price='".$instance['show_price']."' ";
        $params .= " enable_instructor='".$instance['show_instructor']."' ";
        $params .= " enable_image='".$instance['show_image']."' ";
        $params .= " widget='yes' ";

        echo '<div class="widget edgt-course-list-widget">';
		    if ( ! empty( $instance['widget_title'] ) ) {
			    echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
		    }

            echo do_shortcode("[edgt_course_list $params]"); // XSS OK
        echo '</div>';
    }
}