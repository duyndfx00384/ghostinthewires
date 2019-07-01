<?php
namespace EdgefLMS\CPT\Shortcodes\Course;

use EdgefLMS\Lib;

class CourseSlider implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edgt_course_slider';

	    add_action('vc_before_init', array($this, 'vcMap'));

	    //Course category filter
	    add_filter( 'vc_autocomplete_edgt_course_slider_category_callback', array( &$this, 'courseSliderCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course category render
	    add_filter( 'vc_autocomplete_edgt_course_slider_category_render', array( &$this, 'courseSliderCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course selected projects filter
	    add_filter( 'vc_autocomplete_edgt_course_slider_selected_courses_callback', array( &$this, 'courseSliderIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course selected projects render
	    add_filter( 'vc_autocomplete_edgt_course_slider_selected_courses_render', array( &$this, 'courseSliderIdAutocompleteRender', ), 10, 1 ); // Render exact course. Must return an array (label,value)

	    //Course tag filter
	    add_filter( 'vc_autocomplete_edgt_course_slider_tag_callback', array( &$this, 'courseSliderTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course tag render
	    add_filter( 'vc_autocomplete_edgt_course_slider_tag_render', array( &$this, 'courseSliderTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
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
	        vc_map( array(
		        'name'                      => esc_html__( 'Edge Course Slider', 'edge-lms' ),
		        'base'                      => $this->base,
		        'category'                  => esc_html__( 'by EDGE LMS', 'edge-lms' ),
		        'icon'                      => 'icon-wpb-course-slider extended-custom-lms-icon',
		        'allowed_container_element' => 'vc_row',
		        'params'                    => array(
			        array(
				        'type'        => 'textfield',
				        'param_name'  => 'number_of_items',
				        'heading'     => esc_html__( 'Number of Course Items', 'edge-lms' ),
				        'admin_label' => true,
				        'description' => esc_html__( 'Set number of items for your course slider. Enter -1 to show all', 'edge-lms' )
			        ),
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
				        'description' => esc_html__( 'Number of courses that are showing at the same time in slider (on smaller screens is responsive so there will be less items shown). Default value is Four', 'edge-lms' ),
				        'save_always' => true,
					    'admin_label' => true
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'space_between_items',
				        'heading'     => esc_html__( 'Space Between Course Items', 'edge-lms' ),
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
				        'type'        => 'dropdown',
				        'param_name'  => 'image_proportions',
				        'heading'     => esc_html__( 'Image Proportions', 'edge-lms' ),
				        'value'       => array(
					        esc_html__( 'Original', 'edge-lms' )  => 'full',
					        esc_html__( 'Square', 'edge-lms' )    => 'square',
					        esc_html__( 'Landscape', 'edge-lms' ) => 'landscape',
					        esc_html__( 'Portrait', 'edge-lms' )  => 'portrait',
					        esc_html__( 'Medium', 'edge-lms' )    => 'medium',
					        esc_html__( 'Large', 'edge-lms' )     => 'large'
				        ),
				        'description' => esc_html__( 'Set image proportions for your course slider.', 'edge-lms' ),
				        'save_always' => true
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
				        'heading'     => esc_html__( 'One-Tag Course List', 'edge-lms' ),
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
				        'type'       => 'dropdown',
				        'param_name' => 'order',
				        'heading'    => esc_html__('Order', 'edge-lms'),
				        'value'      => array_flip(educator_edge_get_query_order_array()),
				        'save_always' => true
			        ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'enable_title',
                        'heading'    => esc_html__( 'Enable Title', 'edge-lms' ),
                        'value'      => array_flip(educator_edge_get_yes_no_select_array(false, true)),
                        'group'      => esc_html__( 'Content Layout', 'edge-lms' ),
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
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'enable_price',
                        'heading'    => esc_html__( 'Enable Price', 'edge-lms' ),
                        'value'      => array_flip(educator_edge_get_yes_no_select_array(false, true)),
                        'group'      => esc_html__( 'Content Layout', 'edge-lms' ),
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'enable_excerpt',
                        'heading'    => esc_html__( 'Enable Excerpt', 'edge-lms' ),
                        'value'      => array_flip(educator_edge_get_yes_no_select_array(false)),
                        'group'      => esc_html__( 'Content Layout', 'edge-lms' )
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
                    ),
                    array(
                        'type'       => 'dropdown',
                        'param_name' => 'enable_category',
                        'heading'    => esc_html__( 'Enable Category', 'edge-lms' ),
                        'value'      => array_flip(educator_edge_get_yes_no_select_array(false, true)),
                        'group'      => esc_html__( 'Content Layout', 'edge-lms' ),
                    ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'enable_loop',
				        'heading'     => esc_html__('Enable Slider Loop', 'edge-lms'),
				        'value'       => array_flip(educator_edge_get_yes_no_select_array(false, false)),
				        'save_always' => true,
				        'group'       => esc_html__('Slider Settings', 'edge-lms'),
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'enable_autoplay',
				        'heading'     => esc_html__('Enable Slider Autoplay', 'edge-lms'),
				        'value'       => array_flip(educator_edge_get_yes_no_select_array(false, true)),
				        'save_always' => true,
				        'group'       => esc_html__('Slider Settings', 'edge-lms')
			        ),
			        array(
				        'type'        => 'textfield',
				        'param_name'  => 'slider_speed',
				        'heading'     => esc_html__('Slide Duration', 'edge-lms'),
				        'description' => esc_html__('Default value is 5000 (ms)', 'edge-lms'),
				        'group'       => esc_html__('Slider Settings', 'edge-lms')
			        ),
			        array(
				        'type'        => 'textfield',
				        'param_name'  => 'slider_speed_animation',
				        'heading'     => esc_html__('Slide Animation Duration', 'edge-lms'),
				        'description' => esc_html__('Speed of slide animation in milliseconds. Default value is 600.', 'edge-lms'),
				        'group'       => esc_html__('Slider Settings', 'edge-lms')
			        ),
			        array(
				        'type'		  => 'dropdown',
				        'param_name'  => 'enable_navigation',
				        'heading'	  => esc_html__('Enable Slider Navigation Arrows', 'edge-lms'),
				        'value'       => array_flip(educator_edge_get_yes_no_select_array(false, true)),
				        'save_always' => true,
				        'group'       => esc_html__('Slider Settings', 'edge-lms')
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'navigation_skin',
				        'heading'     => esc_html__( 'Navigation Skin', 'edge-lms' ),
				        'value'       => array(
					        esc_html__( 'Default', 'edge-lms' ) => '',
					        esc_html__( 'Light', 'edge-lms' )   => 'light',
					        esc_html__( 'Dark', 'edge-lms' )    => 'dark'
				        ),
				        'dependency'  => array( 'element' => 'enable_navigation', 'value' => array( 'yes' ) ),
				        'group'       => esc_html__( 'Slider Settings', 'edge-lms' )
			        ),
			        array(
				        'type'		  => 'dropdown',
				        'param_name'  => 'enable_pagination',
				        'heading'	  => esc_html__('Enable Slider Pagination', 'edge-lms'),
				        'value'       => array_flip(educator_edge_get_yes_no_select_array(false, true)),
				        'save_always' => true,
				        'group'       => esc_html__('Slider Settings', 'edge-lms')
			        ),
			        array(
				        'type'       => 'dropdown',
				        'param_name' => 'pagination_skin',
				        'heading'    => esc_html__( 'Pagination Skin', 'edge-lms' ),
				        'value'      => array(
					        esc_html__( 'Default', 'edge-lms' ) => '',
					        esc_html__( 'Light', 'edge-lms' )   => 'light',
					        esc_html__( 'Dark', 'edge-lms' )    => 'dark'
				        ),
				        'dependency' => array( 'element' => 'enable_pagination', 'value' => array( 'yes' ) ),
				        'group'      => esc_html__( 'Slider Settings', 'edge-lms' )
			        ),
			        array(
				        'type'        => 'dropdown',
				        'param_name'  => 'pagination_position',
				        'heading'     => esc_html__( 'Pagination Position', 'edge-lms' ),
				        'value'       => array(
					        esc_html__( 'Below Slider', 'edge-lms' ) => 'below-slider',
					        esc_html__( 'On Slider', 'edge-lms' )    => 'on-slider'
				        ),
				        'save_always' => true,
				        'dependency'  => array( 'element' => 'enable_pagination', 'value' => array( 'yes' ) ),
				        'group'       => esc_html__( 'Slider Settings', 'edge-lms' )
			        )
		        )
	        ) );
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
        $args = array(
	        'number_of_items'        => '9',
	        'number_of_columns'      => '4',
	        'space_between_items'    => 'normal',
	        'image_proportions'      => 'full',
	        'category'               => '',
	        'selected_projects'      => '',
	        'tag'                    => '',
	        'order_by'               => 'date',
	        'order'                  => 'ASC',
	        'item_layout'             => 'standard',
            'enable_title'              => 'yes',
            'title_tag'                 => 'h5',
            'title_text_transform'      => '',
            'enable_instructor'         => 'yes',
            'enable_price'              => 'yes',
            'enable_excerpt'            => 'no',
            'excerpt_length'            => '20',
            'enable_students'           => 'yes',
            'enable_category'           => 'yes',
	        'enable_loop'		     => 'no',
	        'enable_autoplay'		 => 'yes',
	        'slider_speed'		     => '5000',
	        'slider_speed_animation' => '600',
	        'enable_navigation'	     => 'yes',
	        'navigation_skin'        => '',
	        'enable_pagination'	     => 'yes',
	        'pagination_skin'        => '',
	        'pagination_position'    => 'below-slider'
        );
		$params = shortcode_atts($args, $atts);

	    $params['course_slider_on'] = 'yes';

		$html = '';

	    $html .= '<div class="edgt-course-slider-holder">';
			$html .= educator_edge_execute_shortcode('edgt_course_list', $params);
	    $html .= '</div>';

        return $html;
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
     * Filter course categories
     *
     * @param $query
     *
     * @return array
     */
    public function courseSliderCategoryAutocompleteSuggester( $query ) {
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
    public function courseSliderCategoryAutocompleteRender( $query ) {
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
    public function courseSliderIdAutocompleteSuggester( $query ) {
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
    public function courseSliderIdAutocompleteRender( $query ) {
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
    public function courseSliderTagAutocompleteSuggester( $query ) {
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
    public function courseSliderTagAutocompleteRender( $query ) {
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