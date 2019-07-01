<?php if(edgt_lms_core_plugin_installed()) { ?>
	<?php echo educator_edge_get_button_html(array(
		'text'			=> esc_html__('Completed', 'edge-lms'),
		'link'			=> 'javascript:void(0)'
	)); ?>
<?php } else { ?>
	<a href="javascript:void(0)" class="edgt-btn edgt-btn-medium edgt-btn-solid"><?php echo esc_html__('Completed', 'edge-lms'); ?></a>
<?php } ?>