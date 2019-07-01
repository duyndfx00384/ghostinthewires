<?php if(edgt_lms_core_plugin_installed()) {
	global $woocommerce;
	$cart_url = $woocommerce->cart->get_cart_url();
	?>
	<?php echo educator_edge_get_button_html(array(
		'text'			=> esc_html__('View Cart', 'edge-lms'),
		'link'			=> $cart_url
	)); ?>
<?php } else { ?>
	<a href="<?php echo esc_url($cart_url); ?>" class="edgt-btn edgt-btn-medium edgt-btn-solid"><?php echo esc_html__('View Cart', 'edge-lms'); ?></a>
<?php } ?>