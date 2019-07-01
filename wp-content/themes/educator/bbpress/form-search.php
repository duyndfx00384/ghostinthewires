<?php

/**
 * Search 
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<form action="<?php bbp_search_url(); ?>" id="bbp-search-form" class="edgt-search-menu-holder" method="get">
    <div class="edgt-form-holder">
        <input type="hidden" name="action" value="bbp-search-request" />
        <input type="text" placeholder="<?php esc_attr_e('Search', 'educator') ?>" class="edgt-search-field" autocomplete="off" name="bbp_search" id="bbp_search" tabindex="<?php bbp_tab_index(); ?>"  value="<?php echo esc_attr( bbp_get_search_terms() ); ?>" /><button tabindex="<?php bbp_tab_index(); ?>" class="button" type="submit" id="bbp_search_submit" value=""><span class="icon_search"></span></button>
    </div>
</form>