<?php if(educator_edge_options()->getOptionValue('enable_social_share') == 'yes' && educator_edge_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') : ?>
    <div class="edgt-ps-info-item edgt-ps-social-share">
        <span class="share-text"><?php echo esc_html__('SHARE:', 'edge-cpt') ?> </span> <?php echo educator_edge_get_social_share_html() ?>
    </div>
<?php endif; ?>