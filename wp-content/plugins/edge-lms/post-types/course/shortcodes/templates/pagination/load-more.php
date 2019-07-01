<?php if($query_results->max_num_pages > 1) {
	$holder_styles = $this_object->getLoadMoreStyles($params);
	?>
	<div class="edgt-cl-loading">
		<div class="edgt-cl-loading-bounce1"></div>
		<div class="edgt-cl-loading-bounce2"></div>
		<div class="edgt-cl-loading-bounce3"></div>
	</div>
	<div class="edgt-cl-load-more-holder">
		<div class="edgt-cl-load-more" <?php educator_edge_inline_style($holder_styles); ?>>
			<?php 
				echo educator_edge_get_button_html(array(
					'link' => 'javascript: void(0)',
					'size' => 'large',
					'text' => esc_html__('Load more', 'edge-lms')
				));
			?>
		</div>
	</div>
<?php }