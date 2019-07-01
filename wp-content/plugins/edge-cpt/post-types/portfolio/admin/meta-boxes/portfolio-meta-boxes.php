<?php

if ( ! function_exists( 'edgt_core_map_portfolio_meta' ) ) {
	function edgt_core_map_portfolio_meta() {
		global $educator_edge_Framework;
		
		$edge_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$edge_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$edgePortfolioImages = new EducatorEdgeMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'edge-cpt' ), '', '', 'portfolio_images' );
		$educator_edge_Framework->edgtMetaBoxes->addMetaBox( 'portfolio_images', $edgePortfolioImages );
		
		$edgt_portfolio_image_gallery = new EducatorEdgeMultipleImages( 'edgt-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'edge-cpt' ), esc_html__( 'Choose your portfolio images', 'edge-cpt' ) );
		$edgePortfolioImages->addChild( 'edgt-portfolio-image-gallery', $edgt_portfolio_image_gallery );
		
		//Portfolio Images/Videos 2
		
		$edgePortfolioImagesVideos2 = new EducatorEdgeMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images/Videos (single upload)', 'edge-cpt' ) );
		$educator_edge_Framework->edgtMetaBoxes->addMetaBox( 'portfolio_images_videos2', $edgePortfolioImagesVideos2 );
		
		$edgt_portfolio_images_videos2 = new EducatorEdgeImagesVideosFramework( '', '' );
		$edgePortfolioImagesVideos2->addChild( 'edge_portfolio_images_videos2', $edgt_portfolio_images_videos2 );
		
		//Portfolio Additional Sidebar Items
		
		$edgeAdditionalSidebarItems = educator_edge_add_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'edge-cpt' ),
				'name'  => 'portfolio_properties'
			)
		);
		
		$edge_portfolio_properties = educator_edge_add_options_framework(
			array(
				'label'  => esc_html__( 'Portfolio Properties', 'edge-cpt' ),
				'name'   => 'edge_portfolio_properties',
				'parent' => $edgeAdditionalSidebarItems
			)
		);
	}
	
	add_action( 'educator_edge_meta_boxes_map', 'edgt_core_map_portfolio_meta', 40 );
}