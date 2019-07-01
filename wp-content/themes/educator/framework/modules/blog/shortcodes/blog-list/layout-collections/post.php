<li class="edgt-bl-item clearfix">
	<div class="edgt-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			educator_edge_get_module_template_part( 'templates/parts/image', 'blog', '', $params );
		} ?>
        <div class="edgt-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="edgt-bli-info">
	                <?php
		                if ( $post_info_date == 'yes' ) {
			                educator_edge_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
		                if ( $post_info_category == 'yes' ) {
			                educator_edge_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
		                if ( $post_info_comments == 'yes' ) {
			                educator_edge_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
		                }
		                if ( $post_info_like == 'yes' ) {
			                educator_edge_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
		                }
		                if ( $post_info_share == 'yes' ) {
			                educator_edge_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <?php educator_edge_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	
	        <div class="edgt-bli-excerpt">
		        <?php educator_edge_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
	        </div>
            <div class="edgt-bli-info edgt-bli-info-bottom">
                <?php if ( $post_info_author == 'yes' ) {
                    educator_edge_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
                } ?>
            </div>
        </div>
	</div>
</li>