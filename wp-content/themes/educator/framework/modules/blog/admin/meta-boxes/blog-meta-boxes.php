<?php

foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'educator_edge_map_blog_meta' ) ) {
	function educator_edge_map_blog_meta() {
		$edgt_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$edgt_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = educator_edge_add_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'educator' ),
				'name'  => 'blog_meta'
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'educator' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'educator' ),
				'parent'      => $blog_meta_box,
				'options'     => $edgt_blog_categories
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'educator' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'educator' ),
				'parent'      => $blog_meta_box,
				'options'     => $edgt_blog_categories,
				'args'        => array( "col_width" => 3 )
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'educator' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'educator' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'educator' ),
					'in-grid'    => esc_html__( 'In Grid', 'educator' ),
					'full-width' => esc_html__( 'Full Width', 'educator' )
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'educator' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'educator' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''      => esc_html__( 'Default', 'educator' ),
					'two'   => esc_html__( '2 Columns', 'educator' ),
					'three' => esc_html__( '3 Columns', 'educator' ),
					'four'  => esc_html__( '4 Columns', 'educator' ),
					'five'  => esc_html__( '5 Columns', 'educator' )
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'educator' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'educator' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''       => esc_html__( 'Default', 'educator' ),
                    'large'   => esc_html__('Large', 'educator'),
					'normal' => esc_html__( 'Normal', 'educator' ),
					'small'  => esc_html__( 'Small', 'educator' ),
					'tiny'   => esc_html__( 'Tiny', 'educator' ),
					'no'     => esc_html__( 'No Space', 'educator' )
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'educator' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'educator' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'educator' ),
					'fixed'    => esc_html__( 'Fixed', 'educator' ),
					'original' => esc_html__( 'Original', 'educator' )
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'educator' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'educator' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'educator' ),
					'standard'        => esc_html__( 'Standard', 'educator' ),
					'load-more'       => esc_html__( 'Load More', 'educator' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'educator' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'educator' )
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'edgt_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'educator' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'educator' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'educator_edge_map_blog_meta', 30 );
}