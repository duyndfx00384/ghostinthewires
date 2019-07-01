<?php
$thumb_size = $this_object->getImageSize($params);
?>
<div class="edgt-cli-image">
	<?php if(has_post_thumbnail()) { ?>
		<?php echo get_the_post_thumbnail(get_the_ID(), $thumb_size); ?>
	<?php } else { ?>
		<img itemprop="image" class="edgt-cl-original-image" width="800" height="600" src="<?php echo EDGE_LMS_CPT_URL_PATH.'/course/assets/img/course_featured_image.jpg'; ?>" alt="<?php esc_html_e('Course Featured Image', 'edge-lms'); ?>" />
	<?php } ?>
</div>