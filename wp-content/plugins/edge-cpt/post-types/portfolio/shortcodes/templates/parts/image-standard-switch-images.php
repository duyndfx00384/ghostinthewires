<?php
$thumb_size = $this_object->getImageSize($params);
$switch_featured_image = $this_object->getSwitchFeaturedImage($params);
?>
<div class="edgt-pli-image">
	<?php if(has_post_thumbnail()) { ?>
		<?php echo get_the_post_thumbnail(get_the_ID(), $thumb_size); ?>
	<?php } else { ?>
		<img itemprop="image" class="edgt-pl-original-image" width="800" height="600" src="<?php echo EDGE_CORE_CPT_URL_PATH.'/portfolio/assets/img/portfolio_featured_image.jpg'; ?>" alt="<?php esc_html_e('Portfolio Featured Image', 'edge-cpt'); ?>" />
	<?php } ?>

    <?php if (!empty($switch_featured_image)) {
        if ($thumb_size === 'full') { ?>
            <img itemprop="image" class="edgt-pl-hover-image" src="<?php echo esc_url($switch_featured_image); ?>" alt="<?php esc_html_e('Portfolio Hover Featured Image', 'edge-cpt'); ?>" />
        <?php } else {
            $thumb_image_size = educator_edge_get_image_size($thumb_size);
            echo educator_edge_generate_thumbnail(null, $switch_featured_image, $thumb_image_size['width'], $thumb_image_size['height']);
        }
    } ?>
</div>