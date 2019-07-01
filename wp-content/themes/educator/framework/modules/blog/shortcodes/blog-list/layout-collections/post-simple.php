<li class="edgt-bl-item clearfix">
	<div class="edgt-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			educator_edge_get_module_template_part( 'templates/parts/image', 'blog', '', $params );
		} ?>
		<div class="edgt-bli-content">
			<?php educator_edge_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
			<?php if ($post_info_section == 'yes') { ?>
				<div class="edgt-bli-excerpt">
					<?php educator_edge_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
				</div>
				<div class="edgt-bli-info">
					<?php
					if ( $post_info_date == 'yes' ) {
						educator_edge_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
					}
					if ( $post_info_comments == 'yes' ) {
						educator_edge_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
					}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</li>