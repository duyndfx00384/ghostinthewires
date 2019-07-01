<?php
namespace EdgeCore\CPT\Shortcodes\ProductList;

use EdgeCore\Lib;

class ProductList implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgt_product_list';
		
		add_action('vc_before_init', array($this,'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Product List', 'educator' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-product-list extended-custom-icon',
					'category'                  => esc_html__( 'by EDGE', 'educator' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'       => 'textfield',
							'param_name' => 'number_of_posts',
							'heading'    => esc_html__( 'Number of Products', 'educator' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'educator' ),
							'value'       => array(
								esc_html__( 'One', 'educator' )   => '1',
								esc_html__( 'Two', 'educator' )   => '2',
								esc_html__( 'Three', 'educator' ) => '3',
								esc_html__( 'Four', 'educator' )  => '4',
								esc_html__( 'Five', 'educator' )  => '5',
								esc_html__( 'Six', 'educator' )   => '6'
							),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'space_between_items',
							'heading'    => esc_html__( 'Space Between Items', 'educator' ),
							'value'      => array(
								esc_html__( 'Normal', 'educator' )   => 'normal',
								esc_html__( 'Small', 'educator' )    => 'small',
								esc_html__( 'Tiny', 'educator' )     => 'tiny',
								esc_html__( 'No Space', 'educator' ) => 'no'
							)
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order_by',
							'heading'     => esc_html__( 'Order By', 'educator' ),
							'value'       => array_flip( educator_edge_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'educator' ),
							'value'       => array_flip( educator_edge_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'taxonomy_to_display',
							'heading'     => esc_html__( 'Choose Sorting Taxonomy', 'educator' ),
							'value'       => array(
								esc_html__( 'Category', 'educator' ) => 'category',
								esc_html__( 'Tag', 'educator' )      => 'tag',
								esc_html__( 'Id', 'educator' )       => 'id'
							),
							'description' => esc_html__( 'If you would like to display only certain products, this is where you can select the criteria by which you would like to choose which products to display', 'educator' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'taxonomy_values',
							'heading'     => esc_html__( 'Enter Taxonomy Values', 'educator' ),
							'description' => esc_html__( 'Separate values (category slugs, tags, or post IDs) with a comma', 'educator' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_size',
							'heading'    => esc_html__( 'Image Proportions', 'educator' ),
							'value'      => array(
								esc_html__( 'Default', 'educator' )        => '',
								esc_html__( 'Original', 'educator' )       => 'full',
								esc_html__( 'Square', 'educator' )         => 'square',
								esc_html__( 'Landscape', 'educator' )      => 'landscape',
								esc_html__( 'Portrait', 'educator' )       => 'portrait',
								esc_html__( 'Medium', 'educator' )         => 'medium',
								esc_html__( 'Large', 'educator' )          => 'large',
								esc_html__( 'Shop Catalog', 'educator' )   => 'shop_catalog',
								esc_html__( 'Shop Single', 'educator' )    => 'shop_single',
								esc_html__( 'Shop Thumbnail', 'educator' ) => 'shop_thumbnail'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_title',
							'heading'    => esc_html__( 'Display Title', 'educator' ),
							'value'      => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'educator' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'product_info_skin',
							'heading'    => esc_html__( 'Product Info Skin', 'educator' ),
							'value'      => array(
								esc_html__( 'Default', 'educator' ) => 'default',
								esc_html__( 'Light', 'educator' )   => 'light',
								esc_html__( 'Dark', 'educator' )    => 'dark'
							),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-on-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'educator' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'educator' ),
							'value'      => array_flip( educator_edge_get_title_tag( true ) ),
							'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'educator' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_transform',
							'heading'    => esc_html__( 'Title Text Transform', 'educator' ),
							'value'      => array_flip( educator_edge_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'display_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'educator' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_category',
							'heading'    => esc_html__( 'Display Category', 'educator' ),
							'value'      => array_flip( educator_edge_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Product Info', 'educator' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_excerpt',
							'heading'    => esc_html__( 'Display Excerpt', 'educator' ),
							'value'      => array_flip( educator_edge_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Product Info', 'educator' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'excerpt_length',
							'heading'     => esc_html__( 'Excerpt Length', 'educator' ),
							'description' => esc_html__( 'Number of characters', 'educator' ),
							'dependency'  => array( 'element' => 'display_excerpt', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Product Info Style', 'educator' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_rating',
							'heading'    => esc_html__( 'Display Rating', 'educator' ),
							'value'      => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'educator' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_price',
							'heading'    => esc_html__( 'Display Price', 'educator' ),
							'value'      => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'educator' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'display_button',
							'heading'    => esc_html__( 'Display Button', 'educator' ),
							'value'      => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Product Info', 'educator' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_skin',
							'heading'    => esc_html__( 'Button Skin', 'educator' ),
							'value'      => array(
								esc_html__( 'Default', 'educator' ) => 'default',
								esc_html__( 'Light', 'educator' )   => 'light',
								esc_html__( 'Dark', 'educator' )    => 'dark'
							),
							'dependency' => array( 'element' => 'display_button', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Product Info Style', 'educator' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'shader_background_color',
							'heading'    => esc_html__( 'Shader Background Color', 'educator' ),
							'group'      => esc_html__( 'Product Info Style', 'educator' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'info_bottom_text_align',
							'heading'    => esc_html__( 'Product Info Text Alignment', 'educator' ),
							'value'      => array(
								esc_html__( 'Default', 'educator' ) => '',
								esc_html__( 'Left', 'educator' )    => 'left',
								esc_html__( 'Center', 'educator' )  => 'center',
								esc_html__( 'Right', 'educator' )   => 'right'
							),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'educator' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'info_bottom_margin',
							'heading'    => esc_html__( 'Product Info Bottom Margin (px)', 'educator' ),
							'dependency' => array( 'element' => 'info_position', 'value' => array( 'info-below-image' ) ),
							'group'      => esc_html__( 'Product Info Style', 'educator' )
						)
					)
				)
			);
		}
	}

	public function render($atts, $content = null) {
		$default_atts = array(
            'number_of_posts' 		  => '8',
            'number_of_columns' 	  => '4',
            'space_between_items'	  => 'normal',
            'order_by' 				  => 'date',
            'order' 				  => 'ASC',
            'taxonomy_to_display' 	  => 'category',
            'taxonomy_values' 		  => '',
            'image_size'			  => 'full',
            'display_title' 		  => 'yes',
			'product_info_skin'       => '',
            'title_tag'				  => 'h5',
            'title_transform'		  => '',
			'display_category'        => 'no',
            'display_excerpt' 		  => 'no',
            'excerpt_length' 		  => '20',
			'display_rating' 		  => 'yes',
			'display_price' 		  => 'yes',
            'display_button' 		  => 'yes',
			'button_skin'             => 'default',
			'shader_background_color' => '',
			'info_bottom_text_align'  => '',
            'info_bottom_margin' 	  => ''
        );
		
		$params = shortcode_atts($default_atts, $atts);
		extract($params);

		$params['type'] = !empty($params['type']) ? $params['type'] : $default_atts['type'];
		if($params['type'] == 'masonry'){
			$params['info_position'] = 'info-on-image';
		}

		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['class_name'] = 'pli';
		
		$params['title_tag'] = !empty($params['title_tag']) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['title_styles'] = $this->getTitleStyles($params);
		
		$params['shader_styles'] = $this->getShaderStyles($params);

		$params['text_wrapper_styles'] = $this->getTextWrapperStyles($params);

		$queryArray = $this->generateProductQueryArray($params);
		$query_result = new \WP_Query($queryArray);
		$params['query_result'] = $query_result;

		$html = educator_edge_get_woo_shortcode_module_template_part('templates/product-list-standard', 'product-list', '', $params);
		
		return $html;
	}

	/**
	   * Generates holder classes
	   *
	   * @param $params
	   *
	   * @return string
	*/
	private function getHolderClasses($params){
		$holderClasses = '';

		$productListType = !empty($params['type']) ? 'edgt-'.$params['type'].'-layout' : 'edgt-standard-layout';

        $columnsSpace = !empty($params['space_between_items']) ? 'edgt-'.$params['space_between_items'].'-space' : 'edgt-normal-space';

        $columnNumber = $this->getColumnNumberClass($params);

		$infoPosition = !empty($params['info_position']) ? 'edgt-'.$params['info_position'] : 'edgt-info-on-image';
		
		$productInfoClasses = !empty($params['product_info_skin']) ? 'edgt-product-info-'.$params['product_info_skin'] : '';

        $holderClasses .= $productListType . ' ' . $columnsSpace . ' ' . $columnNumber . ' ' . $infoPosition . ' ' . $productInfoClasses;
		
		return $holderClasses;
	}

    /**
     * Generates columns number classes for product list holder
     *
     * @param $params
     *
     * @return string
     */
    private function getColumnNumberClass($params){
        $columnsNumber = '';
        $columns = $params['number_of_columns'];

        switch ($columns) {
            case 1:
                $columnsNumber = 'edgt-one-column';
                break;
            case 2:
                $columnsNumber = 'edgt-two-columns';
                break;
            case 3:
                $columnsNumber = 'edgt-three-columns';
                break;
            case 4:
                $columnsNumber = 'edgt-four-columns';
                break;
            case 5:
                $columnsNumber = 'edgt-five-columns';
                break;
            case 6:
                $columnsNumber = 'edgt-six-columns';
                break;        
            default:
                $columnsNumber = 'edgt-four-columns';
                break;
        }

        return $columnsNumber;
    }

	/**
	   * Generates query array
	   *
	   * @param $params
	   *
	   * @return array
	*/
	public function generateProductQueryArray($params){
		$queryArray = array(
			'post_status' => 'publish',
			'post_type' => 'product',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $params['number_of_posts'],
			'orderby' => $params['order_by'],
			'order' => $params['order']
		);

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'category') {
            $queryArray['product_cat'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'tag') {
            $queryArray['product_tag'] = $params['taxonomy_values'];
        }

        if ($params['taxonomy_to_display'] !== '' && $params['taxonomy_to_display'] === 'id') {
            $idArray = $params['taxonomy_values'];
            $ids = explode(',', $idArray);
            $queryArray['post__in'] = $ids;
        }

        return $queryArray;
	}

	/**
     * Return Style for Title
     *
     * @param $params
     * @return string
     */
    public function getTitleStyles($params) {
        $styles = array();
	
	    if (!empty($params['title_transform'])) {
		    $styles[] = 'text-transform: '.$params['title_transform'];
	    }

		return implode(';', $styles);
    }

    /**
     * Return Style for Shader
     *
     * @param $params
     * @return string
     */
	public function getShaderStyles($params) {
	    $styles = array();
	
	    if (!empty($params['shader_background_color'])) {
		    $styles[] = 'background-color: '.$params['shader_background_color'];
	    }

		return implode(';', $styles);
    }

    /**
     * Return Style for Text Wrapper Holder
     *
     * @param $params
     * @return string
     */
	public function getTextWrapperStyles($params) {
	    $styles = array();
	
	    if (!empty($params['info_bottom_text_align'])) {
		    $styles[] = 'text-align: '.$params['info_bottom_text_align'];
	    }
		
        if ($params['info_bottom_margin'] !== '') {
	        $styles[] = 'margin-bottom: '.educator_edge_filter_px($params['info_bottom_margin']).'px';
        }

		return implode(';', $styles);
    }
}