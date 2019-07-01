<?php
namespace EdgeCore\CPT\Shortcodes\PricingTable;

use EdgeCore\Lib;

class PricingTable implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgt_pricing_table';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Edge Pricing Table', 'edge-cpt' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'edgt_pricing_table_item' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'                    => 'icon-wpb-pricing-table extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'columns',
							'heading'     => esc_html__( 'Number of Columns', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'One', 'edge-cpt' )   => 'edgt-one-column',
								esc_html__( 'Two', 'edge-cpt' )   => 'edgt-two-columns',
								esc_html__( 'Three', 'edge-cpt' ) => 'edgt-three-columns',
								esc_html__( 'Four', 'edge-cpt' )  => 'edgt-four-columns',
								esc_html__( 'Five', 'edge-cpt' )  => 'edgt-five-columns',
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_columns',
							'heading'     => esc_html__( 'Space Between Columns', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Normal', 'edge-cpt' )   => 'normal',
								esc_html__( 'Small', 'edge-cpt' )    => 'small',
								esc_html__( 'Tiny', 'edge-cpt' )     => 'tiny',
								esc_html__( 'No Space', 'edge-cpt' ) => 'no'
							),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'columns'               => 'edgt-two-columns',
			'space_between_columns' => 'normal'
		);
		$params = shortcode_atts( $args, $atts );
		
		$holder_class = $this->getHolderClasses( $params );
		
		$html = '<div class="edgt-pricing-tables clearfix ' . esc_attr( $holder_class ) . '">';
			$html .= '<div class="edgt-pt-wrapper">';
				$html .= do_shortcode( $content );
			$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['columns'] ) ? $params['columns'] : '';
		$holderClasses[] = ! empty( $params['space_between_columns'] ) ? 'edgt-pt-' . $params['space_between_columns'] . '-space' : '';
		
		return implode( ' ', $holderClasses );
	}
}