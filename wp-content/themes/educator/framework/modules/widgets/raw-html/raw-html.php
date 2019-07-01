<?php

class EducatorEdgeRawHTMLWidget extends EducatorEdgeWidget {
	public function __construct() {
		parent::__construct(
			'edgt_raw_html_widget',
			esc_html__( 'Edge Raw HTML Widget', 'educator' ),
			array( 'description' => esc_html__( 'Add raw HTML holder to widget areas', 'educator' ) )
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
				'title' => esc_html__( 'Extra Class Name', 'educator' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'educator' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'widget_grid',
				'title'   => esc_html__( 'Widget Grid', 'educator' ),
				'options' => array(
					''     => esc_html__( 'Full Width', 'educator' ),
					'auto' => esc_html__( 'Auto', 'educator' )
				)
			),
			array(
				'type'  => 'textarea',
				'name'  => 'content',
				'title' => esc_html__( 'Content', 'educator' )
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
		$extra_class   = array();
		$extra_class[] = !empty( $instance['extra_class'] ) ? $instance['extra_class'] : '';
		$extra_class[] = !empty( $instance['widget_grid'] ) && $instance['widget_grid'] === 'auto' ? 'edgt-grid-auto-width' : '';
		?>
		
		<div class="widget edgt-raw-html-widget <?php echo esc_attr( implode( ' ', $extra_class ) ); ?>">
			<?php
				if ( ! empty( $instance['widget_title'] ) ) {
					echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
				}
				if ( ! empty( $instance['content'] ) ) {
					echo wp_kses_post( $instance['content'] );
				}
			?>
		</div>
		<?php
	}
}