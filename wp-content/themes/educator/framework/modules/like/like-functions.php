<?php

if ( ! function_exists('educator_edge_like') ) {
	/**
	 * Returns EducatorEdgeLike instance
	 *
	 * @return EducatorEdgeLike
	 */
	function educator_edge_like() {
		return EducatorEdgeLike::get_instance();
	}
}

function educator_edge_get_like() {

	echo wp_kses(educator_edge_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'i' => array(
			'class' => true,
			'style' => true,
			'id' => true
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}