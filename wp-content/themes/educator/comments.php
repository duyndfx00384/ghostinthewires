<?php
if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number()) { ?>
	<div class="edgt-comment-holder clearfix" id="comments">
		<div class="edgt-comment-holder-inner">
			<?php if ( have_comments() ) { ?>
				<div class="edgt-comments-title">
					<h4><?php esc_html_e('Comments', 'educator' ); ?></h4>
				</div>
				<div class="edgt-comments">
					<ul class="edgt-comment-list">
						<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'educator_edge_comment' ), apply_filters( 'educator_edge_comments_callback', array() ) ) ) ); ?>
					</ul>
				</div>
			<?php } ?>
			<?php if( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' )) { ?>
				<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'educator'); ?></p>
			<?php } ?>
		</div>
	</div>
	<?php
		$edgt_commenter = wp_get_current_commenter();
		$edgt_req = get_option( 'require_name_email' );
		$edgt_aria_req = ( $edgt_req ? " aria-required='true'" : '' );

		$edgt_args = array(
			'id_form' => 'commentform',
			'id_submit' => 'submit_comment',
			'title_reply'=> esc_html__( 'Post a Comment','educator' ),
			'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after' => '</h4>',
			'title_reply_to' => esc_html__( 'Post a Reply to %s','educator' ),
			'cancel_reply_link' => esc_html__( 'cancel reply','educator' ),
			'label_submit' => esc_html__( 'Submit','educator' ),
			'comment_field' => apply_filters( 'educator_edge_comment_form_textarea_field', '<textarea id="comment" placeholder="'.esc_html__( 'Your comment','educator' ).'" name="comment" cols="45" rows="6" aria-required="true"></textarea>'),
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'fields' => apply_filters( 'educator_edge_comment_form_default_fields', array(
				'author' => '<input id="author" name="author" placeholder="'. esc_html__( 'Your Name', 'educator' ) .'" type="text" value="' . esc_attr( $edgt_commenter['comment_author'] ) . '"' . $edgt_aria_req . ' />',
				'email' => '<input id="email" name="email" placeholder="'. esc_html__( 'Your Email', 'educator' ) .'" type="text" value="' . esc_attr(  $edgt_commenter['comment_author_email'] ) . '"' . $edgt_aria_req . ' />',
				'url'    => '<input id="url" name="url" placeholder="'. esc_html__( 'Website', 'educator' ) .'" type="text" value="' . esc_attr(  $edgt_commenter['comment_author_url'] ) . '" size="30" maxlength="200" />'
			 ) ) );
	 ?>
	<?php if(get_comment_pages_count() > 1){ ?>
		<div class="edgt-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
	<?php } ?>

    <?php
    $edgt_show_comment_form = apply_filters('educator_edge_show_comment_form_filter', true);
    if($edgt_show_comment_form) {
    ?>
        <div class="edgt-comment-form">
            <div class="edgt-comment-form-inner">
                <?php comment_form($edgt_args); ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>	