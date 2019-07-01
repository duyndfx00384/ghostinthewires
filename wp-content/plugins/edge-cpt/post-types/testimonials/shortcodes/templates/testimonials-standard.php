<div class="edgt-testimonial-content" id="edgt-testimonials-<?php echo esc_attr( $current_id ) ?>">
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="edgt-testimonial-image">
			<?php echo get_the_post_thumbnail( get_the_ID(), array( 110, 110 ) ); ?>
		</div>
	<?php } ?>
	<div class="edgt-testimonial-text-holder">
		<?php if ( ! empty( $title ) ) { ?>
			<h2 itemprop="name" class="edgt-testimonial-title entry-title"><?php echo esc_html( $title ); ?></h2>
		<?php } ?>
		<?php if ( ! empty( $text ) ) { ?>
			<p class="edgt-testimonial-text"><?php echo esc_html( $text ); ?></p>
		<?php } ?>
		<?php if ( ! empty( $author ) ) { ?>
			<h3  class="edgt-testimonial-author">
				<span class="edgt-testimonials-author-name"><?php echo esc_html( $author ); ?></span>
			</h3>
			<?php if ( ! empty( $position ) ) { ?>
				<span class="edgt-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
			<?php } ?>
		<?php } ?>
	</div>
</div>