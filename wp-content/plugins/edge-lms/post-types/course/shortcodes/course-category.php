<?php
namespace EdgefLMS\CPT\Shortcodes\Course;

use EdgefLMS\Lib;

class CourseCategory implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edgt_course_category';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Course category filter
	    add_filter( 'vc_autocomplete_edgt_course_category_category_callback', array( &$this, 'courseCategoryCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course category render
	    add_filter( 'vc_autocomplete_edgt_course_category_category_render', array( &$this, 'courseCategoryCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
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
				    'name'                      => esc_html__( 'Edge Course Category', 'edge-lms' ),
				    'base'                      => $this->getBase(),
				    'category'                  => esc_html__( 'by EDGE LMS', 'edge-lms' ),
				    'icon'                      => 'icon-wpb-course-category extended-custom-lms-icon',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array(
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'custom_class',
                            'heading'     => esc_html__( 'Custom Class', 'edge-lms' ),
                            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'edge-lms' )
                        ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'category',
						    'heading'     => esc_html__( 'Category', 'edge-lms' ),
						    'description' => esc_html__( 'Enter one category slug', 'edge-lms' )
					    ),
                        array(
                            'type'        => 'attach_image',
                            'param_name'  => 'category_image',
                            'heading'     => esc_html__( 'Category Image', 'edge-lms' ),
                            'admin_label' => true,
                            'save_always' => true,
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'title_tag',
                            'heading'     => esc_html__( 'Title Tag', 'edge-lms' ),
                            'value'       => array_flip(educator_edge_get_title_tag(true)),
                            'admin_label' => true,
                            'save_always' => true,
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'skin',
                            'heading'     => esc_html__( 'Skin', 'edge-lms' ),
                            'value'       => array(
                                esc_html__( 'Default', 'edge-lms' ) => '',
                                esc_html__( 'Light', 'edge-lms' )   => 'light-skin'
                            ),
                            'admin_label' => true,
                            'save_always' => true,
                        ),
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
            'custom_class'              => '',
            'category'                  => '',
            'category_image'            => '',
            'title_tag'                 => 'h4',
            'skin'                      => ''
        );
		$params = shortcode_atts($args, $atts);

		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['title_tag'] = $params['title_tag'] == '' ? $args['title_tag'] : $params['title_tag'];

        $html = edgt_lms_get_cpt_shortcode_module_template_part( 'course', 'course-category-item', '', $params );

	    return $html;
	}

	/**
	 * Filter course categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function courseCategoryCategoryAutocompleteSuggester( $query ) {
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
	public function courseCategoryCategoryAutocompleteRender( $query ) {
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

	private function getHolderClasses($params){
	    $holderClasses = array();

	    if(!empty($params['custom_class'])){
	        $holderClasses[] = $params['custom_class'];
        }

        $holderClasses[] = $params['skin'];

	    return implode(' ', $holderClasses);
    }

}