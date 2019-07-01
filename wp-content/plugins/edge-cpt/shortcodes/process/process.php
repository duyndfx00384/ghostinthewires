<?php
namespace EdgeCore\CPT\Shortcodes\Process;

use EdgeCore\Lib;

class Process implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'edgt_process';
        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(array(
                'name' => 'Edge Process',
                'base' => $this->getBase(),
                'as_parent' => array('only' => 'edgt_process_item'),
                'content_element' => true,
                'show_settings_on_create' => true,
                'category' => esc_html__( 'by EDGE', 'edge-cpt' ),
                'icon' => 'icon-wpb-process extended-custom-icon',
                'js_view' => 'VcColumnView',
                'params' => array(
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'number_of_items',
                        'heading' => esc_html__('Number of Process Items','edge-cpt'),
                        'value' => array(
                            esc_html__('Three','edge-cpt') => 'three',
                            esc_html__('Four','edge-cpt') => 'four'
                        ),
                        'save_always' => true,
                        'admin_label' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'skin',
                        'heading' => esc_html__('Skin','edge-cpt'),
                        'value' => array(
                            esc_html__('Dark','edge-cpt') => 'dark',
                            esc_html__('Light','edge-cpt') => 'light'
                        ),
                        'save_always' => true,
                        'admin_label' => true,
                        'description' => ''
                    )
                )
            ));
        }
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'number_of_items' => '',
            'skin'            => 'dark'
        );

        $params            = shortcode_atts($default_atts, $atts);
        $params['content'] = $content;

        $params['holder_classes'] = array(
            'edgt-process-holder',
            'edgt-process-holder-items-'.$params['number_of_items'],
            'edgt-process-' . $params['skin'] . '-skin'
        );

        return edgt_core_get_shortcode_module_template_part('templates/process-holder-template', 'process', '', $params);
    }
}