<?php
namespace EdgefLMS\CPT\Course;

use EdgefLMS\Lib\PostTypeInterface;

/**
 * Class CourseRegister
 * @package EdgefLMS\CPT\Course
 */
class CourseRegister implements PostTypeInterface {
    /**
     * @var string
     */
    private $base;
    private $taxBase;

    public function __construct() {
        $this->base = 'course';
        $this->taxBase = 'course-category';

	    add_filter('archive_template', array($this, 'registerArchiveTemplate'));
        add_filter('single_template', array($this, 'registerSingleTemplate'));
        add_action('admin_menu', array($this, 'extendLMSCourseMenu'));
    }

    /**
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Registers custom post type with WordPress
     */
    public function register() {
        $this->registerPostType();
        $this->registerTax();
        $this->registerTagTax();
    }
	
	/**
	 * Registers course archive template if one does'nt exists in theme.
	 * Hooked to archive_template filter
	 * @param $archive string current template
	 * @return string string changed template
	 */
	public function registerArchiveTemplate($archive) {
		global $post;

		if(! empty( $post ) && $post->post_type == $this->base) {
			if(!file_exists(get_template_directory().'/archive-'.$this->base.'.php')) {
				return EDGE_LMS_CPT_PATH.'/course/templates/archive-'.$this->base.'.php';
			}
		}
		
		return $archive;
	}

    /**
     * Registers course single template if one does'nt exists in theme.
     * Hooked to single_template filter
     * @param $single string current template
     * @return string string changed template
     */
    public function registerSingleTemplate($single) {
        global $post;

        if(! empty( $post ) && $post->post_type == $this->base) {
            if(!file_exists(get_template_directory().'/single-course-item.php')) {
                return EDGE_LMS_CPT_PATH.'/course/templates/single-'.$this->base.'.php';
            }
        }

        return $single;
    }

    /**
     * Registers custom post type with WordPress
     */
    private function registerPostType() {

        $slug = $this->base;

        if(edgt_lms_theme_installed()) {
            if(educator_edge_options()->getOptionValue('course_single_slug')) {
                $slug = educator_edge_options()->getOptionValue('course_single_slug');
            }
        }

        $labels = array(
            'name'          => esc_html__( 'Edge Courses','edge-lms' ),
            'singular_name' => esc_html__( 'Edge Course','edge-lms' ),
            'add_item'      => esc_html__( 'New Course','edge-lms' ),
            'add_new_item'  => esc_html__( 'Add New Course','edge-lms' ),
            'add_new'  		=> esc_html__( 'Add New Course','edge-lms' ),
            'edit_item'     => esc_html__( 'Edit Course','edge-lms' )
        );

        register_post_type( $this->base,
            array(
                'labels'            => $labels,
                'public'            => true,
                'has_archive'       => true,
                'rewrite'           => array('slug' => $slug),
                'show_in_menu'      => 'edgt_lms_menu',
                'show_in_admin_bar' => true,
                'show_in_nav_menus' => true,
                'show_ui'           => true,
                'supports'          => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'comments')
            )
        );
    }

    /**
     * Registers custom taxonomy with WordPress
     */
    private function registerTax() {
        $labels = array(
            'name'              => esc_html__('Course Categories', 'edge-lms'),
            'singular_name'     => esc_html__('Course Category', 'edge-lms'),
            'search_items'      => esc_html__('Search Course Categories','edge-lms'),
            'all_items'         => esc_html__('All Course Categories','edge-lms'),
            'parent_item'       => esc_html__('Parent Course Category','edge-lms'),
            'parent_item_colon' => esc_html__('Parent Course Category:','edge-lms'),
            'edit_item'         => esc_html__('Edit Course Category','edge-lms'),
            'update_item'       => esc_html__('Update Course Category','edge-lms'),
            'add_new_item'      => esc_html__('Add New Course Category','edge-lms'),
            'new_item_name'     => esc_html__('New Course Category Name','edge-lms'),
            'menu_name'         => esc_html__('Course Categories','edge-lms')
        );

        register_taxonomy(
            $this->taxBase,
            array(
                $this->base
            ),
            array(
                'public'            => true,
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'query_var'         => true,
                'show_admin_column' => true,
                'rewrite'           => array('slug' => 'course-category')
            )
        );
    }

    /**
     * Registers custom tag taxonomy with WordPress
     */
    private function registerTagTax() {
        $labels = array(
            'name'              => esc_html__('Course Tags', 'edge-lms'),
            'singular_name'     => esc_html__('Course Tag', 'edge-lms'),
            'search_items'      => esc_html__('Search Course Tags','edge-lms'),
            'all_items'         => esc_html__('All Course Tags','edge-lms'),
            'parent_item'       => esc_html__('Parent Course Tag','edge-lms'),
            'parent_item_colon' => esc_html__('Parent Course Tags:','edge-lms'),
            'edit_item'         => esc_html__('Edit Course Tag','edge-lms'),
            'update_item'       => esc_html__('Update Course Tag','edge-lms'),
            'add_new_item'      => esc_html__('Add New Course Tag','edge-lms'),
            'new_item_name'     => esc_html__('New Course Tag Name','edge-lms'),
            'menu_name'         => esc_html__('Course Tags','edge-lms')
        );

        register_taxonomy(
            'course-tag',
            array(
                $this->base
            ),
            array(
                'public'            => true,
                'hierarchical'      => false,
                'labels'            => $labels,
                'show_ui'           => true,
                'query_var'         => true,
                'show_admin_column' => true,
                'rewrite'           => array('slug' => 'course-tag')
            )
        );
    }

    function extendLMSCourseMenu() {

        add_submenu_page(
            'edgt_lms_menu',
            esc_html__('New Course', 'edge-lms'),
            esc_html__('Add New Course', 'edge-lms'),
            'edit_posts',
            'post-new.php?post_type=' . $this->base
        );

        add_submenu_page(
            'edgt_lms_menu',
            esc_html__('Course Categories', 'edge-lms'),
            esc_html__('Course Categories', 'edge-lms'),
            'edit_posts',
            'edit-tags.php?taxonomy=' . $this->taxBase
        );

        add_submenu_page(
            'edgt_lms_menu',
            esc_html__('Course Tags', 'edge-lms'),
            esc_html__('Course Tags', 'edge-lms'),
            'edit_posts',
            'edit-tags.php?taxonomy=course-tag'
        );
    }
}