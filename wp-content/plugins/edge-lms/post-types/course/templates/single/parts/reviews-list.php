
<div class="edgt-course-reviews-main-title">
	<h3><?php esc_html_e('Reviews' , 'edge-lms') ?></h3>
</div>

<div class="edgt-course-reviews-list-top">
    <div class="edgt-course-reviews-number-wrapper">
        <div class="edgt-course-reviews-number"><?php echo edgt_lms_course_average_rating(); ?></div>
        <div class="edgt-course-stars-wrapper">
            <span class="edgt-course-stars">
                <?php
                $review_rating = edgt_lms_course_average_rating();
                for($i=1; $i<=$review_rating; $i++){ ?>
                    <i class="fa fa-star" aria-hidden="true"></i>
                <?php } ?>
            </span>
            <span class="edgt-course-reviews-count"><?php comments_number('0 ' . esc_html__('Ratings','edge-lms'), '1 '.esc_html__('Rating','edge-lms'), '% '.esc_html__('Ratings','edge-lms') ); ?></span>
        </div>
    </div>
    <div class="edgt-course-rating-separator"></div>
    <div class="edgt-course-rating-percente-wrapper">
        <?php $ratings_array = edgt_lms_course_ratings();
        $number = edgt_lms_course_number_of_ratings();
        foreach ($ratings_array as $item => $value) {
            $percentage = $number == 0 ? 0 : round(($value /$number)*100);
            echo do_shortcode('[edgt_progress_bar type="rating" number_of_ratings="'.$value.'" percent="'.$percentage.'" title="'.$item . esc_html__(' Stars', 'edge-lms').'"]');
        }
        ?>
    </div>
</div>
<div class="edgt-course-reviews-list">
	<?php comments_template('', true); ?>
</div>