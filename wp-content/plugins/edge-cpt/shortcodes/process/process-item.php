<?php
namespace EdgeCore\CPT\Shortcodes\Process;

use EdgeCore\Lib;

class ProcessItem implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'edgt_process_item';
        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(array(
                'name' => 'Edge Process Item',
                'base' => $this->getBase(),
                'as_child' => array('only' => 'edgt_process_holder'),
                'category'=> esc_html__( 'by EDGE', 'edge-cpt' ),
                'icon' => 'icon-wpb-process-item extended-custom-icon',
                'show_settings_on_create' => true,
                'params' => array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Image','edge-cpt'),
                        'param_name' => 'image'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title','edge-cpt'),
                        'param_name' => 'title',
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Text','edge-cpt'),
                        'param_name' => 'text',
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Highlighted item?','edge-cpt'),
                        'param_name' => 'highlighted',
                        'value' => array_flip(educator_edge_get_yes_no_select_array(false)),
                        'save_always' => true,
                        'admin_label' => true
                    )
                )
            ));
        }
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'image'     => '',
            'title'     => '',
            'text'      => '',
            'highlighted' => ''
        );

        $params = shortcode_atts($default_atts, $atts);

        $params['item_classes'] = array(
            'edgt-process-item-holder'
        );

        if($params['highlighted'] === 'yes') {
            $params['item_classes'][] = 'edgt-pi-highlighted';
        }

        return edgt_core_get_shortcode_module_template_part('templates/process-item-template', 'process', '', $params);
    }

}