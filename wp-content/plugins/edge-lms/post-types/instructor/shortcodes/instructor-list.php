<?php
namespace EdgefLMS\CPT\Shortcodes\Instructor;

use EdgefLMS\Lib;

class InstructorList implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edgt_instructor_list';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Instructor category filter
	    add_filter( 'vc_autocomplete_edgt_instructor_list_category_callback', array( &$this, 'instructorListCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Instructor category render
	    add_filter( 'vc_autocomplete_edgt_instructor_list_category_render', array( &$this, 'instructorListCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Instructor selected instructors filter
	    add_filter( 'vc_autocomplete_edgt_instructor_list_selected_instructors_callback', array( &$this, 'instructorListIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Instructor selected instructors render
	    add_filter( 'vc_autocomplete_edgt_instructor_list_selected_instructors_render', array( &$this, 'instructorListIdAutocompleteRender', ), 10, 1 ); // Render exact instructor. Must return an array (label,value)
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
	    if(function_exists('vc_map')) {
		    vc_map(
		    	array(
				    'name'                      => esc_html__( 'Edge Instructor List', 'edge-lms' ),
				    'base'                      => $this->getBase(),
				    'category'                  => esc_html__( 'by EDGE LMS', 'edge-lms' ),
				    'icon'                      => 'icon-wpb-instructor-list extended-custom-lms-icon',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array(
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'number_of_columns',
						    'heading'     => esc_html__( 'Number of Columns', 'edge-lms' ),
						    'value'       => array(
							    esc_html__( 'Default', 'edge-lms' ) => '',
							    esc_html__( 'One', 'edge-lms' )     => '1',
							    esc_html__( 'Two', 'edge-lms' )     => '2',
							    esc_html__( 'Three', 'edge-lms' )   => '3',
							    esc_html__( 'Four', 'edge-lms' )    => '4',
							    esc_html__( 'Five', 'edge-lms' )    => '5'
						    ),
						    'description' => esc_html__( 'Default value is Three', 'edge-lms' )
					    ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'space_between_items',
                            'heading'     => esc_html__( 'Space Between Instructors', 'edge-lms' ),
                            'value'       => array(
                                esc_html__( 'Normal', 'edge-lms' )   => 'normal',
                                esc_html__( 'Small', 'edge-lms' )    => 'small',
                                esc_html__( 'Tiny', 'edge-lms' )     => 'tiny',
                                esc_html__( 'No Space', 'edge-lms' ) => 'no'
                            ),
                            'save_always' => true,
                            'admin_label' => true
                        ),
					    array(
						    'type'        => 'textfield',
						    'param_name'  => 'number_of_items',
						    'heading'     => esc_html__( 'Number of Instructors per page', 'edge-lms' ),
						    'description' => esc_html__( 'Set number of items for your instructor list. Enter -1 to show all.', 'edge-lms' ),
						    'value'       => '-1'
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'category',
						    'heading'     => esc_html__( 'One-Category Instructor List', 'edge-lms' ),
						    'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'edge-lms' )
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'selected_instructors',
						    'heading'     => esc_html__( 'Show Only Instructors with Listed IDs', 'edge-lms' ),
						    'settings'    => array(
							    'multiple'      => true,
							    'sortable'      => true,
							    'unique_values' => true
						    ),
						    'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'edge-lms' )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'order_by',
						    'heading'     => esc_html__('Order By', 'edge-lms'),
						    'value'       => array_flip(educator_edge_get_query_order_by_array()),
						    'save_always' => true
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'order',
						    'heading'    => esc_html__('Order', 'edge-lms'),
						    'value'      => array_flip(educator_edge_get_query_order_array()),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'instructor_layout',
						    'heading'     => esc_html__( 'Instructor Layout', 'edge-lms' ),
						    'value'       => array(
								esc_html__( 'Info Bellow', 'edge-lms' ) => 'info-bellow',
								esc_html__( 'Info on Hover', 'edge-lms' ) => 'info-hover',
								esc_html__( 'Simple', 'edge-lms' ) => 'simple',
                                esc_html__( 'Minimal', 'edge-lms' ) => 'minimal'
						    ),
						    'save_always' => true,
						    'group'       => esc_html__( 'Content Layout', 'edge-lms' )
					    ),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_shadow',
							'heading'     => esc_html__( 'Enable Instructor Item Shadow', 'edge-lms' ),
							'value'       => array_flip( educator_edge_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Content Layout', 'edge-lms' ),
							'dependency' => array( 'element' => 'instructor_layout', 'value' => array( 'simple' ) )
						),
						array(
							'type'        => 'colorpicker',
							'param_name'  => 'instructor_background',
							'heading'     => esc_html__( 'Instructor Item Background Color', 'edge-lms' ),
							'group'       => esc_html__( 'Content Layout', 'edge-lms' ),
							'dependency' => array( 'element' => 'instructor_layout', 'value' => array( 'simple' ) )
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
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
	        'number_of_columns'     => '3',
            'space_between_items'   => 'normal',
	        'number_of_items'       => '-1',
            'category'              => '',
            'selected_instructors'  => '',
	        'tag'                   => '',
            'order_by'              => 'date',
            'order'                 => 'ASC',
	        'instructor_layout'     => 'info-bellow',
	        'instructor_slider'     => 'no',
	        'slider_navigation'	    => 'no',
	        'slider_pagination'	    => 'no',
	        'instructor_background' => '',
	        'enable_shadow'         => 'no',
        );
		$params = shortcode_atts($args, $atts);
	
	    /***
	     * @params query_results
	     * @params holder_data
	     * @params holder_classes
	     */
		$additional_params = array();
	    
		$query_array = $this->getQueryArray($params);
		$query_results = new \WP_Query($query_array);
	    $additional_params['query_results'] = $query_results;

	    $additional_params['holder_classes'] = $this->getHolderClasses($params);
	    $additional_params['inner_classes']  = $this->getInnerClasses($params);
	    $additional_params['data_attrs']     = $this->getDataAttribute($params);
	    $additional_params['background']     = $this->getBckgColor($params);

	    $params['this_object'] = $this;
	    
	    $html = edgt_lms_get_cpt_shortcode_module_template_part('instructor', 'instructor-holder', '', $params, $additional_params);

        return $html;
	}

	/**
    * Generates instructor list query attribute array
    *
    * @param $params
    *
    * @return array
    */
	public function getQueryArray($params){
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'instructor',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['order_by'],
			'order'          => $params['order']
		);

		if(!empty($params['category'])){
			$query_array['instructor-category'] = $params['category'];
		}

		$instructor_ids = null;
		if (!empty($params['selected_instructors'])) {
            $instructor_ids = explode(',', $params['selected_instructors']);
			$query_array['post__in'] = $instructor_ids;
		}

		return $query_array;
	}

	/**
    * Generates instructor holder classes
    *
    * @param $params
    *
    * @return string
    */
	public function getHolderClasses($params){
		$classes = array();

		$number_of_columns   = $params['number_of_columns'];

        $classes[] = !empty($params['space_between_items']) ? 'edgt-tl-'.$params['space_between_items'].'-space' : 'edgt-pl-normal-space';
		$classes[] = $params['enable_shadow'] === 'yes' ? 'edgt-has-shadow' : '';

        if($params['instructor_slider'] !== 'yes') {
            switch ($number_of_columns):
                case '1':
                    $classes[] = 'edgt-tl-one-columns';
                    break;
                case '2':
                    $classes[] = 'edgt-tl-two-columns';
                    break;
                case '3':
                    $classes[] = 'edgt-tl-three-columns';
                    break;
                case '4':
                    $classes[] = 'edgt-tl-four-columns';
                    break;
                case '5':
                    $classes[] = 'edgt-tl-five-columns';
                    break;
                default:
                    $classes[] = 'edgt-tl-three-columns';
                    break;
            endswitch;
        } else {
            $classes[] = 'edgt-tl-slider';
        }

        return implode(' ', $classes);
	}
	
	/**
	 * Generates instructor inner classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getInnerClasses($params){
		$classes = array();
		
		if($params['instructor_slider'] === 'yes') {
			$classes[] = 'edgt-owl-slider';
		}
		
		return implode(' ', $classes);
	}

	/**
	 * Generates instructor background color
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getBckgColor($params){
		$classes ='';

		if($params['instructor_background'] !== '') {
			$classes = 'background-color:'.$params['instructor_background'];
		}

		return $classes;
	}


	/**
     * Return Instructor Slider data attribute
     *
     * @param $params
     *
     * @return array
     */

    private function getDataAttribute($params) {
        $data_attrs = array();
	
	    $data_attrs['data-number-of-items']   = !empty($params['number_of_columns']) ? $params['number_of_columns'] : '3';
	    $data_attrs['data-enable-navigation'] = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
	    $data_attrs['data-enable-pagination'] = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';

        return $data_attrs;
    }

	public function getInstructorSocialIcons($id) {
		$social_icons = array();

		for($i = 1; $i < 6; $i++) {
			$instructor_icon_pack = get_post_meta($id, 'edgt_instructor_social_icon_pack_'.$i, true);
			if($instructor_icon_pack) {
				$instructor_icon_collection = educator_edge_icon_collections()->getIconCollection(get_post_meta($id, 'edgt_instructor_social_icon_pack_' . $i, true));
				$instructor_social_icon = get_post_meta($id, 'edgt_instructor_social_icon_pack_' . $i . '_' . $instructor_icon_collection->param, true);
				$instructor_social_link = get_post_meta($id, 'edgt_instructor_social_icon_' . $i . '_link', true);
				$instructor_social_target = get_post_meta($id, 'edgt_instructor_social_icon_' . $i . '_target', true);

				if ($instructor_social_icon !== '') {

					$instructor_icon_params = array();
					$instructor_icon_params['icon_pack'] = $instructor_icon_pack;
					$instructor_icon_params[$instructor_icon_collection->param] = $instructor_social_icon;
					$instructor_icon_params['link'] = ($instructor_social_link !== '') ? $instructor_social_link : '';
					$instructor_icon_params['target'] = ($instructor_social_target !== '') ? $instructor_social_target : '';

					$social_icons[] = educator_edge_execute_shortcode('edgt_icon', $instructor_icon_params);
				}
			}
		}

		return $social_icons;
	}

	/**
	 * Filter instructor categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function instructorListCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS instructor_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'instructor-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['instructor_category_title'] ) > 0 ) ? esc_html__( 'Category', 'edge-lms' ) . ': ' . $value['instructor_category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find instructor category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function instructorListCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get instructor category
			$instructor_category = get_term_by( 'slug', $query, 'instructor-category' );
			if ( is_object( $instructor_category ) ) {

				$instructor_category_slug = $instructor_category->slug;
				$instructor_category_title = $instructor_category->name;

				$instructor_category_title_display = '';
				if ( ! empty( $instructor_category_title ) ) {
					$instructor_category_title_display = esc_html__( 'Category', 'edge-lms' ) . ': ' . $instructor_category_title;
				}

				$data          = array();
				$data['value'] = $instructor_category_slug;
				$data['label'] = $instructor_category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter instructors by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function instructorListIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$instructor_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'instructor' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $instructor_id > 0 ? $instructor_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'edge-lms' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'edge-lms' ) . ': ' . $value['title'] : '' );
				$results[] = $data;
			}
		}

		return $results;
	}

	/**
	 * Find instructor by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function instructorListIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get instructor
			$instructor = get_post( (int) $query );
			if ( ! is_wp_error( $instructor ) ) {

				$instructor_id = $instructor->ID;
				$instructor_title = $instructor->post_title;

				$instructor_title_display = '';
				if ( ! empty( $instructor_title ) ) {
					$instructor_title_display = ' - ' . esc_html__( 'Title', 'edge-lms' ) . ': ' . $instructor_title;
				}

				$instructor_id_display = esc_html__( 'Id', 'edge-lms' ) . ': ' . $instructor_id;

				$data          = array();
				$data['value'] = $instructor_id;
				$data['label'] = $instructor_id_display . $instructor_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}