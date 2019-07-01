<?php
$blog_single_navigation = educator_edge_options()->getOptionValue('blog_single_navigation') === 'no' ? false : true;
$blog_navigation_through_same_category = educator_edge_options()->getOptionValue('blog_navigation_through_same_category') === 'no' ? false : true;
?>
<?php if($blog_single_navigation){ ?>
	<div class="edgt-blog-single-navigation">
		<div class="edgt-blog-single-navigation-inner clearfix">
			<?php
				/* Single navigation section - SETTING PARAMS */
				$post_navigation = array(
					'prev' => array(
						'title' => '',
						'image' => '',
						'label' => '<span class="edgt-blog-single-nav-label">'.esc_html__('Previous', 'educator').'</span>'
					),
					'next' => array(
						'title' => '',
						'image' => '',
						'label' => '<span class="edgt-blog-single-nav-label">'.esc_html__('Next', 'educator').'</span>'
					)
				);

			if(get_previous_post() !== ""){
				if($blog_navigation_through_same_category){
					if(get_previous_post(true) !== ""){
						$post_navigation['prev']['post'] = get_previous_post(true);
					}
				} else {
					if(get_previous_post() != ""){
						$post_navigation['prev']['post'] = get_previous_post();
					}
				}

				if($post_navigation['prev']['post']->post_title != '') {
					$post_navigation['prev']['title'] = '<span class="edgt-blog-single-nav-title-text">'.$post_navigation['prev']['post']->post_title.'</span>';
				}

				$prev_post_ID = $post_navigation['prev']['post']->ID;
				$prev_background_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post_ID),'educator_edge_square');
				$prev_post_thumbnail = $prev_background_image_src[0];

				if($prev_post_thumbnail != '') {
					$post_navigation['prev']['image'] = '<img class="edgt-nav-image" src="'.esc_url($prev_post_thumbnail).'" alt="test">';
				}
			}
			if(get_next_post() != ""){
				if($blog_navigation_through_same_category){
					if(get_next_post(true) !== ""){
						$post_navigation['next']['post'] = get_next_post(true);

					}
				} else {
					if(get_next_post() !== ""){
						$post_navigation['next']['post'] = get_next_post();
					}
				}

				if($post_navigation['next']['post']->post_title != '') {
					$post_navigation['next']['title'] = '<span class="edgt-blog-single-nav-title-text">'.$post_navigation['next']['post']->post_title.'</span>';
				}

				$next_post_ID = $post_navigation['next']['post']->ID;
				$next_background_image_src = wp_get_attachment_image_src(get_post_thumbnail_id($next_post_ID),'educator_edge_square');
				$next_post_thumbnail = $next_background_image_src[0];

				if($next_post_thumbnail != '') {
					$post_navigation['next']['image'] = '<img class="edgt-nav-image" src="'.esc_url($next_post_thumbnail).'" alt="test">';
				}
			}

			if (isset($post_navigation['prev']['post']) || isset($post_navigation['next']['post'])) {
				foreach (array('prev', 'next') as $nav_type) {
					if (isset($post_navigation[$nav_type]['post'])) { ?>
						<?php $edgt_nav_class = get_the_post_thumbnail($post_navigation[$nav_type]['post']->ID) == '' ? ' edgt-no-nav-image' : '';  ?>
						<a itemprop="url" class="edgt-blog-single-<?php echo esc_attr($nav_type); ?> <?php echo esc_attr($edgt_nav_class); ?>" href="<?php echo get_permalink($post_navigation[$nav_type]['post']->ID); ?>">

							<div class="edgt-nav-blog-post-image">
								<?php echo wp_kses($post_navigation[$nav_type]['image'], array('img' => array('class' => true, 'src' => true, 'alt' => true))); ?>
							</div>
							<div class="edgt-nav-blog-post-label-wrapper">
								<?php echo wp_kses($post_navigation[$nav_type]['label'], array('span' => array('class' => true))); ?>
								<h5 class="edgt-blog-single-nav-title">
									<?php echo wp_kses($post_navigation[$nav_type]['title'], array('span' => array('class' => true))); ?>
								</h5>
							</div>
						</a>
					<?php }
				}
			}
			?>
		</div>
	</div>
<?php } ?>
