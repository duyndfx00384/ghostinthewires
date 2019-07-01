<div class="edgt-page-header page-header clearfix">
    <div class="edgt-theme-name pull-left" >
        <img src="<?php echo esc_url(educator_edge_get_skin_uri() . '/assets/img/logo.png'); ?>" alt="<?php esc_html_e( 'Logo', 'educator' ); ?>" class="edgt-header-logo pull-left"/>
        <?php $current_theme = wp_get_theme(); ?>
        <h1 class="pull-left">
            <?php echo esc_html($current_theme->get('Name')); ?>
            <small><?php echo esc_html($current_theme->get('Version')); ?></small>
        </h1>
    </div>
    <div class="edgt-top-section-holder">
        <div class="edgt-top-section-holder-inner">
            <?php $this->getAnchors($active_page); ?>
            <div class="edgt-top-buttons-holder">
                <?php if($show_save_btn) { ?>
                    <input type="button" id="edgt_top_save_button" class="btn btn-info btn-sm" value="<?php esc_html_e('Save Changes', 'educator'); ?>"/>
                <?php } ?>
            </div>
            <?php if($show_save_btn) { ?>
                <div class="edgt-input-change">
                    <i class="fa fa-exclamation-circle"></i><?php esc_html_e('You should save your changes', 'educator') ?>
                </div>
                <div class="edgt-changes-saved">
                    <i class="fa fa-check-circle"></i><?php esc_html_e('All your changes are successfully saved', 'educator') ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>