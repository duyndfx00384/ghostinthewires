<?php
namespace EdgeCore\CPT\Shortcodes\EducationTimeline;

use EdgeCore\Lib;

class EducationTimelineHolder implements Lib\ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'edgt_education_timeline_holder';
        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name'      => esc_html__( 'Edge Timeline Holder', 'edge-cpt' ),
                    'base'      => $this->base,
                    'icon'      => 'icon-wpb-education-timeline-holder extended-custom-icon',
                    'category'  => esc_html__( 'by EDGE', 'edge-cpt' ),
                    'as_parent' => array( 'only' => 'edgt_education_timeline_item' ),
                    'is_container'  => true,
                    'js_view'   => 'VcColumnView',
                    'params'    => array(
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'title',
                            'heading'     => esc_html__( 'Title', 'edge-cpt' ),
                            'description' => esc_html__( 'Add Timeline Title', 'edge-cpt' )
                        )
                    )
                )
            );
        }
    }

    public function render( $atts, $content = null ) {
        $args   = array(
            'title'         => '',
        );
        $params = shortcode_atts( $args, $atts );

        $params['content']        = $content;
        return edgt_core_get_shortcode_module_template_part('templates/education-timeline-holder-template', 'education-timeline', '', $params);

    }
}
