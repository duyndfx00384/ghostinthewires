<?php
namespace EdgeCore\CPT\Shortcodes\ElementsHolder;

use EdgeCore\Lib;

class ElementsHolder implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgt_elements_holder';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'      => esc_html__( 'Edge Elements Holder', 'edge-cpt' ),
					'base'      => $this->base,
					'icon'      => 'icon-wpb-elements-holder extended-custom-icon',
					'category'  => esc_html__( 'by EDGE', 'edge-cpt' ),
					'as_parent' => array( 'only' => 'edgt_elements_holder_item' ),
					'js_view'   => 'VcColumnView',
					'params'    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'edge-cpt' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'holder_full_height',
							'heading'     => esc_html__( 'Enable Holder Full Height', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Columns', 'edge-cpt' ),
							'value'       => array(
								esc_html__( '1 Column', 'edge-cpt' )  => 'one-column',
								esc_html__( '2 Columns', 'edge-cpt' ) => 'two-columns',
								esc_html__( '3 Columns', 'edge-cpt' ) => 'three-columns',
								esc_html__( '4 Columns', 'edge-cpt' ) => 'four-columns',
								esc_html__( '5 Columns', 'edge-cpt' ) => 'five-columns',
								esc_html__( '6 Columns', 'edge-cpt' ) => 'six-columns'
							),
							'save_always' => true
						),
						array(
							'type'       => 'checkbox',
							'param_name' => 'items_float_left',
							'heading'    => esc_html__( 'Items Float Left', 'edge-cpt' ),
							'value'      => array( 'Make Items Float Left?' => 'yes' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'switch_to_one_column',
							'heading'     => esc_html__( 'Switch to One Column', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Default', 'edge-cpt' )      => '',
								esc_html__( 'Below 1280px', 'edge-cpt' ) => '1280',
								esc_html__( 'Below 1024px', 'edge-cpt' ) => '1024',
								esc_html__( 'Below 768px', 'edge-cpt' )  => '768',
								esc_html__( 'Below 680px', 'edge-cpt' )  => '680',
								esc_html__( 'Below 480px', 'edge-cpt' )  => '480',
								esc_html__( 'Never', 'edge-cpt' )        => 'never'
							),
							'description' => esc_html__( 'Choose on which stage item will be in one column', 'edge-cpt' ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'alignment_one_column',
							'heading'     => esc_html__( 'Choose Alignment In Responsive Mode', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Default', 'edge-cpt' ) => '',
								esc_html__( 'Left', 'edge-cpt' )    => 'left',
								esc_html__( 'Center', 'edge-cpt' )  => 'center',
								esc_html__( 'Right', 'edge-cpt' )   => 'right'
							),
							'description' => esc_html__( 'Alignment When Items are in One Column', 'edge-cpt' ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'         => '',
			'holder_full_height'   => 'no',
			'background_color'     => '',
			'number_of_columns'    => 'one-column',
			'items_float_left'     => '',
			'switch_to_one_column' => '',
			'alignment_one_column' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$holder_classes = $this->getHolderClasses( $params );
		$holder_styles  = $this->getHolderStyles( $params );
		
		$html = '<div ' . educator_edge_get_class_attribute( $holder_classes ) . ' ' . educator_edge_get_inline_attr( $holder_styles, 'style' ) . '>';
			$html .= do_shortcode( $content );
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array( 'edgt-elements-holder' );
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['holder_full_height'] === 'yes' ? 'edgt-eh-full-height' : '';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'edgt-' . $params['number_of_columns'] : '';
		$holderClasses[] = $params['items_float_left'] !== '' ? 'edgt-ehi-float' : '';
		$holderClasses[] = ! empty( $params['switch_to_one_column'] ) ? 'edgt-responsive-mode-' . $params['switch_to_one_column'] : 'edgt-responsive-mode-768';
		$holderClasses[] = ! empty( $params['alignment_one_column'] ) ? 'edgt-one-column-alignment-' . $params['alignment_one_column'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		return implode( ';', $styles );
	}
}
