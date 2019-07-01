<div class="edgt-tml-holder">
    <?php if(!empty($title)) { ?>
        <h4 class="edgt-tml-title"><?php echo esc_html($title);?></h4>
    <?php } ?>
    <div class="edgt-timeline">
        <?php echo do_shortcode($content); ?>
    </div>
</div>