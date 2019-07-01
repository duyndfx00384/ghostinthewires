<?php
namespace EdgeTwitter\Shortcodes\TwitterList;

use EdgeTwitter\Lib;
/**
 * Class Team
 */
class TwitterList implements Lib\ShortcodeInterface
{
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'edgt_twitter_list';

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

        vc_map( array(
            'name' => esc_html__('Edge Twitter List', 'edgt-twitter-feed'),
            'base' => $this->base,
            'category' => 'by EDGE',
            'icon' => 'icon-wpb-twitter-list extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('User ID', 'edgt-twitter-feed'),
                    'admin_label' => true,
                    'param_name' => 'user_id'
                ),
                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
                    'heading' => esc_html__('Columns', 'edgt-twitter-feed'),
                    'param_name' => 'number_of_columns',
                    'value'      => array(
                        esc_html__( 'One', 'edgt-twitter-feed' )   => '1',
                        esc_html__( 'Two', 'edgt-twitter-feed' )   => '2',
                        esc_html__( 'Three', 'edgt-twitter-feed' ) => '3',
                        esc_html__( 'Four', 'edgt-twitter-feed' )  => '4',
                        esc_html__( 'Five', 'edgt-twitter-feed' )  => '5'
                    ),
                    'save_always' => true
                ),
                array(
                    'type'       => 'dropdown',
                    'param_name' => 'space_between_columns',
                    'heading'    => esc_html__( 'Space Between Columns', 'edgt-twitter-feed' ),
                    'value'      => array(
                        esc_html__( 'Normal', 'edgt-twitter-feed' )   => 'normal',
                        esc_html__( 'Small', 'edgt-twitter-feed' )    => 'small',
                        esc_html__( 'Tiny', 'edgt-twitter-feed' )     => 'tiny',
                        esc_html__( 'No Space', 'edgt-twitter-feed' ) => 'no'
                    )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Number of Tweets', 'edgt-twitter-feed'),
                    'admin_label' => true,
                    'param_name' => 'number_of_tweets'
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__( 'Tweets Cache Time', 'edgt-twitter-feed' ),
                    'admin_label'   => true,
                    'param_name'    => 'transient_time',
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
            'user_id' => '',
            'number_of_columns' => '3',
            'space_between_columns' => 'normal',
            'number_of_tweets' => '',
            'transient_time' => '',
        );


        $params = shortcode_atts($args, $atts);
        extract($params);

        $params['holder_classes'] = $this->getHolderClasses($params);

        $twitter_api = new \EdgefTwitterApi();
        $params['twitter_api'] = $twitter_api;
        if ( $twitter_api->hasUserConnected() ) {
            $response = $twitter_api->fetchTweets( $user_id, $number_of_tweets, array(
                'transient_time' => $transient_time,
                'transient_id'   => 'edgt_twitter_' . rand(0,1000)
            ) );

            $params['response'] = $response;
        }
        //Get HTML from template based on type of team
        $html = edgt_twitter_get_shortcode_module_template_part('holder', 'twitter-list', '', $params);

        return $html;

    }

    public function getHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = $this->getColumnNumberClass( $params['number_of_columns'] );
        $holderClasses[] = ! empty( $params['space_between_columns'] ) ? 'edgt-tl-' . $params['space_between_columns'] . '-space' : 'edgt-tl-normal-space';

        return implode( ' ', $holderClasses );
    }

    public function getColumnNumberClass( $params ) {
        switch ( $params ) {
            case 1:
                $classes = 'edgt-tl-one-column';
                break;
            case 2:
                $classes = 'edgt-tl-two-columns';
                break;
            case 3:
                $classes = 'edgt-tl-three-columns';
                break;
            case 4:
                $classes = 'edgt-tl-four-columns';
                break;
            case 5:
                $classes = 'edgt-tl-five-columns';
                break;
            default:
                $classes = 'edgt-tl-three-columns';
                break;
        }

        return $classes;
    }

}