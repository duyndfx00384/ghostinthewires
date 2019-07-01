<?php
$tags = wp_get_post_terms(get_the_ID(), 'portfolio-tag');
$tag_names = array();

if(is_array($tags) && count($tags)) : ?>
    <div class="edgt-ps-info-item edgt-ps-tags">
        <p class="edgt-ps-info-title"><?php esc_html_e('Tags:', 'edge-cpt'); ?></p>
        <?php foreach($tags as $tag) { ?>
            <a itemprop="url" class="edgt-ps-info-tag" href="<?php echo esc_url(get_term_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a>
        <?php } ?>
    </div>
<?php endif; ?>