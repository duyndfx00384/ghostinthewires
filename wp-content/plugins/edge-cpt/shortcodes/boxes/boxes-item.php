<?php
namespace EdgeCore\CPT\Shortcodes\Boxes;

use EdgeCore\Lib;

class BoxesItem implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'edgt_boxes_item';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if(function_exists('vc_map')){
            vc_map(
                array(
                    'name' => esc_html__( 'Edge Boxes Item', 'edge-cpt' ),
                    'base' => $this->base,
                    'as_child' => array('only' => 'edgt_boxes'),
                    'as_parent' => array('except' => 'vc_row, vc_accordion'),
                    'content_element' => true,
                    'category' => esc_html__('by EDGE', 'edge-cpt'),
                    'icon' => 'icon-wpb-boxes-item extended-custom-icon',
                    'show_settings_on_create' => true,
                    'js_view' => 'VcColumnView',
                    'params' => array(
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'background_color',
                            'heading'    => esc_html__('Background Color', 'edge-cpt')
                        ),
                        array(
                            'type'       => 'attach_image',
                            'param_name' => 'background_image',
                            'heading'    => esc_html__('Background Image', 'edge-cpt')
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'horizontal_aligment',
                            'heading'    => esc_html__('Horizontal Alignment', 'edge-cpt'),
                            'value'      => array(
                                esc_html__('Left', 'edge-cpt')    	=> 'left',
                                esc_html__('Right', 'edge-cpt')     => 'right',
                                esc_html__('Center', 'edge-cpt')    => 'center'
                            )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'vertical_alignment',
                            'heading'    => esc_html__('Vertical Alignment', 'edge-cpt'),
                            'value'      => array(
                                esc_html__('Middle', 'edge-cpt')    => 'middle',
                                esc_html__('Top', 'edge-cpt')    	=> 'top',
                                esc_html__('Bottom', 'edge-cpt')    => 'bottom'
                            )
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'item_padding',
                            'heading'     => esc_html__('Padding', 'edge-cpt'),
                            'description' => esc_html__('Please insert padding in format 0px 10px 0px 10px', 'edge-cpt')
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'item_link',
                            'heading'    => esc_html__( 'Box Item Link', 'edge-cpt' )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'item_target',
                            'heading'    => esc_html__( 'Box Item Target', 'edge-cpt' ),
                            'value'      => array_flip( educator_edge_get_link_target_array() ),
                            'dependency' => array( 'element' => 'item_link', 'not_empty' => true )
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'background_color'          => '',
            'background_image'          => '',
            'item_padding'              => '',
            'horizontal_aligment'       => '',
            'item_link'                 => '',
            'item_target'               => '_self',
            'vertical_alignment'        => ''
        );

        $params = shortcode_atts($args, $atts);
        extract($params);
        $params['content']= $content;

        $rand_class = 'edgt-boxes-custom-' . mt_rand(100000,1000000);

        $params['boxes_item_style']           = $this->getBoxesItemStyles($params);
        $params['boxes_item_content_style']   = $this->getBoxesItemContentStyles($params);
        $params['boxes_item_class']           = $this->getBoxesItemClass($params);
        $params['boxes_item_content_class']   = $rand_class;

        $html = edgt_core_get_shortcode_module_template_part('templates/boxes-item-template', 'boxes', '', $params);

        return $html;
    }

    /**
     * Return Boxes Item style
     *
     * @param $params
     * @return array
     */
    private function getBoxesItemStyles($params) {
        $styles = array();

        if ($params['background_color'] !== '') {
            $styles[] = 'background-color: '.$params['background_color'];
        }

        if ($params['background_image'] !== '') {
            $styles[] = 'background-image: url(' . wp_get_attachment_url($params['background_image']) . ')';
        }

        return implode(';', $styles);
    }

    /**
     * Return Boxes Item Content style
     *
     * @param $params
     * @return array
     */
    private function getBoxesItemContentStyles($params) {
        $styles = array();

        if ($params['item_padding'] !== '') {
            $styles[] = 'padding: '.$params['item_padding'];
        }

        return implode(';', $styles);
    }

    /**
     * Return Boxes Item classes
     *
     * @param $params
     * @return array
     */
    private function getBoxesItemClass($params) {
        $classes = array();

        if (!empty($params['vertical_alignment'])) {
            $classes[] = 'edgt-vertical-alignment-'. $params['vertical_alignment'];
        }

        if (!empty($params['horizontal_aligment'])) {
            $classes[] = 'edgt-horizontal-alignment-'. $params['horizontal_aligment'];
        }

        return implode(' ', $classes);
    }
}
