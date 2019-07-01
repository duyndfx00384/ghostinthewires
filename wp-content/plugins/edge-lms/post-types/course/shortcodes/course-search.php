<?php
namespace EdgefLMS\CPT\Shortcodes\Course;

use EdgefLMS\Lib;

class CourseSearch implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'edgt_course_search';

        add_action('vc_before_init', array($this, 'vcMap'));
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
			        'name'                      => esc_html__( 'Edge Advanced Course Search', 'edge-lms' ),
			        'base'                      => $this->getBase(),
			        'category'                  => esc_html__( 'by EDGE LMS', 'edge-lms' ),
			        'icon'                      => 'icon-wpb-course-search extended-custom-lms-icon',
			        'allowed_container_element' => 'vc_row',
			        'params'                    => array(
				        array(
					        'type'        => 'dropdown',
					        'param_name'  => 'enable_category',
					        'heading'     => esc_html__( 'Enable Category', 'edge-lms' ),
					        'description' => esc_html__( 'Enable category as parameter for search', 'edge-lms' ),
					        'value'       => array_flip(educator_edge_get_yes_no_select_array(false, true)),
					        'admin_label' => true
				        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_instructor',
                            'heading'     => esc_html__( 'Enable Instructor', 'edge-lms' ),
                            'description' => esc_html__( 'Enable instructor as parameter for search', 'edge-lms' ),
                            'value'       => array_flip(educator_edge_get_yes_no_select_array(false, true)),
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'enable_price',
                            'heading'     => esc_html__( 'Enable Price', 'edge-lms' ),
                            'description' => esc_html__( 'Enable price as parameter for search', 'edge-lms' ),
                            'value'       => array_flip(educator_edge_get_yes_no_select_array(false, true)),
                            'admin_label' => true
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'button_text',
                            'heading'     => esc_html__( 'Button Text', 'edge-lms' ),
                            'value'       => esc_html__( 'Search', 'edge-lms' ),
                            'save_always' => true,
                            'group'       => esc_html__( 'Button Style', 'edge-lms' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'button_type',
                            'heading'     => esc_html__( 'Button Type', 'edge-lms' ),
                            'value'       => array(
                                esc_html__( 'Solid', 'edge-lms' )   => 'solid',
                                esc_html__( 'Outline', 'edge-lms' ) => 'outline'
                            ),
                            'save_always' => true,
                            'group'       => esc_html__( 'Button Style', 'edge-lms' )
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'button_size',
                            'heading'     => esc_html__( 'Button Size', 'edge-lms' ),
                            'value'       => array(
                                esc_html__( 'Default', 'edge-lms' ) => '',
                                esc_html__( 'Small', 'edge-lms' )   => 'small',
                                esc_html__( 'Medium', 'edge-lms' )  => 'medium',
                                esc_html__( 'Large', 'edge-lms' )   => 'large'
                            ),
                            'save_always' => true,
                            'dependency'  => array(
                                'element' => 'button_type',
                                'value'   => array( 'solid', 'outline' )
                            ),
                            'group'       => esc_html__( 'Button Style', 'edge-lms' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_color',
                            'heading'    => esc_html__( 'Button Color', 'edge-lms' ),
                            'group'      => esc_html__( 'Button Style', 'edge-lms' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_hover_color',
                            'heading'    => esc_html__( 'Button Hover Color', 'edge-lms' ),
                            'group'      => esc_html__( 'Button Style', 'edge-lms' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_background_color',
                            'heading'    => esc_html__( 'Button Background Color', 'edge-lms' ),
                            'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid' ) ),
                            'group'      => esc_html__( 'Button Style', 'edge-lms' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_hover_background_color',
                            'heading'    => esc_html__( 'Button Hover Background Color', 'edge-lms' ),
                            'group'      => esc_html__( 'Button Style', 'edge-lms' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_border_color',
                            'heading'    => esc_html__( 'Button Border Color', 'edge-lms' ),
                            'group'      => esc_html__( 'Button Style', 'edge-lms' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'button_hover_border_color',
                            'heading'    => esc_html__( 'Button Hover Border Color', 'edge-lms' ),
                            'group'      => esc_html__( 'Button Style', 'edge-lms' )
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
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
	        'enable_category'               => 'yes',
	        'enable_instructor'             => 'yes',
	        'enable_price'                  => 'yes',
            'button_text'                   => 'Search',
            'button_type'                   => 'solid',
            'button_size'                   => 'medium',
            'button_color'                  => '',
            'button_hover_color'            => '',
            'button_background_color'       => '',
            'button_hover_background_color' => '',
            'button_border_color'           => '',
            'button_hover_border_color'     => '',
            'selected_category'             => '',
            'selected_instructor'           => '',
            'selected_price'                => ''
        );

		$params = shortcode_atts($args, $atts);
		extract($params);

        $params['button_parameters']    = $this->getButtonParameters( $params );

		$html = '';

        $html .= '<form role="search" method="get" class="searchform edgt-advanced-course-search" id="searchform" action="' . esc_url(home_url("/")) . '">';
        $html .= '<div class="input-holder clearfix">';
        $html .= '<input type="hidden" name="s" value="" />';
        $html .= '<input type="hidden" name="edgt-course-search" value="yes" />';
        if(!empty($params['enable_category']) && $params['enable_category'] == 'yes') {
            $html .= '<select name="edgt-course-category">';
            $html .= $this->getCourseCategories($params);
            $html .= '</select>';
        }
        if(!empty($params['enable_instructor']) && $params['enable_instructor'] == 'yes') {
            $html .= '<select name="edgt-course-instructor">';
            $html .= $this->getCourseInstructors($params);
            $html .= '</select>';
        }
        if(!empty($params['enable_price']) && $params['enable_price'] == 'yes') {
            $html .= '<select name="edgt-course-price">';
            $html .= $this->getCoursePrice($params);
            $html .= '</select>';
        }
        $html .= educator_edge_get_button_html($params['button_parameters']);
        $html .= '</div>';
        $html .= '</form>';

        return $html;
	}

	private function getCourseCategories($params) {
        $html = '';
        $terms_args = array();
        $terms_args['taxonomy'] = 'course-category';
        $terms_args['hide_empty'] = true;
        $terms = get_terms($terms_args );

        $html .= '<option value="all">' . esc_html__('Category', 'edge-lms') . '</option>';
        foreach ($terms as $term) {
            if(isset($params['selected_category']) && $params['selected_category'] == $term->slug) {
                $html .= '<option selected value="' . $term->slug . '">';
            } else {
                $html .= '<option value="' . $term->slug . '">';
            }
            $html .= $term->name;
            $html .= '</option>';
        }

        return $html;
    }

    private function getCourseInstructors($params) {
        $html = '';
        $instructors_array = array();

        //Get unique instructors IDs that are set for courses
        $instructors_from_meta_array = array();
        global $wpdb;
        $instructors_from_meta = $wpdb->get_results("SELECT DISTINCT meta_value FROM $wpdb->postmeta pm WHERE meta_key  = 'edgt_course_instructor_meta'",ARRAY_A);
        foreach ($instructors_from_meta as $instructor) {
            $instructors_from_meta_array[] = $instructor['meta_value'];
        }

        //Get all instructors and store only the ones that are set for some course
        $instructors_query_array = array(
            'post_status'    => 'publish',
            'post_type'      => 'instructor',
            'posts_per_page' => '-1',
            'orderby'        => 'name',
            'order'          => 'ASC'
        );
        $instructors_query = new \WP_Query( $instructors_query_array );
        $instructors = $instructors_query->posts;
        if(!empty($instructors)) {
            foreach ($instructors as $instructor) {
                if(in_array($instructor->ID, $instructors_from_meta_array)) {
                    $instructors_array[] = $instructor;
                }
            }
        }
        wp_reset_postdata();

        $html .= '<option value="all">' . esc_html__('Instructor', 'edge-lms') . '</option>';
        foreach($instructors_array as $instructor) {
            if(isset($params['selected_instructor']) && $params['selected_instructor'] == $instructor->ID) {
                $html .= '<option selected value="' . $instructor->ID . '">';
            } else {
                $html .= '<option value="' . $instructor->ID . '">';
            }
            $html .= $instructor->post_title;
            $html .= '</option>';
        }

        return $html;
    }

    private function getCoursePrice($params) {
        $html = '';

        $prices = array(
            'all'   => esc_html__('Price', 'edge-lms'),
            'free'  => esc_html__('Free', 'edge-lms'),
            'paid'  => esc_html__('Paid', 'edge-lms')
        );

        foreach ($prices as $key => $value) {
            if(isset($params['selected_price']) && $params['selected_price'] == $key) {
                $html .= '<option selected value="' . $key . '">';
            }  else {
                $html .= '<option value="' . $key . '">';
            }
            $html .= $value;
            $html .= '</option>';
        }

        return $html;
    }

    private function getButtonParameters( $params ) {
        $button_params_array = array();

        $button_params_array['html_type'] = 'button';

        if ( ! empty( $params['button_text'] ) ) {
            $button_params_array['text'] = $params['button_text'];
        }

        if ( ! empty( $params['button_type'] ) ) {
            $button_params_array['type'] = $params['button_type'];
        }

        if ( ! empty( $params['button_size'] ) ) {
            $button_params_array['size'] = $params['button_size'];
        }

        if ( ! empty( $params['button_link'] ) ) {
            $button_params_array['link'] = $params['button_link'];
        }

        $button_params_array['target'] = ! empty( $params['button_target'] ) ? $params['button_target'] : '_self';

        if ( ! empty( $params['button_color'] ) ) {
            $button_params_array['color'] = $params['button_color'];
        }

        if ( ! empty( $params['button_hover_color'] ) ) {
            $button_params_array['hover_color'] = $params['button_hover_color'];
        }

        if ( ! empty( $params['button_background_color'] ) ) {
            $button_params_array['background_color'] = $params['button_background_color'];
        }

        if ( ! empty( $params['button_hover_background_color'] ) ) {
            $button_params_array['hover_background_color'] = $params['button_hover_background_color'];
        }

        if ( ! empty( $params['button_border_color'] ) ) {
            $button_params_array['border_color'] = $params['button_border_color'];
        }

        if ( ! empty( $params['button_hover_border_color'] ) ) {
            $button_params_array['hover_border_color'] = $params['button_hover_border_color'];
        }

        return $button_params_array;
    }
}