<?php
$args = array(
    'p' => $quiz_id,
    'post_type' => 'quiz'
);
$quiz_query = new WP_Query($args);
?>
<?php if ($quiz_query->have_posts()) : while ($quiz_query->have_posts()) : $quiz_query->the_post(); ?>
    <div class="edgt-quiz-single-holder-active">
        <?php if(post_password_required()) {
            echo get_the_password_form();
        } else {
            do_action('educator_edge_quiz_active_page_before_content');

            edgt_lms_get_cpt_single_module_template_part('templates/single/layout-collections/active', 'quiz', '', $params);

            do_action('educator_edge_quiz_active_page_after_content');
        } ?>
    </div>
<?php endwhile; endif; wp_reset_postdata();?>
