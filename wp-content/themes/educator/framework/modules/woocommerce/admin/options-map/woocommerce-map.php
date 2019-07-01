<?php

if ( ! function_exists('educator_edge_woocommerce_options_map') ) {

	/**
	 * Add Woocommerce options page
	 */
	function educator_edge_woocommerce_options_map() {

		educator_edge_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => esc_html__('Woocommerce', 'educator'),
				'icon' => 'fa fa-shopping-cart'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = educator_edge_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => esc_html__('Product List', 'educator')
			)
		);

		educator_edge_add_admin_field(array(
			'name'        	=> 'edgt_woo_product_list_columns',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product List Columns', 'educator'),
			'default_value'	=> 'edgt-woocommerce-columns-4',
			'description' 	=> esc_html__('Choose number of columns for product listing and related products on single product', 'educator'),
			'options'		=> array(
				'edgt-woocommerce-columns-3' => esc_html__('3 Columns', 'educator'),
				'edgt-woocommerce-columns-4' => esc_html__('4 Columns', 'educator')
			),
			'parent'      	=> $panel_product_list,
		));
		
		educator_edge_add_admin_field(array(
			'name'        	=> 'edgt_woo_product_list_columns_space',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Space Between Products', 'educator'),
			'default_value'	=> 'edgt-woo-normal-space',
			'description' 	=> esc_html__('Select space between products for product listing and related products on single product', 'educator'),
			'options'		=> array(
				'edgt-woo-normal-space' => esc_html__('Normal', 'educator'),
				'edgt-woo-small-space'  => esc_html__('Small', 'educator'),
				'edgt-woo-no-space'     => esc_html__('No Space', 'educator')
			),
			'parent'      	=> $panel_product_list,
		));
		
		educator_edge_add_admin_field(array(
			'name'        	=> 'edgt_woo_product_list_info_position',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Product Info Position', 'educator'),
			'default_value'	=> 'info_below_image',
			'description' 	=> esc_html__('Select product info position for product listing and related products on single product', 'educator'),
			'options'		=> array(
				'info_below_image'    => esc_html__('Info Below Image', 'educator'),
				'info_on_image_hover' => esc_html__('Info On Image Hover', 'educator')
			),
			'parent'      	=> $panel_product_list,
		));

		educator_edge_add_admin_field(array(
			'name'        	=> 'edgt_woo_products_per_page',
			'type'        	=> 'text',
			'label'       	=> esc_html__('Number of products per page', 'educator'),
			'default_value'	=> '',
			'description' 	=> esc_html__('Set number of products on shop page', 'educator'),
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		educator_edge_add_admin_field(array(
			'name'        	=> 'edgt_products_list_title_tag',
			'type'        	=> 'select',
			'label'       	=> esc_html__('Products Title Tag', 'educator'),
			'default_value'	=> 'h5',
			'description' 	=> '',
			'options'       => educator_edge_get_title_tag(),
			'parent'      	=> $panel_product_list,
		));

		/**
		 * Single Product Settings
		 */
		$panel_single_product = educator_edge_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_single_product',
				'title' => esc_html__('Single Product', 'educator')
			)
		);
		
			educator_edge_add_admin_field(
				array(
					'type'          => 'select',
					'name'          => 'show_title_area_woo',
					'default_value' => '',
					'label'         => esc_html__( 'Show Title Area', 'educator' ),
					'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'educator' ),
					'parent'        => $panel_single_product,
					'options'       => educator_edge_get_yes_no_select_array(),
					'args'          => array(
						'col_width' => 3
					)
				)
			);
			
			educator_edge_add_admin_field(
				array(
					'name'          => 'edgt_single_product_title_tag',
					'type'          => 'select',
					'default_value' => 'h2',
					'label'         => esc_html__( 'Single Product Title Tag', 'educator' ),
					'options'       => educator_edge_get_title_tag(),
					'parent'        => $panel_single_product,
				)
			);
		
			educator_edge_add_admin_field(
				array(
					'name'          => 'woo_set_thumb_images_position',
					'type'          => 'select',
					'default_value' => 'below-image',
					'label'         => esc_html__( 'Set Thumbnail Images Position', 'educator' ),
					'options'       => array(
						'below-image'  => esc_html__( 'Below Featured Image', 'educator' ),
						'on-left-side' => esc_html__( 'On The Left Side Of Featured Image', 'educator' )
					),
					'parent'        => $panel_single_product
				)
			);
		
			educator_edge_add_admin_field(
				array(
					'type'          => 'select',
					'name'          => 'woo_enable_single_product_zoom_image',
					'default_value' => 'no',
					'label'         => esc_html__( 'Enable Zoom Maginfier', 'educator' ),
					'description'   => esc_html__( 'Enabling this option will show magnifier image on featured image hover', 'educator' ),
					'parent'        => $panel_single_product,
					'options'       => educator_edge_get_yes_no_select_array( false ),
					'args'          => array(
						'col_width' => 3
					)
				)
			);
		
			educator_edge_add_admin_field(
				array(
					'name'          => 'woo_set_single_images_behavior',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Set Images Behavior', 'educator' ),
					'options'       => array(
						''             => esc_html__( 'No Behavior', 'educator' ),
						'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'educator' ),
						'photo-swipe'  => esc_html__( 'Photo Swipe Lightbox', 'educator' )
					),
					'parent'        => $panel_single_product
				)
			);
	}

	add_action( 'educator_edge_options_map', 'educator_edge_woocommerce_options_map', 21);
}