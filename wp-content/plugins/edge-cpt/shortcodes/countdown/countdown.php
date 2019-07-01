<?php
namespace EdgeCore\CPT\Shortcodes\Countdown;

use EdgeCore\Lib;

class Countdown implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgt_countdown';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Countdown', 'edge-cpt' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'                      => 'icon-wpb-countdown extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'edge-cpt' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-cpt' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'type',
							'heading'    => esc_html__( 'Type', 'edge-cpt' ),
							'value'      => array(
								esc_html__( 'Period Below', 'edge-cpt' ) => 'edgt-below',
								esc_html__( 'Period on the right', 'edge-cpt' )    => 'edgt-inline',
							)
						),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'text_align',
                            'heading'    => esc_html__( 'Text Align', 'edge-cpt' ),
                            'value'      => array(
                                esc_html__( 'Default', 'edge-cpt' ) => '',
                                esc_html__( 'Left', 'edge-cpt' )    => 'text-align-left',
                            ),
                            'dependency' => array(
                                'element' => 'type', 'value' => 'edgt-below'
                            )
                        ),
						array(
							'type'       => 'dropdown',
							'param_name' => 'skin',
							'heading'    => esc_html__( 'Skin', 'edge-cpt' ),
							'value'      => array(
								esc_html__( 'Default', 'edge-cpt' ) => 'edgt-default-skin',
								esc_html__( 'Dark', 'edge-cpt' )    => 'edgt-dark-skin',
								esc_html__( 'Light', 'edge-cpt' )   => 'edgt-light-skin',
							)
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'year',
							'heading'     => esc_html__( 'Year', 'edge-cpt' ),
							'value'       => array(
								'2017' => '2017',
								'2018' => '2018',
								'2019' => '2019',
								'2020' => '2020',
								'2021' => '2021',
								'2022' => '2022'
							),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'month',
							'heading'     => esc_html__( 'Month', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'January', 'edge-cpt' )   => '1',
								esc_html__( 'February', 'edge-cpt' )  => '2',
								esc_html__( 'March', 'edge-cpt' )     => '3',
								esc_html__( 'April', 'edge-cpt' )     => '4',
								esc_html__( 'May', 'edge-cpt' )       => '5',
								esc_html__( 'June', 'edge-cpt' )      => '6',
								esc_html__( 'July', 'edge-cpt' )      => '7',
								esc_html__( 'August', 'edge-cpt' )    => '8',
								esc_html__( 'September', 'edge-cpt' ) => '9',
								esc_html__( 'October', 'edge-cpt' )   => '10',
								esc_html__( 'November', 'edge-cpt' )  => '11',
								esc_html__( 'December', 'edge-cpt' )  => '12'
							),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'day',
							'heading'     => esc_html__( 'Day', 'edge-cpt' ),
							'value'       => array(
								'1'  => '1',
								'2'  => '2',
								'3'  => '3',
								'4'  => '4',
								'5'  => '5',
								'6'  => '6',
								'7'  => '7',
								'8'  => '8',
								'9'  => '9',
								'10' => '10',
								'11' => '11',
								'12' => '12',
								'13' => '13',
								'14' => '14',
								'15' => '15',
								'16' => '16',
								'17' => '17',
								'18' => '18',
								'19' => '19',
								'20' => '20',
								'21' => '21',
								'22' => '22',
								'23' => '23',
								'24' => '24',
								'25' => '25',
								'26' => '26',
								'27' => '27',
								'28' => '28',
								'29' => '29',
								'30' => '30',
								'31' => '31',
							),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'hour',
							'heading'     => esc_html__( 'Hour', 'edge-cpt' ),
							'value'       => array(
								'0'  => '0',
								'1'  => '1',
								'2'  => '2',
								'3'  => '3',
								'4'  => '4',
								'5'  => '5',
								'6'  => '6',
								'7'  => '7',
								'8'  => '8',
								'9'  => '9',
								'10' => '10',
								'11' => '11',
								'12' => '12',
								'13' => '13',
								'14' => '14',
								'15' => '15',
								'16' => '16',
								'17' => '17',
								'18' => '18',
								'19' => '19',
								'20' => '20',
								'21' => '21',
								'22' => '22',
								'23' => '23',
								'24' => '24'
							),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'minute',
							'heading'     => esc_html__( 'Minute', 'edge-cpt' ),
							'value'       => array(
								'0'  => '0',
								'1'  => '1',
								'2'  => '2',
								'3'  => '3',
								'4'  => '4',
								'5'  => '5',
								'6'  => '6',
								'7'  => '7',
								'8'  => '8',
								'9'  => '9',
								'10' => '10',
								'11' => '11',
								'12' => '12',
								'13' => '13',
								'14' => '14',
								'15' => '15',
								'16' => '16',
								'17' => '17',
								'18' => '18',
								'19' => '19',
								'20' => '20',
								'21' => '21',
								'22' => '22',
								'23' => '23',
								'24' => '24',
								'25' => '25',
								'26' => '26',
								'27' => '27',
								'28' => '28',
								'29' => '29',
								'30' => '30',
								'31' => '31',
								'32' => '32',
								'33' => '33',
								'34' => '34',
								'35' => '35',
								'36' => '36',
								'37' => '37',
								'38' => '38',
								'39' => '39',
								'40' => '40',
								'41' => '41',
								'42' => '42',
								'43' => '43',
								'44' => '44',
								'45' => '45',
								'46' => '46',
								'47' => '47',
								'48' => '48',
								'49' => '49',
								'50' => '50',
								'51' => '51',
								'52' => '52',
								'53' => '53',
								'54' => '54',
								'55' => '55',
								'56' => '56',
								'57' => '57',
								'58' => '58',
								'59' => '59',
								'60' => '60',
							),
							'admin_label' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'month_label',
							'heading'    => esc_html__( 'Month Label', 'edge-cpt' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'day_label',
							'heading'    => esc_html__( 'Day Label', 'edge-cpt' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'hour_label',
							'heading'    => esc_html__( 'Hour Label', 'edge-cpt' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'minute_label',
							'heading'    => esc_html__( 'Minute Label', 'edge-cpt' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'second_label',
							'heading'    => esc_html__( 'Second Label', 'edge-cpt' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'digit_font_size',
							'heading'    => esc_html__( 'Digit Font Size (px)', 'edge-cpt' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'label_font_size',
							'heading'    => esc_html__( 'Label Font Size (px)', 'edge-cpt' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'    => '',
			'type'            => '',
			'text_align'      => '',
			'skin'            => '',
			'year'            => '2017',
			'month'           => '',
			'day'             => '',
			'hour'            => '',
			'minute'          => '',
			'month_label'     => 'Months',
			'day_label'       => 'Days',
			'hour_label'      => 'Hours',
			'minute_label'    => 'Minutes',
			'second_label'    => 'Seconds',
			'digit_font_size' => '',
			'label_font_size' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['id']             = mt_rand( 1000, 9999 );
		$params['holder_classes'] = $this->getHolderClasses( $params );
		
		$html = edgt_core_get_shortcode_module_template_part( 'templates/countdown', 'countdown', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();

		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['skin'] ) ? $params['skin'] : '';
		$holderClasses[] = ! empty( $params['type'] ) ? $params['type'] : '';
		$holderClasses[] = $params['text_align'];

		return implode( ' ', $holderClasses );
	}
}