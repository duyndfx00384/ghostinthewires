<?php
namespace EdgefLMS\CPT\Shortcodes\Course;

use EdgefLMS\Lib;

class CourseList implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edgt_course_list';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Course category filter
	    add_filter( 'vc_autocomplete_edgt_course_list_category_callback', array( &$this, 'courseListCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course category render
	    add_filter( 'vc_autocomplete_edgt_course_list_category_render', array( &$this, 'courseListCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course selected projects filter
	    add_filter( 'vc_autocomplete_edgt_course_list_selected_courses_callback', array( &$this, 'courseListIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course selected projects render
	    add_filter( 'vc_autocomplete_edgt_course_list_selected_courses_render', array( &$this, 'courseListIdAutocompleteRender', ), 10, 1 ); // Render exact course. Must return an array (label,value)

	    //Course tag filter
	    add_filter( 'vc_autocomplete_edgt_course_list_tag_callback', array( &$this, 'courseListTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course tag render
	    add_filter( 'vc_autocomplete_edgt_course_list_tag_render', array( &$this, 'courseListTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
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
     *
     * @see vc_map
     */
    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map( array(
				    'name'                      => esc_html__( 'Edge Course List', 'edge-lms' ),
				    'base'                      => $this->getBase(),
				    'category'                  => esc_html__( 'by EDGE LMS', 'edge-lms' ),
				    'icon'                      => 'icon-wpb-course-list extended-custom-lms-icon',
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
						    'description' => esc_html__( 'Default value is Three', 'edge-lms' ),
						    'save_always' => true,
						    'admin_label' => true,
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'space_between_items',
						    'heading'     => esc_html__( 'Space Between Courses', 'edge-lms' ),
						    'value'       => array(
							    esc_html__( 'Normal', 'edge-lms' )   => 'normal',
							    esc_html__( 'Small', 'edge-lms' )    => 'small',
							    esc_html__( 'Tiny', 'edge-lms' )     => 'tiny',
							    esc_html__( 'No Space', 'edge-lms' ) => 'no'
						    ),
				        	'save_always' => true,
						    'admin_label' => true,
					    ),
					    array(
						    'type'        => 'textfield',
						    'param_name'  => 'number_of_items',
						    'heading'     => esc_html__( 'Number of Courses Per Page', 'edge-lms' ),
						    'description' => esc_html__( 'Set number of items for your course list. Enter -1 to show all.', 'edge-lms' ),
						    'value'       => '-1'
					    ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'enable_image',
                            'heading'    => esc_html__( 'Enable Image', 'edge-lms' ),
                            'value'      => array_flip(educator_edge_get_yes_no_select_array(false, true)),
                        ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'image_proportions',
						    'heading'     => esc_html__( 'Image Proportions', 'edge-lms' ),
						    'value'       => array(
							    esc_html__( 'Original', 'edge-lms' )  => 'full',
							    esc_html__( 'Square', 'edge-lms' )    => 'square',
							    esc_html__( 'Landscape', 'edge-lms' ) => 'landscape',
							    esc_html__( 'Small Landscape', 'edge-lms' ) => 'small_landscape',
							    esc_html__( 'Portrait', 'edge-lms' )  => 'portrait',
                                esc_html__( 'Thumbnail', 'edge-lms' ) => 'thumbnail',
							    esc_html__( 'Medium', 'edge-lms' )    => 'medium',
							    esc_html__( 'Large', 'edge-lms' )     => 'large'
						    ),
						    'description' => esc_html__( 'Set image proportions for your courses list.', 'edge-lms' ),
                            'dependency'  => array( 'element' => 'enable_image', 'value' => 'yes' )
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'category',
						    'heading'     => esc_html__( 'One-Category Course List', 'edge-lms' ),
						    'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'edge-lms' )
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'selected_courses',
						    'heading'     => esc_html__( 'Show Only Courses with Listed IDs', 'edge-lms' ),
						    'settings'    => array(
							    'multiple'      => true,
							    'sortable'      => true,
							    'unique_values' => true
						    ),
						    'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'edge-lms' )
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'tag',
						    'heading'     => esc_html__( 'One-Tag Courses List', 'edge-lms' ),
						    'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'edge-lms' )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'order_by',
						    'heading'     => esc_html__('Order By', 'edge-lms'),
						    'value'       => array_flip(educator_edge_get_query_order_by_array()),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'order',
						    'heading'     => esc_html__('Order', 'edge-lms'),
						    'value'       => array_flip(educator_edge_get_query_order_array()),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'item_layout',
						    'heading'     => esc_html__( 'Item Style', 'edge-lms' ),
						    'value'       => array(
							    esc_html__( 'Standard ', 'edge-lms' )  => 'standard',
							    esc_html__( 'Minimal ', 'edge-lms' )   => 'minimal',
						    ),
						    'group'       => esc_html__( 'Content Layout', 'edge-lms' ),
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'enable_title',
						    'heading'    => esc_html__( 'Enable Title', 'edge-lms' ),
						    'value'      => array_flip(educator_edge_get_yes_no_select_array(false, true)),
						    'group'      => esc_html__( 'Content Layout', 'edge-lms' ),
                            'dependency'  => array( 'element' => 'item_layout', 'value' => array( 'standard' ) )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'title_tag',
						    'heading'     => esc_html__( 'Title Tag', 'edge-lms' ),
						    'value'       => array_flip(educator_edge_get_title_tag(true)),
						    'dependency'  => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
						    'group'       => esc_html__( 'Content Layout', 'edge-lms' ),
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'title_text_transform',
						    'heading'     => esc_html__( 'Title Text Transform', 'edge-lms' ),
						    'value'       => array_flip(educator_edge_get_text_transform_array(true)),
						    'dependency'  => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
						    'group'       => esc_html__( 'Content Layout', 'edge-lms' )
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'enable_instructor',
						    'heading'    => esc_html__( 'Enable Instructor', 'edge-lms' ),
						    'value'      => array_flip(educator_edge_get_yes_no_select_array(false, true)),
						    'group'      => esc_html__( 'Content Layout', 'edge-lms' ),
                            'dependency'  => array( 'element' => 'item_layout', 'value' => array( 'standard' ) )
					    ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'enable_price',
                            'heading'    => esc_html__( 'Enable Price', 'edge-lms' ),
                            'value'      => array_flip(educator_edge_get_yes_no_select_array(false, true)),
                            'group'      => esc_html__( 'Content Layout', 'edge-lms' ),
                            'dependency'  => array( 'element' => 'item_layout', 'value' => array( 'standard' ) )
                        ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'enable_excerpt',
						    'heading'    => esc_html__( 'Enable Excerpt', 'edge-lms' ),
						    'value'      => array_flip(educator_edge_get_yes_no_select_array(false ,true)),
						    'group'      => esc_html__( 'Content Layout', 'edge-lms' ),
                            'dependency'  => array( 'element' => 'item_layout', 'value' => array( 'standard' ) )
					    ),
					    array(
						    'type'        => 'textfield',
						    'param_name'  => 'excerpt_length',
						    'heading'     => esc_html__( 'Excerpt Length', 'edge-lms' ),
						    'description' => esc_html__( 'Number of characters', 'edge-lms' ),
						    'dependency'  => array( 'element' => 'enable_excerpt', 'value' => array( 'yes' ) ),
						    'group'       => esc_html__( 'Content Layout', 'edge-lms' )
					    ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'enable_students',
                            'heading'    => esc_html__( 'Enable Students', 'edge-lms' ),
                            'value'      => array_flip(educator_edge_get_yes_no_select_array(false, true)),
                            'group'      => esc_html__( 'Content Layout', 'edge-lms' ),
                            'dependency'  => array( 'element' => 'item_layout', 'value' => array( 'standard' ) )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'enable_category',
                            'heading'    => esc_html__( 'Enable Category', 'edge-lms' ),
                            'value'      => array_flip(educator_edge_get_yes_no_select_array(false, false)),
                            'group'      => esc_html__( 'Content Layout', 'edge-lms' ),
                            'dependency'  => array( 'element' => 'item_layout', 'value' => array( 'standard' ) )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'enable_duration',
                            'heading'    => esc_html__( 'Enable Duration', 'edge-lms' ),
                            'value'      => array_flip(educator_edge_get_yes_no_select_array(false, true)),
                            'group'      => esc_html__( 'Content Layout', 'edge-lms' ),
                            'dependency'  => array( 'element' => 'item_layout', 'value' => array( 'standard' ) )
                        ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'pagination_type',
						    'heading'     => esc_html__( 'Pagination Type', 'edge-lms' ),
						    'value'       => array(
							    esc_html__( 'None', 'edge-lms' )  => 'no-pagination',
							    esc_html__( 'Standard', 'edge-lms' ) => 'standard',
							    esc_html__( 'Load More', 'edge-lms' )    => 'load-more',
							    esc_html__( 'Infinite Scroll', 'edge-lms' )  => 'infinite-scroll'
						    ),
						    'group'       => esc_html__( 'Additional Features', 'edge-lms' )
					    ),
					    array(
						    'type'       => 'textfield',
						    'param_name' => 'load_more_top_margin',
						    'heading'    => esc_html__( 'Load More Top Margin (px or %)', 'edge-lms' ),
						    'dependency' => array( 'element' => 'pagination_type', 'value' => array( 'load-more' ) ),
						    'group'      => esc_html__( 'Additional Features', 'edge-lms' )
					    ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'filter',
                            'heading'    => esc_html__( 'Enable Filter', 'edge-lms' ),
                            'value'      => array_flip(educator_edge_get_yes_no_select_array(false)),
                            'group'      => esc_html__( 'Additional Features', 'edge-lms' )
                        ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'enable_article_animation',
						    'heading'     => esc_html__( 'Enable Article Animation', 'edge-lms' ),
						    'value'       => array_flip(educator_edge_get_yes_no_select_array(false)),
						    'description' => esc_html__( 'Enabling this option you will enable appears animation for your course list items', 'edge-lms' ),
						    'group'       => esc_html__( 'Additional Features', 'edge-lms' ),
                            'dependency'  => array( 'element' => 'item_layout', 'value' => array( 'standard' ) )
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
	        'number_of_columns'         => '3',
            'space_between_items'       => 'normal',
	        'number_of_items'           => '-1',
            'enable_image'              => 'yes',
            'image_proportions'         => 'full',
            'category'                  => '',
            'selected_courses'          => '',
	        'tag'                       => '',
            'order_by'                  => 'date',
            'order'                     => 'DESC',
	        'item_layout'                => 'standard',
	        'enable_title'              => 'yes',
            'title_tag'                 => 'h4',
	        'title_text_transform'      => '',
            'enable_instructor'         => 'yes',
            'enable_price'              => 'yes',
            'enable_excerpt'            => 'yes',
            'excerpt_length'            => '60',
            'enable_students'           => 'yes',
            'enable_category'           => 'no',
            'enable_duration'           => 'yes',
            'pagination_type'           => 'no-pagination',
	        'load_more_top_margin'      => '',
            'filter'                    => 'no',
            'enable_article_animation'  => 'no',
	        'course_slider_on'          => 'no',
            'enable_loop'               => 'yes',
            'enable_autoplay'		    => 'yes',
            'slider_speed'              => '5000',
            'slider_speed_animation'    => '600',
            'enable_navigation'         => 'yes',
            'navigation_skin'           => '',
            'enable_pagination'         => 'yes',
            'pagination_skin'           => '',
	        'pagination_position'       => '',
            'widget'                    => 'no',
        );
		$params = shortcode_atts($args, $atts);
	
	    /***
	     * @params query_results
	     * @params holder_data
	     * @params holder_classes
	     * @params holder_inner_classes
	     */
		$additional_params = array();
	
	    $query_array                        = $this->getQueryArray( $params );
	    $query_results                      = new \WP_Query( $query_array );
	    $additional_params['query_results'] = $query_results;

	    $additional_params['pagination_values']    = $this->getPaginationValues($params);
	    $additional_params['holder_data']          = $this->getHolderData( $params, $additional_params );
	    $additional_params['holder_classes']       = $this->getHolderClasses( $params );
	    $additional_params['holder_inner_classes'] = $this->getHolderInnerClasses( $params );
        $additional_params['slug'] = '';

        if($params['widget'] == 'yes') {
            $additional_params['slug'] = 'widget';
        }
	
	    $params['this_object'] = $this;
	
	    $html = edgt_lms_get_cpt_shortcode_module_template_part( 'course', 'course-holder', '', $params, $additional_params );
	
	    return $html;
	}

	/**
    * Generates course list query attribute array
    *
    * @param $params
    *
    * @return array
    */
	public function getQueryArray($params){
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'course',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['order_by'],
			'order'          => $params['order']
		);

		if(!empty($params['category'])){
			$query_array['course-category'] = $params['category'];
		}

		$project_ids = null;
		if (!empty($params['selected_courses'])) {
			$project_ids = explode(',', $params['selected_courses']);
			$query_array['post__in'] = $project_ids;
		}

		if(!empty($params['tag'])){
			$query_array['course-tag'] = $params['tag'];
		}

		if(!empty($params['next_page'])){
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}

		return $query_array;
	}

    public function getPaginationValues($params){
	    $paginationValues = array();

        if(!empty($params['next_page'])){
            $paginationValues['paged'] = $params['next_page'];
        } else {
            $paginationValues['paged'] = 1;
        }

        $query_array = array(
            'post_status'    => 'publish',
            'post_type'      => 'course',
            'posts_per_page' => -1
        );

        if(!empty($params['category'])){
            $query_array['course-category'] = $params['category'];
        }

        $project_ids = null;
        if (!empty($params['selected_courses'])) {
            $project_ids = explode(',', $params['selected_courses']);
            $query_array['post__in'] = $project_ids;
        }

        if(!empty($params['tag'])){
            $query_array['course-tag'] = $params['tag'];
        }

        $query_results  = new \WP_Query( $query_array );
        $posts = $query_results->get_posts();
        $paginationValues['total_items'] = count($posts);

        if(!empty($params['number_of_items'])){
            if ($params['number_of_items'] == '-1') {
                $paginationValues['min_value'] = 1;
                $paginationValues['max_value'] = count($posts);
            } else {
                if($paginationValues['paged'] == '1') {
                    $paginationValues['min_value'] = 1;
                    $paginationValues['max_value'] = $params['number_of_items'];
                } else {
                    $paginationValues['min_value'] = ($paginationValues['paged'] - 1) * $params['number_of_items'] + 1;
                    $paginationValues['max_value'] = $paginationValues['paged'] * $params['number_of_items'];
                }
            }
        }

        return $paginationValues;
    }
	
	/**
	 * Generates data attributes array
	 *
	 * @param $params
	 * @param $additional_params
	 *
	 * @return string
	 */
	public function getHolderData($params, $additional_params){
		$dataString = '';
		
		if(get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif(get_query_var('page')) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		
		$query_results = $additional_params['query_results'];
		$params['max_num_pages'] = $query_results->max_num_pages;
		
		if(!empty($paged)) {
			$params['next_page'] = $paged+1;
		}
		
		foreach ($params as $key => $value) {
			if($value !== '') {
				$new_key = str_replace( '_', '-', $key );
				
				$dataString .= ' data-'.$new_key.'="'.esc_attr($value) . '"';
			}
		}
		
		return $dataString;
	}

	/**
    * Generates course holder classes
    *
    * @param $params
    *
    * @return string
    */
	public function getHolderClasses( $params ) {
		$classes = array();

		$classes[] = 'edgt-cl-gallery';
		$classes[] = ! empty( $params['space_between_items'] ) ? 'edgt-' . $params['space_between_items'] . '-space' : 'edgt-normal-space';
		
		$number_of_columns = $params['number_of_columns'];
		switch ( $number_of_columns ):
			case '1':
				$classes[] = 'edgt-cl-one-column';
				break;
			case '2':
				$classes[] = 'edgt-cl-two-columns';
				break;
			case '3':
				$classes[] = 'edgt-cl-three-columns';
				break;
			case '4':
				$classes[] = 'edgt-cl-four-columns';
				break;
			case '5':
				$classes[] = 'edgt-cl-five-columns';
				break;
			default:
				$classes[] = 'edgt-cl-three-columns';
				break;
		endswitch;
		
		$classes[] = ! empty( $params['item_layout'] ) ? 'edgt-cl-' . $params['item_layout'] : '';
		$classes[] = ! empty( $params['pagination_type'] ) ? 'edgt-cl-pag-' . $params['pagination_type'] : '';
		$classes[] = $params['enable_article_animation'] === 'yes' ? 'edgt-cl-has-animation' : '';
        $classes[] = $params['filter'] === 'yes' ? 'edgt-cl-has-filter' : '';
		$classes[] = ! empty( $params['navigation_skin'] ) ? 'edgt-nav-' . $params['navigation_skin'] . '-skin' : '';
		$classes[] = ! empty( $params['pagination_skin'] ) ? 'edgt-pag-' . $params['pagination_skin'] . '-skin' : '';
		$classes[] = ! empty( $params['pagination_position'] ) ? 'edgt-pag-' . $params['pagination_position'] : '';
		
		return implode( ' ', $classes );
	}
	
	/**
	 * Generates course holder inner classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getHolderInnerClasses($params){
		$classes = array();
		
		$classes[] = $params['course_slider_on'] === 'yes' ? 'edgt-owl-slider edgt-pl-is-slider' : '';
		
		return implode(' ', $classes);
	}

	/**
	 * Generates course article classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getArticleClasses($params){
		$classes = array();
		
		$article_classes = get_post_class($classes);

		return implode(' ', $article_classes);
	}

    /**
     * Generates course article data for sorting
     *
     * @param $params
     *
     * @return string
     */
    public function getArticleData($params){
        $data = array();
        $dataString = '';
        $data['name'] = strtolower(str_replace(' ', '-', get_the_title()));
        $data['date'] = strtotime(get_the_date());

        foreach ($data as $key => $value) {
            if($value !== '') {
                $dataString .= ' data-'.$key.'=' . esc_attr($value);
            }
        }

		return $dataString;

    }

	/**
    * Generates course image size
    *
    * @param $params
    *
    * @return string
    */
	public function getImageSize($params){
		$thumb_size = 'full';

		if (!empty($params['image_proportions'])) {
			$image_size = $params['image_proportions'];

			switch ($image_size) {
				case 'landscape':
					$thumb_size = 'educator_edge_landscape';
					break;
				case 'small_landscape':
					$thumb_size = 'educator_edge_small_landscape';
					break;
				case 'portrait':
					$thumb_size = 'educator_edge_portrait';
					break;
				case 'square':
					$thumb_size = 'educator_edge_square';
					break;
				case 'medium':
					$thumb_size = 'medium';
					break;
				case 'large':
					$thumb_size = 'large';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
			}
		}

		return $thumb_size;
	}

	/**
	 * Returns array of title element styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getTitleStyles($params) {
		$styles = array();
		
		if(!empty($params['title_text_transform'])) {
			$styles[] = 'text-transform: '.$params['title_text_transform'];
		}
		
		return implode(';', $styles);
	}
	
	/**
	 * Returns array of load more element styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getLoadMoreStyles($params) {
		$styles = array();
		
		if (!empty($params['load_more_top_margin'])) {
			$margin = $params['load_more_top_margin'];
			
			if(educator_edge_string_ends_with($margin, '%') || educator_edge_string_ends_with($margin, 'px')) {
				$styles[] = 'margin-top: '.$margin;
			} else {
				$styles[] = 'margin-top: '.educator_edge_filter_px($margin).'px';
			}
		}
		
		return implode(';', $styles);
	}

	/**
	 * Filter course categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function courseListCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS course_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'course-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['course_category_title'] ) > 0 ) ? esc_html__( 'Category', 'edge-lms' ) . ': ' . $value['course_category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find course category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function courseListCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get course category
			$course_category = get_term_by( 'slug', $query, 'course-category' );
			if ( is_object( $course_category ) ) {

				$course_category_slug = $course_category->slug;
				$course_category_title = $course_category->name;

				$course_category_title_display = '';
				if ( ! empty( $course_category_title ) ) {
                    $course_category_title_display = esc_html__( 'Category', 'edge-lms' ) . ': ' . $course_category_title;
				}

				$data          = array();
				$data['value'] = $course_category_slug;
				$data['label'] = $course_category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter courses by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function courseListIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$course_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'course' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $course_id > 0 ? $course_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

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
	 * Find course by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function courseListIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get course
			$course = get_post( (int) $query );
			if ( ! is_wp_error( $course ) ) {

				$course_id = $course->ID;
				$course_title = $course->post_title;

				$course_title_display = '';
				if ( ! empty( $course_title ) ) {
                    $course_title_display = ' - ' . esc_html__( 'Title', 'edge-lms' ) . ': ' . $course_title;
				}

				$course_id_display = esc_html__( 'Id', 'edge-lms' ) . ': ' . $course_id;

				$data          = array();
				$data['value'] = $course_id;
				$data['label'] = $course_id_display . $course_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter course tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function courseListTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS course_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'course-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['course_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'edge-lms' ) . ': ' . $value['course_tag_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find course tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function courseListTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get course tag
			$course_tag = get_term_by( 'slug', $query, 'course-tag' );
			if ( is_object( $course_tag ) ) {

				$course_tag_slug = $course_tag->slug;
				$course_tag_title = $course_tag->name;

				$course_tag_title_display = '';
				if ( ! empty( $course_tag_title ) ) {
                    $course_tag_title_display = esc_html__( 'Tag', 'edge-lms' ) . ': ' . $course_tag_title;
				}

				$data          = array();
				$data['value'] = $course_tag_slug;
				$data['label'] = $course_tag_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}