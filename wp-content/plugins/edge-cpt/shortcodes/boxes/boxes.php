<?php
namespace EdgeCore\CPT\Shortcodes\Boxes;

use EdgeCore\Lib;

class Boxes implements Lib\ShortcodeInterface {
    private $base;

    function __construct()
    {
        $this->base = 'edgt_boxes';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase()
    {
        return $this->base;
    }

    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map(
                array(
                    'name'      => esc_html__( 'Edge Boxes', 'edge-cpt' ),
                    'base'      => $this->base,
                    'icon'      => 'icon-wpb-boxes extended-custom-icon',
                    'category'  => esc_html__( 'by EDGE', 'edge-cpt' ),
                    'as_parent' => array( 'only' => 'edgt_boxes_item' ),
                    'js_view'   => 'VcColumnView',
                    'params'    => array(
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'number_of_columns',
                            'heading'     => esc_html__( 'Columns', 'edge-cpt' ),
                            'value'       => array(
                                esc_html__( '1 Column', 'edge-cpt' )  => 'one-column',
                                esc_html__( '2 Columns', 'edge-cpt' ) => 'two-columns',
                                esc_html__( '3 Columns', 'edge-cpt' ) => 'three-columns',
                                esc_html__( '4 Columns', 'edge-cpt' ) => 'four-columns'
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
            'number_of_columns' 	=> ''
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

        $html = '';

        $boxes_classes = array();
        $boxes_classes[] = 'edgt-boxes';
        $boxes_style = '';

        if($number_of_columns != ''){
            $boxes_classes[] .= 'edgt-'.$number_of_columns ;
        }

        $boxes_class = implode(' ', $boxes_classes);

        $html .= '<div ' . educator_edge_get_class_attribute($boxes_class) . ' ' . educator_edge_get_inline_attr($boxes_style, 'style'). '>';
        $html .= do_shortcode($content);
        $html .= '</div>';

        return $html;
    }

}