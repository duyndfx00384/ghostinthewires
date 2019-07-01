<?php
	$author_info_box = esc_attr(educator_edge_options()->getOptionValue('blog_author_info'));
	$author_info_email = esc_attr(educator_edge_options()->getOptionValue('blog_author_info_email'));
	$author_id = esc_attr(get_the_author_meta('ID'));
	$social_networks   = educator_edge_core_plugin_installed() ? educator_edge_get_user_custom_fields() : false;
    $display_author_social = educator_edge_options()->getOptionValue('blog_single_author_social') === 'no' ? false : true;
?>
<?php if($author_info_box === 'yes' && get_the_author_meta('description') !== "") { ?>
	<div class="edgt-author-description">
		<div class="edgt-author-description-inner">
			<div class="edgt-author-description-content">
				<div class="edgt-author-description-image">
					<a itemprop="url" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" title="<?php the_title_attribute(); ?>" target="_self">
						<?php echo educator_edge_kses_img(get_avatar(get_the_author_meta( 'ID' ), 136)); ?>
					</a>
				</div>
				<div class="edgt-author-description-text-holder">
					<h4 class="edgt-author-name vcard author">
						<a itemprop="url" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>" title="<?php the_title_attribute(); ?>" target="_self">
							<span class="fn">
							<?php
								if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
									echo esc_html(get_the_author_meta('first_name')) . " " . esc_html(get_the_author_meta('last_name'));
								} else {
									echo esc_html(get_the_author_meta('display_name'));
								}
							?>
							</span>
						</a>
					</h4>
					<?php if(get_the_author_meta('position') !== '') : ?>
						<div class="edgt-author-position-holder">
							<p class="edgt-author-position"><?php echo esc_html(get_the_author_meta('position')); ?></p>
						</div>
					<?php endif; ?>
					<?php if(get_the_author_meta('description') != "") { ?>
						<div class="edgt-author-text">
							<p itemprop="description"><?php echo esc_html(get_the_author_meta('description')); ?></p>
						</div>
					<?php } ?>
					<?php if($display_author_social) { ?>
						<?php if(is_array($social_networks) && count($social_networks)){ ?>
							<div class="edgt-author-social-icons clearfix">
								<?php foreach($social_networks as $network){ ?>
									<?php
									$icon_family = 'font_elegant';
									if(strpos($network['class'],'instagram')) {
										$icon_family = 'font_awesome';
									} ?>
									<a itemprop="url" href="<?php echo esc_attr($network['link'])?>" target="_blank">
										<?php echo educator_edge_icon_collections()->renderIcon($network['class'], $icon_family); ?>
									</a>
								<?php }?>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>