<?php
namespace EdgeCore\CPT\Shortcodes\ElementsHolder;

use EdgeCore\Lib;

class ElementsHolderItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgt_elements_holder_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Edge Elements Holder Item', 'edge-cpt' ),
					'base'                    => $this->base,
					'as_child'                => array( 'only' => 'edgt_elements_holder' ),
					'as_parent'               => array( 'except' => 'vc_row, vc_accordion' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'                    => 'icon-wpb-elements-holder-item extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'edge-cpt' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'class'       => '',
							'heading'     => esc_html__('Width', 'edge-cpt'),
							'param_name'  => 'item_width',
							'value'       => array(
								'1/1' => '1-1',
								'1/2' => '1-2',
								'1/3' => '1-3',
								'2/3' => '2-3',
								'1/4' => '1-4',
								'3/4' => '3-4',
								'1/5' => '1-5',
								'2/5' => '2-5',
								'3/5' => '3-5',
								'4/5' => '4-5',
								'1/6' => '1-6',
								'5/6' => '5-6',
							),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'edge-cpt' )
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'background_image',
							'heading'    => esc_html__( 'Background Image', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding',
							'heading'     => esc_html__( 'Padding', 'edge-cpt' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'edge-cpt' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'horizontal_alignment',
							'heading'    => esc_html__( 'Horizontal Alignment', 'edge-cpt' ),
							'value'      => array(
								esc_html__( 'Left', 'edge-cpt' )   => 'left',
								esc_html__( 'Right', 'edge-cpt' )  => 'right',
								esc_html__( 'Center', 'edge-cpt' ) => 'center'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'vertical_alignment',
							'heading'    => esc_html__( 'Vertical Alignment', 'edge-cpt' ),
							'value'      => array(
								esc_html__( 'Middle', 'edge-cpt' ) => 'middle',
								esc_html__( 'Top', 'edge-cpt' )    => 'top',
								esc_html__( 'Bottom', 'edge-cpt' ) => 'bottom'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'animation',
							'heading'    => esc_html__( 'Animation Type', 'edge-cpt' ),
							'value'      => array(
								esc_html__( 'Default (No Animation)', 'edge-cpt' )   => '',
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
							)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'animation_delay',
							'heading'    => esc_html__( 'Animation Delay (ms)', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1280_1600',
							'heading'     => esc_html__( 'Padding on screen size between 1280px-1600px', 'edge-cpt' ),
							'description' => esc_html__( 'Please insert padding in format top right bottom left. For example 10px 0 10px 0', 'edge-cpt' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1024_1280',
							'heading'     => esc_html__( 'Padding on screen size between 1024px-1280px', 'edge-cpt' ),
							'description' => esc_html__( 'Please insert padding in format top right bottom left. For example 10px 0 10px 0', 'edge-cpt' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_768_1024',
							'heading'     => esc_html__( 'Padding on screen size between 768px-1024px', 'edge-cpt' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'edge-cpt' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_680_768',
							'heading'     => esc_html__( 'Padding on screen size between 680px-768px', 'edge-cpt' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'edge-cpt' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_680',
							'heading'     => esc_html__( 'Padding on screen size bellow 680px', 'edge-cpt' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'edge-cpt' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'edge-cpt' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'           => '',
			'item_width'             => '1-1',
			'background_color'       => '',
			'background_image'       => '',
			'item_padding'           => '',
			'horizontal_alignment'   => '',
			'vertical_alignment'     => '',
			'animation'              => '',
			'animation_delay'        => '',
			'item_padding_1280_1600' => '',
			'item_padding_1024_1280' => '',
			'item_padding_768_1024'  => '',
			'item_padding_680_768'   => '',
			'item_padding_680'       => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content']           = $content;
		$params['holder_classes']    = $this->getHolderClasses( $params );
		$params['holder_rand_class'] = 'edgt-eh-custom-' . mt_rand( 1000, 10000 );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['content_styles']    = $this->getContentStyles( $params );
		$params['holder_data']       = $this->getHolderData( $params );
		
		$html = edgt_core_get_shortcode_module_template_part( 'templates/elements-holder-item-template', 'elements-holder', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['item_width'] ) ? 'edgt-width-' . $params['item_width'] : '';
		$holderClasses[] = ! empty( $params['vertical_alignment'] ) ? 'edgt-vertical-alignment-' . $params['vertical_alignment'] : '';
		$holderClasses[] = ! empty( $params['horizontal_alignment'] ) ? 'edgt-horizontal-alignment-' . $params['horizontal_alignment'] : '';
		$holderClasses[] = ! empty( $params['animation'] ) ? $params['animation'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['background_image'] ) ) {
			$styles[] = 'background-image: url(' . wp_get_attachment_url( $params['background_image'] ) . ')';
		}
		
		return implode( ';', $styles );
	}
	
	private function getContentStyles( $params ) {
		$styles = array();
		
		if ( $params['item_padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['item_padding'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getHolderData( $params ) {
		$data                    = array();
		$data['data-item-class'] = $params['holder_rand_class'];
		
		if ( ! empty( $params['animation'] ) ) {
			$data['data-animation'] = $params['animation'];
		}
		
		if ( $params['animation_delay'] !== '' ) {
			$data['data-animation-delay'] = esc_attr( $params['animation_delay'] );
		}
		
		if ( $params['item_padding_1280_1600'] !== '' ) {
			$data['data-1280-1600'] = $params['item_padding_1280_1600'];
		}
		
		if ( $params['item_padding_1024_1280'] !== '' ) {
			$data['data-1024-1280'] = $params['item_padding_1024_1280'];
		}
		
		if ( $params['item_padding_768_1024'] !== '' ) {
			$data['data-768-1024'] = $params['item_padding_768_1024'];
		}
		
		if ( $params['item_padding_680_768'] !== '' ) {
			$data['data-680-768'] = $params['item_padding_680_768'];
		}
		
		if ( $params['item_padding_680'] !== '' ) {
			$data['data-680'] = $params['item_padding_680'];
		}
		
		return $data;
	}
}
