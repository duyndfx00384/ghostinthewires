<?php
namespace EdgeCore\CPT\Shortcodes\IconTabs;

use EdgeCore\Lib;

class IconTabsItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgt_icon_tabs_item';
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
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Edge Icon Tabs Item', 'edge-cpt' ),
					'base'            => $this->getBase(),
					'as_parent'       => array( 'except' => 'vc_row' ),
					'as_child'        => array( 'only' => 'edgt_icon_tabs' ),
					'category'        => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'            => 'icon-wpb-icon-tabs-item extended-custom-icon',
					'content_element' => true,
					'js_view'         => 'VcColumnView',
					'params'          => array_merge(
						array(
							array(
								'type'       => 'textfield',
								'param_name' => 'tab_title',
								'heading'    => esc_html__( 'Title', 'edge-cpt' )
							)
						),
						educator_edge_icon_collections()->getVCParamsArray(),
						array(
							array(
								'type'       => 'attach_image',
								'param_name' => 'custom_icon',
								'heading'    => esc_html__( 'Custom Icon', 'edge-cpt' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_type',
								'heading'    => esc_html__( 'Icon Type', 'edge-cpt' ),
								'value'      => array(
									esc_html__( 'Normal', 'edge-cpt' ) => 'edgt-normal',
									esc_html__( 'Circle', 'edge-cpt' ) => 'edgt-circle',
									esc_html__( 'Square', 'edge-cpt' ) => 'edgt-square'
								),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_size',
								'heading'    => esc_html__( 'Icon Size', 'edge-cpt' ),
								'value'      => array(
									esc_html__( 'Medium', 'edge-cpt' )     => 'edgt-icon-medium',
									esc_html__( 'Tiny', 'edge-cpt' )       => 'edgt-icon-tiny',
									esc_html__( 'Small', 'edge-cpt' )      => 'edgt-icon-small',
									esc_html__( 'Large', 'edge-cpt' )      => 'edgt-icon-large',
									esc_html__( 'Very Large', 'edge-cpt' ) => 'edgt-icon-huge'
								),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'custom_icon_size',
								'heading'    => esc_html__( 'Custom Icon Size (px)', 'edge-cpt' ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'shape_size',
								'heading'    => esc_html__( 'Shape Size (px)', 'edge-cpt' ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_color',
								'heading'    => esc_html__( 'Icon Color', 'edge-cpt' ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_hover_color',
								'heading'    => esc_html__( 'Icon Hover Color', 'edge-cpt' ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_background_color',
								'heading'    => esc_html__( 'Icon Background Color', 'edge-cpt' ),
								'dependency' => array( 'element' => 'icon_type', 'value'   => array( 'edgt-square', 'edgt-circle' ) ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_hover_background_color',
								'heading'    => esc_html__( 'Icon Hover Background Color', 'edge-cpt' ),
								'dependency' => array( 'element' => 'icon_type', 'value'   => array( 'edgt-square', 'edgt-circle' ) ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_color',
								'heading'    => esc_html__( 'Icon Border Color', 'edge-cpt' ),
								'dependency' => array( 'element' => 'icon_type', 'value'   => array( 'edgt-square', 'edgt-circle' ) ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_hover_color',
								'heading'    => esc_html__( 'Icon Border Hover Color', 'edge-cpt' ),
								'dependency' => array( 'element' => 'icon_type', 'value'   => array( 'edgt-square', 'edgt-circle' ) ),
								'group'      => esc_html__( 'Icon Settings', 'edge-cpt' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_border_width',
								'heading'    => esc_html__( 'Border Width (px)', 'edge-cpt' ),
								'dependency' => array( 'element' => 'icon_type', 'value'   => array( 'edgt-square', 'edgt-circle' ) ),
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
						)
					)
				)
			);
		}
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'tab_title' 	   			  => 'Tab',
			'custom_icon'   			  => '',
			'tab_id'    				  => '',
			'icon_type'                   => 'edgt-normal',
			'icon_size'                   => 'edgt-icon-medium',
			'custom_icon_size'            => '',
			'shape_size'                  => '',
			'icon_color'                  => '',
			'icon_hover_color'            => '',
			'icon_background_color'       => '',
			'icon_hover_background_color' => '',
			'icon_border_color'           => '',
			'icon_border_hover_color'     => '',
			'icon_border_width'           => '',
			'icon_animation'              => '',
			'icon_animation_delay'        => '',
		);

		$default_atts = array_merge($default_atts, educator_edge_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);
		extract($params);

		$rand_number = rand(0, 1000);

		$params['tab_title'] = $params['tab_title'].'-'.$rand_number;
		$params['icon_parameters'] = $this->getIconParameters($params);


		$params['content'] = $content;
		
		$output = '';
		
		$output .= edgt_core_get_shortcode_module_template_part('templates/icon-tab-content','icon-tabs', '', $params);
		
		return $output;
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

		if(empty($params['custom_icon'])) {
			$iconPackName = educator_edge_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

			$params_array['icon_pack']   = $params['icon_pack'];
			$params_array[$iconPackName] = $params[$iconPackName];

			if(!empty($params['icon_size'])) {
				$params_array['size'] = $params['icon_size'];
			}

			if(!empty($params['custom_icon_size'])) {
				$params_array['custom_size'] = educator_edge_filter_px($params['custom_icon_size']).'px';
			}

			if(!empty($params['icon_type'])) {
				$params_array['type'] = $params['icon_type'];
			}

			if(!empty($params['shape_size'])) {
				$params_array['shape_size'] = educator_edge_filter_px($params['shape_size']).'px';
			}

			if(!empty($params['icon_border_color'])) {
				$params_array['border_color'] = $params['icon_border_color'];
			}

			if(!empty($params['icon_border_hover_color'])) {
				$params_array['hover_border_color'] = $params['icon_border_hover_color'];
			}

			if($params['icon_border_width'] !== '') {
				$params_array['border_width'] = educator_edge_filter_px($params['icon_border_width']).'px';
			}

			if(!empty($params['icon_background_color'])) {
				$params_array['background_color'] = $params['icon_background_color'];
			}

			if(!empty($params['icon_hover_background_color'])) {
				$params_array['hover_background_color'] = $params['icon_hover_background_color'];
			}

			$params_array['icon_color'] = $params['icon_color'];

			if(!empty($params['icon_hover_color'])) {
				$params_array['hover_icon_color'] = $params['icon_hover_color'];
			}

			$params_array['icon_animation']       = $params['icon_animation'];
			$params_array['icon_animation_delay'] = $params['icon_animation_delay'];
		}

		return $params_array;
	}
}