<?php

namespace EdgeCore\CPT\Shortcodes\EducationTimeline;

use EdgeCore\Lib;

class EducationTimelineItem implements Lib\ShortcodeInterface {
    private $base;

    /**
     * ComparisonPricingTable constructor.
     */
    public function __construct() {
        $this->base = 'edgt_education_timeline_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }


    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name' => 'Timeline Item',
                    'base' => $this->base,
                    'icon' => 'icon-wpb-education-timeline-item extended-custom-icon',
                    'category' => 'by EDGE',
                    'allowed_container_element' => 'vc_row',
                    'as_child' => array('only' => 'edgt_education_timeline_holder'),
                    'params' => array(
                        array(
                            'type' => 'textfield',
                            'admin_label' => true,
                            'heading' => esc_html__('Title','edge-cpt'),
                            'param_name' => 'title',
                            'description' => esc_html__('Add Title for Timeline Item','edge-cpt')
                        ),
                        array(
                            'type' => 'textfield',
                            'admin_label' => true,
                            'heading' => esc_html__('Subtitle', 'edge-cpt'),
                            'param_name' => 'subtitle',
                            'description' => esc_html__('Add Subtitle for Timeline Item', 'edge-cpt')
                        )
                    )
                ));
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'title'                => '',
            'subtitle'           => '',
        );

        $params = shortcode_atts($args, $atts);
        $params['content']        = $content;
       

        return edgt_core_get_shortcode_module_template_part('templates/education-timeline-item-template', 'education-timeline', '', $params);
    }

}