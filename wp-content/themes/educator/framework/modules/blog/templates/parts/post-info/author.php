<div class="edgt-post-info-author">
    <span class="edgt-post-info-author-avatar-holder">
			<?php echo educator_edge_kses_img(get_avatar(get_the_author_meta('ID'), 30)); ?>
	</span>
    <span class="edgt-post-info-author-text">
        <?php esc_html_e('by', 'educator'); ?>
    </span>
    <a itemprop="author" class="edgt-post-info-author-link" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
        <?php the_author_meta('display_name'); ?>
    </a>
</div>