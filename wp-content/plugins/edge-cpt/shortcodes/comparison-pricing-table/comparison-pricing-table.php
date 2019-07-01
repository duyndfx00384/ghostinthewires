<?php

namespace EdgeCore\CPT\Shortcodes\ComparisonPricingTable;

use EdgeCore\Lib;

class ComparisonPricingTable implements Lib\ShortcodeInterface {
    private $base;

    /**
     * ComparisonPricingTablesHolder constructor.
     */
    public function __construct() {
        $this->base = 'edgt_comparison_pricing_table';

        add_action('vc_before_init', array($this, 'vcMap'));
    }


    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name' => 'Edge Comparison Pricing Table',
                    'base' => $this->base,
                    'as_parent' => array('only' => 'edgt_comparison_pricing_table_item'),
                    'content_element' => true,
                    'category' => 'by EDGE',
                    'icon' => 'icon-wpb-comparison-pricing-table extended-custom-icon',
                    'show_settings_on_create' => true,
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'holder' => 'div',
                            'class' => '',
                            'heading' => 'Columns',
                            'param_name' => 'columns',
                            'value' => array(
                                'Two' => 'edgt-two-columns',
                                'Three' => 'edgt-three-columns',
                                'Four' => 'edgt-four-columns',
                            ),
                            'save_always' => true,
                            'description' => ''
                        ),
                        array(
                            'type' => 'textarea',
                            'holder' => 'div',
                            'class' => '',
                            'heading' => 'Title',
                            'param_name' => 'title',
                            'value' => '',
                            'save_always' => true
                        ),
                        array(
                            'type' => 'exploded_textarea',
                            'holder' => 'div',
                            'class' => '',
                            'heading' => 'Features',
                            'param_name' => 'features',
                            'value' => '',
                            'save_always' => true,
                            'description' => 'Enter features. Separate each features with new line (enter).'
                        ),
                        array(
                            'type' => 'colorpicker',
                            'holder' => 'div',
                            'class' => '',
                            'heading' => 'Border Top Color',
                            'param_name' => 'border_top_color',
                            'value' => '',
                            'save_always' => true
                        )
                    ),
                    'js_view' => 'VcColumnView'
                ));
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'columns'          => 'edgt-two-columns',
            'features'         => '',
            'title'            => '',
            'border_top_color' => ''
        );

        $params = shortcode_atts($args, $atts);

        $params['features']       = $this->getFeaturesArray($params);
        $params['content']        = $content;
        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['border_style']   = $this->getBorderStyles($params);
        $params['display_border'] = is_array($params['border_style']) && count($params['border_style']);

        return edgt_core_get_shortcode_module_template_part('templates/cpt-holder-template', 'comparison-pricing-table', '', $params);
    }

    private function getFeaturesArray($params) {
        $features = array();

        if(!empty($params['features'])) {
            $features = explode(',', $params['features']);
        }

        return $features;
    }

    private function getHolderClasses($params) {
        $classes = array('edgt-comparision-pricing-tables-holder');

        if($params['columns'] !== '') {
            $classes[] = $params['columns'];
        }

        return $classes;
    }

    private function getBorderStyles($params) {
        $styles = array();

        if($params['border_top_color'] !== '') {
            $styles[] = 'background-color: '.$params['border_top_color'];
        }

        return $styles;
    }

}