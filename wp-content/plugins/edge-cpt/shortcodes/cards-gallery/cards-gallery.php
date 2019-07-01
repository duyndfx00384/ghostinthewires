<?php
namespace EdgeCore\CPT\Shortcodes\CardsGallery;

use EdgeCore\Lib;

class CardsGallery implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edgt_cards_gallery';

        add_action( 'vc_before_init', array( $this, 'vcMap' ) );
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if ( function_exists( 'vc_map' ) ) {
            vc_map(
                array(
                    'name'                      => esc_html__( 'Edge Cards Gallery', 'edge-cpt' ),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__( 'by EDGE', 'edge-cpt' ),
                    'icon'                      => 'icon-wpb-cards-gallery extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'custom_class',
                            'heading'     => esc_html__( 'Custom CSS Class', 'edge-cpt' ),
                            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-cpt' )
                        ),
                        array(
                            'type'        => 'attach_images',
                            'param_name'  => 'images',
                            'heading'     => esc_html__( 'Images', 'edge-cpt' ),
                            'description' => esc_html__( 'Select images from media library', 'edge-cpt' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'layout',
                            'heading'     => esc_html__( 'Layout', 'edge-cpt' ),
                            'value'       => array(
                                esc_html__( 'Shuffled Left', 'edge-cpt' )  => 'shuffled-left',
                                esc_html__( 'Shuffled Right', 'edge-cpt' ) => 'shuffled-right'
                            ),
                            'save_always' => true,
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'appear_effect',
                            'heading'     => esc_html__( 'Appear effect', 'edge-cpt' ),
                            'value'       => array(
                                esc_html__( 'Yes', 'edge-cpt' )  => 'yes',
                                esc_html__( 'No', 'edge-cpt' ) => 'no'
                            ),
                            'save_always' => true
                        )
                    )
                )
            );
        }
    }

    public function render( $atts, $content = null ) {
        $args   = array(
            'custom_class'    => '',
            'images'          => '',
            'layout'          => '',
            'appear_effect'   => 'yes'
        );

        $params                   = shortcode_atts($args, $atts);
        $params['images']         = $this->getGalleryImages($params);
        $params['holder_classes'] = $this->getHolderClasses($params);

        $html = edgt_core_get_shortcode_module_template_part( 'templates/cards-gallery', 'cards-gallery', '', $params );

        return $html;
    }

    /**
     * Return images for slider
     *
     * @param $params
     *
     * @return array
     */
    private function getGalleryImages($params) {
        $image_ids = array();
        $images    = array();
        $i         = 0;

        if($params['images'] !== '') {
            $image_ids = explode(',', $params['images']);
        }

        foreach($image_ids as $id) {

            $image['image_id']     = $id;
            $image_original        = wp_get_attachment_image_src($id, 'full');
            $image['url']          = $image_original[0];
            $image['title']        = get_the_title($id);
            $image['image_link']   = get_post_meta($id, 'attachment_image_link', true);
            $image['image_target'] = get_post_meta($id, 'attachment_image_target', true);

            $image_dimensions = educator_edge_get_image_dimensions($image['url']);
            if(is_array($image_dimensions) && array_key_exists('height', $image_dimensions)) {

                if(!empty($image_dimensions['height']) && $image_dimensions['width']) {
                    $image['height'] = $image_dimensions['height'];
                    $image['width']  = $image_dimensions['width'];
                }
            }

            $images[$i] = $image;
            $i++;
        }

        return $images;

    }

    private function getHolderClasses($params) {
        $classes = array('edgt-cards-gallery-holder');

        $classes[] = 'edgt-'.$params['layout'];

        $classes[] = 'edgt-appear-effect-'.$params['appear_effect'];

        return $classes;
    }
}