<?php
namespace EdgeCore\CPT\Shortcodes\ImageGallery;

use EdgeCore\Lib;

class ImageGallery implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgt_image_gallery';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Image Gallery', 'edge-cpt' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'                      => 'icon-wpb-image-gallery extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'edge-cpt' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Gallery Type', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Image Grid', 'edge-cpt' ) => 'grid',
								esc_html__( 'Masonry', 'edge-cpt' )    => 'masonry',
								esc_html__( 'Slider', 'edge-cpt' )     => 'slider',
								esc_html__( 'Carousel', 'edge-cpt' )   => 'carousel'
							),
							'save_always' => true,
							'admin_label' => true
						),
						array(
							'type'        => 'attach_images',
							'param_name'  => 'images',
							'heading'     => esc_html__( 'Images', 'edge-cpt' ),
							'description' => esc_html__( 'Select images from media library', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size',
							'heading'     => esc_html__( 'Image Size', 'edge-cpt' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_image_shadow',
							'heading'     => esc_html__( 'Enable Image Shadow', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_behavior',
							'heading'    => esc_html__( 'Image Behavior', 'edge-cpt' ),
							'value'      => array(
								esc_html__( 'None', 'edge-cpt' )             => '',
								esc_html__( 'Open Lightbox', 'edge-cpt' )    => 'lightbox',
								esc_html__( 'Open Custom Link', 'edge-cpt' ) => 'custom-link',
								esc_html__( 'Zoom', 'edge-cpt' )             => 'zoom',
								esc_html__( 'Grayscale', 'edge-cpt' )        => 'grayscale'
							)
						),
						array(
							'type'        => 'textarea',
							'param_name'  => 'custom_links',
							'heading'     => esc_html__( 'Custom Links', 'edge-cpt' ),
							'description' => esc_html__( 'Delimit links by comma', 'edge-cpt' ),
							'dependency'  => array( 'element' => 'image_behavior', 'value' => array( 'custom-link' ) )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'custom_link_target',
							'heading'    => esc_html__( 'Custom Link Target', 'edge-cpt' ),
							'value'      => array_flip( educator_edge_get_link_target_array() ),
							'dependency' => array( 'element' => 'image_behavior', 'value' => array( 'custom-link' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Two', 'edge-cpt' )   => 'two',
								esc_html__( 'Three', 'edge-cpt' ) => 'three',
								esc_html__( 'Four', 'edge-cpt' )  => 'four',
								esc_html__( 'Five', 'edge-cpt' )  => 'five',
								esc_html__( 'Six', 'edge-cpt' )   => 'six'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'grid', 'masonry' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_columns',
							'heading'     => esc_html__( 'Space Between Columns', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Normal', 'edge-cpt' )   => 'normal',
                                esc_html__( 'Large', 'edge-cpt' )    => 'large',
								esc_html__( 'Small', 'edge-cpt' )    => 'small',
								esc_html__( 'Tiny', 'edge-cpt' )     => 'tiny',
								esc_html__( 'No Space', 'edge-cpt' ) => 'no'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'grid', 'masonry', 'carousel' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_visible_items',
							'heading'     => esc_html__( 'Number Of Visible Items', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'One', 'edge-cpt' )   => '1',
								esc_html__( 'Two', 'edge-cpt' )   => '2',
								esc_html__( 'Three', 'edge-cpt' ) => '3',
								esc_html__( 'Four', 'edge-cpt' )  => '4',
								esc_html__( 'Five', 'edge-cpt' )  => '5',
								esc_html__( 'Six', 'edge-cpt' )   => '6'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'edge-cpt' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'edge-cpt' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'edge-cpt' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'edge-cpt' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable-active-item',
							'heading'     => esc_html__( 'Enable Active Item', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable-center',
							'heading'     => esc_html__( 'Enable Center Item', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable-auto-width',
							'heading'     => esc_html__( 'Enable Item Auto Width', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_padding',
							'heading'     => esc_html__( 'Enable Slider Padding', 'edge-cpt' ),
							'description' => esc_html__( 'Padding left and right on stage (can see neighbours).', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'            => '',
			'type'                    => 'grid',
			'images'                  => '',
			'image_size'              => 'thumbnail',
			'enable_image_shadow'     => 'no',
			'image_behavior'          => '',
			'enable-center'           => 'no',
			'enable-active-item'      => 'no',
			'enable-auto-width'       => 'no',
			'custom_links'            => '',
			'custom_link_target'      => '_self',
			'number_of_columns'       => 'three',
			'space_between_columns'   => 'normal',
			'number_of_visible_items' => '1',
			'slider_loop'             => 'yes',
			'slider_autoplay'         => 'yes',
			'slider_speed'            => '5000',
			'slider_speed_animation'  => '600',
			'slider_padding'          => 'no',
			'slider_navigation'       => 'yes',
			'slider_pagination'       => 'yes'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']    = $this->getHolderClasses( $params, $args );
		$params['inner_classes']     = $this->getInnerClasses( $params, $args );
		$params['carousel_classes']  = $this->getCarouselClasses( $params, $args );
		$params['slider_data']       = $this->getSliderData( $params );
		
		$params['type']               = ! empty( $params['type'] ) ? $params['type'] : $args['type'];
		$params['images']             = $this->getGalleryImages( $params );
		$params['image_size']         = $this->getImageSize( $params['image_size'] );
		$params['image_behavior']     = ! empty( $params['image_behavior'] ) ? $params['image_behavior'] : $args['image_behavior'];
		$params['custom_links']       = $this->getCustomLinks( $params );
		$params['custom_link_target'] = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : $args['custom_link_target'];
		
		$html = edgt_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'image-gallery', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'edgt-ig-' . $params['type'] . '-type' : 'edgt-ig-' . $args['type'] . '-type';
		$holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'edgt-has-shadow' : '';
		$holderClasses[] = $params['enable-active-item'] === 'yes' ? 'edgt-active-item-enabled' : '';
		$holderClasses[] = ! empty( $params['image_behavior'] ) ? 'edgt-image-behavior-' . $params['image_behavior'] : 'edgt-image-no-behavior';

		return implode( ' ', $holderClasses );
	}
	
	private function getInnerClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = $params['type'] === 'masonry' ? 'edgt-ig-masonry' : 'edgt-ig-grid';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'edgt-ig-' . $params['number_of_columns'] . '-columns' : 'edgt-ig-' . $args['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_columns'] ) ? 'edgt-ig-' . $params['space_between_columns'] . '-space' : 'edgt-ig-' . $args['space_between_columns'] . '-space';
		
		return implode( ' ', $holderClasses );
	}

	private function getCarouselClasses( $params, $args ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['space_between_columns'] ) ? 'edgt-' . $params['space_between_columns'] . '-space' : 'edgt-ig-' . $args['space_between_columns'] . '-space';

		return implode( ' ', $holderClasses );
	}
	
	private function getSliderData( $params ) {
		$slider_data = array();
		
		$slider_data['data-number-of-items']        = $params['number_of_visible_items'] !== '' && $params['type'] === 'carousel' ? $params['number_of_visible_items'] : '1';
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-center']          = ! empty( $params['enable-center'] ) ? $params['enable-center'] : '';
		$slider_data['data-enable-auto-width']      = ! empty( $params['enable-auto-width'] ) ? $params['enable-auto-width'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-slider-padding']         = ! empty( $params['slider_padding'] ) ? $params['slider_padding'] : '';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';

		return $slider_data;
	}
	
	private function getGalleryImages( $params ) {
		$image_ids = array();
		$images    = array();
		$i         = 0;
		
		if ( $params['images'] !== '' ) {
			$image_ids = explode( ',', $params['images'] );
		}
		
		foreach ( $image_ids as $id ) {
			
			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['title']    = get_the_title( $id );
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
			
			$images[ $i ] = $image;
			$i ++;
		}
		
		return $images;
	}
	
	private function getImageSize( $image_size ) {
		$image_size = trim( $image_size );
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
			return $image_size;
		} elseif ( ! empty( $matches[0] ) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}
	
	private function getCustomLinks( $params ) {
		$custom_links = array();
		
		if ( ! empty( $params['custom_links'] ) ) {
			$custom_links = array_map( 'trim', explode( ',', $params['custom_links'] ) );
		}
		
		return $custom_links;
	}
}