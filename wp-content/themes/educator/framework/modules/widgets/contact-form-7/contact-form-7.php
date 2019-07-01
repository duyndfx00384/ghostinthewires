<?php

class EducatorEdgeContactForm7Widget extends EducatorEdgeWidget {
	public function __construct() {
		parent::__construct(
			'edgt_contact_form_7_widget',
			esc_html__('Edge Contact Form 7 Widget', 'educator'),
			array( 'description' => esc_html__( 'Add contact form 7 to widget areas', 'educator'))
		);
		
		$this->setParams();
	}
	
	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
		
		$contact_forms = array();
		if ( $cf7 ) {
			foreach ( $cf7 as $cform ) {
				$contact_forms[ $cform->ID ] = $cform->post_title;
			}
		} else {
			$contact_forms[0] = esc_html__( 'No contact forms found', 'educator' );
		}
		
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
				'type'  => 'textfield',
				'name'  => 'widget_subtitle',
				'title' => esc_html__( 'Widget Subtitle', 'educator' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'image_src',
				'title' => esc_html__( 'Background Image Source', 'educator' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'background_color',
				'title' => esc_html__( 'Widget Background Color', 'educator' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'contact_form',
				'title'   => esc_html__( 'Select Contact Form 7', 'educator' ),
				'options' => $contact_forms
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'contact_form_style',
				'title'   => esc_html__( 'Contact Form 7 Style', 'educator' ),
				'options' => array(
					''                   => esc_html__( 'Default', 'educator' ),
					'cf7_custom_style_1' => esc_html__( 'Custom Style 1', 'educator' ),
					'cf7_custom_style_2' => esc_html__( 'Custom Style 2', 'educator' ),
					'cf7_custom_style_3' => esc_html__( 'Custom Style 3', 'educator' )
				)
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
		$extra_class = '';
		$image_src = '';
		if (!empty($instance['extra_class'])) {
			$extra_class = esc_html($instance['extra_class']);
		}
		if ( ! empty( $instance['image_src'] ) ) {
			$image_src = 'background-image: url("' . esc_url($instance['image_src']) . '");';
		}

		elseif ( ! empty ( $instance['background_color'] ) ) {
			$image_src = 'background-color: ' . esc_url($instance['background_color']) . ';';
		}

		?>
		<div class="widget edgt-contact-form-7-widget <?php echo esc_attr($extra_class); ?>" <?php echo educator_edge_get_inline_style($image_src); ?>>
			<?php if ( ! empty( $instance['widget_title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			} ?>
			<?php if ( ! empty( $instance['widget_subtitle'] ) ) { ?>
				<span><?php echo esc_html( $instance['widget_subtitle'] ); ?></span>
			<?php } ?>
			<?php if (!empty($instance['contact_form'])) {
				echo do_shortcode('[contact-form-7 id="'.esc_attr($instance['contact_form']).'" html_class="'.esc_attr($instance['contact_form_style']).'"]');
			} ?>
		</div>
		<?php
	}
}