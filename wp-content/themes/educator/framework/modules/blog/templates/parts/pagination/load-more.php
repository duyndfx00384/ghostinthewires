<?php if($max_num_pages > 1) { ?>
	<div class="edgt-blog-pag-loading">
		<div class="edgt-blog-pag-bounce1"></div>
		<div class="edgt-blog-pag-bounce2"></div>
		<div class="edgt-blog-pag-bounce3"></div>
	</div>
	<div class="edgt-blog-pag-load-more">
		<?php
        if(educator_edge_core_plugin_installed()) {
			echo educator_edge_get_button_html(
                apply_filters(
                    'educator_edge_blog_template_load_more_button',
                    array(
                        'link' => 'javascript: void(0)',
                        'size' => 'large',
                        'text' => esc_html__('Load more', 'educator')
			        )
                )
            );
        } else { ?>
            <a itemprop="url" href="javascript:void(0)" target="_self" class="edgt-btn edgt-btn-large edgt-btn-solid">
                <span class="edgt-btn-text">
                    <?php echo esc_html__('Load more', 'educator'); ?>
                </span>
            </a>
		<?php } ?>
	</div>
<?php }