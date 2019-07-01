<div class="edgt-banner-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="edgt-banner-image">
        <?php echo wp_get_attachment_image($image, 'full'); ?>
    </div>
    <div class="edgt-banner-text-holder" <?php echo educator_edge_get_inline_style($overlay_styles); ?>>
	    <div class="edgt-banner-text-outer">
		    <div class="edgt-banner-text-inner">
		        <?php if(!empty($subtitle)) { ?>
		            <<?php echo esc_attr($subtitle_tag); ?> class="edgt-banner-subtitle" <?php echo educator_edge_get_inline_style($subtitle_styles); ?>>
			            <?php echo esc_html($subtitle); ?>
		            </<?php echo esc_attr($subtitle_tag); ?>>
		        <?php } ?>
		        <?php if(!empty($title)) { ?>
		            <<?php echo esc_attr($title_tag); ?> class="edgt-banner-title" <?php echo educator_edge_get_inline_style($title_styles); ?>>
		                <?php echo wp_kses($title, array('span' => array('class' => true))); ?>
	                </<?php echo esc_attr($title_tag); ?>>
		        <?php } ?>
				<?php if(!empty($link) && !empty($link_text)) { ?>
		            <a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" class="edgt-banner-link-text" <?php echo educator_edge_get_inline_style($link_styles); ?>>
			            <span class="edgt-banner-link-original">
				            <span class="edgt-banner-link-icon ion-arrow-right-c"></span>
			                <span class="edgt-banner-link-label"><?php echo esc_html($link_text); ?></span>
			            </span>
			            <span class="edgt-banner-link-hover">
				            <span class="edgt-banner-link-icon ion-arrow-right-c"></span>
			                <span class="edgt-banner-link-label"><?php echo esc_html($link_text); ?></span>
			            </span>
		            </a>
		        <?php } ?>
			</div>
		</div>
	</div>
	<?php if (!empty($link)) { ?>
        <a itemprop="url" class="edgt-banner-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
    <?php } ?>
</div>