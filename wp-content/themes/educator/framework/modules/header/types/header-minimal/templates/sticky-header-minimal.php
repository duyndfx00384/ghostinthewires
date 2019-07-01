<?php do_action('educator_edge_after_sticky_header'); ?>

<div class="edgt-sticky-header">
    <?php do_action('educator_edge_after_sticky_menu_html_open'); ?>
    <div class="edgt-sticky-holder">
        <?php if ($sticky_header_in_grid) : ?>
        <div class="edgt-grid">
            <?php endif; ?>
            <div class=" edgt-vertical-align-containers">
                <div class="edgt-position-left">
                    <div class="edgt-position-left-inner">
                        <?php if (!$hide_logo) {
                            educator_edge_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <div class="edgt-position-right">
                    <div class="edgt-position-right-inner">
                        <a href="javascript:void(0)" class="edgt-fullscreen-menu-opener">
                            <span class="edgt-fm-lines">
								<span class="edgt-fm-line edgt-line-1"></span>
								<span class="edgt-fm-line edgt-line-2"></span>
								<span class="edgt-fm-line edgt-line-3"></span>
							</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php if ($sticky_header_in_grid) : ?>
        </div>
    <?php endif; ?>
    </div>
</div>

<?php do_action('educator_edge_after_sticky_header'); ?>
