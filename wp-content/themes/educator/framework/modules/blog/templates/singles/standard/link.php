<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="edgt-post-content">
        <div class="edgt-post-text">
            <div class="edgt-post-text-inner">
                <div class="edgt-post-text-main">
                    <div class="edgt-post-mark">
                        <span class="fa fa-link edgt-link-mark"></span>
                    </div>
                    <?php educator_edge_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
                </div>
                <div class="edgt-post-info-top">
                    <?php educator_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php educator_edge_get_module_template_part('templates/parts/post-info/like', 'blog', '', $part_params); ?>
                    <?php educator_edge_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                    <?php educator_edge_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                </div>
                <div class="edgt-post-info-bottom clearfix">
                    <div class="edgt-post-info-bottom-left">
                        <?php educator_edge_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                    </div>
                    <div class="edgt-post-info-bottom-right">
                        <?php educator_edge_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="edgt-post-additional-content">
        <?php the_content(); ?>
    </div>
</article>