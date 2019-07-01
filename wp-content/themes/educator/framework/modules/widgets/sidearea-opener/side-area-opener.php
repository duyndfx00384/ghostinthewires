<?php

class EducatorEdgeSideAreaOpener extends EducatorEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edgt_side_area_opener',
	        esc_html__('Edge Side Area Opener', 'educator'),
	        array( 'description' => esc_html__( 'Display a "hamburger" icon that opens the side area', 'educator'))
        );

        $this->setParams();
    }
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'        => 'icon_color',
				'title'       => esc_html__( 'Side Area Opener Color', 'educator' ),
				'description' => esc_html__( 'Define color for side area opener', 'educator' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'icon_hover_color',
				'title'       => esc_html__( 'Side Area Opener Hover Color', 'educator' ),
				'description' => esc_html__( 'Define hover color for side area opener', 'educator' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'widget_margin',
				'title'       => esc_html__( 'Side Area Opener Margin', 'educator' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'educator' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Side Area Opener Title', 'educator' )
			)
		);
	}
	
	public function widget($args, $instance) {
		$holder_styles = array();
		
		if ( ! empty( $instance['icon_color'] ) ) {
			$holder_styles[] = 'color: ' . $instance['icon_color'] . ';';
		}
		if ( ! empty( $instance['widget_margin'] ) ) {
			$holder_styles[] = 'margin: ' . $instance['widget_margin'];
		}
		?>
		
		<a class="edgt-side-menu-button-opener edgt-icon-has-hover" <?php echo educator_edge_get_inline_attr($instance['icon_hover_color'], 'data-hover-color'); ?> href="javascript:void(0)" <?php educator_edge_inline_style($holder_styles); ?>>
			<?php if (!empty($instance['widget_title'])) { ?>
				<h5 class="edgt-side-menu-title"><?php echo esc_html($instance['widget_title']); ?></h5>
			<?php } ?>
			<span class="edgt-side-menu-icon">
        		<?php echo educator_edge_icon_collections()->renderIcon('fa-bars', 'font_awesome'); ?>
        	</span>
		</a>
	<?php }
}