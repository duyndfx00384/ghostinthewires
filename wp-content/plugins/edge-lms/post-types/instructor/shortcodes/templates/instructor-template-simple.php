<div class="edgt-instructor <?php echo esc_attr($instructor_layout) ?>">
	<div class="edgt-instructor-inner" <?php echo educator_edge_inline_style($background);?>>
		<?php if (get_the_post_thumbnail($instructor_id) !== '') { ?>
			<div class="edgt-instructor-image">
                <a itemprop="url" href="<?php echo esc_url(get_the_permalink($instructor_id)) ?>">
                    <?php echo get_the_post_thumbnail($instructor_id, 'full'); ?>
                </a>
			</div>
		<?php } ?>
		<div class="edgt-instructor-info">
            <div class="edgt-instructor-title-holder">
                <h5 itemprop="name" class="edgt-instructor-name entry-title">
                    <a itemprop="url" href="<?php echo esc_url(get_the_permalink($instructor_id)) ?>"><?php echo esc_html($title) ?></a>
                </h5>
                <?php if (!empty($position)) { ?>
                    <span class="edgt-instructor-position"><?php echo esc_html($position); ?></span>
                <?php } ?>
            </div>
		</div>
        <a itemprop="url" href="<?php echo esc_url(get_the_permalink($instructor_id)) ?>" class="edgt-instructor-link"></a>
	</div>
</div>