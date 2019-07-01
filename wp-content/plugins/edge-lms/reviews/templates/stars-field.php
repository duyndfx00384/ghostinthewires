<div class="edgt-rating-form-title-holder">
	<div class="edgt-comment-form-rating">
		<label><?php esc_html_e('Rating', 'edge-lms') ?><span class="required">*</span></label>
		<span class="edgt-comment-rating-box">
			<?php for ($i = 1; $i <= 5; $i++) { ?>
					<span class="edgt-star-rating" data-value="<?php echo esc_attr($i); ?>"></span>
			<?php }	?>
			<input type="hidden" name="edgt_rating" id="edgt-rating" value="3">
		</span>
	</div>
</div>