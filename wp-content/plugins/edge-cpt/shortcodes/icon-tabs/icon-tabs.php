<?php
namespace EdgeCore\CPT\Shortcodes\IconTabs;

use EdgeCore\Lib;

class IconTabs implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgt_icon_tabs';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'            => esc_html__( 'Edge Icon Tabs', 'edge-cpt' ),
					'base'            => $this->getBase(),
					'as_parent'       => array( 'only' => 'edgt_icon_tabs_item' ),
					'content_element' => true,
					'category'        => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'            => 'icon-wpb-icon-tabs extended-custom-icon',
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Number of tabs', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'One', 'edge-cpt' ) => 'one',
								esc_html__( 'Two', 'edge-cpt' ) => 'two',
								esc_html__( 'Three', 'edge-cpt' ) => 'three',
								esc_html__( 'Four', 'edge-cpt' ) => 'four',
								esc_html__( 'Five', 'edge-cpt' ) => 'five',
								esc_html__( 'Six', 'edge-cpt' ) => 'six',
							),
							'save_always' => true
						)
					)
				)
			);
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'type' => 'three'
		);

        $params  = shortcode_atts($args, $atts);
		extract($params);
		
		// Extract tab titles
		preg_match_all('/tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		/**
		 * get tab titles array
		 */
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}

		$tab_title_array = array();

		foreach($tab_titles as $tab) {
			preg_match('/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['tabs_titles']    = $tab_title_array;
		$params['content']        = $content;
		
		$output = '';
		
		$output .= edgt_core_get_shortcode_module_template_part('templates/icon-tab-template','icon-tabs', '', $params);
		
		return $output;
	}
	
	/**
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getHolderClasses($params){
		$holder_classes = array();
		
		$holder_classes[] = !empty($params['type']) ? 'edgt-icon-tabs-'.esc_attr($params['type']) : 'edgt-icon-tabs-three';
		
		return implode(' ', $holder_classes);
	}
}