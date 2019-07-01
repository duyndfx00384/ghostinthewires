<div class="edgt-cli-image-wrapper">
<?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/image', $item_layout, $params); ?>
<?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/wishlist', $item_layout, $params);?>
</div>
<div class="edgt-cli-text-holder">
	<div class="edgt-cli-text-wrapper">
		<div class="edgt-cli-text">
			<div class="edgt-cli-top-info">
				<?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/title', $item_layout, $params); ?>

				<?php if($enable_price == 'yes') {
                    echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/price', $item_layout, $params);
                } ?>
				<?php if($enable_instructor == 'yes') {
                    echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/instructor-simple', $item_layout, $params);
                } ?>
                <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/category', $item_layout, $params);?>
			</div>
			<?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/excerpt', $item_layout, $params); ?>
			<div class="edgt-cli-bottom-info">
				<?php if($enable_students == 'yes') {
                    echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/students', $item_layout, $params);
                } ?>
                <?php echo edgt_lms_get_cpt_shortcode_module_template_part('course', 'parts/duration', $item_layout, $params);?>
			</div>
		</div>
	</div>
</div>