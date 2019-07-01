<?php
namespace EdgeCore\CPT\Shortcodes\InfoCard;

use EdgeCore\Lib;
/**
 * Class Team
 */
class InfoCard implements Lib\ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'edgt_info_card';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    public function vcMap()	{
        vc_map( array(
            'name' => esc_html__('Edge Info Card', 'edge-cpt'),
            'base' => $this->base,
            'category' => esc_html__('by EDGE', 'edge-cpt'),
            'icon' => 'icon-wpb-info-card extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params' => array_merge(
                array(
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Image', 'edge-cpt'),
                        'param_name' => 'image'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Title', 'edge-cpt'),
                        'admin_label' => true,
                        'param_name' => 'title'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Title Tag', 'edge-cpt'),
                        'param_name' => 'team_name_tag',
                        'value'       => array_flip( educator_edge_get_title_tag( true ) ),
                        'dependency' => array('element' => 'title', 'not_empty' => true)
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Description', 'edge-cpt'),
                        'admin_label' => true,
                        'param_name' => 'description'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Additional tag', 'edge-cpt'),
                        'admin_label' => true,
                        'param_name' => 'additional_tag'
                    )
                )
            )
        ) );

    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null)
    {

        $args = array(
            'image' => '',
            'title' => '',
            'title_tag' => 'h4',
            'description' => '',
            'additional_tag' => '',
        );

        $params = shortcode_atts($args, $atts);
        $params['title_tag'] = $params['title_tag'] !== '' ? $params['title_tag'] : $args['title_tag'];

        //Get HTML from template based on type of team
        $html = edgt_core_get_shortcode_module_template_part('templates/info-card', 'info-card', '', $params);

        return $html;

    }

}