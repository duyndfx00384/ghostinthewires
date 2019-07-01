<?php
namespace EdgeCore\CPT\Shortcodes\LinkedImagesList;

use EdgeCore\Lib;

class LinkedImagesList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgt_linked_images_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Edge Linked Image List', 'edge-cpt' ),
					'base'     => $this->base,
					'icon'     => 'icon-wpb-linked-image-list extended-custom-icon',
					'category' => esc_html__( 'by EDGE', 'edge-cpt' ),
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Columns', 'edge-cpt' ),
							'value'       => array(
								esc_html__( '1 Column', 'edge-cpt' )  => 'one-column',
								esc_html__( '2 Columns', 'edge-cpt' ) => 'two-columns',
								esc_html__( '3 Columns', 'edge-cpt' ) => 'three-columns',
								esc_html__( '4 Columns', 'edge-cpt' ) => 'four-columns',
								esc_html__( '5 Columns', 'edge-cpt' ) => 'five-columns',
								esc_html__( '6 Columns', 'edge-cpt' ) => 'six-columns'
							),
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'target',
							'heading'     => esc_html__( 'Link Target', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_link_target_array() ),
							'save_always' => true
						),
						array(
							'type' => 'param_group',
							'heading' => esc_html__( 'Linked Image Items', 'edge-cpt' ),
							'param_name' => 'category_items',
							'value' => '',
							'params' => array(
								array(
									'type'        => 'textfield',
									'param_name'  => 'title',
									'heading'     => esc_html__( 'Title', 'edge-cpt' ),
									'save_always' => true,
									'admin_label' => true
								),
								array(
									'type'       => 'textfield',
									'param_name' => 'link',
									'heading'    => esc_html__( 'Link', 'edge-cpt' )
								),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'image',
									'heading'     => esc_html__( 'Image', 'edge-cpt' ),
									'description' => esc_html__( 'Select image from media library', 'edge-cpt' )
								),
							)
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts   = array(
			'number_of_columns'  => 'one-column',
			'target'   => '',
			'category_items'        => ''
		);
		$params       = shortcode_atts( $default_atts, $atts );

		$params['holder_class'] = $this->getHolderClasses( $params );
		$params['category_items'] = json_decode(urldecode($params['category_items']), true);
		
		$html = edgt_core_get_shortcode_module_template_part( 'templates/linked-images-list-template', 'linked-images-list', '', $params );
		
		return $html;
	}


	private function getHolderClasses( $params ) {
		$holderClasses = array( 'edgt-linked-images-list' );

		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'edgt-' . $params['number_of_columns'] : '';

		return implode( ' ', $holderClasses );
	}
	

}