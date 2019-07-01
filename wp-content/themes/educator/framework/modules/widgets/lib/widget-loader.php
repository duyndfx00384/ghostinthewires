<?php

if (!function_exists('educator_edge_register_widgets')) {
	function educator_edge_register_widgets() {
		$widgets = apply_filters('educator_edge_register_widgets', $widgets = array());

		foreach ($widgets as $widget) {
			register_widget($widget);
		}
	}
	
	add_action('widgets_init', 'educator_edge_register_widgets');
}