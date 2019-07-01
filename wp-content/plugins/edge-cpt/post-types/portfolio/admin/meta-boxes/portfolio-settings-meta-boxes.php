<?php

if ( ! function_exists( 'edgt_core_map_portfolio_settings_meta' ) ) {
	function edgt_core_map_portfolio_settings_meta() {
		$meta_box = educator_edge_add_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'edge-cpt' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		educator_edge_add_meta_box_field( array(
			'name'        => 'edgt_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'edge-cpt' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'edge-cpt' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'edge-cpt' ),
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
			'args'        => array(
				'dependence' => true,
				'show'       => array(
					''                  => '',
					'huge-images'       => '',
					'images'            => '',
					'small-images'      => '',
					'slider'            => '',
					'small-slider'      => '',
					'gallery'           => '#edgt_edgt_gallery_type_meta_container',
					'small-gallery'     => '#edgt_edgt_gallery_type_meta_container',
					'masonry'           => '#edgt_edgt_masonry_type_meta_container',
					'small-masonry'     => '#edgt_edgt_masonry_type_meta_container',
					'custom'            => '',
					'full-width-custom' => ''
				),
				'hide'       => array(
					''                  => '#edgt_edgt_gallery_type_meta_container, #edgt_edgt_masonry_type_meta_container',
					'huge-images'       => '#edgt_edgt_gallery_type_meta_container, #edgt_edgt_masonry_type_meta_container',
					'images'            => '#edgt_edgt_gallery_type_meta_container, #edgt_edgt_masonry_type_meta_container',
					'small-images'      => '#edgt_edgt_gallery_type_meta_container, #edgt_edgt_masonry_type_meta_container',
					'slider'            => '#edgt_edgt_gallery_type_meta_container, #edgt_edgt_masonry_type_meta_container',
					'small-slider'      => '#edgt_edgt_gallery_type_meta_container, #edgt_edgt_masonry_type_meta_container',
					'gallery'           => '#edgt_edgt_masonry_type_meta_container',
					'small-gallery'     => '#edgt_edgt_masonry_type_meta_container',
					'masonry'           => '#edgt_edgt_gallery_type_meta_container',
					'small-masonry'     => '#edgt_edgt_gallery_type_meta_container',
					'custom'            => '#edgt_edgt_gallery_type_meta_container, #edgt_edgt_masonry_type_meta_container',
					'full-width-custom' => '#edgt_edgt_gallery_type_meta_container, #edgt_edgt_masonry_type_meta_container'
				)
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = educator_edge_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'edgt_gallery_type_meta_container',
				'hidden_property' => 'edgt_portfolio_single_template_meta',
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
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'edge-cpt' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'edge-cpt' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => array(
					''      => esc_html__( 'Default', 'edge-cpt' ),
					'two'   => esc_html__( '2 Columns', 'edge-cpt' ),
					'three' => esc_html__( '3 Columns', 'edge-cpt' ),
					'four'  => esc_html__( '4 Columns', 'edge-cpt' )
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'edge-cpt' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'edge-cpt' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => array(
					''       => esc_html__( 'Default', 'edge-cpt' ),
					'normal' => esc_html__( 'Normal', 'edge-cpt' ),
					'small'  => esc_html__( 'Small', 'edge-cpt' ),
					'tiny'   => esc_html__( 'Tiny', 'edge-cpt' ),
					'no'     => esc_html__( 'No Space', 'edge-cpt' )
				)
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = educator_edge_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'edgt_masonry_type_meta_container',
				'hidden_property' => 'edgt_portfolio_single_template_meta',
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
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'edge-cpt' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'edge-cpt' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => array(
					''      => esc_html__( 'Default', 'edge-cpt' ),
					'two'   => esc_html__( '2 Columns', 'edge-cpt' ),
					'three' => esc_html__( '3 Columns', 'edge-cpt' ),
					'four'  => esc_html__( '4 Columns', 'edge-cpt' )
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'edge-cpt' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'edge-cpt' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => array(
					''       => esc_html__( 'Default', 'edge-cpt' ),
					'normal' => esc_html__( 'Normal', 'edge-cpt' ),
					'small'  => esc_html__( 'Small', 'edge-cpt' ),
					'tiny'   => esc_html__( 'Tiny', 'edge-cpt' ),
					'no'     => esc_html__( 'No Space', 'edge-cpt' )
				)
			)
		);
		
		/***************** Masonry Layout *****************/
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'edge-cpt' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'edge-cpt' ),
				'parent'        => $meta_box,
				'options'       => educator_edge_get_yes_no_select_array()
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'edge-cpt' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'edge-cpt' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'edge-cpt' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'edge-cpt' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'edgt_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'edge-cpt' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'edge-cpt' ),
				'parent'      => $meta_box
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'edge-cpt' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'edge-cpt' ),
				'default_value' => 'default',
				'parent'        => $meta_box,
				'options'       => array(
					'default'            => esc_html__( 'Default', 'edge-cpt' ),
					'large-width'        => esc_html__( 'Large Width', 'edge-cpt' ),
					'large-height'       => esc_html__( 'Large Height', 'edge-cpt' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'edge-cpt' )
				)
			)
		);
		
		educator_edge_add_meta_box_field(
			array(
				'name'          => 'edgt_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'edge-cpt' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'edge-cpt' ),
				'default_value' => 'default',
				'parent'        => $meta_box,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'edge-cpt' ),
					'large-width' => esc_html__( 'Large Width', 'edge-cpt' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		educator_edge_add_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'edge-cpt' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'edge-cpt' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'edgt_core_map_portfolio_settings_meta', 41 );
}