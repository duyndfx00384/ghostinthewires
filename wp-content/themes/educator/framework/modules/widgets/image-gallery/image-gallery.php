<?php

class EducatorEdgeImageGalleryWidget extends EducatorEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edgt_image_gallery_widget',
            esc_html__('Edge Image Gallery Widget', 'educator'),
            array( 'description' => esc_html__( 'Add image gallery element to widget areas', 'educator'))
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
		        'name'  => 'extra_class',
		        'title' => esc_html__( 'Custom CSS Class', 'educator' )
	        ),
	        array(
		        'type'  => 'textfield',
		        'name'  => 'widget_title',
		        'title' => esc_html__( 'Widget Title', 'educator' )
	        ),
	        array(
		        'type'    => 'dropdown',
		        'name'    => 'type',
		        'title'   => esc_html__( 'Gallery Type', 'educator' ),
		        'options' => array(
			        'grid'   => esc_html__( 'Image Grid', 'educator' ),
			        'slider' => esc_html__( 'Slider', 'educator' )
		        )
	        ),
	        array(
		        'type'        => 'textfield',
		        'name'        => 'images',
		        'title'       => esc_html__( 'Image ID\'s', 'educator' ),
		        'description' => esc_html__( 'Add images id for your image gallery widget, separate id\'s with comma', 'educator' )
	        ),
	        array(
		        'type'        => 'textfield',
		        'name'        => 'image_size',
		        'title'       => esc_html__( 'Image Size', 'educator' ),
		        'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'educator' )
	        ),
	        array(
		        'type'    => 'dropdown',
		        'name'    => 'enable_image_shadow',
		        'title'   => esc_html__( 'Enable Image Shadow', 'educator' ),
		        'options' => educator_edge_get_yes_no_select_array( )
	        ),
	        array(
		        'type'    => 'dropdown',
		        'name'    => 'image_behavior',
		        'title'   => esc_html__( 'Image Behavior', 'educator' ),
		        'options' => array(
			        ''            => esc_html__( 'None', 'educator' ),
			        'lightbox'    => esc_html__( 'Open Lightbox', 'educator' ),
			        'custom-link' => esc_html__( 'Open Custom Link', 'educator' ),
			        'zoom'        => esc_html__( 'Zoom', 'educator' ),
			        'grayscale'   => esc_html__( 'Grayscale', 'educator' )
		        )
	        ),
	        array(
		        'type'        => 'textarea',
		        'name'        => 'custom_links',
		        'title'       => esc_html__( 'Custom Links', 'educator' ),
		        'description' => esc_html__( 'Delimit links by comma', 'educator' )
	        ),
	        array(
		        'type'    => 'dropdown',
		        'name'    => 'custom_link_target',
		        'title'   => esc_html__( 'Custom Link Target', 'educator' ),
		        'options' => educator_edge_get_link_target_array()
	        ),
	        array(
		        'type'    => 'dropdown',
		        'name'    => 'number_of_columns',
		        'title'   => esc_html__( 'Number of Columns', 'educator' ),
		        'options' => array(
			        'two'   => esc_html__( 'Two', 'educator' ),
			        'three' => esc_html__( 'Three', 'educator' ),
			        'four'  => esc_html__( 'Four', 'educator' ),
			        'five'  => esc_html__( 'Five', 'educator' ),
			        'six'   => esc_html__( 'Six', 'educator' )
		        )
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
		        'name'    => 'slider_navigation',
		        'title'   => esc_html__( 'Enable Slider Navigation Arrows', 'educator' ),
		        'options' => educator_edge_get_yes_no_select_array( false )
	        ),
	        array(
		        'type'    => 'dropdown',
		        'name'    => 'slider_pagination',
		        'title'   => esc_html__( 'Enable Slider Pagination', 'educator' ),
		        'options' => educator_edge_get_yes_no_select_array( false )
	        )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
	    if ( ! is_array( $instance ) ) {
		    $instance = array();
	    }
	    
	    $extra_class      = ! empty( $instance['extra_class'] ) ? $instance['extra_class'] : '';
	    $instance['type'] = ! empty( $instance['type'] ) ? $instance['type'] : 'grid';
	    
	    //prepare variables
	    $params = '';
	
	    //is instance empty?
	    if ( is_array( $instance ) && count( $instance ) ) {
		    //generate shortcode params
		    foreach ( $instance as $key => $value ) {
			    $params .= " $key='$value' ";
		    }
	    }
        ?>

        <div class="widget edgt-image-gallery-widget <?php echo esc_html($extra_class); ?>">
            <?php
	            if ( ! empty( $instance['widget_title'] ) ) {
		            echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
	            }
                echo do_shortcode("[edgt_image_gallery $params]"); // XSS OK
            ?>
        </div>
    <?php 
    }
}