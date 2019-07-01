<?php
$edgt_search_holder_params = educator_edge_get_holder_params_search();
?>
<?php get_header(); ?>
<?php educator_edge_get_title(); ?>
    <div class="<?php echo esc_attr($edgt_search_holder_params['holder']); ?>">
        <?php do_action('educator_edge_after_container_open'); ?>
        <div class="<?php echo esc_attr($edgt_search_holder_params['inner']); ?>">
            <?php educator_edge_get_search_page(); ?>
        </div>
        <?php do_action('educator_edge_before_container_close'); ?>
    </div>
<?php get_footer(); ?>