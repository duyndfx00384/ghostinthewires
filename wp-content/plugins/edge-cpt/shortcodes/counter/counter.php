<?php
namespace EdgeCore\CPT\Shortcodes\Counter;

use EdgeCore\Lib;

class Counter implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgt_counter';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Counter', 'edge-cpt' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'                      => 'icon-wpb-counter extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
							array(
								'type'        => 'textfield',
								'param_name'  => 'custom_class',
								'heading'     => esc_html__( 'Custom CSS Class', 'edge-cpt' ),
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-cpt' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'type',
								'heading'     => esc_html__( 'Type', 'edge-cpt' ),
								'value'       => array(
									esc_html__( 'Zero Counter', 'edge-cpt' )   => 'edgt-zero-counter',
									esc_html__( 'Random Counter', 'edge-cpt' ) => 'edgt-random-counter'
								),
								'save_always' => true,
							)
						),
						educator_edge_icon_collections()->getVCParamsArray(),
						array(
							array(
								'type'       => 'textfield',
								'param_name' => 'custom_icon_size',
								'heading'    => esc_html__( 'Custom Icon Size (px)', 'edge-cpt' ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_color',
								'heading'    => esc_html__( 'Icon Color', 'edge-cpt' ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_margin',
								'heading'    => esc_html__( 'Icon Margin', 'edge-cpt' ),
								'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'edge-cpt' ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_animation',
								'heading'    => esc_html__( 'Icon Animation', 'edge-cpt' ),
								'value'      => array_flip( educator_edge_get_yes_no_select_array( false ) ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_animation_delay',
								'heading'    => esc_html__( 'Icon Animation Delay (ms)', 'edge-cpt' ),
								'dependency' => array( 'element' => 'icon_animation', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'digit',
								'heading'    => esc_html__( 'Digit', 'edge-cpt' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'digit_font_size',
								'heading'    => esc_html__( 'Digit Font Size (px)', 'edge-cpt' ),
								'dependency' => array( 'element' => 'digit', 'not_empty' => true )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'digit_color',
								'heading'    => esc_html__( 'Digit Color', 'edge-cpt' ),
								'dependency' => array( 'element' => 'digit', 'not_empty' => true )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'title',
								'heading'    => esc_html__( 'Title', 'edge-cpt' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'title_tag',
								'heading'     => esc_html__( 'Title Tag', 'edge-cpt' ),
								'value'       => array_flip( educator_edge_get_title_tag( true ) ),
								'save_always' => true,
								'dependency'  => array( 'element' => 'title', 'not_empty' => true )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'title_color',
								'heading'    => esc_html__( 'Title Color', 'edge-cpt' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'title_font_weight',
								'heading'     => esc_html__( 'Title Font Weight', 'edge-cpt' ),
								'value'       => array_flip( educator_edge_get_font_weight_array( true ) ),
								'save_always' => true,
								'dependency'  => array( 'element' => 'title', 'not_empty' => true )
							),
							array(
								'type'       => 'textarea',
								'param_name' => 'text',
								'heading'    => esc_html__( 'Text', 'edge-cpt' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'text_color',
								'heading'    => esc_html__( 'Text Color', 'edge-cpt' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts   = array(
			'custom_class'      => '',
			'type'              => 'edgt-zero-counter',
			'digit'             => '123',
			'digit_font_size'   => '',
			'custom_icon_size'   => '48',
			'icon_color'  	    => '',
			'icon_margin'  	    => '',
			'icon_animation'  	=> '',
			'icon_animation_delay'  	    => '',
			'digit_color'       => '',
			'title'             => '',
			'title_tag'         => 'h6',
			'title_color'       => '',
			'title_font_weight' => '',
			'text'              => '',
			'text_color'        => ''
		);
		$default_atts = array_merge( $default_atts, educator_edge_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['holder_classes']       = $this->getHolderClasses( $params );
		$params['icon_parameters'] = $this->getIconParameters( $params );
		$params['counter_styles']       = $this->getCounterStyles( $params );
		$params['counter_title_styles'] = $this->getCounterTitleStyles( $params );
		$params['counter_text_styles']  = $this->getCounterTextStyles( $params );
		
		$params['title_tag'] = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		
		$html = edgt_core_get_shortcode_module_template_part( 'templates/counter', 'counter', '', $params );
		
		return $html;
	}

	private function getIconParameters( $params ) {
		$params_array = array();

		if ( empty( $params['custom_icon'] ) ) {
			$iconPackName = educator_edge_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );

			$params_array['icon_pack']     = $params['icon_pack'];
			$params_array[ $iconPackName ] = $params[ $iconPackName ];



			if ( ! empty( $params['custom_icon_size'] ) ) {
				$params_array['custom_size'] = educator_edge_filter_px( $params['custom_icon_size'] ) . 'px';
			}

			$params_array['icon_color'] = $params['icon_color'];

			if ( ! empty( $params['icon_hover_color'] ) ) {
				$params_array['hover_icon_color'] = $params['icon_hover_color'];
			}


			if ( ! empty( $params['icon_margin'] ) ) {
				$params_array['margin'] = $params['icon_margin'];
			}

			$params_array['icon_animation']       = $params['icon_animation'];
			$params_array['icon_animation_delay'] = $params['icon_animation_delay'];
		}

		return $params_array;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getCounterStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['digit_font_size'] ) ) {
			$styles[] = 'font-size: ' . educator_edge_filter_px( $params['digit_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['digit_color'] ) ) {
			$styles[] = 'color: ' . $params['digit_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getCounterTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( ! empty( $params['title_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['title_font_weight'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getCounterTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		return implode( ';', $styles );
	}
}