<?php

require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edgt.kses.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edgt.layout1.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edgt.layout2.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edgt.layout3.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edgt.optionsapi.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edgt.framework.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edgt.functions.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/lib/edgt.icons/edgt.icons.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/admin/options/edgt-options-setup.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/admin/meta-boxes/edgt-meta-boxes-setup.php";
require_once EDGE_FRAMEWORK_ROOT_DIR."/modules/edgt-modules-loader.php";

if(!function_exists('educator_edge_admin_scripts_init')) {
	/**
	 * Function that registers all scripts that are necessary for our back-end
	 */
	function educator_edge_admin_scripts_init() {
        /**
         * @see EdgeSkinAbstract::registerScripts - hooked with 10
         * @see EdgeSkinAbstract::registerStyles - hooked with 10
         */
        do_action('educator_edge_admin_scripts_init');
	}

	add_action('admin_init', 'educator_edge_admin_scripts_init');
}

if(!function_exists('educator_edge_enqueue_admin_styles')) {
	/**
	 * Function that enqueues styles for options page
	 */
	function educator_edge_enqueue_admin_styles() {
		wp_enqueue_style('wp-color-picker');

        /**
         * @see EdgeSkinAbstract::enqueueStyles - hooked with 10
         */
        do_action('educator_edge_enqueue_admin_styles');
	}
}

if(!function_exists('educator_edge_enqueue_admin_scripts')) {
	/**
	 * Function that enqueues styles for options page
	 */
	function educator_edge_enqueue_admin_scripts() {
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		wp_enqueue_media();
		wp_enqueue_script('edgt-dependence', get_template_directory_uri().'/framework/admin/assets/js/edgt-ui/edgt-dependence.js', array(), false, true);
		wp_enqueue_script('edgt-twitter-connect', get_template_directory_uri().'/framework/admin/assets/js/edgt-twitter-connect.js', array(), false, true);

		/**
		 * @see EdgeSkinAbstract::enqueueScripts - hooked with 10
		 */
		do_action('educator_edge_enqueue_admin_scripts');
	}
}

if(!function_exists('educator_edge_enqueue_meta_box_styles')) {
	/**
	 * Function that enqueues styles for meta boxes
	 */
	function educator_edge_enqueue_meta_box_styles() {
		wp_enqueue_style( 'wp-color-picker' );

        /**
         * @see EdgeSkinAbstract::enqueueStyles - hooked with 10
         */
        do_action('educator_edge_enqueue_meta_box_styles');
	}
}

if(!function_exists('educator_edge_enqueue_meta_box_scripts')) {
	/**
	 * Function that enqueues scripts for meta boxes
	 */
	function educator_edge_enqueue_meta_box_scripts() {
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
		wp_enqueue_media();
		wp_enqueue_script('edgt-dependence');

        /**
         * @see EdgeSkinAbstract::enqueueScripts - hooked with 10
         */
        do_action('educator_edge_enqueue_meta_box_scripts');
	}
}

if(!function_exists('educator_edge_enqueue_nav_menu_script')) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 * @param $hook string current page hook to check
	 */
	function educator_edge_enqueue_nav_menu_script($hook) {
		if($hook == 'nav-menus.php') {
			wp_enqueue_script('edgt-nav-menu', get_template_directory_uri().'/framework/admin/assets/js/edgt-nav-menu.js');
			wp_enqueue_style('edgt-nav-menu', get_template_directory_uri().'/framework/admin/assets/css/edgt-nav-menu.css');
		}
	}

	add_action('admin_enqueue_scripts', 'educator_edge_enqueue_nav_menu_script');
}

if(!function_exists('educator_edge_enqueue_widgets_admin_script')) {
	/**
	 * Function that enqueues styles and scripts for admin widgets page.
	 * @param $hook string current page hook to check
	 */
	function educator_edge_enqueue_widgets_admin_script($hook) {
		if($hook == 'widgets.php') {
			wp_enqueue_script('edgt-dependence');
			wp_enqueue_script('edgt-widgets-dependence', get_template_directory_uri().'/framework/admin/assets/js/edgt-ui/edgt-widget-dependence.js', array(), false, true);
		}
	}

	add_action('admin_enqueue_scripts', 'educator_edge_enqueue_widgets_admin_script');
}

if(!function_exists('educator_edge_init_theme_options_array')) {
	/**
	 * Function that merges $educator_edge_options and default options array into one array.
	 *
	 * @see array_merge()
	 */
	function educator_edge_init_theme_options_array() {
        global $educator_edge_options, $educator_edge_Framework;

		$db_options = get_option('edgt_options_educator');

		//does edgt_options exists in db?
		if(is_array($db_options)) {
			//merge with default options
			$educator_edge_options  = array_merge($educator_edge_Framework->edgtOptions->options, get_option('edgt_options_educator'));
		} else {
			//options don't exists in db, take default ones
			$educator_edge_options = $educator_edge_Framework->edgtOptions->options;
		}
	}

	add_action('educator_edge_after_options_map', 'educator_edge_init_theme_options_array', 0);
}

if(!function_exists('educator_edge_init_theme_options')) {
	/**
	 * Function that sets $educator_edge_options variable if it does'nt exists
	 */
	function educator_edge_init_theme_options() {
		global $educator_edge_options;
		global $educator_edge_Framework;
		if(isset($educator_edge_options['reset_to_defaults'])) {
			if( $educator_edge_options['reset_to_defaults'] == 'yes' ) delete_option( "edgt_options_educator");
		}

		if (!get_option("edgt_options_educator")) {
			add_option( "edgt_options_educator",
				$educator_edge_Framework->edgtOptions->options
			);

			$educator_edge_options = $educator_edge_Framework->edgtOptions->options;
		}
	}
}

if(!function_exists('educator_edge_register_theme_settings')) {
	/**
	 * Function that registers setting that will be used to store theme options
	 */
	function educator_edge_register_theme_settings() {
		register_setting( 'educator_edge_theme_menu', 'edgt_options' );
	}

	add_action('admin_init', 'educator_edge_register_theme_settings');
}

if(!function_exists('educator_edge_get_admin_tab')) {
	/**
	 * Helper function that returns current tab from url.
	 * @return null
	 */
	function educator_edge_get_admin_tab(){
		return isset($_GET['page']) ? educator_edge_strafter($_GET['page'],'tab') : NULL;
	}
}

if(!function_exists('educator_edge_strafter')) {
	/**
	 * Function that returns string that comes after found string
	 * @param $string string where to search
	 * @param $substring string what to search for
	 * @return null|string string that comes after found string
	 */
	function educator_edge_strafter($string, $substring) {
		$pos = strpos($string, $substring);
		if ($pos === false) {
			return NULL;
		}

		return(substr($string, $pos+strlen($substring)));
	}
}

if(!function_exists('educator_edge_save_options')) {
	/**
	 * Function that saves theme options to db.
	 * It hooks to ajax wp_ajax_edgt_save_options action.
	 */
	function educator_edge_save_options() {
		global $educator_edge_options;

        if(current_user_can('administrator')) {
            $_REQUEST = stripslashes_deep($_REQUEST);

            unset($_REQUEST['action']);

            check_ajax_referer('edgt_ajax_save_nonce', 'edgt_ajax_save_nonce');

            $educator_edge_options = array_merge($educator_edge_options, $_REQUEST);

            update_option('edgt_options_educator', $educator_edge_options);

            do_action('educator_edge_after_theme_option_save');
            echo esc_html__('Saved', 'educator');

            die();
        }
	}

	add_action('wp_ajax_educator_edge_save_options', 'educator_edge_save_options');
}

if(!function_exists('educator_edge_meta_box_add')) {
	/**
	 * Function that adds all defined meta boxes.
	 * It loops through array of created meta boxes and adds them
	 */
	function educator_edge_meta_box_add() {
		global $educator_edge_Framework;
		
		foreach ($educator_edge_Framework->edgtMetaBoxes->metaBoxes as $key=>$box ) {
			$hidden = false;
			if (!empty($box->hidden_property)) {
				foreach ($box->hidden_values as $value) {
					if (educator_edge_option_get_value($box->hidden_property) == $value) {
						$hidden = true;
					}
				}
			}

			if(is_string($box->scope)) {
				$box->scope = array($box->scope);
			}

			if(is_array($box->scope) && count($box->scope)) {
				foreach($box->scope as $screen) {
					add_meta_box(
						'edgt-meta-box-'.$key,
						$box->title,
                        'educator_edge_render_meta_box',
						$screen,
						'advanced',
						'high',
						array( 'box' => $box)
					);

					if ($hidden) {
						add_filter('postbox_classes_'.$screen.'_edgt-meta-box-'.$key, 'educator_edge_meta_box_add_hidden_class');
					}
				}
			}
		}

		add_action('admin_enqueue_scripts', 'educator_edge_enqueue_meta_box_styles');
		add_action('admin_enqueue_scripts', 'educator_edge_enqueue_meta_box_scripts');
	}

	add_action('add_meta_boxes', 'educator_edge_meta_box_add');
}

if(!function_exists('educator_edge_meta_box_save')) {
	/**
	 * Function that saves meta box to postmeta table
	 * @param $post_id int id of post that meta box is being saved
	 * @param $post WP_Post current post object
	 */
	function educator_edge_meta_box_save( $post_id, $post ) {
		global $educator_edge_Framework;

		$nonces_array = array();
		$meta_boxes = educator_edge_framework()->edgtMetaBoxes->getMetaBoxesByScope($post->post_type);

		if(is_array($meta_boxes) && count($meta_boxes)) {
			foreach($meta_boxes as $meta_box) {
				$nonces_array[] = 'educator_edge_meta_box_'.$meta_box->name.'_save';
			}
		}

		if(is_array($nonces_array) && count($nonces_array)) {
			foreach($nonces_array as $nonce) {
				if(!isset($_POST[$nonce]) || !wp_verify_nonce($_POST[$nonce], $nonce)) {
					return;
				}
			}
		}
		
		$postTypes = apply_filters('educator_edge_meta_box_post_types_save', array('post', 'page'));

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		if (!isset( $_POST[ '_wpnonce' ])) {
			return;
		}

		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		if (!in_array($post->post_type, $postTypes)) {
			return;
		}

		foreach ($educator_edge_Framework->edgtMetaBoxes->options as $key=>$box ) {

			if (isset($_POST[$key]) && trim($_POST[$key] !== '')) {

				$value = $_POST[$key];

				update_post_meta( $post_id, $key, $value );
			} else {
				delete_post_meta( $post_id, $key );
			}
		}

		$portfolios = false;
		if (isset($_POST['optionLabel'])) {
			foreach ($_POST['optionLabel'] as $key => $value) {
				$portfolios_val[$key] = array('optionLabel'=>$value,'optionValue'=>$_POST['optionValue'][$key],'optionUrl'=>$_POST['optionUrl'][$key],'optionlabelordernumber'=>$_POST['optionlabelordernumber'][$key]);
				$portfolios = true;

			}
		}

		if ($portfolios) {
			update_post_meta( $post_id,  'edgt_portfolios', $portfolios_val );
		} else {
			delete_post_meta( $post_id, 'edgt_portfolios' );
		}

		$portfolio_images = false;
		if (isset($_POST['portfolioimg'])) {
			foreach ($_POST['portfolioimg'] as $key => $value) {
				$portfolio_images_val[$key] = array('portfolioimg'=>$_POST['portfolioimg'][$key],'portfoliotitle'=>$_POST['portfoliotitle'][$key],'portfolioimgordernumber'=>$_POST['portfolioimgordernumber'][$key], 'portfoliovideotype'=>$_POST['portfoliovideotype'][$key], 'portfoliovideoid'=>$_POST['portfoliovideoid'][$key], 'portfoliovideoimage'=>$_POST['portfoliovideoimage'][$key], 'portfoliovideowebm'=>$_POST['portfoliovideowebm'][$key], 'portfoliovideomp4'=>$_POST['portfoliovideomp4'][$key], 'portfoliovideoogv'=>$_POST['portfoliovideoogv'][$key], 'portfolioimgtype'=>$_POST['portfolioimgtype'][$key] );
				$portfolio_images = true;
			}
		}

		if ($portfolio_images) {
			update_post_meta( $post_id,  'edgt_portfolio_images', $portfolio_images_val );
		} else {
			delete_post_meta( $post_id,  'edgt_portfolio_images' );
		}
	}

	add_action( 'save_post', 'educator_edge_meta_box_save', 1, 2 );
}

if(!function_exists('educator_edge_render_meta_box')) {
	/**
	 * Function that renders meta box
	 * @param $post WP_Post post object
	 * @param $metabox array array of current meta box parameters
	 */
	function educator_edge_render_meta_box($post, $metabox) {?>
		<div class="edgt-meta-box edgt-page">
			<div class="edgt-meta-box-holder">
				<?php $metabox['args']['box']->render(); ?>
				<?php wp_nonce_field('educator_edge_meta_box_'.$metabox['args']['box']->name.'_save', 'educator_edge_meta_box_'.$metabox['args']['box']->name.'_save'); ?>
			</div>
		</div>
	<?php
	}
}

if(!function_exists('educator_edge_meta_box_add_hidden_class')) {
	/**
	 * Function that adds class that will initially hide meta box
	 * @param array $classes array of classes
	 * @return array modified array of classes
	 */
	function educator_edge_meta_box_add_hidden_class( $classes=array() ) {
		if( !in_array( 'edgt-meta-box-hidden', $classes ) )
			$classes[] = 'edgt-meta-box-hidden';

		return $classes;
	}
}

if(!function_exists('educator_edge_remove_default_custom_fields')) {
	/**
	 * Function that removes default WordPress custom fields interface
	 */
	function educator_edge_remove_default_custom_fields() {
		foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
			foreach ( apply_filters('educator_edge_meta_box_post_types_remove', array( 'post', 'page')) as $postType ) {
				remove_meta_box( 'postcustom', $postType, $context );
			}
		}
	}

	add_action('do_meta_boxes', 'educator_edge_remove_default_custom_fields');
}

if(!function_exists('educator_edge_generate_icon_pack_options')) {
    /**
     * Generates options HTML for each icon in given icon pack
     * Hooked to wp_ajax_update_admin_nav_icon_options action
     */
    function educator_edge_generate_icon_pack_options() {
        global $educator_edge_IconCollections;

        $html = '';
        $icon_pack = isset($_POST['icon_pack']) ? $_POST['icon_pack'] : '';
        $collections_object = $educator_edge_IconCollections->getIconCollection($icon_pack);

        if($collections_object) {
            $icons = $collections_object->getIconsArray();
            if(is_array($icons) && count($icons)) {
                foreach ($icons as $key => $icon) {
                    $html .= '<option value="'.esc_attr($key).'">'.esc_html($key).'</option>';
                }
            }
        }

        echo wp_kses($html, array('option' => array('value' => true)));
    }

    add_action('wp_ajax_update_admin_nav_icon_options', 'educator_edge_generate_icon_pack_options');
}

if(!function_exists('educator_edge_save_dismisable_notice')) {
    /**
     * Updates user meta with dismisable notice. Hooks to admin_init action
     * in order to check this on every page request in admin
     */
    function educator_edge_save_dismisable_notice() {
        if(is_admin() && !empty($_GET['edgt_dismis_notice'])) {
            $notice_id = sanitize_key($_GET['edgt_dismis_notice']);
            $current_user_id = get_current_user_id();

            update_user_meta($current_user_id, 'dismis_'.$notice_id, 1);
        }
    }

    add_action('admin_init', 'educator_edge_save_dismisable_notice');
}

if( ! function_exists( 'educator_edge_ajax_status' ) ) {
    /**
     * Function that return status from ajax functions
     */
    function educator_edge_ajax_status($status, $message, $data = NULL) {
        $response = array (
            'status' => $status,
            'message' => $message,
            'data' => $data
        );

        $output = json_encode($response);

        exit($output);
    }
}

if(!function_exists('educator_edge_hook_twitter_request_ajax')) {
    /**
     * Wrapper function for obtaining twitter request token.
     * Hooks to wp_ajax_edgt_twitter_obtain_request_token ajax action
     *
     * @see EdgeTwitterApi::obtainRequestToken()
     */
    function educator_edge_hook_twitter_request_ajax() {
        EdgefTwitterApi::getInstance()->obtainRequestToken();
    }

    add_action('wp_ajax_edgt_twitter_obtain_request_token', 'educator_edge_hook_twitter_request_ajax');
}

if (!function_exists('educator_edge_comment')) {
    /**
     * Function which modify default wordpress comments
     *
     * @return comments html
     */
    function educator_edge_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;

        global $post;

        $is_pingback_comment = $comment->comment_type == 'pingback';
        $is_author_comment  = $post->post_author == $comment->user_id;

        $comment_class = 'edgt-comment clearfix';

        if($is_author_comment) {
            $comment_class .= ' edgt-post-author-comment';
        }

        if($is_pingback_comment) {
            $comment_class .= ' edgt-pingback-comment';
        }
        ?>

        <li <?php comment_class(); ?>>
	        <div class="<?php echo esc_attr($comment_class); ?>">
	            <?php if(!$is_pingback_comment) { ?>
	                <div class="edgt-comment-image"> <?php echo educator_edge_kses_img(get_avatar($comment, 'thumbnail')); ?> </div>
	            <?php } ?>
	            <div class="edgt-comment-text">
	                <div class="edgt-comment-info">
	                    <h5 class="edgt-comment-name vcard">
	                        <?php if($is_pingback_comment) { esc_html_e('Pingback:', 'educator'); } ?>
	                        <?php echo wp_kses_post(get_comment_author_link()); ?>
	                    </h5>
						<div class="edgt-comment-date"><?php comment_time(get_option('date_format')); ?></div>
                        <?php
                        edit_comment_link(esc_html__('Edit','educator'));
                        comment_reply_link( array_merge( $args, array('reply_text' => esc_html__('Reply', 'educator'), 'depth' => $depth, 'max_depth' => $args['max_depth'])));
                        ?>
	                </div>
	                <?php if(!$is_pingback_comment) { ?>
	                    <div class="edgt-text-holder" id="comment-<?php echo comment_ID(); ?>">
	                        <?php comment_text(); ?>
	                    </div>
	                <?php } ?>
	            </div>
	        </div>
        <?php //li tag will be closed by WordPress after looping through child elements ?>
        <?php
    }
}
?>