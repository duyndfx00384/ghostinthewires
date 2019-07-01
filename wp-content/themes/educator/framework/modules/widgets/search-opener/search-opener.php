<?php

class EducatorEdgeSearchOpener extends EducatorEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edgt_search_opener',
	        esc_html__('Edge Search Opener', 'educator'),
	        array( 'description' => esc_html__( 'Display a "search" icon that opens the search form', 'educator'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'search_icon_size',
				'title'       => esc_html__( 'Icon Size (px)', 'educator' ),
				'description' => esc_html__( 'Define size for search icon', 'educator' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'search_icon_color',
				'title'       => esc_html__( 'Icon Color', 'educator' ),
				'description' => esc_html__( 'Define color for search icon', 'educator' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'search_icon_hover_color',
				'title'       => esc_html__( 'Icon Hover Color', 'educator' ),
				'description' => esc_html__( 'Define hover color for search icon', 'educator' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'search_icon_margin',
				'title'       => esc_html__( 'Icon Margin', 'educator' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'educator' )
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'show_label',
				'title'       => esc_html__( 'Enable Search Icon Text', 'educator' ),
				'description' => esc_html__( 'Enable this option to show search text next to search icon in header', 'educator' ),
				'options'     => educator_edge_get_yes_no_select_array()
			)
		);
	}

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        global $educator_edge_options, $educator_edge_IconCollections;

	    $search_type_class    = 'edgt-search-opener edgt-icon-has-hover';
	    $styles = array();
	    $show_search_text     = $instance['show_label'] == 'yes' || $educator_edge_options['enable_search_icon_text'] == 'yes' ? true : false;

	    if(!empty($instance['search_icon_size'])) {
		    $styles[] = 'font-size: '.intval($instance['search_icon_size']).'px';
	    }

	    if(!empty($instance['search_icon_color'])) {
		    $styles[] = 'color: '.$instance['search_icon_color'].';';
	    }

	    if (!empty($instance['search_icon_margin'])) {
		    $styles[] = 'margin: ' . $instance['search_icon_margin'].';';
	    }
	    ?>

	    <a <?php educator_edge_inline_attr($instance['search_icon_hover_color'], 'data-hover-color'); ?> <?php educator_edge_inline_style($styles); ?>
		    <?php educator_edge_class_attribute($search_type_class); ?> href="javascript:void(0)">
            <span class="edgt-search-opener-wrapper">
                <?php if(isset($educator_edge_options['search_icon_pack'])) {
	                $educator_edge_IconCollections->getSearchIcon($educator_edge_options['search_icon_pack'], false);
                } ?>
	            <?php if($show_search_text) { ?>
		            <span class="edgt-search-icon-text"><?php esc_html_e('Search', 'educator'); ?></span>
	            <?php } ?>
            </span>
	    </a>
    <?php }
}