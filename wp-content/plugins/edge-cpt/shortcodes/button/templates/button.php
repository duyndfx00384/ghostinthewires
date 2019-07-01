<button type="submit" <?php educator_edge_inline_style($button_styles); ?> <?php educator_edge_class_attribute($button_classes); ?> <?php echo educator_edge_get_inline_attrs($button_data); ?> <?php echo educator_edge_get_inline_attrs($button_custom_attrs); ?>>
    <span class="edgt-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo educator_edge_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>