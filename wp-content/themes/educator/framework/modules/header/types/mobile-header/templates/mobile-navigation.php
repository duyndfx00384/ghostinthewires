<?php do_action('educator_edge_before_mobile_navigation'); ?>

<nav class="edgt-mobile-nav">
    <div class="edgt-grid">
        <?php wp_nav_menu(array(
            'theme_location' => 'mobile-navigation' ,
            'container'  => '',
            'container_class' => '',
            'menu_class' => '',
            'menu_id' => '',
            'fallback_cb' => 'top_navigation_fallback',
            'link_before' => '<span>',
            'link_after' => '</span>',
            'walker' => new EducatorEdgeMobileNavigationWalker()
        )); ?>
    </div>
</nav>

<?php do_action('educator_edge_after_mobile_navigation'); ?>