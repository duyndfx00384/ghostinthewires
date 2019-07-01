<form action="" method="post" class="edgt-lms-retake-course-form">
	<input type="hidden" name="edgt_lms_course_id" value="<?php echo get_the_ID(); ?>" />
	<?php if(edgt_lms_core_plugin_installed()) { ?>
		<?php echo educator_edge_get_button_html(array(
			'html_type' 	=> 'input',
			'text'			=> esc_html__('Retake', 'edge-lms'),
			'input_name'	=> 'submit'
		)); ?>
	<?php } else { ?>
		<input name="submit" type="submit" value="<?php echo esc_html__('Retake', 'edge-lms'); ?>" />
	<?php } ?>
</form>
