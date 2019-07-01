<?php

class EducatorEdgeButtonWidget extends EducatorEdgeWidget {
	public function __construct() {
		parent::__construct(
			'edgt_button_widget',
			esc_html__('Edge Button Widget', 'educator'),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'educator'))
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
					'solid'   => esc_html__( 'Solid', 'educator' ),
					'outline' => esc_html__( 'Outline', 'educator' ),
					'simple'  => esc_html__( 'Simple', 'educator' )
				)
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'size',
				'title'       => esc_html__( 'Size', 'educator' ),
				'options'     => array(
					'small'  => esc_html__( 'Small', 'educator' ),
					'medium' => esc_html__( 'Medium', 'educator' ),
					'large'  => esc_html__( 'Large', 'educator' ),
					'huge'   => esc_html__( 'Huge', 'educator' )
				),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'educator' )
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__( 'Text', 'educator' ),
				'default' => esc_html__( 'Button Text', 'educator' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'educator' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Link Target', 'educator' ),
				'options' => educator_edge_get_link_target_array()
			),
			array(
				'type'  => 'textfield',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'educator' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'hover_color',
				'title' => esc_html__( 'Hover Color', 'educator' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'background_color',
				'title'       => esc_html__( 'Background Color', 'educator' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'educator' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_background_color',
				'title'       => esc_html__( 'Hover Background Color', 'educator' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'educator' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'border_color',
				'title'       => esc_html__( 'Border Color', 'educator' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'educator' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'hover_border_color',
				'title'       => esc_html__( 'Hover Border Color', 'educator' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'educator' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__( 'Margin', 'educator' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'educator' )
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
		$params = '';

		if (!is_array($instance)) { $instance = array(); }

		// Filter out all empty params
		$instance = array_filter($instance, function($array_value) { return trim($array_value) != ''; });

		// Default values
		if (!isset($instance['text'])) { $instance['text'] = 'Button Text'; }

		// Generate shortcode params
		foreach($instance as $key => $value) {
			$params .= " $key='$value' ";
		}

		echo '<div class="widget edgt-button-widget">';
			echo do_shortcode("[edgt_button $params]"); // XSS OK
		echo '</div>';
	}
}