<?php if(educator_edge_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>
    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = educator_edge_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
    ?>
    <div class="edgt-ps-navigation">
        <?php if(get_previous_post() !== '') : ?>
            <div class="edgt-ps-prev">
                <?php if($nav_same_category) {
	                previous_post_link('%link','<div class="edgt-prev-ps-img-wrapper"><img src='.get_the_post_thumbnail_url(get_previous_post()->ID).'></div><div class="edgt-prev-ps-text-wrapper"><span class="prev-text">'.esc_html__('previous', 'edge-cpt').'</span><span class="edgt-ps-nav-prev-title">%title</span></div>', true, '', 'portfolio-category');
                } else {
	                previous_post_link('%link','<div class="edgt-prev-ps-img-wrapper"><img src='.get_the_post_thumbnail_url(get_previous_post()->ID).'></div><div class="edgt-prev-ps-text-wrapper"><span class="prev-text">'.esc_html__('previous', 'edge-cpt').'</span><span class="edgt-ps-nav-prev-title">%title</span></div>');
                } ?>
            </div>
        <?php endif; ?>

        <?php if($back_to_link !== '') : ?>
            <div class="edgt-ps-back-btn">
                <a itemprop="url" href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                    <span class="icon-arrows-squares"></span>
                </a>
            </div>
        <?php endif; ?>

        <?php if(get_next_post() !== '') : ?>
            <div class="edgt-ps-next">
                <?php if($nav_same_category) {
                    next_post_link('%link', '<div class="edgt-next-ps-text-wrapper"><span class="next-text">'.esc_html__('next', 'edge-cpt').'</span><span class="edgt-ps-nav-next-title">%title</span></div><div class="edgt-next-ps-img-wrapper"><img src='.get_the_post_thumbnail_url(get_next_post()->ID).'></div>', true, '', 'portfolio-category');
                } else {
                    next_post_link('%link', '<div class="edgt-next-ps-text-wrapper"><span class="next-text">'.esc_html__('next', 'edge-cpt').'</span><span class="edgt-ps-nav-next-title">%title</span></div><div class="edgt-next-ps-img-wrapper"><img src='.get_the_post_thumbnail_url(get_next_post()->ID).'></div>');
                } ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>