<div class="edgt-container">
    <div class="edgt-container-inner clearfix">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="edgt-course-single-holder">
                <?php if(post_password_required()) {
                    echo get_the_password_form();
                } else {

                } ?>
                <div class="edgt-grid-row">
                    <div <?php echo educator_edge_get_content_sidebar_class(); ?>>
                        <div class="edgt-course-single-outer">
                            <?php
                            do_action('educator_edge_course_page_before_content');

                            edgt_lms_get_cpt_single_module_template_part('templates/single/layout-collections/'.$params['type'], 'course', '', $params);

                            do_action('educator_edge_course_page_after_content');
                            ?>
                        </div>
                    </div>
                    <?php if($sidebar_layout !== 'no-sidebar') { ?>
                        <div <?php echo educator_edge_get_sidebar_holder_class(); ?>>
                            <?php get_sidebar(); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>
<?php do_action('edgt_lms_course_popup'); ?>