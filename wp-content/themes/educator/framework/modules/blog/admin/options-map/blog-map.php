<?php

if ( ! function_exists( 'educator_edge_get_blog_list_types_options' ) ) {
	function educator_edge_get_blog_list_types_options() {
		$blog_list_type_options = apply_filters( 'educator_edge_blog_list_type_global_option', $blog_list_type_options = array() );
		
		return $blog_list_type_options;
	}
}

if ( ! function_exists('educator_edge_blog_options_map') ) {
	function educator_edge_blog_options_map() {
		$blog_list_type_options = educator_edge_get_blog_list_types_options();
		
		educator_edge_add_admin_page(
			array(
				'slug' => '_blog_page',
				'title' => esc_html__('Blog', 'educator'),
				'icon' => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */
		$panel_blog_lists = educator_edge_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_lists',
				'title' => esc_html__('Blog Lists', 'educator')
			)
		);

		educator_edge_add_admin_field(array(
			'name'        => 'blog_list_type',
			'type'        => 'select',
			'label'       => esc_html__('Blog Layout for Archive Pages', 'educator'),
			'description' => esc_html__('Choose a default blog layout for archived blog post lists', 'educator'),
			'default_value' => 'standard',
			'parent'      => $panel_blog_lists,
			'options'     => $blog_list_type_options
		));

		educator_edge_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout for Archive Pages', 'educator'),
			'description' => esc_html__('Choose a sidebar layout for archived blog post lists', 'educator'),
			'default_value' => '',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				''		            => esc_html__('Default', 'educator'),
				'no-sidebar'		=> esc_html__('No Sidebar', 'educator'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'educator'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'educator'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'educator'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'educator')
			)
		));
		
		$educator_custom_sidebars = educator_edge_get_custom_sidebars();
		if(count($educator_custom_sidebars) > 0) {
			educator_edge_add_admin_field(array(
				'name' => 'archive_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display for Archive Pages', 'educator'),
				'description' => esc_html__('Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'educator'),
				'parent' => $panel_blog_lists,
				'options' => educator_edge_get_custom_sidebars(),
				'args'        => array(
					'select2'	=> true
				)
			));
		}

        educator_edge_add_admin_field(array(
            'name'        => 'blog_masonry_layout',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Layout', 'educator'),
            'default_value' => 'in-grid',
            'description' => esc_html__('Set masonry layout. Default is in grid.', 'educator'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'in-grid'    => esc_html__('In Grid', 'educator'),
                'full-width' => esc_html__('Full Width', 'educator')
            )
        ));
		
		educator_edge_add_admin_field(array(
			'name'        => 'blog_masonry_number_of_columns',
			'type'        => 'select',
			'label'       => esc_html__('Masonry - Number of Columns', 'educator'),
			'default_value' => 'three',
			'description' => esc_html__('Set number of columns for your masonry blog lists. Default value is 4 columns', 'educator'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'two'   => esc_html__('2 Columns', 'educator'),
				'three' => esc_html__('3 Columns', 'educator'),
				'four'  => esc_html__('4 Columns', 'educator'),
				'five'  => esc_html__('5 Columns', 'educator')
			)
		));
		
		educator_edge_add_admin_field(array(
			'name'        => 'blog_masonry_space_between_items',
			'type'        => 'select',
			'label'       => esc_html__('Masonry - Space Between Items', 'educator'),
			'default_value' => 'normal',
			'description' => esc_html__('Set space size between posts for your masonry blog lists. Default value is normal', 'educator'),
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'normal'  => esc_html__('Normal', 'educator'),
                'large'   => esc_html__('Large', 'educator'),
				'small'   => esc_html__('Small', 'educator'),
				'tiny'    => esc_html__('Tiny', 'educator'),
				'no'      => esc_html__('No Space', 'educator')
			)
		));

        educator_edge_add_admin_field(array(
            'name'        => 'blog_list_featured_image_proportion',
            'type'        => 'select',
            'label'       => esc_html__('Masonry - Featured Image Proportion', 'educator'),
            'default_value' => 'fixed',
            'description' => esc_html__('Choose type of proportions you want to use for featured images on masonry blog lists', 'educator'),
            'parent'      => $panel_blog_lists,
            'options'     => array(
                'fixed'    => esc_html__('Fixed', 'educator'),
                'original' => esc_html__('Original', 'educator')
            )
        ));

		educator_edge_add_admin_field(array(
			'name'        => 'blog_pagination_type',
			'type'        => 'select',
			'label'       => esc_html__('Pagination Type', 'educator'),
			'description' => esc_html__('Choose a pagination layout for Blog Lists', 'educator'),
			'parent'      => $panel_blog_lists,
			'default_value' => 'standard',
			'options'     => array(
				'standard'		  => esc_html__('Standard', 'educator'),
				'load-more'		  => esc_html__('Load More', 'educator'),
				'infinite-scroll' => esc_html__('Infinite Scroll', 'educator'),
				'no-pagination'   => esc_html__('No Pagination', 'educator')
			)
		));
	
		educator_edge_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'number_of_chars',
				'default_value' => '40',
				'label' => esc_html__('Number of Words in Excerpt', 'educator'),
				'description' => esc_html__('Enter a number of words in excerpt (article summary). Default value is 40', 'educator'),
				'parent' => $panel_blog_lists,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		/**
		 * Blog Single
		 */
		$panel_blog_single = educator_edge_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_single',
				'title' => esc_html__('Blog Single', 'educator')
			)
		);

		educator_edge_add_admin_field(array(
			'name'        => 'blog_single_sidebar_layout',
			'type'        => 'select',
			'label'       => esc_html__('Sidebar Layout', 'educator'),
			'description' => esc_html__('Choose a sidebar layout for Blog Single pages', 'educator'),
			'default_value'	=> '',
			'parent'      => $panel_blog_single,
			'options'     => array(
				''		            => esc_html__('Default', 'educator'),
				'no-sidebar'		=> esc_html__('No Sidebar', 'educator'),
				'sidebar-33-right'	=> esc_html__('Sidebar 1/3 Right', 'educator'),
				'sidebar-25-right' 	=> esc_html__('Sidebar 1/4 Right', 'educator'),
				'sidebar-33-left' 	=> esc_html__('Sidebar 1/3 Left', 'educator'),
				'sidebar-25-left' 	=> esc_html__('Sidebar 1/4 Left', 'educator')
			)
		));

		if(count($educator_custom_sidebars) > 0) {
			educator_edge_add_admin_field(array(
				'name' => 'blog_single_custom_sidebar_area',
				'type' => 'selectblank',
				'label' => esc_html__('Sidebar to Display', 'educator'),
				'description' => esc_html__('Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'educator'),
				'parent' => $panel_blog_single,
				'options' => educator_edge_get_custom_sidebars(),
				'args'        => array(
					'select2'	=> true
				)
			));
		}
		
		educator_edge_add_admin_field(
			array(
				'type' => 'select',
				'name' => 'show_title_area_blog',
				'default_value' => '',
				'label'       => esc_html__('Show Title Area', 'educator'),
				'description' => esc_html__('Enabling this option will show title area on single post pages', 'educator'),
				'parent'      => $panel_blog_single,
				'options'     => educator_edge_get_yes_no_select_array(false, false),
				'args' => array(
					'col_width' => 3
				)
			)
		);

        educator_edge_add_admin_field(array(
            'name'          => 'blog_single_title',
            'type'          => 'yesno',
            'label'         => esc_html__('Show Blog Title In Title Area', 'educator'),
            'description'   => esc_html__('Enabling this option will show blog title in title area on single post pages', 'educator'),
            'parent'        => $panel_blog_single,
            'default_value' => 'yes',
            'args' => array(
                'dependence' => true,
                'dependence_hide_on_yes' => '',
                'dependence_show_on_yes' => '#edgt_edgt_blog_single_title_container'
            )
        ));

        $blog_single_title_container = educator_edge_add_admin_container(
            array(
                'name' => 'edgt_blog_single_title_container',
                'hidden_property' => 'blog_single_title',
                'hidden_value' => 'no',
                'parent' => $panel_blog_single,
            )
        );

		educator_edge_add_admin_field(array(
			'name'          => 'blog_single_title_in_title_area',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Post Title in Title Area', 'educator'),
			'description'   => esc_html__('Enabling this option will show post title in title area on single post pages', 'educator'),
			'parent'        => $blog_single_title_container,
			'default_value' => 'no',
		));

		educator_edge_add_admin_field(array(
			'name'			=> 'blog_single_related_posts',
			'type'			=> 'yesno',
			'label'			=> esc_html__('Show Related Posts', 'educator'),
			'description'   => esc_html__('Enabling this option will show related posts on single post pages', 'educator'),
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		educator_edge_add_admin_field(array(
			'name'          => 'blog_single_comments',
			'type'          => 'yesno',
			'label'         => esc_html__('Show Comments Form', 'educator'),
			'description'   => esc_html__('Enabling this option will show comments form on single post pages', 'educator'),
			'parent'        => $panel_blog_single,
			'default_value' => 'yes'
		));

		educator_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_navigation',
				'default_value' => 'yes',
				'label' => esc_html__('Enable Prev/Next Single Post Navigation Links', 'educator'),
				'description' => esc_html__('Enable navigation links through the blog posts (left and right arrows will appear)', 'educator'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgt_edgt_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = educator_edge_add_admin_container(
			array(
				'name' => 'edgt_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		educator_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'       => esc_html__('Enable Navigation Only in Current Category', 'educator'),
				'description' => esc_html__('Limit your navigation only through current category', 'educator'),
				'parent'      => $blog_single_navigation_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		educator_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_author_info',
				'default_value' => 'yes',
				'label' => esc_html__('Show Author Info Box', 'educator'),
				'description' => esc_html__('Enabling this option will display author name and descriptions on single post pages', 'educator'),
				'parent' => $panel_blog_single,
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgt_edgt_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = educator_edge_add_admin_container(
			array(
				'name' => 'edgt_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		educator_edge_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_author_info_email',
				'default_value' => 'no',
				'label'       => esc_html__('Show Author Email', 'educator'),
				'description' => esc_html__('Enabling this option will show author email', 'educator'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		educator_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'       => esc_html__('Show Author Social Icons', 'educator'),
				'description' => esc_html__('Enabling this option will show author social icons on single post pages', 'educator'),
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);
	}

	add_action( 'educator_edge_options_map', 'educator_edge_blog_options_map', 13);
}