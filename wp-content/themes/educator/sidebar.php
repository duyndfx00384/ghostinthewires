<aside class="edgt-sidebar">
    <?php
        $edgt_sidebar = educator_edge_get_sidebar();
    
        if (is_active_sidebar($edgt_sidebar)) {
            dynamic_sidebar($edgt_sidebar);
        }
    ?>
</aside>