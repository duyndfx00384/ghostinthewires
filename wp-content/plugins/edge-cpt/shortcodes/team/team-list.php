<?php
namespace EdgeCore\CPT\Shortcodes\Team;

use EdgeCore\Lib;
/**
 * Class Team
 */
class Team implements Lib\ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'edgt_team';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer. Hooked on vc_before_init
     *
     * @see edgt_core_get_carousel_slider_array_vc()
     */
    public function vcMap()	{

        $team_social_icons_array = array();
        for ($x = 1; $x<6; $x++) {
            $teamIconCollections = educator_edge_icon_collections()->getCollectionsWithSocialIcons();
            foreach($teamIconCollections as $collection_key => $collection) {

                $team_social_icons_array[] = array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Social Icon ', 'edge-cpt') .$x,
                    'param_name' => 'team_social_'.$collection->param.'_'.$x,
                    'value' => $collection->getSocialIconsArrayVC(),
                    'dependency' => Array('element' => 'team_social_icon_pack', 'value' => array($collection_key))
                );

            }

            $team_social_icons_array[] = array(
                'type' => 'textfield',
                'heading' => esc_html__('Social Icon ', 'edge-cpt').$x. esc_html__(' Link', 'edge-cpt'),
                'param_name' => 'team_social_icon_'.$x.'_link',
                'dependency' => array('element' => 'team_social_icon_pack', 'value' => educator_edge_icon_collections()->getIconCollectionsKeys())
            );

            $team_social_icons_array[] = array(
                'type' => 'dropdown',
                'heading' => esc_html__('Social Icon ', 'edge-cpt').$x. esc_html__(' Target', 'edge-cpt'),
                'param_name' => 'team_social_icon_'.$x.'_target',
                'value' => array(
                    '' => '',
                    esc_html__('Self', 'edge-cpt') => '_self',
                    esc_html__('Blank', 'edge-cpt') => '_blank'
                ),
                'dependency' => Array('element' => 'team_social_icon_'.$x.'_link', 'not_empty' => true)
            );

            $team_social_icons_array[] = array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Social Icon ', 'edge-cpt').$x. esc_html__(' Color', 'edge-cpt'),
                'param_name' => 'team_social_icon_'.$x.'_color',
                'dependency' => array('element' => 'team_social_icon_type', 'value' => 'normal'),
            );

            $team_social_icons_array[] = array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Social Icon ', 'edge-cpt').$x. esc_html__(' Hover Color', 'edge-cpt'),
                'param_name' => 'team_social_icon_'.$x.'_hover_color',
                'dependency' => array('element' => 'team_social_icon_type', 'value' => 'normal'),
            );

        }

        vc_map( array(
            'name' => esc_html__('Edge Team', 'edge-cpt'),
            'base' => $this->base,
            'category' => 'by EDGE',
            'icon' => 'icon-wpb-team extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params' => array_merge(
                array(
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => esc_html__('Skin', 'edge-cpt'),
                        'param_name' => 'skin',
                        'value' => array(
                            esc_html__('' ,'edge-cpt')    => '',
                            esc_html__('Light' ,'edge-cpt')    => 'light',
                            esc_html__('Dark','edge-cpt')  => 'dark'
                        ),
                        'dependency' => array('element' => 'team_type', 'value' => array('main-info-below-image')),
                        'save_always' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => esc_html__('Image', 'edge-cpt'),
                        'param_name' => 'team_image'
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Name', 'edge-cpt'),
                        'admin_label' => true,
                        'param_name' => 'team_name'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Name Tag', 'edge-cpt'),
                        'param_name' => 'team_name_tag',
                        'value' => array(
                            ''   => '',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6',
                        ),
                        'dependency' => array('element' => 'team_name', 'not_empty' => true)
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Position', 'edge-cpt'),
                        'admin_label' => true,
                        'param_name' => 'team_position'
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Description', 'edge-cpt'),
                        'admin_label' => true,
                        'param_name' => 'team_description'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Social Icon Pack', 'edge-cpt'),
                        'param_name' => 'team_social_icon_pack',
                        'admin_label' => true,
                        'value' => array_merge(array('' => ''),educator_edge_icon_collections()->getIconCollectionsVCExclude(array('dripicons', 'linea_icons','linear_icons'))),
                        'save_always' => true
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Social Icons Type', 'edge-cpt'),
                        'param_name' => 'team_social_icon_type',
                        'value' => array(
                            esc_html__('Normal', 'edge-cpt') => 'normal',
                            esc_html__('Circle', 'edge-cpt') => 'circle',
                            esc_html__('Square', 'edge-cpt') => 'square'
                        ),
                        'save_always' => true,
                        'dependency' => array('element' => 'team_social_icon_pack', 'value' => educator_edge_icon_collections()->getIconCollectionsKeys())
                    ),
                ),
                $team_social_icons_array
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
            'team_image' => '',
            'skin' => '',
            'team_name' => '',
            'team_name_tag' => 'h4',
            'team_position' => '',
            'team_description' => '',
            'team_social_icon_pack' => '',
            'team_social_icon_type' => 'normal_social'
        );

        $team_social_icons_form_fields = array();
        $number_of_social_icons = 5;

        for ($x = 1; $x <= $number_of_social_icons; $x++) {

            foreach (educator_edge_icon_collections()->iconCollections as $collection_key => $collection) {
                $team_social_icons_form_fields['team_social_' . $collection->param . '_' . $x] = '';
            }

            $team_social_icons_form_fields['team_social_icon_'.$x.'_link'] = '';
            $team_social_icons_form_fields['team_social_icon_'.$x.'_target'] = '';
            $team_social_icons_form_fields['team_social_icon_'.$x.'_color'] ='';
            $team_social_icons_form_fields['team_social_icon_'.$x.'_hover_color'] ='';

        }

        $args = array_merge($args, $team_social_icons_form_fields);

        $params = shortcode_atts($args, $atts);

        $params['number_of_social_icons'] = 5;
        $params['team_name_tag'] = $this->getTeamNameTag($params, $args);
        $params['team_social_icons'] = $this->getTeamSocialIcons($params);

        //Get HTML from template based on type of team
        $html = edgt_core_get_shortcode_module_template_part('templates/main-info-below-image', 'team', '', $params);

        return $html;

    }

    /**
     * Return correct heading value. If provided heading isn't valid get the default one
     *
     * @param $params
     * @return mixed
     */
    private function getTeamNameTag($params, $args) {

        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
        return (in_array($params['team_name_tag'], $headings_array)) ? $params['team_name_tag'] : $args['team_name_tag'];

    }

    private function getTeamSocialIcons($params) {

        extract($params);
        $social_icons = array();

        if ($team_social_icon_pack !== '') {

            $icon_pack = educator_edge_icon_collections()->getIconCollection($team_social_icon_pack);
            $team_social_icon_type_label = 'team_social_' . $icon_pack->param;
            $team_social_icon_param_label = $icon_pack->param;

            for ( $i = 1; $i <= $number_of_social_icons; $i++ ) {

                $team_social_icon = ${$team_social_icon_type_label . '_' . $i};
                $team_social_link = ${'team_social_icon_' . $i . '_link'};
                $team_social_target = ${'team_social_icon_' . $i . '_target'};
                $team_social_icon_color = ${'team_social_icon_'.$i.'_color'};
                $team_social_icon_hover_color = ${'team_social_icon_'.$i.'_hover_color'};

                if ($team_social_icon !== '') {

                    $team_icon_params = array();
                    $team_icon_params['icon_pack'] = $team_social_icon_pack;
                    $team_icon_params[$team_social_icon_param_label] =   $team_social_icon;
                    $team_icon_params['link'] = ($team_social_link !== '') ? $team_social_link : '';
                    $team_icon_params['target'] = ($team_social_target !== '') ? $team_social_target : '';
                    $team_icon_params['type'] = ($team_social_icon_type !== '') ? $team_social_icon_type : '';
                    $team_icon_params['hover_icon_color'] = ($team_social_icon_hover_color !== '') ? $team_social_icon_hover_color : '';
                    $team_icon_params['icon_color'] = ($team_social_icon_color !== '') ? $team_social_icon_color : '';

                    $social_icons[] = educator_edge_execute_shortcode('edgt_icon', $team_icon_params);
                }

            }

        }

        return $social_icons;

    }

}