<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="edgt-post-content">
        <div class="edgt-post-heading">
            <?php educator_edge_get_module_template_part('templates/parts/post-type/video', 'blog', '', $part_params); ?>
        </div>
        <div class="edgt-post-text">
            <div class="edgt-post-text-inner">
                <div class="edgt-post-info-top">
                    <?php educator_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                </div>
                <div class="edgt-post-text-main">
                    <?php educator_edge_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                </div>
                <div class="edgt-post-info-bottom clearfix">
                        <?php educator_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>