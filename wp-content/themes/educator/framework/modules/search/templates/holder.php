<div class="edgt-grid-row">
    <div <?php echo educator_edge_get_content_sidebar_class(); ?>>
        <div class="edgt-search-page-holder">
            <?php educator_edge_get_search_page_layout(); ?>
        </div>
        <?php do_action('educator_edge_page_after_content'); ?>
    </div>
    <?php if($sidebar_layout !== 'no-sidebar') { ?>
        <div <?php echo educator_edge_get_sidebar_holder_class(); ?>>
            <?php get_sidebar(); ?>
        </div>
    <?php } ?>
</div>