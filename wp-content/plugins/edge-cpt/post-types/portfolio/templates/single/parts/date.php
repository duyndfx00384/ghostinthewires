<?php if(educator_edge_options()->getOptionValue('portfolio_single_hide_date') === 'yes') : ?>
    <div class="edgt-ps-info-item edgt-ps-date">
        <p class="edgt-ps-info-title"><?php esc_html_e('Date:', 'edge-cpt'); ?></p>
        <p itemprop="dateCreated" class="edgt-ps-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(educator_edge_get_page_id()); ?>"/>
    </div>
<?php endif; ?>