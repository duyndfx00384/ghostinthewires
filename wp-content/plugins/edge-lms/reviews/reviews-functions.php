<?php

if(!function_exists('edgt_lms_rating_posts_types')) {

	function edgt_lms_rating_posts_types() {

		$post_types = apply_filters( 'edgt_lms_rating_post_types', array() );

		return $post_types;
	}

}

if(!function_exists('edgt_lms_comment_additional_title_field')) {

	function edgt_lms_comment_additional_title_field($textarea) {
		$post_types = edgt_lms_rating_posts_types();
		if(is_array($post_types) && count($post_types) > 0) {
			foreach($post_types as $post_type) {
				if (is_singular($post_type)) {

                    $textarea = edgt_lms_get_module_template_part('reviews/templates/title-field');
                    $textarea .= edgt_lms_get_module_template_part('reviews/templates/text-field');
                    $textarea .= edgt_lms_get_module_template_part('reviews/templates/stars-field');
				}
			}
		}

		return $textarea;
	}

	add_filter( 'educator_edge_comment_form_textarea_field', 'edgt_lms_comment_additional_title_field', 10, 1 );

}

if(!function_exists('edgt_lms_extend_comment_edit_metafields')) {

	function edgt_lms_extend_comment_edit_metafields($comment_id) {
		if ((!isset($_POST['extend_comment_update']) || !wp_verify_nonce($_POST['extend_comment_update'], 'extend_comment_update'))) return;

		if ((isset($_POST['edgt_comment_title'])) && ($_POST['edgt_comment_title'] != '')):
			$title = wp_filter_nohtml_kses($_POST['edgt_comment_title']);
			update_comment_meta($comment_id, 'edgt_comment_title', $title);
		else :
			delete_comment_meta($comment_id, 'edgt_comment_title');
		endif;

		if ((isset($_POST['edgt_rating'])) && ($_POST['edgt_rating'] != '')):
			$rating = wp_filter_nohtml_kses($_POST['edgt_rating']);
			update_comment_meta($comment_id, 'edgt_rating', $rating);
		else :
			delete_comment_meta($comment_id, 'edgt_rating');
		endif;
	}

	add_action('edit_comment', 'edgt_lms_extend_comment_edit_metafields');
}

if(!function_exists('edgt_lms_extend_comment_add_meta_box')) {

	function edgt_lms_extend_comment_add_meta_box() {
		add_meta_box('title', esc_html__('Comment - Reviews', 'edge-lms'), 'edgt_lms_extend_comment_meta_box', 'comment', 'normal', 'high');
	}

	add_action('add_meta_boxes_comment', 'edgt_lms_extend_comment_add_meta_box');

}

if(!function_exists('edgt_lms_extend_comment_meta_box')) {

	function edgt_lms_extend_comment_meta_box($comment) {

		$post_types = edgt_lms_rating_posts_types();
		if(is_array($post_types) && count($post_types) > 0) {
			foreach($post_types as $post_type) {
				if ($comment->post_type == $post_type) {
					$title = get_comment_meta($comment->comment_ID, 'edgt_comment_title', true);
					$rating = get_comment_meta($comment->comment_ID, 'edgt_rating', true);
					wp_nonce_field('extend_comment_update', 'extend_comment_update', false);
					?>
					<p>
						<label for="title"><?php esc_html_e('Comment Title', 'edge-lms'); ?></label>
						<input type="text" name="edgt_comment_title" value="<?php echo esc_attr($title); ?>" class="widefat"/>
					</p>
					<p>
						<label for="rating"><?php esc_html_e('Rating', 'edge-lms'); ?>: </label>
						<span class="commentratingbox">
							<?php
							for ($i = 1; $i <= 5; $i++) {
								echo '<span class="commentrating"><input type="radio" name="edgt_rating" id="rating" value="' . $i . '"';
								if ($rating == $i) echo ' checked="checked"';
								echo ' />' . $i . ' </span>';
							}
							?>
						</span>
					</p>
					<?php
				}
			}
		}
	}
}

if(!function_exists('edgt_lms_save_comment_meta_data')) {

	function edgt_lms_save_comment_meta_data($comment_id) {

		if ((isset($_POST['edgt_comment_title'])) && ($_POST['edgt_comment_title'] != '')) {
			$title = wp_filter_nohtml_kses($_POST['edgt_comment_title']);
			add_comment_meta($comment_id, 'edgt_comment_title', $title);
		}

		if ((isset($_POST['edgt_rating'])) && ($_POST['edgt_rating'] != '')) {
			$rating = wp_filter_nohtml_kses($_POST['edgt_rating']);
			add_comment_meta($comment_id, 'edgt_rating', $rating);
		}

	}

	add_action('comment_post', 'edgt_lms_save_comment_meta_data');

}

if(!function_exists('edgt_lms_verify_comment_meta_data')) {

	function edgt_lms_verify_comment_meta_data($commentdata) {

		$post_types = edgt_lms_rating_posts_types();

		if(is_array($post_types) && count($post_types) > 0) {
			foreach ($post_types as $post_type) {
				if (is_singular($post_type)) {
					if (!isset($_POST['edgt_rating'])) {
						wp_die(esc_html__('Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.', 'edge-lms'));
					}
				}
			}
		}
		return $commentdata;
	}

	add_filter('preprocess_comment', 'edgt_lms_verify_comment_meta_data');

}


if(!function_exists('edgt_lms_override_comments_callback')) {

	function edgt_lms_override_comments_callback($args) {
		$post_types = edgt_lms_rating_posts_types();

		if(is_array($post_types) && count($post_types) > 0) {
			foreach ($post_types as $post_type) {
				if (is_singular($post_type)) {
					$args['callback'] = 'edgt_lms_reviews';
				}
			}
		}
		return $args;
	}

	add_filter('educator_edge_comments_callback', 'edgt_lms_override_comments_callback');

}

if(!function_exists('edgt_lms_reviews')) {

	function edgt_lms_reviews($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		global $post;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment  = $post->post_author == $comment->user_id;

		$comment_class = 'edgt-comment clearfix';

		if($is_author_comment) {
			$comment_class .= ' edgt-post-author-comment';
		}
		$review_rating = get_comment_meta( $comment->comment_ID, 'edgt_rating', true );
		$date_format = get_option('date_format');
		$review_date = get_comment_date( $date_format, $comment->comment_ID);

		?>

		<li>
		<div class="<?php echo esc_attr($comment_class); ?>">
			<?php if(!$is_pingback_comment) { ?>
				<div class="edgt-comment-image"> <?php echo educator_edge_kses_img(get_avatar($comment, 'thumbnail')); ?> </div>
			<?php } ?>
			<div class="edgt-comment-text">
				<div class="edgt-comment-info">
					<h5 class="edgt-comment-name vcard">
						<?php echo wp_kses_post(get_comment_author_link()); ?>
					</h5>
                    <span class="edgt-comment-date">
                        <?php echo wp_kses_post($review_date) ?>
                    </span>
					<div class="edgt-review-rating">
						<span class="edgt-rating-inner">
							<?php for($i=1; $i<=$review_rating; $i++){ ?>
								<i class="fa fa-star" aria-hidden="true"></i>
							<?php } ?>
						</span>
					</div>
				</div>
				<?php if(!$is_pingback_comment) { ?>
					<div class="edgt-text-holder" id="comment-<?php comment_ID(); ?>">
						<?php comment_text(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}

}