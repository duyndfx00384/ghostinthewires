<?php
$user_favorites = get_user_meta(get_current_user_id(), 'edgt_course_wishlist', true);
?>
<div class="edgt-lms-profile-favorites-holder">
<?php if(!empty($user_favorites)) { ?>
    <?php
	foreach($user_favorites as $user_favorite){	?>

		<div class="edgt-lms-profile-favorite-item">
			<div class="edgt-lms-profile-favorite-item-image">
                <?php
                    if(has_post_thumbnail($user_favorite)) {
                        $image = get_the_post_thumbnail_url($user_favorite, 'thumbnail');
                    }
                    else {
                        $image = EDGE_LMS_CPT_URL_PATH.'/course/assets/img/course_featured_image.jpg';
                    }
                ?>
            <img src="<?php echo esc_attr($image); ?>" alt="<?php echo esc_attr('Course thumbnail','edge-lms') ?>" />
			</div>
            <div class="edgt-lms-profile-favorite-item-title">
			    <h5>
                    <a href="<?php echo get_the_permalink($user_favorite); ?>">
                        <?php echo get_the_title($user_favorite); ?>
                    </a>
                    <?php
                        $icon = edgt_lms_is_course_in_wishlist($user_favorite) ? 'fa fa-heart' : 'fa fa-heart-o';
                    ?>
                    <a href="javascript:void(0)" class="edgt-course-wishlist edgt-icon-only" data-course-id="<?php echo esc_attr($user_favorite); ?>">
                        <i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
                    </a>
                </h5>
            </div>
		</div>
    <?php
	}
 } else { ?>
    <h3><?php esc_html_e('Your favorites list is empty.', 'edge-lms') ?> </h3>
<?php } ?>
</div>