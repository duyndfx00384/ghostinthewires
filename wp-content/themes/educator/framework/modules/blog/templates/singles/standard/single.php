<?php

educator_edge_get_single_post_format_html($blog_single_type);

educator_edge_get_module_template_part('templates/parts/single/author-info', 'blog');

educator_edge_get_module_template_part('templates/parts/single/related-posts', 'blog', '', $single_info_params);

educator_edge_get_module_template_part('templates/parts/single/comments', 'blog');

educator_edge_get_module_template_part('templates/parts/single/single-navigation', 'blog');