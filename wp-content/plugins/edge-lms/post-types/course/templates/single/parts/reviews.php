<?php if(comments_open()) { ?>
<div class="edgt-grid-col-4 edgt-course-info-wrapper">
    <div class="edgt-course-reviews">
        <div class="edgt-course-reviews-label">
            <?php esc_html_e('Reviews:', 'edge-lms') ?>
        </div>
        <span class="edgt-course-stars">
            <?php
                $review_rating = edgt_lms_course_average_rating();
                for($i=1; $i<=$review_rating; $i++){ ?>
                    <i class="fa fa-star" aria-hidden="true"></i>
            <?php } ?>
		</span>
        <!-- This should change to open tab -->
        <a itemprop="url" class="edgt-post-info-comments" href="<?php comments_link(); ?>" target="_self">
            <?php comments_number('0 ' . esc_html__('Reviews','edge-lms'), '1 '.esc_html__('Review','edge-lms'), '% '.esc_html__('Reviews','edge-lms') ); ?>
        </a>
    </div>
</div>
<?php } ?>