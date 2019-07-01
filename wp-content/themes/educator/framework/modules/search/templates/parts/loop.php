<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="edgt-post-content">
            <?php if (has_post_thumbnail()) { ?>
                <div class="edgt-post-image">
                    <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </a>
                </div>
            <?php } ?>
            <div class="edgt-post-title-area <?php if (!has_post_thumbnail()) { echo esc_attr('edgt-no-thumbnail'); } ?>">
                <div class="edgt-post-title-area-inner">
                    <h5 itemprop="name" class="edgt-post-title entry-title">
                        <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                    </h5>
                    <?php
                    $edgt_my_excerpt = get_the_excerpt();
                    if ($edgt_my_excerpt != '') { ?>
                        <p itemprop="description" class="edgt-post-excerpt"><?php echo wp_trim_words( esc_html( $edgt_my_excerpt ) ); ?></p>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </article>
<?php endwhile; ?>
<?php else: ?>
    <p class="edgt-blog-no-posts"><?php esc_html_e('No posts were found.', 'educator'); ?></p>
<?php endif; ?>