<?php
namespace EdgeCore\CPT\Shortcodes\IconShowcase;

use EdgeCore\Lib;

class IconShowcase implements Lib\ShortcodeInterface {
	private $base;
	function __construct() {
		$this->base = 'edgt_icon_showcase';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Edge Interactive Icon Showcase', 'edge-cpt'),
			'base' => $this->base,
			'icon' => 'icon-wpb-icon-showcase extended-custom-icon',
			'category'  => esc_html__( 'by EDGE', 'edge-cpt' ),
			'as_parent' => array('only' => 'edgt_icon_showcase_item'),
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => esc_html__('Autoplay', 'edge-cpt'),
					'param_name' => 'autoplay',
					'value' => array_flip(educator_edge_get_yes_no_select_array(false)),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => esc_html__('Autoplay Interval (ms)', 'edge-cpt'),
					'param_name' => 'autoplay_interval',
					'save_always' => true,
					'description' => esc_html__('Default value is 3000.', 'edge-cpt')
				),
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'autoplay' => 'yes',
			'autoplay_interval' => '3000',
		);

		$params = shortcode_atts($args, $atts);

		$icon_showcase_classes = array();
		$icon_showcase_classes[] = 'edgt-int-icon-showcase';
		if ($params['autoplay'] == 'yes') {
			$icon_showcase_classes[] = 'edgt-autoplay';
		}
		$icon_showcase_class = implode(' ', $icon_showcase_classes);

        $data_attr = $this->getDataAttr($params);


		$html = '';

		$html .= '<div '. educator_edge_get_class_attribute($icon_showcase_class) . educator_edge_get_inline_attrs($data_attr) . '>';
		$html .= '<div class="edgt-int-icon-showcase-inner">';
		$html .= do_shortcode($content);
		$html .= '</div>';
		$html .= '<div class="edgt-int-icon-circle"></div>';
		$html .= '</div>';

		return $html;

	}

	/**
	 *
	 * Returns array of data attr
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getDataAttr($params) {
	    $data_attr = array();

	    if(!empty($params['autoplay_interval'])) {
	        $data_attr['data-interval'] = $params['autoplay_interval'];
	    }

	    return $data_attr;
	}

}
