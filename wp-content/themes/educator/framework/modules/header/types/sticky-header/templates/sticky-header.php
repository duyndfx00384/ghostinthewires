<?php do_action('educator_edge_before_sticky_header'); ?>

<div class="edgt-sticky-header">
    <?php do_action( 'educator_edge_after_sticky_menu_html_open' ); ?>
    <div class="edgt-sticky-holder">
        <?php if($sticky_header_in_grid) : ?>
        <div class="edgt-grid">
            <?php endif; ?>
            <div class=" edgt-vertical-align-containers">
                <div class="edgt-position-left">
                    <div class="edgt-position-left-inner">
                        <?php if(!$hide_logo) {
                            educator_edge_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <div class="edgt-position-right">
                    <div class="edgt-position-right-inner">
						<?php educator_edge_get_sticky_menu('edgt-sticky-nav'); ?>
						<?php if(is_active_sidebar('edgt-sticky-right')) : ?>
                            <?php dynamic_sidebar('edgt-sticky-right'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if($sticky_header_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
	<?php do_action( 'educator_edge_before_sticky_menu_html_close' ); ?>
</div>

<?php do_action('educator_edge_after_sticky_header'); ?>