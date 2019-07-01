<?php

if ( ! function_exists('educator_edge_sidearea_options_map') ) {

	function educator_edge_sidearea_options_map() {

		educator_edge_add_admin_page(
			array(
				'slug' => '_side_area_page',
				'title' => esc_html__('Side Area', 'educator'),
				'icon' => 'fa fa-indent'
			)
		);

		$side_area_panel = educator_edge_add_admin_panel(
			array(
				'title' => esc_html__('Side Area', 'educator'),
				'name' => 'side_area',
				'page' => '_side_area_page'
			)
		);

		$side_area_icon_style_group = educator_edge_add_admin_group(
			array(
				'parent' => $side_area_panel,
				'name' => 'side_area_icon_style_group',
				'title' => esc_html__('Side Area Icon Style', 'educator'),
				'description' => esc_html__('Define styles for Side Area icon', 'educator')
			)
		);

		$side_area_icon_style_row1 = educator_edge_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row1'
			)
		);

		educator_edge_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_color',
				'label' => esc_html__('Color', 'educator')
			)
		);

		educator_edge_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row1,
				'type' => 'colorsimple',
				'name' => 'side_area_icon_hover_color',
				'label' => esc_html__('Hover Color', 'educator')
			)
		);

		$side_area_icon_style_row2 = educator_edge_add_admin_row(
			array(
				'parent'	=> $side_area_icon_style_group,
				'name'		=> 'side_area_icon_style_row2',
				'next'		=> true
			)
		);

		educator_edge_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_color',
				'label' => esc_html__('Close Icon Color', 'educator')
			)
		);

		educator_edge_add_admin_field(
			array(
				'parent' => $side_area_icon_style_row2,
				'type' => 'colorsimple',
				'name' => 'side_area_close_icon_hover_color',
				'label' => esc_html__('Close Icon Hover Color', 'educator')
			)
		);

		educator_edge_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_width',
				'default_value' => '',
				'label' => esc_html__('Side Area Width', 'educator'),
				'description' => esc_html__('Enter a width for Side Area', 'educator'),
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		educator_edge_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'color',
				'name' => 'side_area_background_color',
				'label' => esc_html__('Background Color', 'educator'),
				'description' => esc_html__('Choose a background color for Side Area', 'educator')
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'text',
				'name' => 'side_area_padding',
				'label' => esc_html__('Padding', 'educator'),
				'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'educator'),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		educator_edge_add_admin_field(
			array(
				'parent' => $side_area_panel,
				'type' => 'selectblank',
				'name' => 'side_area_aligment',
				'default_value' => '',
				'label' => esc_html__('Text Alignment', 'educator'),
				'description' => esc_html__('Choose text alignment for side area', 'educator'),
				'options' => array(
					'' => esc_html__('Default', 'educator'),
					'left' => esc_html__('Left', 'educator'),
					'center' => esc_html__('Center', 'educator'),
					'right' => esc_html__('Right', 'educator')
				)
			)
		);
	}

	add_action('educator_edge_options_map', 'educator_edge_sidearea_options_map', 15);
}