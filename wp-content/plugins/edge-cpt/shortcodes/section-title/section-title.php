<?php
namespace EdgeCore\CPT\Shortcodes\SectionTitle;

use EdgeCore\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgt_section_title';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Section Title', 'edge-cpt' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'                      => 'icon-wpb-section-title extended-custom-icon',
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
							'heading'     => esc_html__( 'Type', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Standard', 'edge-cpt' )    => 'standard',
								esc_html__( 'Two Columns', 'edge-cpt' ) => 'two-columns'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_position',
							'heading'     => esc_html__( 'Title - Text Position', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Title Left - Text Right', 'edge-cpt' ) => 'title-left',
								esc_html__( 'Title Right - Text Left', 'edge-cpt' ) => 'title-right'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'two-columns' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'columns_space',
							'heading'     => esc_html__( 'Space Between Columns', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Normal', 'edge-cpt' ) => 'normal',
								esc_html__( 'Small', 'edge-cpt' )  => 'small',
								esc_html__( 'Tiny', 'edge-cpt' )   => 'tiny'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'two-columns' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'position',
							'heading'     => esc_html__( 'Horizontal Position', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Default', 'edge-cpt' ) => '',
                                esc_html__( 'Center', 'edge-cpt' )  => 'center',
								esc_html__( 'Left', 'edge-cpt' )    => 'left',
								esc_html__( 'Right', 'edge-cpt' )   => 'right'
							),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'standard' ) )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'holder_padding',
							'heading'    => esc_html__( 'Holder Side Padding (px or %)', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'edge-cpt' ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'edge-cpt' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'edge-cpt' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title Style', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_bold_words',
							'heading'     => esc_html__( 'Words with Bold Font Weight', 'edge-cpt' ),
							'description' => esc_html__( 'Enter the positions of the words you would like to display in a "bold" font weight. Separate the positions with commas (e.g. if you would like the first, second, and third word to have a light font weight, you would enter "1,2,3")', 'edge-cpt' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_light_words',
							'heading'     => esc_html__( 'Words with Light Font Weight', 'edge-cpt' ),
							'description' => esc_html__( 'Enter the positions of the words you would like to display in a "light" font weight. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a light font weight, you would enter "1,3,4")', 'edge-cpt' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title_break_words',
							'heading'     => esc_html__( 'Position of Line Break', 'edge-cpt' ),
							'description' => esc_html__( 'Enter the position of the word after which you would like to create a line break (e.g. if you would like the line break after the 3rd word, you would enter "3")', 'edge-cpt' ),
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'disable_break_words',
							'heading'     => esc_html__( 'Disable Line Break for Smaller Screens', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'edge-cpt' )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_tag',
							'heading'     => esc_html__( 'Text Tag', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'edge-cpt' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'edge-cpt' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'edge-cpt' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_font_size',
							'heading'    => esc_html__( 'Text Font Size (px)', 'edge-cpt' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'edge-cpt' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_line_height',
							'heading'    => esc_html__( 'Text Line Height (px)', 'edge-cpt' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_font_weight',
							'heading'     => esc_html__( 'Text Font Weight', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_font_weight_array( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'edge-cpt' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_margin',
							'heading'    => esc_html__( 'Text Top Margin (px)', 'edge-cpt' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'edge-cpt' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'type'                => 'standard',
			'title_position'      => 'title-left',
			'columns_space'       => 'normal',
			'position'            => 'center',
			'holder_padding'      => '',
			'title'               => '',
			'title_tag'           => 'h2',
			'title_color'         => '',
			'title_bold_words'    => '',
			'title_light_words'   => '',
			'title_break_words'   => '',
			'disable_break_words' => '',
			'text'                => '',
			'text_tag'            => 'p',
			'text_color'          => '#888',
			'text_font_size'      => '',
			'text_line_height'    => '',
			'text_font_weight'    => '',
			'text_margin'         => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['holder_styles']  = $this->getHolderStyles( $params );
		$params['title']          = $this->getModifiedTitle( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']   = $this->getTitleStyles( $params );
		$params['text_tag']       = ! empty( $params['text_tag'] ) ? $params['text_tag'] : $args['text_tag'];
		$params['text_styles']    = $this->getTextStyles( $params );
		
		$html = edgt_core_get_shortcode_module_template_part( 'templates/section-title', 'section-title', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'edgt-st-' . $params['type'] : 'edgt-st-' . $args['type'];
		$holderClasses[] = ! empty( $params['title_position'] ) ? 'edgt-st-' . $params['title_position'] : 'edgt-st-' . $args['title_position'];
		$holderClasses[] = ! empty( $params['columns_space'] ) ? 'edgt-st-' . $params['columns_space'] . '-space' : 'edgt-st-' . $args['columns_space'] . '-space';
		$holderClasses[] = $params['disable_break_words'] === 'yes' ? 'edgt-st-disable-title-break' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['holder_padding'] ) ) {
			$styles[] = 'padding: 0 ' . $params['holder_padding'];
		}
		
		if ( ! empty( $params['position'] ) ) {
			$styles[] = 'text-align: ' . $params['position'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getModifiedTitle( $params ) {
		$title             = $params['title'];
		$title_bold_words  = str_replace( ' ', '', $params['title_bold_words'] );
		$title_light_words = str_replace( ' ', '', $params['title_light_words'] );
		$title_break_words = str_replace( ' ', '', $params['title_break_words'] );
		
		if ( ! empty( $title ) ) {
			$bold_words  = explode( ',', $title_bold_words );
			$light_words = explode( ',', $title_light_words );
			$split_title = explode( ' ', $title );
			
			if ( ! empty( $title_bold_words ) ) {
				foreach ( $bold_words as $value ) {
					if ( ! empty( $split_title[ $value - 1 ] ) ) {
						$split_title[ $value - 1 ] = '<span class="edgt-st-title-bold">' . $split_title[ $value - 1 ] . '</span>';
					}
				}
			}
			
			if ( ! empty( $title_light_words ) ) {
				foreach ( $light_words as $value ) {
					if ( ! empty( $split_title[ $value - 1 ] ) ) {
						$split_title[ $value - 1 ] = '<span class="edgt-st-title-light">' . $split_title[ $value - 1 ] . '</span>';
					}
				}
			}
			
			if ( ! empty( $title_break_words ) ) {
				if ( ! empty( $split_title[ $title_break_words - 1 ] ) ) {
					$split_title[ $title_break_words - 1 ] = $split_title[ $title_break_words - 1 ] . '<br />';
				}
			}
			
			$title = implode( ' ', $split_title );
		}
		
		return $title;
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( ! empty( $params['text_font_size'] ) ) {
			$styles[] = 'font-size: ' . educator_edge_filter_px( $params['text_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['text_line_height'] ) ) {
			$styles[] = 'line-height: ' . educator_edge_filter_px( $params['text_line_height'] ) . 'px';
		}
		
		if ( ! empty( $params['text_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['text_font_weight'];
		}
		
		if ( $params['text_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . educator_edge_filter_px( $params['text_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}