<?php
namespace EdgeCore\CPT\Shortcodes\FullScreenSections;

use EdgeCore\Lib;

class FullScreenSections implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgt_full_screen_sections';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'      => esc_html__( 'Edge Full Screen Sections', 'edge-cpt' ),
					'base'      => $this->base,
					'icon'      => 'icon-wpb-full-screen-sections extended-custom-icon',
					'category'  => esc_html__( 'by EDGE', 'edge-cpt' ),
					'as_parent' => array( 'only' => 'edgt_full_screen_sections_item' ),
					'js_view'   => 'VcColumnView',
					'params'    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_continuous_vertical',
							'heading'     => esc_html__( 'Enable Continuous Scrolling', 'edge-cpt' ),
							'description' => esc_html__( 'Defines whether scrolling down in the last section or should scroll down to the first one and if scrolling up in the first section should scroll up to the last one', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_navigation',
							'heading'     => esc_html__( 'Enable Navigation Arrows', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_pagination',
							'heading'     => esc_html__( 'Enable Pagination Dots', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'enable_continuous_vertical' => 'no',
			'enable_navigation'          => 'yes',
			'enable_pagination'          => 'yes'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['holder_data']    = $this->getHolderData( $params );
		$params['content']        = $content;
		
		$html = edgt_core_get_shortcode_module_template_part( 'templates/full-screen-sections', 'full-screen-sections', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = $params['enable_navigation'] === 'yes' ? 'edgt-fss-has-nav' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderData( $params ) {
		$data = array();
		
		if ( ! empty( $params['enable_continuous_vertical'] ) ) {
			$data['data-enable-continuous-vertical'] = $params['enable_continuous_vertical'];
		}
		
		if ( ! empty( $params['enable_navigation'] ) ) {
			$data['data-enable-navigation'] = $params['enable_navigation'];
		}
		
		if ( ! empty( $params['enable_pagination'] ) ) {
			$data['data-enable-pagination'] = $params['enable_pagination'];
		}
		
		return $data;
	}
}
