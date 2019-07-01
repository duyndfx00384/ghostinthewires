<?php if(comments_open()) { ?>
	<div class="edgt-post-info-comments-holder">
		<a itemprop="url" class="edgt-post-info-comments" href="<?php comments_link(); ?>" target="_self">
			<span class="edgt-post-info-comments-icon">
				<?php echo educator_edge_icon_collections()->renderIcon('icon_comment_alt', 'font_elegant'); ?>
			</span>
			<span itemprop="commentCount"><?php comments_number('0', '1', '%'); ?></span>
		</a>
	</div>
<?php } ?>