<div class="edgt-ttevents-single">
	<?php if(has_post_thumbnail()) : ?>
		<div class="edgt-ttevents-single-image-holder">
			<?php the_post_thumbnail('full'); ?>
		</div>
	<?php endif; ?>

	<div class="edgt-ttevents-single-holder">
		<h2 class="edgt-ttevents-single-title"><?php the_title(); ?></h2>

		<?php if($subtitle !== '') : ?>
			<p class="edgt-ttevents-single-subtitle"><?php echo esc_html($subtitle); ?></p>
		<?php endif; ?>

		<div class="edgt-ttevents-single-content">
			<?php the_content(); ?>
		</div>
	</div>
</div>