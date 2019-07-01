<div class="edgt-icon-tabs <?php echo esc_attr($holder_classes); ?>">
    <ul class="edgt-icon-tabs-nav clearfix">
        <?php foreach ($tabs_titles as $tab_title) { ?>
            <li>
                <?php if(!empty($tab_title)) { ?>
                    <a href="#tab-<?php echo sanitize_title($tab_title)?>">
                        <span class="edgt-icon-tabs-title-holder"><?php echo esc_html($tab_title); ?></span>
                    </a>
                <?php } ?>
            </li>
        <?php } ?>
    </ul>
    <?php echo do_shortcode($content); ?>
</div>