<?php

if(!function_exists('educator_edge_timetable_assets')) {
	/**
	 * Loads all assets for timetable plugin
	 */
	function educator_edge_timetable_assets() {

	}

	add_action('wp_enqueue_scripts', 'educator_edge_timetable_assets', 20);
}

if(!function_exists('educator_edge_timetable_style_dynamic_deps')) {
	/**
	 * Adds dependency for style dynamic css file
	 *
	 * @param $deps
	 *
	 * @return array
	 */
	function educator_edge_timetable_style_dynamic_deps($deps) {
		$deps[] = 'educator_edge_timetable';

		return $deps;
	}

	add_filter('educator_edge_style_dynamic_dependencies', 'educator_edge_timetable_style_dynamic_deps');
}

if(!function_exists('educator_edge_tt_event_single_content')) {
	/**
	 * Loads timetable single event page
	 */
	function educator_edge_tt_event_single_content() {
		$id = get_the_ID();

		$subtitle = get_post_meta($id, 'timetable_subtitle', true);

		$params = array(
			'subtitle' => $subtitle
		);


		educator_edge_get_module_template_part('templates/events-single', 'timetable-schedule', '', $params);
	}
}

if(!function_exists('educator_edge_tt_events_single_default_sidebar')) {
	/**
	 * Sets default sidebar for timetable single event event
	 *
	 * @param $sidebar
	 *
	 * @return string
	 */
	function educator_edge_tt_events_single_default_sidebar($sidebar) {
		$id      = educator_edge_get_page_id();

		if(get_post_type($id) === 'tt-events') {
			$sidebar = 'sidebar-event';

			if(get_post_meta($id, 'edgt_custom_sidebar_meta', true) != '') {
				$sidebar = get_post_meta($id, 'edgt_custom_sidebar_meta', true);
			}
		}

		return $sidebar;
	}

	add_filter('educator_edge_sidebar', 'educator_edge_tt_events_single_default_sidebar');
}

