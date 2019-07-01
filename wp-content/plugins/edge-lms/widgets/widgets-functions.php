<?php
if(!function_exists('edgt_lms_include_widgets_loaders')) {
    /**
     * Loads all custom post types by going through all folders that are placed directly in post types folder
     */
    function edgt_lms_include_widgets_loaders() {
        if(edgt_lms_theme_installed()) {
            foreach (glob(EDGE_LMS_ABS_PATH . '/widgets/*/load.php') as $widget_load) {
                include_once $widget_load;
            }
        }
    }

    add_action('educator_edge_before_options_map', 'edgt_lms_include_widgets_loaders', 20); //Priority needs to be bigger than 10 so abstract widget class is loaded first
}