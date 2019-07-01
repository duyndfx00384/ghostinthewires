<form action="<?php echo esc_url(home_url('/')); ?>" class="edgt-search-page-form" method="get">
    <h2 class="edgt-search-title"><?php esc_html_e('Search results:', 'educator'); ?></h2>
    <div class="edgt-form-holder">
        <div class="edgt-column-left">
            <input type="text" name="s" class="edgt-search-field" autocomplete="off" value="" placeholder="<?php esc_html_e('Type here', 'educator'); ?>"/>
        </div>
        <div class="edgt-column-right">
            <button type="submit" class="edgt-search-submit"><span class="icon_search"></span></button>
        </div>
    </div>
    <div class="edgt-search-label">
        <?php esc_html_e('If you are not happy with the results below please do another search', 'educator'); ?>
    </div>
</form>