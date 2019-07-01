<?php

if ( ! function_exists('edgt_lms_course_options_map') ) {
	function edgt_lms_course_options_map() {

		educator_edge_add_admin_page(array(
			'slug'  => '_course',
			'title' => esc_html__('Course', 'edge-lms'),
			'icon'  => 'fa fa-book'
		));

		$panel_archive = educator_edge_add_admin_panel(array(
			'title' => esc_html__('Course Archive', 'edge-lms'),
			'name'  => 'panel_course_archive',
			'page'  => '_course'
		));

		educator_edge_add_admin_field(array(
			'name'        => 'course_archive_number_of_items',
			'type'        => 'text',
			'label'       => esc_html__('Number of Items', 'edge-lms'),
			'description' => esc_html__('Set number of items for your course list on archive pages. Default value is 12', 'edge-lms'),
			'parent'      => $panel_archive,
			'args'        => array(
				'col_width' => 3
			)
		));

		educator_edge_add_admin_field(array(
			'name'        => 'course_archive_number_of_columns',
			'type'        => 'select',
			'label'       => esc_html__('Number of Columns', 'edge-lms'),
			'default_value' => '4',
			'description' => esc_html__('Set number of columns for your course list on archive pages. Default value is 4 columns', 'edge-lms'),
			'parent'      => $panel_archive,
			'options'     => array(
				'2' => esc_html__('2 Columns', 'edge-lms'),
				'3' => esc_html__('3 Columns', 'edge-lms'),
				'4' => esc_html__('4 Columns', 'edge-lms'),
				'5' => esc_html__('5 Columns', 'edge-lms')
			)
		));

		educator_edge_add_admin_field(array(
			'name'        => 'course_archive_space_between_items',
			'type'        => 'select',
			'label'       => esc_html__('Space Between Items', 'edge-lms'),
			'default_value' => 'normal',
			'description' => esc_html__('Set space size between course items for your course list on archive pages. Default value is normal', 'edge-lms'),
			'parent'      => $panel_archive,
			'options'     => array(
				'normal'    => esc_html__('Normal', 'edge-lms'),
				'small'     => esc_html__('Small', 'edge-lms'),
				'tiny'      => esc_html__('Tiny', 'edge-lms'),
				'no'        => esc_html__('No Space', 'edge-lms')
			)
		));

		educator_edge_add_admin_field(array(
			'name'        => 'course_archive_image_size',
			'type'        => 'select',
			'label'       => esc_html__('Image Proportions', 'edge-lms'),
			'default_value' => 'landscape',
			'description' => esc_html__('Set image proportions for your course list on archive pages. Default value is landscape', 'edge-lms'),
			'parent'      => $panel_archive,
			'options'     => array(
				'full'      => esc_html__('Original', 'edge-lms'),
				'landscape' => esc_html__('Landscape', 'edge-lms'),
				'portrait'  => esc_html__('Portrait', 'edge-lms'),
				'square'    => esc_html__('Square', 'edge-lms')
			)
		));

		$panel = educator_edge_add_admin_panel(array(
			'title' => esc_html__('Course Single', 'edge-lms'),
			'name'  => 'panel_course_single',
			'page'  => '_course'
		));
		
		educator_edge_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_course_single',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'edge-lms'),
				'description' => esc_html__('Enabling this option will show title area on single courses', 'edge-lms'),
				'parent'      => $panel,
                'options' => array(
                    '' => esc_html__('Default', 'edge-lms'),
                    'yes' => esc_html__('Yes', 'edge-lms'),
                    'no' => esc_html__('No', 'edge-lms')
                ),
				'args' => array(
					'col_width' => 3
				)
			)
		);

		educator_edge_add_admin_field(array(
			'name'          => 'course_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments', 'edge-lms'),
			'description'   => esc_html__('Enabling this option will show comments on your page', 'edge-lms'),
			'parent'        => $panel,
			'default_value' => 'yes'
		));

		educator_edge_add_admin_field(array(
			'name'        => 'course_single_slug',
			'type'        => 'text',
			'label'       => esc_html__('Course Single Slug', 'edge-lms'),
			'description' => esc_html__('Enter if you wish to use a different Single Course slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'edge-lms'),
			'parent'      => $panel,
			'args'        => array(
				'col_width' => 3
			)
		));
	}

	add_action( 'educator_edge_options_map', 'edgt_lms_course_options_map', 22);
}