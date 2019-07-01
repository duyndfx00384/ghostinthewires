<div class="edgt-testimonial-content" id="edgt-testimonials-<?php echo esc_attr( $current_id ) ?>">
    <?php if ( has_post_thumbnail() ) { ?>
        <div class="edgt-testimonial-image">
            <?php echo get_the_post_thumbnail( get_the_ID(), array( 110, 110 ) ); ?>
        </div>
    <?php } ?>
    <div class="edgt-testimonial-text-holder">
        <?php if ( ! empty( $text ) ) { ?>
            <h2 class="edgt-testimonial-text"><?php echo esc_html( $text ); ?></h2>
        <?php } ?>
        <?php if ( ! empty( $author ) ) { ?>
            <p  class="edgt-testimonial-author">
                <span class="edgt-testimonials-author-name"><?php echo esc_html( $author ); ?></span>
                <?php if ( ! empty( $position ) ) { ?>
                    <span class="edgt-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
                <?php } ?>
            </p>
        <?php } ?>
    </div>
</div>