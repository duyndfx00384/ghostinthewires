<table class="edgt-course-table-holder">
    <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/table-h', '', $params); ?>
    <tbody>
        <?php if($query_results->have_posts()):
            while ( $query_results->have_posts() ) : $query_results->the_post();
                    echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'course-table-item', '', $params);
            endwhile;
            else:
                echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/posts-not-found', 'tr', $params);
            endif;

            wp_reset_postdata();
        ?>
    </tbody>
</table>