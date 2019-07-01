<?php
namespace EdgeCore\CPT\Shortcodes\Tabs;

use EdgeCore\Lib;

class TabsItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgt_tabs_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Edge Tabs Item', 'edge-cpt' ),
					'base'            => $this->getBase(),
					'as_parent'       => array( 'except' => 'vc_row' ),
					'as_child'        => array( 'only' => 'edgt_tabs' ),
					'category'        => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'            => 'icon-wpb-tabs-item extended-custom-icon',
					'content_element' => true,
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'       => 'textfield',
							'param_name' => 'tab_title',
							'heading'    => esc_html__( 'Title', 'edge-cpt' )
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'tab_content_title',
                            'heading'    => esc_html__( 'Content Title', 'edge-cpt' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'content_title_tag',
                            'heading'     => esc_html__( 'Title Tag', 'edge-cpt' ),
                            'value'       => array_flip( educator_edge_get_title_tag() ),
                            'save_always' => true,
                            'dependency'  => array( 'element' => 'tab_content_title', 'not_empty' => true )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'tab_content_description',
                            'heading'    => esc_html__( 'Content Description', 'edge-cpt' )
                        ),
                        array(
                            'type'        => 'attach_image',
                            'param_name'  => 'tab_image',
                            'heading'     => esc_html__( 'Image', 'edge-cpt' ),
                            'description' => esc_html__( 'Select image to be displayed in tab content', 'edge-cpt' )
                        ),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'tab_title' => 'Tab',
			'tab_content_title' => '',
            'content_title_tag' => 'h2',
			'tab_content_description' => '',
			'tab_image' => 'Tab',
			'tab_id'    => ''
		);
		$params       = shortcode_atts( $default_atts, $atts );
		
		$rand_number         = rand( 0, 1000 );
		$params['tab_title'] = $params['tab_title'] . '-' . $rand_number;
		$params['content']   = $content;
		
		$output = edgt_core_get_shortcode_module_template_part( 'templates/tab-content', 'tabs', '', $params );
		
		return $output;
	}
}