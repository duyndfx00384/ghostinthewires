<?php
namespace EdgeCore\CPT\Shortcodes\AnimationHolder;

use EdgeCore\Lib;

class AnimationHolder implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgt_animation_holder';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Edge Animation Holder', 'edge-cpt' ),
					'base'                    => $this->base,
					"as_parent"               => array( 'except' => 'vc_row' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'                    => 'icon-wpb-animation-holder extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'animation',
							'heading'     => esc_html__( 'Animation Type', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Element Grow In', 'edge-cpt' )          => 'edgt-grow-in',
								esc_html__( 'Element Fade In Down', 'edge-cpt' )     => 'edgt-fade-in-down',
								esc_html__( 'Element From Fade', 'edge-cpt' )        => 'edgt-element-from-fade',
								esc_html__( 'Element From Left', 'edge-cpt' )        => 'edgt-element-from-left',
								esc_html__( 'Element From Right', 'edge-cpt' )       => 'edgt-element-from-right',
								esc_html__( 'Element From Top', 'edge-cpt' )         => 'edgt-element-from-top',
								esc_html__( 'Element From Bottom', 'edge-cpt' )      => 'edgt-element-from-bottom',
								esc_html__( 'Element Flip In', 'edge-cpt' )          => 'edgt-flip-in',
								esc_html__( 'Element X Rotate', 'edge-cpt' )         => 'edgt-x-rotate',
								esc_html__( 'Element Z Rotate', 'edge-cpt' )         => 'edgt-z-rotate',
								esc_html__( 'Element Y Translate', 'edge-cpt' )      => 'edgt-y-translate',
								esc_html__( 'Element Fade In X Rotate', 'edge-cpt' ) => 'edgt-fade-in-left-x-rotate',
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'animation_delay',
							'heading'    => esc_html__( 'Animation Delay (ms)', 'edge-cpt' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args = array(
			'animation'       => '',
			'animation_delay' => ''
		);
		extract( shortcode_atts( $args, $atts ) );
		
		$html = '<div class="edgt-animation-holder ' . esc_attr( $animation ) . '" data-animation="' . esc_attr( $animation ) . '" data-animation-delay="' . esc_attr( $animation_delay ) . '"><div class="edgt-animation-inner">' . do_shortcode( $content ) . '</div></div>';
		
		return $html;
	}
}