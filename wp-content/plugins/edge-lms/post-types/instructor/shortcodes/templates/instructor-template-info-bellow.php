<div class="edgt-instructor <?php echo esc_attr($instructor_layout) ?>">
	<div class="edgt-instructor-inner">
		<?php if (get_the_post_thumbnail($instructor_id) !== '') { ?>
			<div class="edgt-instructor-image">
                <a itemprop="url" href="<?php echo esc_url(get_the_permalink($instructor_id)) ?>">
                    <?php echo get_the_post_thumbnail($instructor_id, 'full'); ?>
                </a>
			</div>
		<?php } ?>
		<div class="edgt-instructor-info">
            <div class="edgt-instructor-title-holder">
                <h4 itemprop="name" class="edgt-instructor-name entry-title">
                    <a itemprop="url" href="<?php echo esc_url(get_the_permalink($instructor_id)) ?>"><?php echo esc_html($title) ?></a>
                </h4>

                <?php if (!empty($position)) { ?>
                    <h6 class="edgt-instructor-position"><?php echo esc_html($position); ?></h6>
                <?php } ?>
            </div>
			<?php if (!empty($excerpt)) { ?>
				<div class="edgt-instructor-text">
					<div class="edgt-instructor-text-inner">
						<div class="edgt-instructor-description">
							<p itemprop="description" class="edgt-instructor-excerpt"><?php echo esc_html($excerpt); ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="edgt-instructor-social-holder-between">
				<div class="edgt-instructor-social">
					<div class="edgt-instructor-social-inner">
						<div class="edgt-instructor-social-wrapp">
							<?php foreach ($instructor_social_icons as $instructor_social_icon) {
								echo wp_kses_post($instructor_social_icon);
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>