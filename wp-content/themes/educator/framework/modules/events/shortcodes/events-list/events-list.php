<?php
namespace EdgeCore\CPT\Shortcodes\EventsList;

use EdgeCore\CPT\Shortcodes\EventsList\EventsQuery\EventsQuery;
use EdgeCore\Lib;

class EventsList implements Lib\ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'edgt_events_list';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
				'name'                      => 'Edge Events List',
				'base'                      => $this->getBase(),
				'category'                  => 'by EDGE',
				'icon'                      => 'icon-wpb-events-list extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params'                    => array_merge(
					array(
						array(
							'type'        => 'dropdown',
							'heading'     => esc_html__('Number of Columns', 'educator'),
							'param_name'  => 'columns',
							'value'       => array(
								''      => '',
								esc_html__('One', 'educator')   => 'one',
                                esc_html__('Two', 'educator')   => 'two',
								esc_html__('Three', 'educator') => 'three',
								esc_html__('Four', 'educator')  => 'four',
								esc_html__('Five', 'educator')  => 'five',
								esc_html__('Six', 'educator')   => 'six'
							),
							'admin_label' => true,
							'description' => esc_html__('Default value is Three', 'educator'),
							'group'       => esc_html__('Layout Options', 'educator')
						),
						array(
							'type'        => 'dropdown',
							'heading'     => esc_html__('Image Proportions', 'educator'),
							'param_name'  => 'image_size',
							'value'       => array(
                                esc_html__('Original', 'educator')  => 'full',
								esc_html__('Square', 'educator')    => 'square',
								esc_html__('Landscape', 'educator') => 'landscape',
								esc_html__('Portrait', 'educator')  => 'portrait'
							),
							'save_always' => true,
							'admin_label' => true,
							'description' => '',
							'group'       => esc_html__('Layout Options', 'educator')
						),
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Date Skin', 'educator'),
                            'param_name'  => 'date_skin',
                            'value'       => array(
                                esc_html__('Default', 'educator') => '',
                                esc_html__('Light', 'educator') => 'edgt-events-light-date-skin'
                            ),
                            'save_always' => true,
                            'admin_label' => true,
                            'group'       => esc_html__('Layout Options', 'educator')
                        ),
					),
					EventsQuery::getInstance()->queryVCParams()
				)
			)
		);
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'columns'    => '',
			'image_size' => '',
            'date_skin'  => ''
		);

		$eventsQuery = EventsQuery::getInstance();
		
		$default_atts = array_merge($default_atts, $eventsQuery->getShortcodeAtts());
		$params       = shortcode_atts($default_atts, $atts);

		$queryResults = $eventsQuery->buildQueryObject($params);

		$params['query']  = $queryResults;
		$params['caller'] = $this;

		$itemClass[] = 'edgt-events-list-item';
        $itemClass[] = $params['date_skin'];

		switch($params['columns']) {
			case 'one':
				$itemClass[] = 'edgt-grid-col-12';
				break;
			case 'two':
				$itemClass[] = 'edgt-grid-col-6';
				break;
			case 'three':
				$itemClass[] = 'edgt-grid-col-4';
				break;
			case 'four':
				$itemClass[] = 'edgt-grid-col-3';
				$itemClass[] = 'edgt-grid-col-ipad-landscape-6';
				$itemClass[] = 'edgt-grid-col-ipad-portrait-12';
				break;
			default:
				$itemClass[] = 'edgt-grid-col-4';
				break;
		}

		$params['item_class'] = implode(' ', $itemClass);

		$params['image_size'] = $this->getImageSize($params);

		return educator_edge_get_events_shortcode_module_template_part('templates/events-list-holder', 'events-list', '', $params);
	}

	public function getEventItemTemplate($params) {
		echo educator_edge_get_events_shortcode_module_template_part('templates/events-list-item', 'events-list', '', $params);
	}

	private function getImageSize($params) {

		if(!empty($params['image_size'])) {
			$image_size = $params['image_size'];

			switch($image_size) {
				case 'landscape':
					$thumb_size = 'educator_edge_landscape';
					break;
				case 'portrait':
					$thumb_size = 'educator_edge_portrait';
					break;
				case 'square':
					$thumb_size = 'educator_edge_square';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
				case 'custom':
					$thumb_size = 'custom';
					break;
				default:
					$thumb_size = 'full';
					break;
			}

			return $thumb_size;
		}
	}
}