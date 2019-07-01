<?php $sidebar = educator_edge_sidebar_layout(); ?>
<?php get_header(); ?>
<?php educator_edge_get_title(); ?>
<?php get_template_part('slider'); ?>
    <div class="edgt-container edgt-container-with-sidebar">
        <?php do_action('educator_edge_after_container_open'); ?>
        <div class="edgt-container-inner clearfix">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php if(is_active_sidebar('sidebar-event')): ?>
                    <div class="edgt-grid-row">
                        <div class="edgt-page-content-holder edgt-grid-col-9 edgt-content-left">
                            <div class="edgt-column-inner">
                                <?php educator_edge_tt_event_single_content(); ?>
                                <?php do_action('educator_edge_page_after_content'); ?>
                            </div>
                        </div>
                        <div class="edgt-sidebar-holder edgt-grid-col-3 edgt-sidebar-right">
                            <div class="edgt-column-inner">
                                <div class="edgt-sidebar">
                                    <?php
                                    dynamic_sidebar('sidebar-event');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                                <?php educator_edge_tt_event_single_content(); ?>
                                <?php do_action('educator_edge_page_after_content'); ?>
                <?php endif; ?>

            <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <?php do_action('educator_edge_before_container_close'); ?>
    </div>
<?php get_footer(); ?>