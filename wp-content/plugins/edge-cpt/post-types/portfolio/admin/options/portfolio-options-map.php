<?php

if ( ! function_exists( 'educator_edge_portfolio_options_map' ) ) {
	function educator_edge_portfolio_options_map() {
		
		educator_edge_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'edge-cpt' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = educator_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'edge-cpt' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'edge-cpt' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'edge-cpt' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'edge-cpt' ),
				'default_value' => '4',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is 4 columns', 'edge-cpt' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'2' => esc_html__( '2 Columns', 'edge-cpt' ),
					'3' => esc_html__( '3 Columns', 'edge-cpt' ),
					'4' => esc_html__( '4 Columns', 'edge-cpt' ),
					'5' => esc_html__( '5 Columns', 'edge-cpt' )
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'edge-cpt' ),
				'default_value' => 'normal',
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'edge-cpt' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'normal' => esc_html__( 'Normal', 'edge-cpt' ),
					'small'  => esc_html__( 'Small', 'edge-cpt' ),
					'tiny'   => esc_html__( 'Tiny', 'edge-cpt' ),
					'no'     => esc_html__( 'No Space', 'edge-cpt' )
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'edge-cpt' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'edge-cpt' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'edge-cpt' ),
					'landscape' => esc_html__( 'Landscape', 'edge-cpt' ),
					'portrait'  => esc_html__( 'Portrait', 'edge-cpt' ),
					'square'    => esc_html__( 'Square', 'edge-cpt' )
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'edge-cpt' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'edge-cpt' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'edge-cpt' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'edge-cpt' )
				)
			)
		);
		
		$panel = educator_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'edge-cpt' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'edge-cpt' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'edge-cpt' ),
				'parent'        => $panel,
				'options'       => array(
					'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'edge-cpt' ),
					'images'            => esc_html__( 'Portfolio Images', 'edge-cpt' ),
					'small-images'      => esc_html__( 'Portfolio Small Images', 'edge-cpt' ),
					'slider'            => esc_html__( 'Portfolio Slider', 'edge-cpt' ),
					'small-slider'      => esc_html__( 'Portfolio Small Slider', 'edge-cpt' ),
					'gallery'           => esc_html__( 'Portfolio Gallery', 'edge-cpt' ),
					'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'edge-cpt' ),
					'masonry'           => esc_html__( 'Portfolio Masonry', 'edge-cpt' ),
					'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'edge-cpt' ),
					'custom'            => esc_html__( 'Portfolio Custom', 'edge-cpt' ),
					'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'edge-cpt' )
				),
				'args'          => array(
					'dependence' => true,
					'show'       => array(
						'huge-images'       => '',
						'images'            => '',
						'small-images'      => '',
						'slider'            => '',
						'small-slider'      => '',
						'gallery'           => '#edgt_portfolio_gallery_container',
						'small-gallery'     => '#edgt_portfolio_gallery_container',
						'masonry'           => '#edgt_portfolio_masonry_container',
						'small-masonry'     => '#edgt_portfolio_masonry_container',
						'custom'            => '',
						'full-width-custom' => ''
					),
					'hide'       => array(
						'huge-images'       => '#edgt_portfolio_gallery_container, #edgt_portfolio_masonry_container',
						'images'            => '#edgt_portfolio_gallery_container, #edgt_portfolio_masonry_container',
						'small-images'      => '#edgt_portfolio_gallery_container, #edgt_portfolio_masonry_container',
						'slider'            => '#edgt_portfolio_gallery_container, #edgt_portfolio_masonry_container',
						'small-slider'      => '#edgt_portfolio_gallery_container, #edgt_portfolio_masonry_container',
						'gallery'           => '#edgt_portfolio_masonry_container',
						'small-gallery'     => '#edgt_portfolio_masonry_container',
						'masonry'           => '#edgt_portfolio_gallery_container',
						'small-masonry'     => '#edgt_portfolio_gallery_container',
						'custom'            => '#edgt_portfolio_gallery_container, #edgt_portfolio_masonry_container',
						'full-width-custom' => '#edgt_portfolio_gallery_container, #edgt_portfolio_masonry_container'
					)
				)
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = educator_edge_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'hidden_property' => 'portfolio_single_template',
				'hidden_values'   => array(
					'huge-images',
					'images',
					'small-images',
					'slider',
					'small-slider',
					'masonry',
					'small-masonry',
					'custom',
					'full-width-custom'
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'edge-cpt' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'edge-cpt' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => array(
					'two'   => esc_html__( '2 Columns', 'edge-cpt' ),
					'three' => esc_html__( '3 Columns', 'edge-cpt' ),
					'four'  => esc_html__( '4 Columns', 'edge-cpt' )
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'edge-cpt' ),
				'default_value' => 'normal',
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'edge-cpt' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => array(
					'normal' => esc_html__( 'Normal', 'edge-cpt' ),
					'small'  => esc_html__( 'Small', 'edge-cpt' ),
					'tiny'   => esc_html__( 'Tiny', 'edge-cpt' ),
					'no'     => esc_html__( 'No Space', 'edge-cpt' )
				)
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = educator_edge_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'hidden_property' => 'portfolio_single_template',
				'hidden_values'   => array(
					'huge-images',
					'images',
					'small-images',
					'slider',
					'small-slider',
					'gallery',
					'small-gallery',
					'custom',
					'full-width-custom'
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'edge-cpt' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'edge-cpt' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => array(
					'two'   => esc_html__( '2 Columns', 'edge-cpt' ),
					'three' => esc_html__( '3 Columns', 'edge-cpt' ),
					'four'  => esc_html__( '4 Columns', 'edge-cpt' )
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'edge-cpt' ),
				'default_value' => 'normal',
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'edge-cpt' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => array(
					'normal' => esc_html__( 'Normal', 'edge-cpt' ),
					'small'  => esc_html__( 'Small', 'edge-cpt' ),
					'tiny'   => esc_html__( 'Tiny', 'edge-cpt' ),
					'no'     => esc_html__( 'No Space', 'edge-cpt' )
				)
			)
		);
		
		/***************** Masonry Layout *****************/
		
		educator_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'edge-cpt' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'edge-cpt' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'edge-cpt' ),
					'yes' => esc_html__( 'Yes', 'edge-cpt' ),
					'no'  => esc_html__( 'No', 'edge-cpt' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'edge-cpt' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'edge-cpt' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'edge-cpt' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'edge-cpt' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'edge-cpt' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'edge-cpt' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'edge-cpt' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'edge-cpt' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'edge-cpt' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'edge-cpt' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'edge-cpt' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'edge-cpt' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'edge-cpt' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'edge-cpt' ),
				'parent'        => $panel,
				'default_value' => 'no',
				'args'          => array(
					'dependence'             => true,
					'dependence_hide_on_yes' => '#edgt_navigate_same_category_container'
				)
			)
		);
		
		$container_navigate_category = educator_edge_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'hidden_property' => 'portfolio_single_hide_pagination',
				'hidden_value'    => 'yes'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'edge-cpt' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'edge-cpt' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		educator_edge_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'edge-cpt' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'edge-cpt' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'educator_edge_options_map', 'educator_edge_portfolio_options_map', 14 );
}