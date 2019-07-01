<?php

class EducatorEdgeSearchPostType extends EducatorEdgeWidget {
	public function __construct() {
		parent::__construct(
			'edgt_search_post_type',
			esc_html__( 'Edge Search Post Type', 'educator' ),
			array( 'description' => esc_html__( 'Select post type that you want to be searched for', 'educator' ) )
		);
		
		$this->setParams();
	}
	
	/**
	 * Sets widget options
	 */
	protected function setParams() {
		$post_types = apply_filters( 'educator_edge_search_post_type_widget_params_post_type', array( 'post' => 'Post' ) );
		
		$this->params = array(
			array(
				'type'        => 'dropdown',
				'name'        => 'post_type',
				'title'       => esc_html__( 'Post Type', 'educator' ),
				'description' => esc_html__( 'Choose post type that you want to be searched for', 'educator' ),
				'options'     => $post_types
			)
		);
	}
	
	/**
	 * Generates widget's HTML
	 *
	 * @param array $args args from widget area
	 * @param array $instance widget's options
	 */
	public function widget( $args, $instance ) {
		$search_type_class = 'edgt-search-post-type';
		$post_type         = $instance['post_type'];
		?>
		
		<div class="widget edgt-search-post-type-widget">
			<div data-post-type="<?php echo esc_attr( $post_type ); ?>" <?php educator_edge_class_attribute( $search_type_class ); ?>>
				<input class="edgt-post-type-search-field" value="" placeholder="<?php esc_html_e( 'Search here', 'educator' ) ?>">
                <span class="edgt-seach-icon-holder">
                    <i class="edgt-search-icon fa fa-search" aria-hidden="true"></i>
                    <i class="edgt-search-loading fa fa-spinner fa-spin edgt-hidden" aria-hidden="true"></i>
                </span>
			</div>
			<div class="edgt-post-type-search-results"></div>
		</div>
	<?php }
}