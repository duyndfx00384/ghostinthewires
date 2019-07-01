<?php

define('EDGE_LMS_VERSION', '1.0');
define('EDGE_LMS_ABS_PATH', dirname(__FILE__));
define('EDGE_LMS_REL_PATH', dirname(plugin_basename(__FILE__ )));
define('EDGE_LMS_URL_PATH', plugin_dir_url( __FILE__ ));
define('EDGE_LMS_ASSETS_PATH', EDGE_LMS_ABS_PATH.'/assets');
define('EDGE_LMS_ASSETS_URL_PATH', EDGE_LMS_URL_PATH.'assets');
define('EDGE_LMS_CPT_PATH', EDGE_LMS_ABS_PATH.'/post-types');
define('EDGE_LMS_CPT_URL_PATH', EDGE_LMS_URL_PATH.'post-types');
define('EDGE_LMS_SHORTCODES_PATH', EDGE_LMS_ABS_PATH.'/shortcodes');
define('EDGE_LMS_SHORTCODES_URL_PATH', EDGE_LMS_URL_PATH.'shortcodes');