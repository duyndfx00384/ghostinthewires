<?php
if (!function_exists ('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

class EdgefCoreImport {
	/**
	 * @var instance of current class
	 */
	private static $instance;

	/**
	 * Name of folder where revolution slider will stored
	 * @var string
	 */
	private $revSliderFolder;
	
	/**
	 *
	 * URL where are import files
	 * @var string
	 */
	private $importURI;
	
	/**
	 * @return EdgefCoreImport
	 */
	public static function getInstance() {
		if(self::$instance === null) {
			return new self();
		}

		return self::$instance;
	}

    public $message = "";
    public $attachments = false;
    function __construct() {
		$this->revSliderFolder 	= 'edgt-rev-sliders';
		$this->importURI		= 'http://export.edge-themes.com/';

        add_action('admin_menu', array(&$this, 'edgt_admin_import'));
        add_action('admin_init', array(&$this, 'edgt_register_theme_settings'));
    }
    
    function edgt_register_theme_settings() {
        register_setting( 'edgt_options_import_page', 'edgt_options_import');
    }
	
    public function import_content($file){
		ob_start();
		require_once(EDGE_CORE_ABS_PATH . '/import/class.wordpress-importer.php');
		$edgt_import = new WP_Import();
		set_time_limit(0);

		$edgt_import->fetch_attachments = $this->attachments;
		$returned_value = $edgt_import->import($file);
		if(is_wp_error($returned_value)){
			$this->message = esc_html__('An Error Occurred During Import', 'edge-cpt');
		}
		else {
			$this->message = esc_html__('Content imported successfully', 'edge-cpt');
		}
		ob_get_clean();
    }

    public function import_widgets($file, $file2){
        $this->import_custom_sidebars($file2);
        $options = $this->file_options($file);
        foreach ((array) $options['widgets'] as $edgt_widget_id => $edgt_widget_data) {
            update_option( 'widget_' . $edgt_widget_id, $edgt_widget_data );
        }
        $this->import_sidebars_widgets($file);
        $this->message = esc_html__('Widgets imported successfully', 'edge-cpt');
    }

    public function import_sidebars_widgets($file){
        $edgt_sidebars = get_option("sidebars_widgets");
        unset($edgt_sidebars['array_version']);
        $data = $this->file_options($file);
        if ( is_array($data['sidebars']) ) {
            $edgt_sidebars = array_merge( (array) $edgt_sidebars, (array) $data['sidebars'] );
            unset($edgt_sidebars['wp_inactive_widgets']);
            $edgt_sidebars = array_merge(array('wp_inactive_widgets' => array()), $edgt_sidebars);
            $edgt_sidebars['array_version'] = 2;
            wp_set_sidebars_widgets($edgt_sidebars);
        }
    }

    public function import_custom_sidebars($file){
        $options = $this->file_options($file);
        update_option( 'edgt_sidebars', $options);
        $this->message = esc_html__('Custom sidebars imported successfully', 'edge-cpt');
    }

    public function import_options($file){
        $options = $this->file_options($file);
        $result = update_option( 'edgt_options_educator', $options);
        $this->message = esc_html__('Options imported successfully', 'edge-cpt');
    }

    public function import_menus($file){
        global $wpdb;
        $edgt_terms_table = $wpdb->prefix . "terms";
        $this->menus_data = $this->file_options($file);
        $menu_array = array();
        foreach ($this->menus_data as $registered_menu => $menu_slug) {
            $term_rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $edgt_terms_table where slug=%s", $menu_slug), ARRAY_A);
            if(isset($term_rows[0]['term_id'])) {
                $term_id_by_slug = $term_rows[0]['term_id'];
            } else {
                $term_id_by_slug = null;
            }
            $menu_array[$registered_menu] = $term_id_by_slug;
        }
        set_theme_mod('nav_menu_locations', array_map('absint', $menu_array ) );
    }
    
    public function import_settings_pages($file){
        $pages = $this->file_options($file);
        foreach($pages as $edgt_page_option => $edgt_page_id){
            update_option( $edgt_page_option, $edgt_page_id);
        }
    }
	
	public function rev_sliders() {
		$rev_sldiers = array(
			'home-1.zip',
            'home-2.zip',
			'home-3.zip',
            'home-4-content-slider',
			'home-5.zip',
			'home-6.zip',
			'home-9.zip',
			'landing-slider.zip',
            'landing-content-slider.zip',
		);

		return $rev_sldiers;
	}

	public function create_rev_slider_files($folder) {
		$rev_list = $this->rev_sliders();
		$dir_name = $this->revSliderFolder;

		$upload		= wp_upload_dir();
		$upload_dir = $upload['basedir'];
		$upload_dir = $upload_dir . '/' . $dir_name;
		if (!is_dir($upload_dir)) {
			mkdir($upload_dir, 0700);
			mkdir($upload_dir . '/' . $folder, 0700);
		}

		foreach ($rev_list as $rev_slider) {
			file_put_contents(WP_CONTENT_DIR . '/uploads/' . $dir_name . '/'. $folder . '/' . $rev_slider, file_get_contents($this->importURI .'/' . $folder . '/revslider/' . $rev_slider));
		}
	}

	public function rev_slider_import($folder){
		$this->create_rev_slider_files($folder);

		$rev_sliders = $this->rev_sliders();
		$dir_name = $this->revSliderFolder;
		$absolute_path = __FILE__;
		$path_to_file = explode( 'wp-content', $absolute_path );
		$path_to_wp = $path_to_file[0];

		require_once( $path_to_wp.'/wp-load.php' );
		require_once( $path_to_wp.'/wp-includes/functions.php');
		require_once( $path_to_wp.'/wp-admin/includes/file.php');

		$rev_slider_instance = new RevSlider();

		foreach ($rev_sliders as $rev_slider) {
			$nf = WP_CONTENT_DIR . '/uploads/' . $dir_name . '/' . $folder . '/' . $rev_slider;
			$rev_slider_instance->importSliderFromPost(true, true, $nf);
		}
	}

    public function file_options($file){
        $file_content = $this->edgt_file_contents($file);
        
        if ($file_content) {
            $unserialized_content = unserialize(base64_decode($file_content));
            if ($unserialized_content) {
                return $unserialized_content;
            }
        }
        
        return false;
    }

    function edgt_file_contents( $path ) {
		$url      = $this->importURI . $path;
		$response = wp_remote_get($url);
		$body     = wp_remote_retrieve_body($response);
		return $body;
    }

    function edgt_admin_import() {
        if (edgt_core_theme_installed()) {
            global $educator_edge_Framework;

            $slug = "_tabimport";
            $this->pagehook = add_submenu_page(
                'educator_edge_theme_menu',
	            esc_html__( 'Edge Options - Edge Import', 'edge-cpt' ),    // The value used to populate the browser's title bar when the menu page is active
				esc_html__( 'Import', 'edge-cpt' ),        // The text of the menu in the administrator's sidebar
                'administrator',                  // What roles are able to access the menu
                'educator_edge_theme_menu'.$slug,                // The ID used to bind submenu items to this menu
                array($educator_edge_Framework->getSkin(), 'renderImport')
            );

            add_action('admin_print_scripts-'.$this->pagehook, 'educator_edge_enqueue_admin_scripts');
            add_action('admin_print_styles-'.$this->pagehook, 'educator_edge_enqueue_admin_styles');
        }
    }
}