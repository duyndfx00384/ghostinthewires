<?php

class EducatorEdgeBlogListWidget extends EducatorEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edgt_blog_list_widget',
            esc_html__('Edge Blog List Widget', 'educator'),
            array( 'description' => esc_html__( 'Display a list of your blog posts', 'educator'))
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
				'title' => esc_html__( 'Widget Title', 'educator' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'educator' ),
				'options' => array(
					'simple'  => esc_html__( 'Simple', 'educator' ),
					'minimal' => esc_html__( 'Minimal', 'educator' )
				)
			),
			array(
				'type'  => 'textfield',
				'name'  => 'number_of_posts',
				'title' => esc_html__( 'Number of Posts', 'educator' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'space_between_columns',
				'title'   => esc_html__( 'Space Between items', 'educator' ),
				'options' => array(
					'normal' => esc_html__( 'Normal', 'educator' ),
					'small'  => esc_html__( 'Small', 'educator' ),
					'tiny'   => esc_html__( 'Tiny', 'educator' ),
					'no'     => esc_html__( 'No Space', 'educator' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'order_by',
				'title'   => esc_html__( 'Order By', 'educator' ),
				'options' => educator_edge_get_query_order_by_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'order',
				'title'   => esc_html__( 'Order', 'educator' ),
				'options' => educator_edge_get_query_order_array()
			),
			array(
				'type'        => 'textfield',
				'name'        => 'category',
				'title'       => esc_html__( 'Category Slug', 'educator' ),
				'description' => esc_html__( 'Leave empty for all or use comma for list', 'educator' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_tag',
				'title'   => esc_html__( 'Title Tag', 'educator' ),
				'options' => educator_edge_get_title_tag( true, array('p' => 'p') )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_transform',
				'title'   => esc_html__( 'Title Text Transform', 'educator' ),
				'options' => educator_edge_get_text_transform_array( true )
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
	
	    $instance['image_size']        = 'thumbnail';
        $instance['post_info_section'] = 'yes';
        $instance['post_info_author'] = 'no';
        $instance['post_info_date']   = 'yes';
        $instance['post_info_category'] = 'no';
        $instance['post_info_comments'] = 'no';
        $instance['excerpt_length'] = '0';
        $instance['number_of_columns'] = '1';

        // Filter out all empty params
        $instance         = array_filter($instance, function($array_value) { return trim($array_value) != ''; });
	    $instance['type'] = ! empty( $instance['type'] ) ? $instance['type'] : 'simple';
	    
	    $params = '';
        //generate shortcode params
        foreach($instance as $key => $value) {
            $params .= " $key='$value' ";
        }

        echo '<div class="widget edgt-blog-list-widget">';
		    if ( ! empty( $instance['widget_title'] ) ) {
			    echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
		    }

            echo do_shortcode("[edgt_blog_list $params]"); // XSS OK
        echo '</div>';
    }
}