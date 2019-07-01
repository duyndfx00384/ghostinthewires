<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php
    /**
     * educator_edge_header_meta hook
     *
     * @see educator_edge_header_meta() - hooked with 10
     * @see educator_edge_user_scalable_meta - hooked with 10
     */
    do_action('educator_edge_header_meta');

    wp_head(); ?>
</head>
<body <?php body_class();?> itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * educator_edge_after_body_tag hook
	 *
	 * @see educator_edge_get_side_area() - hooked with 10
	 * @see educator_edge_smooth_page_transitions() - hooked with 10
	 */
	do_action('educator_edge_after_body_tag'); ?>
	
	<div class="edgt-wrapper edgt-404-page">
	    <div class="edgt-wrapper-inner">
		    <?php educator_edge_get_header(); ?>
		    
			<div class="edgt-content" <?php educator_edge_content_elem_style_attr(); ?>>
	            <div class="edgt-content-inner">
					<div class="edgt-page-not-found">
						<?php
							$edgt_title_image_404 = educator_edge_options()->getOptionValue('404_page_title_image');
							$edgt_title_404       = educator_edge_options()->getOptionValue('404_title');
							$edgt_subtitle_404    = educator_edge_options()->getOptionValue('404_subtitle');
							$edgt_text_404        = educator_edge_options()->getOptionValue('404_text');
							$edgt_button_label    = educator_edge_options()->getOptionValue('404_back_to_home');
							$edgt_button_style    = educator_edge_options()->getOptionValue('404_button_style');
						?>

						<?php if (!empty($edgt_title_image_404)) { ?>
							<div class="edgt-404-title-image"><img src="<?php echo esc_url($edgt_title_image_404); ?>" alt="<?php esc_html_e('404 Title Image', 'educator'); ?>" /></div>
						<?php } ?>

						<h1 class="edgt-404-title">
							<?php if(!empty($edgt_title_404)) {
								echo esc_html($edgt_title_404);
							} else {
								esc_html_e('404', 'educator');
							} ?>
						</h1>

						<h3 class="edgt-404-subtitle">
							<?php if(!empty($edgt_subtitle_404)){
								echo esc_html($edgt_subtitle_404);
							} else {
								esc_html_e('Page not found', 'educator');
							} ?>
						</h3>
						<?php if(!empty($edgt_text_404)){ ?>
							<p class="edgt-404-text">
								<?php echo esc_html($edgt_text_404);?>
							</p>
						<?php }?>
						<?php
							$edgt_params = array();
							$edgt_params['text'] = !empty($edgt_button_label) ? $edgt_button_label : esc_html__('BACK TO HOME', 'educator');
							$edgt_params['link'] = esc_url(home_url('/'));
							$edgt_params['target'] = '_self';
							$edgt_params['size'] = 'small';
						
							if ($edgt_button_style == 'light-style'){
								$edgt_params['custom_class'] = 'edgt-btn-light-style';
							}
	
							echo educator_edge_execute_shortcode('edgt_button',$edgt_params); ?>
					</div>
				</div>	
			</div>
		</div>
	</div>
    <?php wp_footer(); ?>
</body>
</html>