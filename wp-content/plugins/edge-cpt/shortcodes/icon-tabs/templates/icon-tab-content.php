<?php
$tab_data_str = '';
$icon_html = '';
$tab_data_str .= 'data-icon-pack="'.$icon_pack.'" ';
$icon_html .= (empty($custom_icon))  ? educator_edge_execute_shortcode('edgt_icon', $icon_parameters) : wp_get_attachment_image($custom_icon, 'full');
$tab_data_str .= 'data-icon-html="'. esc_attr($icon_html) .'"';
?>
<div class="edgt-icon-tab-container" id="tab-<?php echo sanitize_title($tab_title); ?>" <?php print $tab_data_str?>><?php echo do_shortcode($content); ?></div>