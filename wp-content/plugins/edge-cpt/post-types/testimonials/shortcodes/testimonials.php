<?php
namespace EdgeCore\CPT\Shortcodes\Testimonials;

use EdgeCore\Lib;

class Testimonials implements Lib\ShortcodeInterface{
    private $base;

    public function __construct() {
        $this->base = 'edgt_testimonials';

        add_action('vc_before_init', array($this, 'vcMap'));
	
	    //Testimonials category filter
	    add_filter( 'vc_autocomplete_edgt_testimonials_category_callback', array( &$this, 'testimonialsCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
	
	    //Testimonials category render
	    add_filter( 'vc_autocomplete_edgt_testimonials_category_render', array( &$this, 'testimonialsCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
    }
	
    public function getBase() {
        return $this->base;
    }
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Edge Testimonials', 'edge-cpt' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by EDGE', 'edge-cpt' ),
					'icon'                      => 'icon-wpb-testimonials extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Type', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Standard', 'edge-cpt' ) => 'standard',
								esc_html__( 'Simple', 'edge-cpt' )    => 'simple',
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'skin',
							'heading'     => esc_html__( 'Skin', 'edge-cpt' ),
							'value'       => array(
								esc_html__( 'Default', 'edge-cpt' ) => '',
								esc_html__( 'Light', 'edge-cpt' )   => 'light',
							),
							'dependency'  => array('element' => 'type', 'value' => 'standard'),
							'save_always' => true
						),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'navigation_skin',
                            'heading'     => esc_html__( 'Navigation Skin', 'edge-cpt' ),
                            'value'       => array(
                                esc_html__( 'Default', 'edge-cpt' ) => '',
                                esc_html__( 'Light', 'edge-cpt' )   => 'light',
                            ),
                            'dependency'  => array('element' => 'type', 'value' => 'simple'),
                            'save_always' => true
                        ),
						array(
							'type'       => 'textfield',
							'param_name' => 'number',
							'heading'    => esc_html__( 'Number of Testimonials', 'edge-cpt' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category',
							'heading'     => esc_html__( 'Category', 'edge-cpt' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'edge-cpt' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'edge-cpt' ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'edge-cpt' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'edge-cpt' ),
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_padding',
							'heading'     => esc_html__( 'Disable Text padding from 1024px to 1280px', 'edge-cpt' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false, false ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Slider Settings', 'edge-cpt' )
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'type'                    => '',
			'skin'                    => '',
            'navigation_skin'         => '',
			'number'                  => '-1',
			'category'                => '',
			'box_color'               => '',
			'number_of_visible_items' => '3',
			'slider_loop'             => 'yes',
			'slider_autoplay'         => 'yes',
			'slider_speed'            => '5000',
			'slider_speed_animation'  => '600',
			'slider_navigation'       => 'yes',
			'slider_pagination'       => 'yes',
			'slider_padding'       		=> 'no',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : 'standard';
		
		$holder_classes = $this->getHolderClasses( $params );
		
		$query_args    = $this->getQueryParams( $params );
		$query_results = new \WP_Query( $query_args );
		
		$data_attr            = $this->getSliderData( $params );
		
		$html = '';
		$html .= '<div class="edgt-testimonials-holder ' . $holder_classes . ' clearfix">';
			$html .= '<div class="edgt-testimonials edgt-owl-slider" ' . educator_edge_get_inline_attrs( $data_attr ) . '>';
		
				if ( $query_results->have_posts() ):
					while ( $query_results->have_posts() ) : $query_results->the_post();
						$title    = get_post_meta( get_the_ID(), 'edgt_testimonial_title', true );
						$text     = get_post_meta( get_the_ID(), 'edgt_testimonial_text', true );
						$author   = get_post_meta( get_the_ID(), 'edgt_testimonial_author', true );
						$position = get_post_meta( get_the_ID(), 'edgt_testimonial_author_position', true );
						
						$params['current_id'] = get_the_ID();
						$params['title']      = $title;
						$params['text']       = $text;
						$params['author']     = $author;
						$params['position']   = $position;
						
						$html .= edgt_core_get_cpt_shortcode_module_template_part( 'testimonials', 'testimonials-' . $params['type'], '', $params );
					
					endwhile;
				else:
					$html .= esc_html__( 'Sorry, no posts matched your criteria.', 'edge-cpt' );
				endif;
				
				wp_reset_postdata();
		
			$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = 'edgt-testimonials-' . $params['type'];
		$holderClasses[] = ! empty( $params['skin'] ) ? 'edgt-testimonials-' . $params['skin'] : '';
        $holderClasses[] = ! empty( $params['navigation_skin'] ) ? 'edgt-testimonials-navigation-' . $params['navigation_skin'] : '';
		$holderClasses[] =  $params['slider_padding'] == 'yes' ? 'edgt-testimonials-disable-padding' : '';

		return implode( ' ', $holderClasses );
	}
	
	private function getQueryParams( $params ) {
		$args = array(
			'post_status'    => 'publish',
			'post_type'      => 'testimonials',
			'orderby'        => 'date',
			'order'          => 'DESC',
			'posts_per_page' => $params['number']
		);
		
		if ( $params['category'] != '' ) {
			$args['testimonials-category'] = $params['category'];
		}
		
		return $args;
	}
	
	private function getSliderData( $params ) {
		$slider_data = array();
		
		$slider_data['data-number-of-items']        = '1';
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';
		
		return $slider_data;
	}
	
	/**
	 * Filter testimonials categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function testimonialsCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS testimonials_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'testimonials-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['testimonials_category_title'] ) > 0 ) ? esc_html__( 'Category', 'edge-cpt' ) . ': ' . $value['testimonials_category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
		
	}
	
	/**
	 * Find testimonials category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function testimonialsCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$testimonials_category = get_term_by( 'slug', $query, 'testimonials-category' );
			if ( is_object( $testimonials_category ) ) {
				
				$testimonials_category_slug = $testimonials_category->slug;
				$testimonials_category_title = $testimonials_category->name;
				
				$testimonials_category_title_display = '';
				if ( ! empty( $testimonials_category_title ) ) {
					$testimonials_category_title_display = esc_html__( 'Category', 'edge-cpt' ) . ': ' . $testimonials_category_title;
				}
				
				$data          = array();
				$data['value'] = $testimonials_category_slug;
				$data['label'] = $testimonials_category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}