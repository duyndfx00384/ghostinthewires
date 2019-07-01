<?php
/**
 * Gonzales WordPress Plugin
 *
 * @package   Gonzales
 * @author    Tomasz Dobrzyński
 * @link      https://tomasz-dobrzynski.com
 * @copyright Copyright © 2018 Tomasz Dobrzyński
 *
 * Plugin Name: Gonzales
 * Plugin URI: https://tomasz-dobrzynski.com/wordpress-gonzales
 * Description: Speed up your site by deactivation of useless plugins, scripts and styles.
 * Version: 2.1
 * Author: Tomasz Dobrzyński
 * Author URI: https://tomasz-dobrzynski.com
 * Tested up to: 4.9.3
 * Revision: 2018.02.06
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Gonzales pre-configuration
 * ============================================================================
 */
register_activation_hook( __FILE__, 'gonzales_activated' );
register_activation_hook( __FILE__, 'gonzales_db_install' );
register_activation_hook( __FILE__, 'gonzales_mu_plugin_install' );

/**
 * Checks whether dependencies are meet or not
 */
function gonzales_activated() {
	add_option( 'Activated_Plugin', 'Gonzales' );

	$result = check_gonzales();
	if ( ! empty( $result ) ) {
		if ( 'gonzales-info' == $result || 'null' == $result->status ) {
			add_option( 'Gonzales_Issue_1', true );
		} elseif ( 'error' == $result->status ) {
			add_option( 'Gonzales_Issue_2', true );
		}
	}
}

global $gonzales_db_version;
$gonzales_db_version = 1.2;

/**
 * Install required tabled:
 * gonzales_disabled, gonzales_enabled
 */
function gonzales_db_install() {
	global $wpdb;
	global $gonzales_db_version;
	$current_db_version = floatval( get_option( 'gonzales_db_version', 1.0 ) );

	$charset_collate = $wpdb->get_charset_collate();
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	if ( version_compare( $current_db_version, 1.1 , '<' ) ) {
		$table_name = $wpdb->prefix . 'gonzales_disabled';
		$sql_gonzales = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			handler_type tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=css, 1=js',
			handler_name varchar(128) DEFAULT '' NOT NULL,
			url varchar(255) DEFAULT '' NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		$table_name = $wpdb->prefix . 'gonzales_enabled';
		$sql_gonzales_exceptions = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			handler_type tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=css, 1=js',
			handler_name varchar(128) DEFAULT '' NOT NULL,
			content_type varchar(64) DEFAULT '' NOT NULL,
			url varchar(255) DEFAULT '' NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		dbDelta( $sql_gonzales );
		dbDelta( $sql_gonzales_exceptions );
	}

	if ( version_compare( $current_db_version, 1.2 , '<' ) ) {
		$table_name = $wpdb->prefix . 'gonzales_p_disabled';
		$sql_gonzales_p = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			name varchar(128) DEFAULT '' NOT NULL,
			url varchar(255) DEFAULT '' NOT NULL,
			regex TEXT NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		$table_name = $wpdb->prefix . 'gonzales_p_enabled';
		$sql_gonzales_p_exceptions = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			name varchar(128) DEFAULT '' NOT NULL,
			content_type varchar(64) DEFAULT '' NOT NULL,
			url varchar(255) DEFAULT '' NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		dbDelta( $sql_gonzales_p );
		dbDelta( $sql_gonzales_p_exceptions );
	}

	update_option( 'gonzales_db_version', $gonzales_db_version );
}

/**
 * Determine Must Use plugins path.
 *
 * @return string Path
 */
function gonzales_mu_dir() {
	$mu_dir = ( defined( 'WPMU_PLUGIN_DIR' ) && defined( 'WPMU_PLUGIN_URL' ) ) ? WPMU_PLUGIN_DIR : trailingslashit( WP_CONTENT_DIR ) . 'mu-plugins';
	$mu_dir = untrailingslashit( $mu_dir );

	return $mu_dir;
}

/**
 * Install Must Use plugin
 */
function gonzales_mu_plugin_install() {
	$error = false;

	$mu_plugin = gonzales_mu_dir() . '/gonzales.php';

	$source = dirname( __FILE__ ) . '/mu-plugins/gonzales.php';

	if ( ! file_exists( $mu_plugin ) ) {
		if ( ! @wp_mkdir_p( gonzales_mu_dir() ) ) {
			add_option( 'Gonzales_Issue_3', true );
			$error = true;
		}

		if ( ! $error && ! @copy( $source, $mu_plugin ) ) {
			add_option( 'Gonzales_Issue_4', true );
		} else {
			delete_option( 'Gonzales_Issue_4' );
		}
	}
}

/**
 * Gonzales actual functionalty
 * ============================================================================
 */
class Gonzales {
	/**
	 * Stores current content type
	 *
	 * @var string
	 */
	private $content_type = '';

	/**
	 * Stores entire entered by user selection for CSS/JS
	 *
	 * @var array
	 */
	private $gonzales_data = array();

	/**
	 * Stores entire entered by user selection for plugins
	 *
	 * @var array
	 */
	private $gonzales_data_plugins = array();

	/**
	 * Stores list of all available assets (used in rendering panel)
	 *
	 * @var array
	 */
	private $collection = array();

	/**
	 * Stores list of asset dependencies
	 *
	 * @var array
	 */
	private $dependency_collection = array();

	/**
	 * Stores list of all plugins
	 *
	 * @var array
	 */
	private $all_plugin = array();

	/**
	 * Stores list of all content types defined in WordPress
	 *
	 * @var array
	 */
	private $all_content_types = array();

	/**
	 * List of all assets
	 *
	 * @var array
	 */
	private $all_assets = array();

	/**
	 * List of plugins not visible on the list
	 *
	 * @var array
	 */
	private $whitelist_plugins = array(
		'gonzales'
	);

	/**
	 * List of CSS/JS not visible on the list
	 *
	 * @var array
	 */
	private $whitelist_assets = array(
		'js' => array( 'admin-bar' ),
		'css' => array( 'admin-bar', 'dashicons' ),
	);

	/**
	 * List of already rendered plugins (to omit conflict of existence in lower sections)
	 *
	 * @var array
	 */
	private $already_listed_plugins = array();

	/**
	 * Version number, to keep latest assets
	 *
	 * @var string
	 */
	protected $version = '2.1';

	/**
	 * Initilize entire machine
	 */
	function __construct() {

		if ( ! defined( 'GONZALES_DISABLE_ON_FRONTEND' ) ) {
			add_action( 'init', array( $this, 'update_configuration' ), 1 );
		} elseif ( defined( 'GONZALES_ENABLE_ON_BACKEND' ) ) {
			add_action( 'admin_init', array( $this, 'update_configuration' ), 1 );
		}
		add_action( 'init', array( $this, 'load_configuration' ), 2 );
		add_action( 'init', array( $this, 'read_plugins_list' ), 3 );
		add_action( 'init', array( $this, 'conditionally_remove_emoji' ), 4 );

		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'admin_init', array( $this, 'check_updates' ), 1 );
		add_action( 'admin_init', array( $this, 'load_plugin' ) );
		add_action( 'template_redirect', array( $this, 'detect_content_type' ) );

		if ( ! defined( 'GONZALES_DISABLE_ON_FRONTEND' ) && ! is_admin() ) {
			add_action( 'wp_head', array( $this, 'collect_assets' ), 10000 );
			add_action( 'wp_footer', array( $this, 'collect_assets' ), 10000 );
			add_filter( 'script_loader_src', array( $this, 'unload_assets' ), 10, 2 );
			add_filter( 'style_loader_src', array( $this, 'unload_assets' ), 10, 2 );

			if ( ! defined( 'DISABLE_GONZALES_PANEL' ) ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'append_asset' ) );
				add_action( 'wp_footer', array( $this, 'render_panel' ), 10000 + 1 );
			}
		}

		if ( defined( 'GONZALES_ENABLE_ON_BACKEND' ) && is_admin() ) {
			add_action( 'admin_head', array( $this, 'collect_assets' ), 10000 );
			add_action( 'admin_footer', array( $this, 'collect_assets' ), 10000 );
			add_filter( 'script_loader_src', array( $this, 'unload_assets' ), 10, 2 );
			add_filter( 'style_loader_src', array( $this, 'unload_assets' ), 10, 2 );

			if ( ! defined( 'DISABLE_GONZALES_PANEL' ) ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'append_asset' ) );
				add_action( 'admin_footer', array( $this, 'render_panel' ), 10000 + 1 );
			}
		}

		if ( ! defined( 'DISABLE_GONZALES_PANEL' ) ) {
			add_action( 'admin_bar_menu', array( $this, 'add_node_to_admin_bar' ), 1000 );
		}
	}

	/**
	 * Conditionally remove emoji script and styles
	 */
	public function conditionally_remove_emoji() {
		if ( ! $this->get_visibility_asset( 'js', 'wp-emoji' ) ) {
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
		}
	}

	/**
	 * Check whether asset should be disabled or not.
	 *
	 * @param  string $url 		Handler URL.
	 * @param  string $handle 	Asset handle name.
	 * @return mixed
	 */
	public function unload_assets( $url, $handle ) {
		$type = ( current_filter() == 'script_loader_src' ) ? 'js' : 'css';
		$source = ( current_filter() == 'script_loader_src' ) ? wp_scripts() : wp_styles();

		return ( $this->get_visibility_asset( $type, $handle ) ? $url : false);
	}

	/**
	 * Sniff whether Emoji has already been disable by 3rd part extensions
	 *
	 * @return bool State
	 */
	private function detect_emoji_visibility() {
		return (bool) has_action( 'wp_head', 'print_emoji_detection_script' );
	}

	/**
	 * Read list of all plugins in plugins dir.
	 *
	 * @return mixed
	 */
	public function read_plugins_list() {
		// Check if get_plugins() function exists. This is required on the front end of the
		// site, since it is in a file that is normally only loaded in the admin.
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$this->all_plugins = get_plugins();
	}

	/**
	 * Get information regarding used assets
	 *
	 * @return bool
	 */
	public function collect_assets() {
		global $gonzales_helper;

		/**
		 * Imitate full untouched list without dequeued assets
		 * Appends part of original table. Safe approach.
		 */
		$data_assets = array(
			'js' => wp_scripts(),
			'css' => wp_styles(),
		);

		/**
		 * Przygotowuje listę da Theme i Misc
		 */
		$plugins_url = plugins_url();
		$theme_root_uri = get_theme_root_uri();
		foreach ( $data_assets as $type => $data ) {
			foreach ( $data->done as $el ) {
				if ( ! in_array( $el, $this->whitelist_assets[ $type ] ) ) {
					if ( isset( $data->registered[ $el ]->src ) && ! empty( $data->registered[ $el ]->src ) ) {
						$url = $this->prepare_correct_url( $data->registered[ $el ]->src );

						if ( false !== strpos( $url, $plugins_url ) ) {
							$resource_name = 'plugins';

							// Generuje nazwę folderu pluginu z URL asseta.
							$plugin_path = str_replace( $plugins_url, '', $url );
							if ( '/' == $plugin_path[0] ) {
								$plugin_path = substr( $plugin_path, 1 );
							}
							$plugin_path = explode( '/', $plugin_path );
							$plugin_dir = $plugin_path[0];

						} elseif ( false !== strpos( $url, $theme_root_uri ) ) {
							$resource_name = 'theme';
						} else {
							$resource_name = 'misc';
						}

						$url_info = pathinfo( $url );
						$filename = isset( $url_info['basename'] ) ? $url_info['basename'] : '';
						$file_base = isset( $url_info['filename'] ) ? $url_info['filename'] : '';
						$file_extension = isset( $url_info['extension'] ) ? $url_info['extension'] : '';

						$arr = array(
							'url_full' => $url,
							'filename' => $filename,
							'file_base' => $file_base,
							'is_external' => $this->check_if_external( $url ),
							'file_extension' => $file_extension,
							'state' => $this->get_visibility_asset( $type, $el ),
							'size' => $this->get_asset_size( $url ),
							'deps' => ( isset( $data->registered[ $el ]->deps ) ? $data->registered[ $el ]->deps : array() ),
						);

						if ( 'plugins' == $resource_name ) {
							$arr['plugin'] = '';
							$this->collection[ $resource_name ][ $plugin_dir ][ $type ][ $el ] = $arr;
						} else {
							$this->collection[ $resource_name ][ $type ][ $el ] = $arr;
						}

						// to not look for dependencies in many levels nested foreach loops.
						$this->dependency_collection[] = array(
							'name' => $el,
							'filename' => $filename,
							'file_extension' => $file_extension,
							'state' => $this->get_visibility_asset( $type, $el ),
							'deps' => ( isset( $data->registered[ $el ]->deps ) ? $data->registered[ $el ]->deps : array() ),
						);
					}
				}
			}
		}

		global $wp_version;
		if ( version_compare( $wp_version, '4.2', '>=' ) ) {
			$url = '/wp-includes/js/wp-emoji-release.min.js';

			$this->collection['misc']['js']['wp-emoji'] = array(
				'url_full' => $url,
				'filename' => 'wp-emoji-release.min.js',
				'file_base' => 'wp-emoji-release.min',
				'is_external' => false,
				'file_extension' => 'js',
				'state' => $this->detect_emoji_visibility(),
				'size' => $this->get_asset_size( $url ),
				'deps' => array(),
			);

		}

		return false;
	}

	/**
	 * Checks whether URL is internal or external resource
	 *
	 * @param  string $url Input URL.
	 * @return bool      True if external
	 */
	private function check_if_external( $url ) {
		$components_dest = parse_url( $url );
		$components_base = parse_url( get_site_url() );
		return ! empty( $components_dest['host'] ) && strcasecmp( $components_dest['host'], $components_base['host'] );
	}

	/**
	 * Initialize interface translation
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'gonzales', false, basename( dirname( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Adds notification after plugin activation how to use Gonzales
	 */
	public function load_plugin() {
		if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
			if ( get_option( 'Gonzales_Issue_1' ) ) {
				delete_option( 'Gonzales_Issue_1' );
				deactivate_plugins( plugin_basename( __FILE__ ) );
				add_action( 'admin_notices', array( $this, 'gonzales_null' ) );
			} elseif ( get_option( 'Gonzales_Issue_2' ) ) {
				delete_option( 'Gonzales_Issue_2' );
				deactivate_plugins( plugin_basename( __FILE__ ) );
				add_action( 'admin_notices', array( $this, 'gonzales_error' ) );
			} elseif ( get_option( 'Gonzales_Issue_3' ) ) {
				delete_option( 'Gonzales_Issue_3' );
				deactivate_plugins( plugin_basename( __FILE__ ) );
				add_action( 'admin_notices', array( $this, 'gonzales_error_mu_1' ) );
			} elseif ( get_option( 'Gonzales_Issue_4' ) ) {
				deactivate_plugins( plugin_basename( __FILE__ ) );
				add_action( 'admin_notices', array( $this, 'gonzales_error_mu_2' ) );
			}
		}

		if ( is_admin() && 'Gonzales' == get_option( 'Activated_Plugin' ) ) {
			delete_option( 'Activated_Plugin' );
		}
	}

	/**
	 * Check for new releases
	 */
	public function check_updates() {
		$gonz_file = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'gonzales-info.php';
		if ( file_exists( $gonz_file ) ) {
			require_once( $gonz_file );
			require_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'plugin-update-checker' . DIRECTORY_SEPARATOR . 'plugin-update-checker.php' );

			$update_checker = Puc_v4_Factory::buildUpdateChecker(
				'http://updates.tomasz-dobrzynski.com/?action=get_metadata&slug=gonzales&license_key=' . $gonzales_token,
				__FILE__,
				'gonzales'
			);

			unset( $gonzales_token );
		}
	}

	/**
	 * Plugin activation exception #1
	 */
	public function gonzales_null() {
		printf( '<div class="notice notice-error"><p>Incorrect Gonzales installation. Please <a href="%s">contact developer</a>.</p></div>', 'https://tomasz-dobrzynski.com/contact' );
	}

	/**
	 * Plugin activation exception #1
	 */
	public function gonzales_error() {
		require_once( 'gonzales-info.php' );
		printf( '<div class="notice notice-error"><p>Looks like you installed Gonzales on all available slots. Please <a href="%s">extend a license</a> to use on higher number of websites.</p></div>', 'https://tomasz-dobrzynski.com/wordpress-gonzales/license-extend/' . $gonzales_token );
	}

	/**
	 * Plugin activation exception #1
	 */
	public function gonzales_error_mu_1() {
		printf( '<div class="notice notice-error"><p>Can\'t install Gonzales MU plugin (helper for main Gonzales plugin). It\'s probably because lack of write permissions to ' . gonzales_mu_dir() . ' directory. Otherwise please <a href="%s">contact developer</a>.</p></div>', 'https://tomasz-dobrzynski.com/contact' );
	}

	/**
	 * Plugin activation exception #1
	 */
	public function gonzales_error_mu_2() {
		printf( '<div class="notice notice-error"><p>Can\'t install Gonzales MU plugin (helper for main Gonzales plugin). It\'s probably because lack of permissions to copy ' . dirname( __FILE__ ) . '/mu-plugins/gonzales.php file to ' . gonzales_mu_dir() . ' directory. Otherwise please <a href="%s">contact developer</a>.</p></div>', 'https://tomasz-dobrzynski.com/contact' );
	}

	/**
	 * Loads functionality that allows to enable/disable js/css without site reload
	 */
	public function append_asset() {
		if ( current_user_can( 'manage_options' ) ) {
			wp_enqueue_style( 'gonzales', plugins_url( 'style.css', __FILE__ ), array(), $this->version, false );
			wp_enqueue_script( 'gonzales', plugins_url( 'script.js', __FILE__ ) , array(), $this->version, true );
		}
	}

	/**
	 * Get asset type based on name/ID
	 *
	 * @param  int|string $input Handler type.
	 * @return int|string        Reversed handler type.
	 */
	private function get_handler_type( $input ) {
		$data = array(
			'css' => 0,
			'js' => 1,
		);

		if ( is_numeric( $input ) ) {
			$data = array_flip( $data );
		}

		return $data[ $input ];
	}

	/**
	 * Execute action once checkbox is changed
	 */
	public function update_configuration() {
		global $wpdb;

		if ( ! current_user_can( 'manage_options' ) ||
		 ! isset( $_POST['gonzalesUpdate'] ) ||
		 ! wp_verify_nonce( filter_input( INPUT_POST, 'gonzalesUpdate' ), 'gonzales' ) ||
		 ! isset( $_POST['allAssets'] ) ||
		 empty( $_POST['allAssets'] ) ||
		 empty( $_POST['currentURL'] ) ) {
			return false;
		}

		$all_assets = json_decode( html_entity_decode( filter_input( INPUT_POST, 'allAssets', FILTER_SANITIZE_SPECIAL_CHARS ) ) );

		if ( empty( $all_assets ) ) {
			return false;
		}

		/**
		 * Clearing old configuration
		 * Removing all selected plugins (list of visible passed in array).
		 * Forget about phpcs warning. It's safe & prepared SQL
		 *
		 * 1. Clear disable everywhere
		 * 2. Clear enable content types & enable here
		 */

		/**
		 * CSS/JS
		 */
		$sql = sprintf( 'DELETE FROM %s WHERE handler_name IN (%s) AND (url = "" OR url = "%s")', $wpdb->prefix . 'gonzales_disabled', implode( ', ', array_fill( 0, count( $all_assets ), '%s' ) ), filter_input( INPUT_POST, 'currentURL' ) );
		$prepared_sql = call_user_func_array( array( $wpdb, 'prepare' ), array_merge( array( $sql ), $all_assets ) );
		$wpdb->query( $prepared_sql );

		$sql = sprintf( 'DELETE FROM %s WHERE handler_name IN (%s) AND (url = "" OR url = "%s")', $wpdb->prefix . 'gonzales_enabled', implode( ', ', array_fill( 0, count( $all_assets ), '%s' ) ), filter_input( INPUT_POST, 'currentURL' ) );
		$prepared_sql = call_user_func_array( array( $wpdb, 'prepare' ), array_merge( array( $sql ), $all_assets ) );
		$wpdb->query( $prepared_sql );

		/**
		 * Inserting new configuration
		 */
		if ( isset( $_POST['disabled'] ) && ! empty( $_POST['disabled'] ) ) {
			foreach ( $_POST['disabled'] as $type => $assets ) {
				if ( ! empty( $assets ) ) {
					foreach ( $assets as $handle => $where ) {
						if ( ! empty( $where ) ) {
							foreach ( $where as /*$place =>*/ $place ) {
								$wpdb->insert(
									$wpdb->prefix . 'gonzales_disabled',
									array(
										'handler_type' => $this->get_handler_type( $type ),
										'handler_name' => $handle,
										'url' => ( 'here' == $place ? filter_input( INPUT_POST, 'currentURL' ) : '' ),
									),
									array( '%d', '%s', '%s' )
								);
							}
						}
					}
				}
			}
		}

		if ( isset( $_POST['enabled'] ) && ! empty( $_POST['enabled'] ) ) {
			foreach ( $_POST['enabled'] as $type => $assets ) {
				if ( ! empty( $assets ) ) {
					foreach ( $assets as $handle => $content_types ) {
						if ( ! empty( $content_types ) ) {
							foreach ( $content_types as $content_type => $nvm ) {
								$wpdb->insert(
									$wpdb->prefix . 'gonzales_enabled',
									array(
										'handler_type' => $this->get_handler_type( $type ),
										'handler_name' => $handle,
										'content_type' => $content_type,
										'url' => ( 'here' == $content_type ? filter_input( INPUT_POST, 'currentURL' ) : '' ),
									),
									array( '%d', '%s', '%s', '%s' )
								);
							}
						}
					}
				}
			}
		}


		/**
		 * Plugins
		 */
		$wpdb->query( sprintf( 'DELETE FROM %s WHERE (url = "" OR url = "%s")', $wpdb->prefix . 'gonzales_p_disabled', filter_input( INPUT_POST, 'currentURL' ) ) );

		$wpdb->query( sprintf( 'DELETE FROM %s WHERE (url = "" OR url = "%s")', $wpdb->prefix . 'gonzales_p_enabled', filter_input( INPUT_POST, 'currentURL' ) ) );

		/**
		 * Inserting new configuration
		 */
		if ( isset( $_POST['disabledPlugin'] ) && ! empty( $_POST['disabledPlugin'] ) ) {
			foreach ( $_POST['disabledPlugin'] as $plugin => $where ) {
				if ( ! empty( $where ) ) {
					$wpdb->insert(
						$wpdb->prefix . 'gonzales_p_disabled',
						array(
							'name' => $plugin,
							'url' => ( 'here' == $where ? filter_input( INPUT_POST, 'currentURL' ) : '' ),
							'regex' => ( 'regex' == $where ? $_POST['disabledPluginRegex'][$plugin] : '' ),
						),
						array( '%s', '%s', '%s' )
					);
				}
			}
		}

		if ( isset( $_POST['enabledPlugin'] ) && ! empty( $_POST['enabledPlugin'] ) ) {
			foreach ( $_POST['enabledPlugin'] as $plugin => $content_types ) {
				if ( ! empty( $content_types ) ) {
					foreach ( $content_types as $content_type => $nvm ) {
						$wpdb->insert(
							$wpdb->prefix . 'gonzales_p_enabled',
							array(
								'name' => $plugin,
								'content_type' => $content_type,
								'url' => ( 'here' == $content_type ? filter_input( INPUT_POST, 'currentURL' ) : '' ),
							),
							array( '%s', '%s', '%s' )
						);
					}
				}
			}
		}

		$http_referer = filter_input( INPUT_SERVER, 'HTTP_REFERER' );
		if ( ! defined( 'GONZALES_CACHE_CONTROL' ) ) {
			if ( function_exists( 'w3tc_pgcache_flush' ) ) {
				w3tc_pgcache_flush();
			} elseif ( function_exists( 'wp_cache_clear_cache' ) ) {
				wp_cache_clear_cache();
			} elseif ( function_exists( 'rocket_clean_files' ) ) {
				rocket_clean_files( esc_url( $http_referer ) );
			}
		}

		// Redirect to refresh plugins configuration.
		if ( wp_redirect( $http_referer ) ) {
			exit;
		}
	}

	/**
	 * Generates Gonzales item with dynamically generated subtrees in administration menu
	 *
	 * @param mixed $wp_admin_bar 	Admin bar object.
	 */
	public function add_node_to_admin_bar( $wp_admin_bar ) {
		/**
		 * Checks whether Gonzales should appear on frontend/backend or not
		 */
		if (
			! current_user_can( 'manage_options' ) ||
			( defined( 'GONZALES_DISABLE_ON_FRONTEND' ) && ! is_admin() ) ||
			( ! defined( 'GONZALES_ENABLE_ON_BACKEND' ) && is_admin() )
		) {
			return;
		}

		$wp_admin_bar->add_menu( array(
			'id'     => 'gonzales',
			'title'  => esc_html__( 'Gonzales', 'gonzales' ),
			'meta'	 => array( 'class' => 'gonzales-object' ),
		) );
	}

	/**
	 * Checks whether asset is enabled/disabled
	 *
	 * @param  string $type   Handler type (CSS/JS).
	 * @param  string $plugin Handler name.
	 * @return bool          State
	 */
	private function get_visibility_asset( $type = '', $plugin = '' ) {
		$state = true;

		if ( isset( $this->gonzales_data['disabled'][ $type ][ $plugin ] ) ) {
			$state = false;

			if ( isset( $this->gonzales_data['enabled'][ $type ][ $plugin ][ $this->content_type ] ) ||
				isset( $this->gonzales_data['enabled'][ $type ][ $plugin ]['here'] ) ) {
				$state = true;
			}
		}

		return $state;
	}

	/**
	 * Checks whether plugin is enabled/disabled
	 *
	 * @param  string $plugin   Plugin type.
	 * @return bool          State
	 */
	private function get_visibility_plugin( $plugin = '' ) {
		$state = 1;

		if ( isset( $this->gonzales_data_plugins['disabled'][ $plugin ] ) ) {

			// Even if regex is available checks if it's valid!
			if ( isset( $this->gonzales_data_plugins['disabled'][ $plugin ]['regex'] ) ) {
				$matches = array();
				@preg_match( '/' . $this->gonzales_data_plugins['disabled'][ $plugin ]['regex'] . '/', esc_url( $this->get_current_url() ), $matches );
				$state = ( count( $matches ) ? 0 : 1 );
			} else {
				$state = 0;
			}

			if ( isset( $this->gonzales_data_plugins['enabled'][ $plugin ][ $this->content_type ] ) ||
				isset( $this->gonzales_data_plugins['enabled'][ $plugin ]['here'] ) ) {
				$state = 1;
			}
		}

		return $state;
	}

	/**
	 * Exception for address starting from "//example.com" instead of
	 * "http://example.com". WooCommerce likes such a format
	 *
	 * @param  string $url Incorrect URL.
	 * @return string      Correct URL.
	 */
	private function prepare_correct_url( $url ) {
		if ( isset( $url[0] ) && isset( $url[1] ) && '/' == $url[0] && '/' == $url[1] ) {
			$out = (is_ssl() ? 'https:' : 'http:') . $url;
		} else {
			$out = $url;
		}

		return $out;
	}

	/**
	 * Checks how heavy is file
	 *
	 * @param  string $src    URL.
	 * @return int          Size in KB.
	 */
	private function get_asset_size( $src ) {
		$weight = 0;

		$home = get_theme_root() . '/../..';
		$src = explode( '?', $src );

		$src_relative = $home . str_replace( get_home_url(), '', $this->prepare_correct_url( $src[0] ) );

		if ( file_exists( $src_relative ) ) {
			$weight = round( filesize( $src_relative ) / 1024, 1 );
		}

		return $weight;
	}

	/**
	 * Detect current content type
	 */
	public function detect_content_type() {
		if ( is_singular() ) {
			$this->content_type = get_post_type();
		}
	}

	/**
	 * Reading saved configuration
	 */
	public function load_configuration() {
		global $wpdb;

		/**
		 * CSS/JS
		 */
		$out = array();

		$disabled_global = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'gonzales_disabled WHERE url = ""', ARRAY_A );
		$disabled_here = $wpdb->get_results( sprintf( 'SELECT * FROM ' . $wpdb->prefix . 'gonzales_disabled WHERE url = "%s"',
			esc_url( $this->get_current_url() )
			), ARRAY_A );

		$enabled_posts = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'gonzales_enabled WHERE content_type != "here"', ARRAY_A );
		$enabled_here = $wpdb->get_results( sprintf( 'SELECT * FROM %s WHERE content_type = \'%s\' AND url=\'%s\'',
			$wpdb->prefix . 'gonzales_enabled',
			'here',
			esc_url( $this->get_current_url() ) ), ARRAY_A );
		$enabled = array_merge( $enabled_here, $enabled_posts );

		if ( ! empty( $disabled_global ) ) {
			foreach ( $disabled_global as $row ) {
				$type = $this->get_handler_type( $row['handler_type'] );
				$out['disabled'][ $type ][ $row['handler_name'] ]['everywhere'] = true;
			}
		}

		if ( ! empty( $disabled_here ) ) {
			foreach ( $disabled_here as $row ) {
				$type = $this->get_handler_type( $row['handler_type'] );
				$out['disabled'][ $type ][ $row['handler_name'] ]['here'] = true;
			}
		}

		if ( ! empty( $enabled ) ) {
			foreach ( $enabled as $row ) {
				$type = $this->get_handler_type( $row['handler_type'] );
				$out['enabled'][ $type ][ $row['handler_name'] ][ $row['content_type'] ] = true;
			}
		}

		$this->gonzales_data = $out;


		/**
		 * Plugins
		 */
		$out = array();
		$current_url = esc_url( $this->get_current_url() );

		$disabled_global = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'gonzales_p_disabled WHERE url = "" AND regex = ""', ARRAY_A );
		$disabled_here = $wpdb->get_results( sprintf( 'SELECT * FROM ' . $wpdb->prefix . 'gonzales_p_disabled WHERE url = "%s"',
			$current_url
			), ARRAY_A );
		$disabled_regex = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'gonzales_p_disabled WHERE regex != ""', ARRAY_A );

		$enabled_posts = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'gonzales_p_enabled WHERE content_type != "here"', ARRAY_A );
		$enabled_here = $wpdb->get_results( sprintf( 'SELECT * FROM %s WHERE content_type = \'%s\' AND url=\'%s\'',
			$wpdb->prefix . 'gonzales_p_enabled',
			'here',
			$current_url ), ARRAY_A );
		$enabled = array_merge( $enabled_here, $enabled_posts );

		if ( ! empty( $disabled_global ) ) {
			foreach ( $disabled_global as $row ) {
				$out['disabled'][ $row['name'] ]['everywhere'] = true;
			}
		}

		if ( ! empty( $disabled_here ) ) {
			foreach ( $disabled_here as $row ) {
				$out['disabled'][ $row['name'] ]['here'] = true;
			}
		}

		if ( ! empty( $disabled_regex ) ) {
			foreach ( $disabled_regex as $row ) {
				$out['disabled'][ $row['name'] ]['regex'] = stripslashes( $row['regex'] );
			}
		}

		if ( ! empty( $enabled ) ) {
			foreach ( $enabled as $row ) {
				$out['enabled'][ $row['name'] ][ $row['content_type'] ] = true;
			}
		}

		$this->gonzales_data_plugins = $out;
	}

	/**
	 * Return peak RAM usage.
	 *
	 * @return float Value in 2 digits after comma
	 */
	private function get_ram_usage() {
		return number_format( ( memory_get_peak_usage() / 1024 / 1024) , 2, '.', '' );
	}

	/**
	 * Print render panel
	 */
	public function render_panel() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return false;
		}

		global $gonzales_helper;
		$http_host = filter_input( INPUT_SERVER, 'HTTP_HOST' );

		$out = isset( $_POST['gonzalesUpdate'] ) ? '<script>document.addEventListener("DOMContentLoaded", function(event) { document.getElementById("wp-admin-bar-gonzales").click(); });</script>' : '';

		$out .= '<form id="gonzales" class="gonzales-panel" method="POST" style="display: none;">
		<h1><span>Gonzales</span> v ' . $this->version . '</h1>
		<table class="gonzales-info">
		<tr>
			<td>
				<div><b>Few things you should know before you start:</b></div>
				<ul>
					<li>' . __( 'CSS/JS files (assets) can look different on particular pages,', 'gonzales' ) . '</li>
					<li>' . __( 'plugin will not present assets if you disable it,', 'gonzales' ) . '</li>
					<li style="color: red">' . __( 'double check that plugin is not mandatory by the other ones before you make decision to disable it,', 'gonzales' ) . '</li>
					<li>' . __( 'regex should be used by experts only. sample', 'gonzales' ) . '<span style="font-family: monospace">(^\/contact$|^\/about-us$)</span> ' . __( 'will disable plugin on /contact and /about-us,', 'gonzales' ) . '</li>
					<li>' . sprintf( __( 'regex subject and current URL = %s', 'gonzales' ), '<b>' . $this->get_current_url() . '</b>' ) . '</li>
					<li>' . __( 'always test regex rules using <a href="http://www.phpliveregex.com/p/mT3" target="_blank">phpliveregex.com</a> before you apply on production,', 'gonzales' ) . '</li>
					<li>' . __( 'you don\'t have to worry about caching because each time you save configuration appropriate caches will be cleared,', 'gonzales' ) . '</li>
					<li>' . __( 'peak RAM usage for current URL', 'gonzales' ) . sprintf( ' = <b>%s</b> MB,', $this->get_ram_usage() ) . '</li>
				</ul>
			</td>
		</tr>
		</table>';

		$this->all_assets = array();
		$this->all_content_types = $this->get_public_post_types();

		// Specific resource types order.
		$tmp = array();
		if ( ! empty( $this->collection['plugins'] ) ) {
			$tmp['plugins'] = $this->collection['plugins'];
		}

		if ( ! empty( $this->collection['theme'] ) ) {
			$tmp['theme'] = $this->collection['theme'];
		}

		if ( ! empty( $this->collection['misc'] ) ) {
			$tmp['misc'] = $this->collection['misc'];
		}

		$this->collection = $tmp;

		foreach ( $this->collection as $resource_type => $types ) {

			if ( 'plugins' == $resource_type ) {
				$out .= '<h2>' . __( $resource_type , 'gonzales' ) . '</h2>';

				foreach ( $types as $plugin_dir => $types_sub ) {
					$plugin_info = $this->get_plugin_info_by_directory( $plugin_dir );

					// Do not place whitelisted plugins + do not clone the same plugin among enabled/disable plugins list.
					if ( in_array( $plugin_info['gPluginName'], $this->whitelist_plugins ) || in_array( $plugin_info['gPluginName'], $this->already_listed_plugins ) ) {
						continue;
					}

					$out .= $this->render_group( $resource_type, $types_sub, $plugin_info );
				}

				$plugin_states = array( 'disabled', 'enabled' );
				/**
				 * Disabled plugins (they do not attach CSS/JS; force showing).
				 * Enabled plugins (which do not generate CSS/JS).
				 */
				foreach ( $plugin_states as $plugin_state ) {
					if ( isset( $gonzales_helper->control[ $plugin_state ] ) && ! empty( $gonzales_helper->control[ $plugin_state ] ) ) {
						foreach ( $gonzales_helper->control[ $plugin_state ] as $plugin_path ) {

							$plugin_dir = $this->get_plugin_slug( $plugin_path );
							$plugin_info = $this->get_plugin_info_by_directory( $plugin_dir );

							// Do not place whitelisted plugins + do not clone the same plugin among enabled/disable plugins list.
							if ( in_array( $plugin_info['gPluginName'], $this->whitelist_plugins ) || in_array( $plugin_info['gPluginName'], $this->already_listed_plugins ) ) {
								continue;
							}

							if ( 'disabled' == $plugin_state ) {
								$out .= $this->render_empty_disabled_plugin_group( $types_sub, $plugin_info );
							} else {
								$out .= $this->render_empty_enabled_plugin_group( $types_sub, $plugin_info );
							}
						}
					}
				}
			} else {
				$out .= $this->render_group( $resource_type, $types );
			}
		}

		$out .= '<input type="submit" id="submit-gonzales" value="' . __( 'Save changes' ) . '">';
		$out .= wp_nonce_field( 'gonzales', 'gonzalesUpdate', true, false );
		$out .= '<input type="hidden" name="currentURL" value="' . esc_url( $this->get_current_url() ) . '">
			<input type="hidden" name="allAssets" value="' . filter_var( json_encode( $this->all_assets ), FILTER_SANITIZE_SPECIAL_CHARS ) . '">
		</form>';

		print $out;
	}

	/**
	 * Get plugin slug by path
	 *
	 * @param  string $plugin_path Input.
	 * @return string              Output
	 */
	/*private function get_plugin_dir_by_path( $plugin_path ) {
		$plugin_dir = explode( '/', $plugin_path );
		$plugin_dir = $plugin_dir[0];
		if ( '/' == $plugin_dir[0] ) {
			$plugin_dir = substr( $plugin_dir, 1 );
		}

		return $plugin_dir;
	}*/
	private function get_plugin_slug( $plugin_path ) {
		$out = explode( '/', $plugin_path );

		if ( count( $out ) == 1 ) {
			/**
			 * Single file, not nested in folder.
			 * Exploding and removing extension assuming it can be .php5 or php7 instead of traditional .php
			 */
			$out = explode( '.', $plugin_path );
			array_pop( $out );
		}

		return $out[0];
	}

	/**
	 * Get plugin details base on provided part of URL address.
	 *
	 * @param  string $plugin_slug Plugin directory.
	 * @return string
	 */
	private function get_plugin_info_by_directory( $plugin_slug ) {
		foreach ( $this->all_plugins as $plugin_path => $plugin_details ) {
			/*
			 * 0 = początek stringu, / = koniec url
			 * by nie zaciągał "bloom" z "et-bloom-extender"
			 */
			if (
				( 0 === strpos( $plugin_path, $plugin_slug . '/' ) ) || // Plugin in directory.
				( 0 === strpos( $plugin_path, $plugin_slug . '.' ) )    // Plugin as single file in plugins directory.
			) {
				return array_merge(
					$plugin_details,
					array(
						'gPluginPath' => $plugin_path,
						'gPluginName' => $plugin_slug,
					)
				);
			}
		}
	}

	/**
	 * Display header with plugin control
	 *
	 * @param  array $types       List of assets in JS/CSS groups.
	 * @param  array $plugin_info Plugin details.
	 * @return string              Html
	 */
	private function render_plugin_group_header( $types, $plugin_info ) {
		$plugin = $plugin_info['gPluginName'];
		$id = '[' . $plugin . ']';

		// Configured state (theory).
		$is_checked_ever = isset( $this->gonzales_data_plugins['disabled'][ $plugin ]['everywhere'] );
		$is_checked_here = isset( $this->gonzales_data_plugins['disabled'][ $plugin ]['here'] );
		$is_checked_regex = isset( $this->gonzales_data_plugins['disabled'][ $plugin ]['regex'] );

		// Real Plugin state (practice).
		$real_state = $this->get_visibility_plugin( $plugin );

		$out = '<table class="gonz plugin">';
		$out .= '<thead>';
			$out .= '<tr>';
				$out .= '<th>' . __( 'Loaded', 'gonzales' ) . '</th>';
				$out .= '<th>' . __( 'Plugin info', 'gonzales' ) . '</th>';
				$out .= '<th>' . __( 'State', 'gonzales' ) . '</th>';
				$out .= '<th></th>';
			$out .= '</tr>';
		$out .= '</thead>';
		$out .= '<tbody>';
		$out .= '<tr>';
		$out .= '<td><div class="state-' . $real_state . '">' . ( true == $real_state ? 'YES' : 'NO' ) . '</div></td>';
		$out .= '<td class="overflow">';

		if ( ! empty( $plugin_info['PluginURI'] ) ) {
			$out .= '<a href="' . $plugin_info['PluginURI'] . '" target="_blank">';
		}

		$out .= '<span>' . $plugin_info['Name'] . '</span>';

		if ( ! empty( $plugin_info['PluginURI'] ) ) {
			$out .= '</a>';
		}

		$out .= '<div class="g-info">';
		if ( ! empty( $plugin_info['Author'] ) ) {
			$out .= '<div><b>Author</b>: ' . $plugin_info['AuthorName'] . '</div>';
		}

		if ( ! empty( $plugin_info['Version'] ) ) {
			$out .= '<div><b>Version</b>: ' . $plugin_info['Version'] . '</div>';
		}
		$out .= '</div>';

		$out .= '</td>';

		$out .= '<td class="option-everwhere">';
			$option_everywhere = '<select>';
				$option_everywhere .= '<option value="e">' . __( 'Enable', 'gonales' ) . '</option>';
				$option_everywhere .= '<option value="d" ' . ( ( $is_checked_ever || $is_checked_here || $is_checked_regex ) ? 'selected' : '' ) . '>' . __( 'Disable', 'gonzales' ) . '</option>';
			$option_everywhere .= '</select>';

			$out .= $option_everywhere;
		$out .= '</td>';

		$out .= '<td class="options"><div class="g-cond ' . ( ( ! $is_checked_ever && ! $is_checked_here && ! $is_checked_regex ) ? 'g-disabled' : '' ) . '"><b>' . __( 'Where', 'gonzales' ) . ':</b><br>';
			$out .= '<label><input name="' . 'disabledPlugin' . $id . '" type="radio" value="here" ' . ( $is_checked_here ? 'checked' : '' ) . '>' . __( 'Current URL', 'gonzales' ) . '</label>';
			$out .= '<label><input name="' . 'disabledPlugin' . $id . '" type="radio" value="everywhere" ' . ( $is_checked_ever ? 'checked' : '' ) . '>' . __( 'Everywhere', 'gonzales' ) . '</label>';
			$out .= '<label><input name="' . 'disabledPlugin' . $id . '" type="radio" value="regex" ' . ( $is_checked_regex ? 'checked' : '' ) . '>' . __( 'Regex', 'gonzales' ) . '</label><br></div>';

			// Exceptions: Current URL.
			$is_checked = (isset( $this->gonzales_data_plugins['enabled'][ $plugin ]['here'] ) ? 'checked="checked"' : '');
			$options_enable = '<label><input type="checkbox" name="enabledPlugin' . $id . '[here]" ' . $is_checked . '>' . __( 'Current URL', 'gonzales' ) . '</label>';

			// Exceptions: Content types.
			/**
				Because of technical problems it's not possible to access content type on option filter
				$id_type = 'enabledPlugin' . $id . '[' . $content_type_code . ']';
				$is_checked = ( isset( $this->gonzales_data_plugins['enabled'][ $plugin ][ $content_type_code ] ) ? 'checked="checked"' : '' );
				$options_enable .= '<label><input type="checkbox" name="' . $id_type . '" ' . $is_checked . '>' . $content_type . '</label>';
			}*/

			// Regex
			$out .= '<div class="g-excp ' . ( ! $is_checked_ever ? 'g-disabled' : '' ) . '">';
				$out .= '<b>' . __( 'Exceptions', 'gonzales' ) . ':</b><br>' . $options_enable;
		$out .= '</div>';
		$out .= '<div class="g-regex ' . ( ! $is_checked_regex ? 'g-disabled' : '' ) . '">';
			$out .= '<textarea name="' . 'disabledPluginRegex' . $id . '" spellcheck="false">' . ( $is_checked_regex ? $this->gonzales_data_plugins['disabled'][ $plugin ]['regex'] : '' ) . '</textarea>';
		$out .= '</div>';
		$out .= '</td>';


		$out .= '</tr></tbody>
		</table>';

		return $out;
	}

	/**
	 * Display empty list of plugins (for disabled plugins)
	 *
	 * @param  array $types       List of assets in JS/CSS groups.
	 * @param  array $plugin_info Plugin details.
	 * @return string              Html
	 */
	private function render_empty_disabled_plugin_group( $types, $plugin_info = null ) {
		$out = '';

		$this->already_listed_plugins[] = $plugin_info['gPluginName'];

		$plugin_wrapper = '<div class="plugin-wrapper">';
		$plugin_wrapper .= $this->render_plugin_group_header( $types, $plugin_info );
		$plugin_wrapper .= '<div class="gonz empty">' . __( 'This list is empty because plugin has been disabled.', 'gonzales' ) . '<br>' . __( 'It means that potential assets served by this plugin have been automatically disabled too.', 'gonzales' ) . '</div>';
		$plugin_wrapper .= '</div>';

		$out .= $plugin_wrapper;

		return $out;
	}

	/**
	 * Display empty list of plugins (for enabled plugins)
	 *
	 * @param  array $types       List of assets in JS/CSS groups.
	 * @param  array $plugin_info Plugin details.
	 * @return string              Html
	 */
	private function render_empty_enabled_plugin_group( $types, $plugin_info = null ) {
		$out = '';

		$this->already_listed_plugins[] = $plugin_info['gPluginName'];

		$plugin_wrapper = '<div class="plugin-wrapper">';
		$plugin_wrapper .= $this->render_plugin_group_header( $types, $plugin_info );
		$plugin_wrapper .= '<div class="gonz empty">' . __( 'This plugin doesn\'t serve assets', 'gonzales' ) . '</div>';
		$plugin_wrapper .= '</div>';

		$out .= $plugin_wrapper;

		return $out;
	}

	/**
	 * Render table of assets (CSS/JS)
	 * To use common code in both certain plugins and themes/misc
	 *
	 * @return string
	 */
	private function render_group( $resource_type, $types, $plugin_info = null ) {
		$out = '';

		if ( ! empty( $plugin_info ) ) {
			$plugin_wrapper = '<div class="plugin-wrapper">';
			$plugin_wrapper .= $this->render_plugin_group_header( $types, $plugin_info );

			$this->already_listed_plugins[] = $plugin_info['gPluginName'];

			$out .= $plugin_wrapper;
		} else {
			$out .= '<h2>' . __( $resource_type, 'gonzales' ) . '</h2>';
		}

		$out .= '<table class="gonz">';
		$out .= '<thead>';
			$out .= '<th>' . __( 'Loaded', 'gonzales' ) . '</th>';
			$out .= '<th>' . __( 'Asset info', 'gonzales' ) . '</th>';
			$out .= '<th>' . __( 'Size', 'gonzales' ) . '</th>';
			$out .= '<th>' . __( 'State', 'gonzales' ) . '</th>';
			$out .= '<th>' /*. __( 'Conditions', 'gonzales' )*/ . '</th>';
		$out .= '</thead>';
		$out .= '<tbody>';

		foreach ( $types as $type_name => $rows ) {
			foreach ( $rows as $handle => $row ) {

				/**
				 * Find dependency
				 */
				$deps = array();
				foreach ( $row['deps'] as $dep_val ) {
					$unique = $type_name . '-' . $dep_val;

					// jQuery is not visible to connect with formal owenr of jQuery handle.
					$href_name = ( 'js-jquery' == $unique ? 'js-jquery-core' : $unique );
					$deps[] = '<a href="#' . $href_name . '">' . $dep_val . '</a>';
				}

				$depend_on = array();
				foreach ( $this->dependency_collection as $asset ) {
					if ( in_array( $handle, $asset['deps'] ) && $asset['state'] && ! empty( $asset['filename'] ) ) {
						$unique = $asset['file_extension'] . '-' . $asset['name'];

						// jQuery is not visible to connect with formal owenr of jQuery handle.
						$href_name = ( 'js-jquery' == $unique ? 'js-jquery-core' : $unique );
						$depend_on[ $unique ] = '<a href="#' . $href_name . '">' . $asset['name'] . '</a>';
					}
				}

				$id = '[' . $type_name . '][' . $handle . ']';

				// Disable everywhere.
				$is_checked_ever = isset( $this->gonzales_data['disabled'][ $type_name ][ $handle ]['everywhere'] );
				$is_checked_here = isset( $this->gonzales_data['disabled'][ $type_name ][ $handle ]['here'] );

				// Exceptions: Current URL.
				$is_checked = (isset( $this->gonzales_data['enabled'][ $type_name ][ $handle ]['here'] ) ? 'checked="checked"' : '');
				$options_enable = '<label><input type="checkbox" name="enabled' . $id . '[here]" ' . $is_checked . '>' . __( 'Current URL', 'gonzales' ) . '</label>';

				// Exceptions: Content types.
				foreach ( $this->all_content_types as $content_type_code => $content_type ) {
					$id_type = 'enabled' . $id . '[' . $content_type_code . ']';
					$is_checked = ( isset( $this->gonzales_data['enabled'][ $type_name ][ $handle ][ $content_type_code ] ) ? 'checked="checked"' : '' );
					$options_enable .= '<label><input type="checkbox" name="' . $id_type . '" ' . $is_checked . '>' . $content_type . '</label>';
				}

				$option_everywhere = '<select>';
					$option_everywhere .= '<option value="e">' . __( 'Enable', 'gonales' ) . '</option>';
					$option_everywhere .= '<option value="d" ' . ( ( $is_checked_ever || $is_checked_here ) ? 'selected' : '' ) . '>' . __( 'Disable', 'gonzales' ) . '</option>';
				$option_everywhere .= '</select>';

				$out .= '<tr>';
					$out .= '<td><div class="state-' . (int) $row['state'] . '">' . ( true == $row['state'] ? 'YES' : 'NO' ) . '</div></td>';
					$out .= '<td class="overflow"><a class="g-link" name="' . $type_name . '-' . $handle . '" href="' . $row['url_full'] . '" target="_blank">' . ($row['is_external'] ? $row['url_full'] : ($row['file_base'] . '.<b>' . $row['file_extension'] . '</b>')) . '</a>';
					$out .= '<div class="g-info">';
						$out .= '<div><b>' . __( 'Handle', 'gonzales' ) . ':</b> ' . $handle . '</div>';

				if ( ! empty( $deps ) ) {
					$out .= '<div><b>' . __( 'Require', 'gonzales' ) . ':</b> ' . implode( ', ', $deps ) . '</div>';
				}

				if ( ! empty( $depend_on ) ) {
					$out .= '<div><b>' . __( 'Depend on', 'gonzales' ) . ':</b> ' . implode( ', ', array_values( $depend_on ) ) . '</div>';
				}

					$out .= '</div>';
					$out .= '</td>';

					$out .= '<td>' . (empty( $row['size'] ) ? '?' : $row['size']) . ' KB</td>';

					$out .= '<td class="option-everwhere">' . $option_everywhere . '</td>';
					$out .= '<td class="options"><div class="g-cond ' . ( ( ! $is_checked_ever && ! $is_checked_here ) ? 'g-disabled' : '' ) . '"><b>' . __( 'Where', 'gonzales' ) . ':</b><br>';
					$out .= '<label><input name="' . 'disabled' . $id . '[type]' . '" type="radio" value="here" ' . ( $is_checked_here ? 'checked' : '' ) . '>' . __( 'Current URL', 'gonzales' ) . '</label>';
					$out .= '<label><input name="' . 'disabled' . $id . '[type]' . '" type="radio" value="everywhere" ' . ( $is_checked_ever ? 'checked' : '' ) . '>' . __( 'Everywhere', 'gonzales' ) . '</label><br></div>';

					$out .= '<div class="g-excp ' . ( ! $is_checked_ever ? 'g-disabled' : '' ) . '">';
						$out .= '<b>' . __( 'Exceptions', 'gonzales' ) . ':</b><br>' . $options_enable;
					$out .= '</div></td>';
				$out .= '</tr>';

				$this->all_assets[] = $handle;
			}
		}

		$out .= '</tbody>
		</table>';

		if ( ! empty( $plugin_info ) ) {
			$plugin_wrapper = '</div>';

			$out .= $plugin_wrapper;
		}

		return $out;
	}

	/**
	 * Get current URL
	 *
	 * @return string
	 */
	private function get_current_url() {
		$request_uri = filter_input( INPUT_SERVER, 'REQUEST_URI' );

		$url = explode( '?', $request_uri, 2 );
		if ( strlen( $url[0] ) > 1 ) {
			$out = rtrim( $url[0], '/' );
		} else {
			$out = $url[0];
		}

		return $out;
	}

	/**
	 * Generated content types
	 *
	 * @return mixed
	 */
	private function get_public_post_types() {
		$tmp = get_post_types( array(
			'public'   => true,
		), 'objects', 'and' );

		$out = array();
		foreach ( $tmp as $key => $value ) {
			$out[ $key ] = $value->label;
		}

		return $out;
	}
}

/**
 * Verify that everything's fine with instance.
 *
 * @return mixed
 */
function check_gonzales() {
	if ( ! file_exists( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'gonzales-info.php' ) ) {
		return 'gonzales-info';
	}

	require_once( 'gonzales-info.php' );
	global $gonzales_token;

	$http_host = filter_input( INPUT_SERVER, 'HTTP_HOST' );

	$response = wp_remote_post( 'https://tomasz-dobrzynski.com/?event=activate', array(
		'method' => 'POST',
		'redirection' => 5,
		'blocking' => true,
		'sslverify' => false,
		'body' => array(
			'plugin' => 'gonzales',
			'token' => $gonzales_token,
			'domain' => $http_host,
		),
	));

	unset( $gonzales_token );

	if ( ! is_wp_error( $response ) ) {
		return json_decode( $response['body'] );
	}
}

new Gonzales;
