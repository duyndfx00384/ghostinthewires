<?php
namespace EdgeCore\CPT\MasonryGallery;

use EdgeCore\Lib;

/**
 * Class MasonryGalleryRegister
 * @package EdgeCore\CPT\MasonryGallery
 */
class MasonryGalleryRegister implements Lib\PostTypeInterface  {
    /**
     * @var string
     */
    private $base;
    private $taxBase;

    public function __construct() {
        $this->base     = 'masonry-gallery';
        $this->taxBase  = 'masonry-gallery-category';
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
    }

    /**
     * Registers custom post type with WordPress
     */
	private function registerPostType() {
	
	   $menuPosition = 5;
	   $menuIcon = 'dashicons-schedule';
	
	    register_post_type($this->base,
	        array(
	            'labels' 		=> array(
	                'name' 				=> esc_html__( 'Edge Masonry Gallery', 'edge-cpt' ),
	                'all_items'			=> esc_html__( 'Edge Masonry Gallery Items', 'edge-cpt' ),
	                'singular_name' 	=> esc_html__( 'Masonry Gallery Item', 'edge-cpt' ),
	                'add_item'			=> esc_html__( 'New Masonry Gallery Item', 'edge-cpt' ),
	                'add_new_item' 		=> esc_html__( 'Add New Masonry Gallery Item', 'edge-cpt' ),
	                'edit_item' 		=> esc_html__( 'Edit Masonry Gallery Item', 'edge-cpt' )
	            ),
	            'public'		=>	false,
	            'show_in_menu'	=>	true,
	            'rewrite' 		=> 	array('slug' => 'masonry-gallery'),
				'menu_position' => 	$menuPosition,
	            'show_ui'		=>	true,
	            'has_archive'	=>	false,
	            'hierarchical'	=>	false,
	            'supports'		=>	array('title', 'thumbnail'),
				'menu_icon'     =>  $menuIcon
	        )
	    );
	}

	/**
	* Registers custom taxonomy with WordPress
	*/
	private function registerTax() {
		$labels = array(
			'name'              => esc_html__('Masonry Gallery Categories', 'edge-cpt'),
			'singular_name'     => esc_html__('Masonry Gallery Category', 'edge-cpt'),
			'search_items'      => esc_html__('Search Masonry Gallery Categories', 'edge-cpt'),
			'all_items'         => esc_html__('All Masonry Gallery Categories', 'edge-cpt'),
			'parent_item'       => esc_html__('Parent Masonry Gallery Category', 'edge-cpt'),
			'parent_item_colon' => esc_html__('Parent Masonry Gallery Category:', 'edge-cpt'),
			'edit_item'         => esc_html__('Edit Masonry Gallery Category', 'edge-cpt'),
			'update_item'       => esc_html__('Update Masonry Gallery Category', 'edge-cpt'),
			'add_new_item'      => esc_html__('Add New Masonry Gallery Category', 'edge-cpt'),
			'new_item_name'     => esc_html__('New Masonry Gallery Category Name', 'edge-cpt'),
			'menu_name'         => esc_html__('Masonry Gallery Categories', 'edge-cpt')
		);
		
		register_taxonomy($this->taxBase, array($this->base), array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'query_var'         => true,
			'show_admin_column' => true,
			'rewrite'           => array('slug' => 'masonry-gallery-category')
		));
	}
}