<?php

class EducatorEdgeSeparatorWidget extends EducatorEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edgt_separator_widget',
	        esc_html__('Edge Separator Widget', 'educator'),
	        array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'educator'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'educator' ),
				'options' => array(
					'normal'     => esc_html__( 'Normal', 'educator' ),
					'full-width' => esc_html__( 'Full Width', 'educator' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'position',
				'title'   => esc_html__( 'Position', 'educator' ),
				'options' => array(
					'center' => esc_html__( 'Center', 'educator' ),
					'left'   => esc_html__( 'Left', 'educator' ),
					'right'  => esc_html__( 'Right', 'educator' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'border_style',
				'title'   => esc_html__( 'Style', 'educator' ),
				'options' => array(
					'solid'  => esc_html__( 'Solid', 'educator' ),
					'dashed' => esc_html__( 'Dashed', 'educator' ),
					'dotted' => esc_html__( 'Dotted', 'educator' )
				)
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'educator' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'width',
				'title' => esc_html__( 'Width', 'educator' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'thickness',
				'title' => esc_html__( 'Thickness (px)', 'educator' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'top_margin',
				'title' => esc_html__( 'Top Margin', 'educator' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'bottom_margin',
				'title' => esc_html__( 'Bottom Margin', 'educator' )
			)
		);
	}

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		echo '<div class="widget edgt-separator-widget">';
			echo do_shortcode( "[edgt_separator $params]" ); // XSS OK
		echo '</div>';
	}
}