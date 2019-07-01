<?php
$edgt_blog_type = 'standard';
educator_edge_include_blog_helper_functions('lists', $edgt_blog_type);
$edgt_holder_params = educator_edge_get_holder_params_blog();
?>
<?php get_header(); ?>
<?php educator_edge_get_title(); ?>
<?php get_template_part('slider'); ?>
    <div class="<?php echo esc_attr($edgt_holder_params['holder']); ?>">
        <?php do_action('educator_edge_after_container_open'); ?>
        <div class="<?php echo esc_attr($edgt_holder_params['inner']); ?>">
            <?php educator_edge_get_blog($edgt_blog_type); ?>
        </div>
        <?php do_action('educator_edge_before_container_close'); ?>
    </div>
<?php do_action('educator_edge_blog_list_additional_tags'); ?>
<?php get_footer(); ?>