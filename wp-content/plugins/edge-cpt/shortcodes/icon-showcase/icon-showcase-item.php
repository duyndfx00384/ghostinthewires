<?php
namespace EdgeCore\CPT\Shortcodes\IconShowcase;

use EdgeCore\Lib;

class IconShowcaseItem implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'edgt_icon_showcase_item';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => esc_html__('Edge Showcase Item', 'edge-cpt'),
					'base' => $this->base,
					'as_child' => array('only' => 'edgt_icon_showcase'),
					'category' => 'by EDGE',
					'icon' => 'icon-wpb-icon-showcase-item extended-custom-icon',
					'params' => array_merge(
						educator_edge_icon_collections()->getVCParamsArray(),
						array(
							array(
								'type' => 'colorpicker',
								'heading' => esc_html__('Icon Background Color', 'edge-cpt'),
								'param_name' => 'icon_background_color',
								'description' => ''
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => esc_html__('Title', 'edge-cpt'),
								'param_name' => 'title',
								'value' => '',
								'description' => ''
							),
							array(
								'type'       => 'dropdown',
								'heading' => esc_html__('Title Tag', 'edge-cpt'),
								'param_name' => 'title_tag',
								'value'      => educator_edge_get_title_tag(true),
								'dependency' => array('element' => 'title', 'not_empty' => true)
							),
							array(
								'type' => 'textarea_html',
								'class' => '',
								'heading' => esc_html__('Content', 'edge-cpt'),
								'param_name' => 'content',
								'value' => ''
							)
						)
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'icon_background_color' => '',
			'subtitle' => '',
			'title' => '',
			'title_tag' => 'h3'
		);

        $args = array_merge($args, educator_edge_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);

		$params['content'] = $content;
		$params['icon_params'] = $this->getIconParameters($params);

		$html = edgt_core_get_shortcode_module_template_part('templates/showcase-item-template', 'icon-showcase', '', $params);

		return $html;
	}

    /**
     * Returns parameters for icon shortcode as a string
     *
     * @param $params
     *
     * @return array
     */
	private function getIconParameters($params) {
        $params_array = array();

        $iconPackName = educator_edge_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

        $params_array['icon_pack']   = $params['icon_pack'];
        $params_array[$iconPackName] = $params[$iconPackName];

		if ($params['icon_background_color'] !== ''){
			$params_array['background_color'] = $params['icon_background_color'];
		}

        $params_array['type'] = 'edgt-circle';
		$params_array['size'] = 'edgt-icon-medium';

        return $params_array;
    }
}
