<div class="edgt-comparision-table-holder edgt-cpt-table <?php echo esc_html($featured);?>">
    <div class="edgt-cpt-table-holder-inner">
        <?php if($display_border) : ?>
            <div class="edgt-cpt-table-border-top" <?php educator_edge_inline_style($border_style); ?>></div>
        <?php endif; ?>

        <div class="edgt-cpt-table-head-holder">
            <div class="edgt-cpt-table-head-holder-inner">
                <?php if(!empty($image)) : ?>
                    <div class="edgt-cpt-table-image-holder">
                        <?php echo wp_get_attachment_image($image, 'full'); ?>
                    </div>
                <?php endif; ?>
                <?php if($title !== '') : ?>
                    <h4 class="edgt-cpt-table-title"><?php echo esc_html($title); ?></h4>
                <?php endif; ?>

                <?php if($price !== '') : ?>
                    <div class="edgt-cpt-table-price-holder">
                        <?php if($currency !== '') : ?>
                        <span class="edgt-cpt-table-currency"><?php echo esc_html($currency); ?></span><!--
						<?php else: ?>
							<!--
						<?php endif; ?>

						 --><span class="edgt-cpt-table-price"><?php echo esc_html($price); ?></span>

                        <?php if($price_period !== '') : ?>
                            <span class="edgt-cpt-table-period">
								/ <?php echo esc_html($price_period); ?>
							</span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="edgt-cpt-table-content">
            <?php echo do_shortcode(preg_replace('#^<\/p>|<p>$#', '', $content)); ?>
        </div>

        <div class="edgt-cpt-table-footer">
            <div class="edgt-cpt-table-btn">
                <a <?php educator_edge_inline_style($btn_styles); ?> href="<?php echo esc_url($link); ?>">
                    <span><?php echo esc_html($button_text); ?></span>
                </a>
            </div>
        </div>
    </div>
</div>