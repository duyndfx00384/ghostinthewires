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

    <div class="edgt-wrapper">
        <div class="edgt-wrapper-inner">
            <?php educator_edge_get_header(); ?>
	
	        <?php
	        /**
	         * educator_edge_after_header_area hook
	         *
	         * @see educator_edge_back_to_top_button() - hooked with 10
	         * @see educator_edge_get_full_screen_menu() - hooked with 10
	         */
	        do_action('educator_edge_after_header_area'); ?>
	        
            <div class="edgt-content" <?php educator_edge_content_elem_style_attr(); ?>>
                <div class="edgt-content-inner">