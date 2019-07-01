<?php if(is_array($features) && count($features)) : ?>
    <div <?php educator_edge_class_attribute($holder_classes); ?>>
        <div class="edgt-cpt-features-holder edgt-cpt-table">
            <?php if($display_border) : ?>
                <div class="edgt-cpt-table-border-top" <?php educator_edge_inline_style($border_style); ?>></div>
            <?php endif; ?>

            <div class="edgt-cpt-features-title edgt-cpt-table-head-holder">
                <div class="edgt-cpt-table-head-holder-inner">
                    <h4><?php echo wp_kses_post(preg_replace('#^<\/p>|<p>$#', '', $title)); ?></h4>
                </div>
            </div>
            <div class="edgt-cpt-features-list-holder edgt-cpt-table-content">
                <ul class="edgt-cpt-features-list">
                    <?php foreach($features as $feature) : ?>
                        <li class="edgt-cpt-features-item"><span><?php echo esc_html($feature); ?></span></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php echo do_shortcode($content); ?>
    </div>
<?php endif; ?>