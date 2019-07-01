<?php
namespace EdgefLMS\CPT\Shortcodes\Instructor;

use EdgefLMS\Lib;

class InstructorSlider implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edgt_instructor_slider';

        add_action('vc_before_init', array($this, 'vcMap'));

        //Instructor category filter
        add_filter( 'vc_autocomplete_edgt_instructor_slider_category_callback', array( &$this, 'instructorSliderCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Instructor category render
        add_filter( 'vc_autocomplete_edgt_instructor_slider_category_render', array( &$this, 'instructorSliderCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Instructor selected projects filter
        add_filter( 'vc_autocomplete_edgt_instructor_slider_selected_instructors_callback', array( &$this, 'instructorSliderIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

        //Instructor selected projects render
        add_filter( 'vc_autocomplete_edgt_instructor_slider_selected_instructors_render', array( &$this, 'instructorSliderIdAutocompleteRender', ), 10, 1 ); // Render exact instructor. Must return an array (label,value)
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map(
		    	array(
				    'name'                      => esc_html__( 'Edge Instructor Slider', 'edge-lms' ),
				    'base'                      => $this->base,
				    'category'                  => esc_html__( 'by EDGE LMS', 'edge-lms' ),
				    'icon'                      => 'icon-wpb-instructor-slider extended-custom-lms-icon',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array(
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'number_of_columns',
						    'heading'     => esc_html__( 'Number of Columns in Row', 'edge-lms' ),
						    'value'       => array(
							    esc_html__( 'Three', 'edge-lms' ) => '3',
							    esc_html__( 'Four', 'edge-lms' )  => '4',
							    esc_html__( 'Five', 'edge-lms' )  => '5',
							    esc_html__( 'Six', 'edge-lms' )   => '6'
						    ),
						    'save_always' => true
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
						    'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'edge-lms' ),
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
						    'heading'     => esc_html__( 'Order By', 'edge-lms' ),
						    'value'       => array_flip( educator_edge_get_query_order_by_array() ),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'order',
						    'heading'     => esc_html__( 'Order', 'edge-lms' ),
						    'value'       => array_flip( educator_edge_get_query_order_array() ),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'instructor_layout',
						    'heading'     => esc_html__( 'Instructor Layout', 'edge-lms' ),
						    'value'       => array(
							    esc_html__( 'Info Bellow', 'edge-lms' )    => 'info-bellow',
							    esc_html__( 'Info on Hover', 'edge-lms' )  => 'info-hover',
                                esc_html__( 'Simple', 'edge-lms' ) => 'simple',

                                esc_html__( 'Minimal', 'edge-lms' ) => 'minimal'
						    ),
						    'save_always' => true,
						    'group'       => esc_html__( 'Content Layout', 'edge-lms' )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'slider_navigation',
						    'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'edge-lms' ),
						    'value'       => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'slider_pagination',
						    'heading'     => esc_html__( 'Enable Slider Pagination', 'edge-lms' ),
						    'value'       => array_flip( educator_edge_get_yes_no_select_array( false, true ) ),
						    'save_always' => true
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

    public function render($atts, $content = null) {
        $default_atts = array(
            'number_of_columns'     => '3',
            'space_between_items'   => 'normal',
            'number_of_items'       => '-1',
            'category'              => '',
            'selected_instructors'  => '',
            'tag'                   => '',
            'order_by'              => 'date',
            'order'                 => 'ASC',
            'instructor_layout'     => 'info-bellow',
            'instructor_slider'     => 'yes',
            'slider_navigation'	    => 'yes',
            'slider_pagination'	    => 'yes',
            'instructor_background'	=> '',
        );

        $params = shortcode_atts($default_atts, $atts);

        $params['content'] = $content;

        $html = '';
        $html .= '<div class="edgt-instructor-slider-holder">';
        $html .= educator_edge_execute_shortcode('edgt_instructor_list', $params);
        $html .= '</div>';

        return $html;
    }

    /**
     * Filter instructor categories
     *
     * @param $query
     *
     * @return array
     */
    public function instructorSliderCategoryAutocompleteSuggester( $query ) {
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
    public function instructorSliderCategoryAutocompleteRender( $query ) {
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
    public function instructorSliderIdAutocompleteSuggester( $query ) {
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
    public function instructorSliderIdAutocompleteRender( $query ) {
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