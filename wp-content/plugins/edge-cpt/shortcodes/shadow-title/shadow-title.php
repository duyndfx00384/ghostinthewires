<?php
namespace EdgeCore\CPT\Shortcodes\ShadowTitle;

use EdgeCore\Lib;

class ShadowTitle implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgt_shadow_title';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Shadow Title', 'edge-cpt' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'                      => 'icon-wpb-shadow-title extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'edge-cpt' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'position',
							'heading'     => esc_html__( 'Horizontal Position', 'edge-cpt' ),
							'value'       => array(
                                esc_html__( 'Center', 'edge-cpt' )  => 'center',
								esc_html__( 'Left', 'edge-cpt' )    => 'left',
								esc_html__( 'Right', 'edge-cpt' )   => 'right'
							),
                            'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'holder_padding',
							'heading'    => esc_html__( 'Holder Side Padding (px or %)', 'edge-cpt' )
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'font_family',
                            'heading'    => esc_html__( 'Font Family', 'edge-cpt' )
                        ),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'edge-cpt' ),
							'admin_label' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_size',
							'heading'     => esc_html__( 'Title Size', 'edge-cpt' ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'edge-cpt' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'edge-cpt' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title Style', 'edge-cpt' )
						),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'font_weight',
                            'heading'    => esc_html__( 'Title Font Weight', 'edge-cpt' ),
                            'value'      => array_flip(educator_edge_get_font_weight_array(true)),
                            'dependency' => array( 'element' => 'title', 'not_empty' => true ),
                            'group'      => esc_html__( 'Title Style', 'edge-cpt' )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'letter_spacing',
                            'heading'    => esc_html__( 'Title Letter Spacing', 'edge-cpt' ),
                            'dependency' => array( 'element' => 'title', 'not_empty' => true ),
                            'group'      => esc_html__( 'Title Style', 'edge-cpt' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'shadow_color',
                            'heading'    => esc_html__( 'Shadow Color', 'edge-cpt' ),
                            'dependency' => array( 'element' => 'title', 'not_empty' => true ),
                            'group'      => esc_html__( 'Title Style', 'edge-cpt' )
                        ),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'position'            => 'center',
			'holder_padding'      => '',
			'font_family'         => '',
			'title'               => '',
			'title_tag'           => 'h2',
			'title_color'         => '',
            'title_size'          => '',
			'font_weight'         => '',
			'letter_spacing'      => '',
			'shadow_color'        => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['holder_styles']  = $this->getHolderStyles( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']   = $this->getTitleStyles( $params );

		$html = edgt_core_get_shortcode_module_template_part( 'templates/shadow-title', 'shadow-title', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';

		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['holder_padding'] ) ) {
			$styles[] = 'padding: 0 ' . $params['holder_padding'];
		}
		
		if ( ! empty( $params['position'] ) ) {
			$styles[] = 'text-align: ' . $params['position'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}

        if ( ! empty($params['font_family'])  ) {
            $styles[] = 'font-family: ' . $params['font_family'];
        }

        if ( ! empty( $params['font_weight'] ) ){
            $styles[] = 'font-weight:' .  $params['font_weight'];
        }

        if ( ! empty( $params['shadow_color'] ) ){
		    $styles[] = 'text-shadow: 3px 3px ' .  $params['shadow_color'];
        }

        if( ! empty( $params['letter_spacing'] ) ){
            if( educator_edge_string_ends_with($params['letter_spacing'], 'px') || educator_edge_string_ends_with($params['letter_spacing'], 'em') ){
                $styles[] = 'letter-spacing:' . $params['letter_spacing'];
            }
            else {
                $styles[] = 'letter-spacing:' . $params['letter_spacing'] . 'px';
            }
        }

        if( ! empty( $params['title_size'] ) ){
            if( educator_edge_string_ends_with($params['title_size'], 'px') || educator_edge_string_ends_with($params['title_size'], 'em') ){
                $styles[] = 'font-size:' . $params['title_size'];
            }
            else {
                $styles[] = 'font-size:' . $params['title_size'] . 'px';
            }
        }
		
		return implode( ';', $styles );
	}
}