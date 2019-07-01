<form action="" method="post" class="edgt-lms-complete-item-form">
	<input type="hidden" name="edgt_lms_course_id" value="<?php echo esc_attr($course_id) ?>" />
	<input type="hidden" name="edgt_lms_item_id" value="<?php echo esc_attr($item_id) ?>" />
	<?php if(edgt_lms_core_plugin_installed()) { ?>
		<?php echo educator_edge_get_button_html(array(
			'html_type' 	=> 'input',
			'size'          => 'small',
			'text'			=> esc_html__('Complete', 'edge-lms'),
			'input_name'	=> 'submit'
		)); ?>
	<?php } else { ?>
		<input name="submit" type="submit" value="<?php echo esc_html__('Complete', 'edge-lms'); ?>" />
	<?php } ?>
</form>
