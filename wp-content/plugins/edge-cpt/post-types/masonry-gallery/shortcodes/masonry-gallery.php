<?php
namespace EdgeCore\CPT\Shortcodes\MasonryGallery;

use EdgeCore\Lib;

class MasonryGallery implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edgt_masonry_gallery';

        add_action('vc_before_init', array($this, 'vcMap'));
	
	    //Masonry Gallery category filter
	    add_filter( 'vc_autocomplete_edgt_masonry_gallery_category_callback', array( &$this, 'masonryGalleryCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
	
	    //Masonry Gallery category render
	    add_filter( 'vc_autocomplete_edgt_masonry_gallery_category_render', array( &$this, 'masonryGalleryCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Masonry Gallery', 'edge-cpt' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'                      => 'icon-wpb-masonry-gallery extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'       => 'textfield',
							'param_name' => 'number',
							'heading'    => esc_html__( 'Number of Items', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Normal', 'edge-cpt' )   => 'normal',
								esc_html__( 'Small', 'edge-cpt' )    => 'small',
								esc_html__( 'Tiny', 'edge-cpt' )     => 'tiny',
								esc_html__( 'No Space', 'edge-cpt' ) => 'no'
							),
							'save_always' => true
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category',
							'heading'     => esc_html__( 'Category', 'edge-cpt' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order_by',
							'heading'     => esc_html__( 'Order By', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_query_order_array() ),
							'save_always' => true
						)
					)
				)
			);
		}
	}

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */
    public function render($atts, $content = null) {
	    $default_args = array(
		    'number'              => - 1,
		    'space_between_items' => 'normal',
		    'category'            => '',
		    'order_by'            => 'date',
		    'order'               => 'ASC'
	    );
	    extract( shortcode_atts( $default_args, $atts ) );
	
	    /* Query for items */
	    $query_args = array(
		    'post_type'      => 'masonry-gallery',
		    'orderby'        => $order_by,
		    'order'          => $order,
		    'posts_per_page' => $number
	    );
	
	    if ( ! empty( $category ) ) {
		    $query_args['masonry-gallery-category'] = $category;
	    }
	
	    $holder_classes = '';
	    if ( ! empty( $space_between_items ) ) {
		    $holder_classes = 'edgt-mg-' . $space_between_items . '-space';
	    }
	
	    $query = new \WP_Query( $query_args );
	
	    $html = '';

        $html .= '<div class="edgt-masonry-gallery-holder '.esc_attr($holder_classes).'">';
	        $html .= '<div class="edgt-mg-inner">';
	            $html .= '<div class="edgt-mg-grid-sizer"></div>';
		        $html .= '<div class="edgt-mg-grid-gutter"></div>';
	
		        if ($query->have_posts()) :
			        while ( $query->have_posts() ) : $query->the_post();
				        $itemID               = get_the_ID();
				        $typeOption           = get_post_meta( $itemID, 'edgt_masonry_gallery_item_type', true );
				        $title                = get_the_title( $itemID );
				        $titleTagOption       = get_post_meta( $itemID, 'edgt_masonry_gallery_item_title_tag', true );
				        $subtitle 		      = get_post_meta( $itemID, 'edgt_masonry_gallery_subtitle_label', true );
				        $subtitle_color	      = get_post_meta( $itemID, 'edgt_masonry_gallery_subtitle_color', true );
				        $text                 = get_post_meta( $itemID, 'edgt_masonry_gallery_item_text', true );
				        $link                 = get_post_meta( $itemID, 'edgt_masonry_gallery_item_link', true );
				        $target               = get_post_meta( $itemID, 'edgt_masonry_gallery_item_link_target', true );
				        $button_label         = get_post_meta( $itemID, 'edgt_masonry_gallery_button_label', true );
						$image_size           = get_post_meta($itemID, 'edgt_masonry_gallery_item_size', true);
						$color_overlay        = get_post_meta( $itemID, 'edgt_masonry_gallery_standard_overlay_color', true );
				
				        $type                           = ! empty( $typeOption ) ? $typeOption : 'standard';
				        $params['item_title']           = ! empty( $title ) ? $title : '';
				        $params['item_title_tag']       = ! empty( $titleTagOption ) ? $titleTagOption : 'h4';
				        $params['item_text']            = ! empty( $text ) ? $text : '';
				        $params['item_link']            = ! empty( $link ) ? $link : '';
				        $params['item_subtitle']        = ! empty( $subtitle ) ? $subtitle : '';
				        $params['item_subtitle_color']  = ! empty( $subtitle_color ) ? 'color:'.$subtitle_color.'' : '';
				        $params['image_overlay_styles']  = ! empty( $color_overlay ) ? 'background-color:'.$color_overlay.'' : '';
				        $params['item_link_target']     = ! empty( $target ) ? $target : '_self';
				        $params['item_button_label']    = ! empty( $button_label ) ? $button_label : '';
				        $params['current_id']           = $itemID;
				        $params['item_classes']         = $this->getItemClasses();
				        $params['item_image']           = $this->getItemImage( $params );
				        $params['background_image_url'] = $this->getBackgroundImage( $params );
						$params['image_size']= '';

						switch ($image_size) {
							case "square-small":
								$params['image_size']= 'educator_edge_square';
								break;
							case "square-big":
								$params['image_size']= 'educator_edge_huge';
								break;
							case "rectangle-portrait":
								$params['image_size']= 'educator_edge_portrait';
								break;
							case "rectangle-landscape":
								$params['image_size']= 'educator_edge_landscape';
								break;
							default:
								$params['image_size']= 'educator_edge_square';
						}

						$params['icon_html'] = $this->getItemIconHtml();
						$params['button_icon_html'] = $this->getButtonIconHtml();

				        $html .= edgt_core_get_cpt_shortcode_module_template_part( 'masonry-gallery', 'masonry-gallery-' . $type . '-template', '', $params );
			
			        endwhile;
		        else:
		            $html .= esc_html__('Sorry, no posts matched your criteria.', 'edge-cpt');
		        endif;
				wp_reset_postdata();
	        $html .= '</div>';
	    $html .= '</div>';

        return $html;
    }
	
	private function getItemClasses() {
		$classes = array( 'edgt-mg-item' );
		
		$itemID          = get_the_ID();
		$type            = get_post_meta( $itemID, 'edgt_masonry_gallery_item_type', true );
		$image_size      = get_post_meta( $itemID, 'edgt_masonry_gallery_item_size', true );
		$background_skin = get_post_meta( $itemID, 'edgt_masonry_gallery_simple_content_background_skin', true );

		if ( ! empty( $type ) ) {
			$classes[] = 'edgt-mg-' . $type;
		}
		
		if ( ! empty( $image_size ) ) {
			$classes[] = 'edgt-mg-' . $image_size;
		}
		
		if ( ! empty( $background_skin ) ) {
			$classes[] = 'edgt-mg-skin-' . $background_skin;
		}
		
		return implode( ' ', $classes );
	}
	
	public function getItemImage( $params ) {
		$id          = $params['current_id'];
		$imageOption = get_post_meta( $id, 'edgt_masonry_gallery_item_image', true );
		$item_image  = array();
		
		if ( ! empty( $imageOption ) ) {
			$image_url = $imageOption;
			$image_id  = educator_edge_get_attachment_id_from_url( $image_url );
			
			$image['url'] = $image_url;
			$image['alt'] = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			$item_image   = $image;
		}
		
		return $item_image;
	}
	
	public function getBackgroundImage( $params ) {
		$masonry_image_url = wp_get_attachment_url( get_post_thumbnail_id( $params['current_id'] ) );
		
		return $masonry_image_url;
	}
	
	/**
	 * Filter masonry gallery categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function masonryGalleryCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS masonry_gallery_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'masonry-gallery-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['masonry_gallery_category_title'] ) > 0 ) ? esc_html__( 'Category', 'edge-cpt' ) . ': ' . $value['masonry_gallery_category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find masonry gallery category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function masonryGalleryCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$masonry_gallery_category = get_term_by( 'slug', $query, 'masonry-gallery-category' );
			if ( is_object( $masonry_gallery_category ) ) {
				
				$masonry_gallery_category_slug = $masonry_gallery_category->slug;
				$masonry_gallery_category_title = $masonry_gallery_category->name;
				
				$masonry_gallery_category_title_display = '';
				if ( ! empty( $masonry_gallery_category_title ) ) {
					$masonry_gallery_category_title_display = esc_html__( 'Category', 'edge-cpt' ) . ': ' . $masonry_gallery_category_title;
				}
				
				$data          = array();
				$data['value'] = $masonry_gallery_category_slug;
				$data['label'] = $masonry_gallery_category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}

	private function getButtonIconHtml() {
		$icon_button_html = '';
		if (get_post_meta(get_the_ID(), 'edgt_masonry_gallery_item_button_icon', true) !== '') {
			$icon_pack = get_post_meta(get_the_ID(), 'edgt_masonry_gallery_item_button_icon', true);
			$iconPackName = educator_edge_icon_collections()->getIconCollectionParamNameByKey($icon_pack);
			if (get_post_meta(get_the_ID(), 'edgt_masonry_gallery_item_button_icon_'.$iconPackName, true) !== '') {
				$icon = get_post_meta(get_the_ID(), 'edgt_masonry_gallery_item_button_icon_'.$iconPackName, true);
				$icon_button_html = educator_edge_icon_collections()->renderIcon($icon, $icon_pack);
			}
		}


		return $icon_button_html;
	}

	private function getItemIconHtml() {
		$icon_html = '';
		if(get_post_meta(get_the_ID(), 'edgt_masonry_gallery_item_icon', true) !== '') {
			$icon_pack    = get_post_meta(get_the_ID(), 'edgt_masonry_gallery_item_icon', true);
			$iconPackName = educator_edge_icon_collections()->getIconCollectionParamNameByKey($icon_pack);

			if(get_post_meta(get_the_ID(), 'edgt_masonry_gallery_item_icon_'.$iconPackName, true) !== '') {
				$icon      = get_post_meta(get_the_ID(), 'edgt_masonry_gallery_item_icon_'.$iconPackName, true);
				$icon_html = educator_edge_icon_collections()->renderIcon($icon, $icon_pack);
			}
		}

		return $icon_html;
	}


}