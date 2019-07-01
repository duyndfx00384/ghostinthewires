<?php
if(!function_exists('educator_edge_events_style_dynamic_deps')) {
	/**
	 * Adds Events Calendar styles to deps array for style dynamic
	 * @param $deps
	 *
	 * @return array
	 */
	function educator_edge_events_style_dynamic_deps($deps) {
		$deps[] = 'educator_edge_events_calendar';

	    return $deps;
    }

	add_filter('educator_edge_style_dynamic_dependencies', 'educator_edge_events_style_dynamic_deps');
}

if ( ! function_exists( 'educator_edge_get_events_shortcode_module_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $module name of the module folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 * @see educator_edge_get_template_part()
	 */
	function educator_edge_get_events_shortcode_module_template_part( $template, $module, $slug = '', $params = array() ) {

		//HTML Content from template
		$html          = '';
		$template_path = 'framework/modules/events/shortcodes/' . $module;

		$temp = $template_path . '/' . $template;

		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		$templates = array();

		if ( $temp !== '' ) {
			if ( $slug !== '' ) {
				$templates[] = "{$temp}-{$slug}.php";
			}

			$templates[] = $temp . '.php';
		}
		$located = educator_edge_find_template_path( $templates );
		if ( $located ) {
			ob_start();
			include( $located );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if(!function_exists('educator_edge_events_deregister_theme_map_script')) {
	/**
	 * Deregisters theme's google map api script when on single event page or on calendar page
	 */
	function educator_edge_events_deregister_theme_map_script() {
		if(tribe_is_event() || is_post_type_archive('tribe_events')) {
			wp_dequeue_script('google_map_api');
		}
    }

	add_action('wp_enqueue_scripts', 'educator_edge_events_deregister_theme_map_script');
}



if(!function_exists('educator_edge_events_archive_title_text')) {
	/**
	 * Hooks to title text filter and alters it for events calendar page
	 * @param $text
	 *
	 * @return string
	 */
	function educator_edge_events_archive_title_text($text) {
	    if(is_post_type_archive('tribe_events')) {
		    $text = esc_html__('Events Calendar', 'educator');
	    }

        return $text;
    }

	add_filter('educator_edge_title_text', 'educator_edge_events_archive_title_text');
}

if(!function_exists('educator_edge_events_tooltip_image')) {
	/**
	 * Hooks to tribe_events_template_data_array and changes tooltip image size
	 * @param $json
	 * @param $event
	 *
	 * @return mixed
	 */
	function educator_edge_events_tooltip_image($json, $event) {
		if(isset($json['imageTooltipSrc'])) {
			$image_tool_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'medium' );
			$image_tool_src = $image_tool_arr[0];

			$json['imageTooltipSrc'] = $image_tool_src;
		}

	    return $json;
    }

	add_filter('tribe_events_template_data_array', 'educator_edge_events_tooltip_image', 10, 2);
}