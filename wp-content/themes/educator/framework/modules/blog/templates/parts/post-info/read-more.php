<?php if ( ! educator_edge_post_has_read_more() ) { ?>
	<div class="edgt-post-read-more-button">
		<?php
		if ( educator_edge_core_plugin_installed() ) {
			echo educator_edge_get_button_html(
				apply_filters(
					'educator_edge_blog_template_read_more_button',
					array(
						'type'         => 'simple',
						'size'         => 'medium',
						'link'         => get_the_permalink(),
						'text'         => esc_html__( 'READ MORE', 'educator' ),
						'custom_class' => 'edgt-blog-list-button'
					)
				)
			);
		} else { ?>
			<a itemprop="url" href="<?php echo esc_attr( get_the_permalink() ); ?>" target="_self" class="edgt-btn edgt-btn-medium edgt-btn-simple edgt-blog-list-button">
                <span class="edgt-btn-text"><?php echo esc_html__( 'READ MORE', 'educator' ); ?></span>
			</a>
		<?php } ?>
	</div>
<?php } ?>