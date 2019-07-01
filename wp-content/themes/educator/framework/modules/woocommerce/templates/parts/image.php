<?php
$product = educator_edge_return_woocommerce_global_variable();

if ($product->is_on_sale()) { ?>
	<span class="edgt-<?php echo esc_attr($class_name); ?>-onsale"><?php esc_html_e('SALE', 'educator'); ?></span>
<?php } ?>

<?php if (!$product->is_in_stock()) { ?>
	<span class="edgt-<?php echo esc_attr($class_name); ?>-out-of-stock"><?php esc_html_e('OUT OF STOCK', 'educator'); ?></span>
<?php }

$product_image_size = 'shop_catalog';
if($image_size === 'full') {
	$product_image_size = 'full';
} else if ($image_size === 'square') {
	$product_image_size = 'educator_edge_square';
} else if ($image_size === 'landscape') {
	$product_image_size = 'educator_edge_landscape';
} else if ($image_size === 'portrait') {
	$product_image_size = 'educator_edge_portrait';
} else if ($image_size === 'medium') {
	$product_image_size = 'medium';
} else if ($image_size === 'large') {
	$product_image_size = 'large';
} else if ($image_size === 'shop_thumbnail') {
	$product_image_size = 'shop_thumbnail';
}

if(has_post_thumbnail()) {
	the_post_thumbnail(apply_filters( 'educator_edge_product_list_image_size', $product_image_size));
}