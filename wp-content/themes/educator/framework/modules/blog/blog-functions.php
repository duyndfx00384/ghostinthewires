<?php
/**
 * FUNCTIONS LIST
 * @see educator_edge_include_blog_helper_functions
 * @see educator_edge_get_archive_blog_list_layout
 * @see educator_edge_get_holder_params_blog
 * @see educator_edge_get_blog
 * @see educator_edge_get_blog_type
 * @see educator_edge_get_blog_query
 * @see educator_edge_get_blog_list_holder_classes
 * @see educator_edge_get_blog_holder_data_params
 * @see educator_edge_set_ajax_url
 * @see educator_edge_blog_load_more
 * @see educator_edge_get_post_format_html
 * @see educator_edge_single_link_pages
 * @see educator_edge_get_blog_single
 * @see educator_edge_get_blog_single_type
 * @see educator_edge_get_single_post_format_html
 * @see educator_edge_excerpt
 * @see educator_edge_excerpt_length
 * @see educator_edge_post_has_read_more
 * @see educator_edge_modify_read_more_link
 * @see educator_edge_get_blog_related_post_type
 * @see educator_edge_get_blog_related_posts
 * @see educator_edge_blog_shortcode_load_more
 * @see educator_edge_get_user_custom_fields
 * @see educator_edge_blog_item_has_link
 * @see educator_edge_get_blog_module
 * @see educator_edge_return_post_format
 * @see educator_edge_return_has_media
 * @see educator_edge_blog_single_title
**/

if ( ! function_exists( 'educator_edge_include_blog_helper_functions' ) ) {
	/**
	 * Function which include blog helper function file
	 *
	 * @param $module - string that defines is single or list loaded
	 *
	 * @param $type - type for module
	 */
	function educator_edge_include_blog_helper_functions( $module, $type ) {
		include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/blog/templates/' . $module . '/' . $type . '/helper.php';
	}
}

if ( ! function_exists( 'educator_edge_include_blog_types_function_file' ) ) {
	/**
	 * Function which include blog type function file
	 */
	function educator_edge_include_blog_types_function_file() {
		foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/blog/templates/lists/*/functions.php' ) as $blog_functions ) {
			include_once $blog_functions;
		}
	}
	
	add_action( 'educator_edge_options_map', 'educator_edge_include_blog_types_function_file', 1 ); // 1 is set to just be before option map init
}

if ( ! function_exists( 'educator_edge_register_blog_template' ) ) {
	/**
	 * Function that register blog templates
	 */
	function educator_edge_register_blog_template( $templates ) {
		$templates = apply_filters( 'educator_edge_register_blog_templates', $templates );
		
		return $templates;
	}
	
	// Add a filter to the theme page templates to assigned our custom template into the list
	add_filter( 'theme_page_templates', 'educator_edge_register_blog_template' );
}

if ( ! function_exists( 'educator_edge_register_blog_template_path' ) ) {
	/**
	 * Function that return blog template file if blog template is selected
	 *
	 * $template - default value is page.php
	 */
	function educator_edge_register_blog_template_path( $template ) {
		global $post;
		
		if ( isset( $post ) ) {
			$postID         = $post->ID;
			$chosenTemplate = get_post_meta( $postID, '_wp_page_template', true );
			
			if ( ! isset( $chosenTemplate ) && ! preg_match( '/blog/', $chosenTemplate ) ) {
				return $template;
			}
			
			$file = EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/blog/templates/lists/' . str_replace( 'blog-', '', $chosenTemplate ) . '/templates/' . $chosenTemplate . '.php';
			
			if ( file_exists( $file ) ) {
				$blog_root_template = get_template_directory() . '/' . $chosenTemplate . '.php';
				
				if ( ! file_exists( $blog_root_template ) ) {
					return $file;
				} else {
					return $blog_root_template;
				}
			} else {
				return $template;
			}
		}
		
		return $template;
	}
	
	// Add a filter to the template include to determine if the page has our template assigned and return it's path
	add_filter( 'template_include', 'educator_edge_register_blog_template_path' );
}

if ( ! function_exists( 'educator_edge_get_archive_blog_list_layout' ) ) {
	/**
	 * Function which return archive blog list layout
	 */
	function educator_edge_get_archive_blog_list_layout() {
		$blog_layout = educator_edge_options()->getOptionValue( 'blog_list_type' );
		
		return $blog_layout;
	}
}

if ( ! function_exists( 'educator_edge_get_holder_params_blog' ) ) {
	/**
	 * Function which return holder class and holder inner class for blog pages
	 */
	function educator_edge_get_holder_params_blog() {
		/**
		 * Available parameters for holder params
		 * -holder
		 * -inner
		 */
		return apply_filters( 'educator_edge_blog_holder_params', $params = array() );
	}
}

if ( ! function_exists( 'educator_edge_get_blog' ) ) {
	/**
	 * Function which return holder for all blog lists
	 */
	function educator_edge_get_blog( $type ) {
		$holder_classes = apply_filters( 'educator_edge_blog_holder_classes', $holder_classes = '' );
		$sidebar_layout = educator_edge_sidebar_layout();
		
		$params = array(
			'holder_classes' => $holder_classes,
			'sidebar_layout' => $sidebar_layout,
			'blog_type'      => $type
		);
		
		educator_edge_get_module_template_part( 'templates/lists/holder', 'blog', '', $params );
	}
}

if ( ! function_exists( 'educator_edge_get_blog_type' ) ) {
	/**
	 * Function which create query for blog lists
	 *
	 * @param $type string with name of list that is loaded
	 */
	function educator_edge_get_blog_type( $type ) {
		$blog_query    = educator_edge_get_blog_query();
		$paged         = isset( $blog_query->query['paged'] ) ? $blog_query->query['paged'] : 1;
		$max_num_pages = $blog_query->max_num_pages;
		
		$blog_classes     = educator_edge_get_blog_list_holder_classes( $type );
		$blog_data_params = educator_edge_get_blog_holder_data_params( $type );
		
		$params = array(
			'blog_query'       => $blog_query,
			'paged'            => $paged,
			'max_num_pages'    => $max_num_pages,
			'blog_type'        => $type,
			'blog_classes'     => $blog_classes,
			'blog_data_params' => $blog_data_params
		);
		
		educator_edge_get_module_template_part( 'templates/lists/' . $type . '/list', 'blog', '', $params );
	}
}

if ( ! function_exists( 'educator_edge_get_blog_query' ) ) {
	/**
	 * Function which create query for blog lists
	 *
	 * @return wp query object
	 */
	function educator_edge_get_blog_query() {
		$id                       = educator_edge_get_page_id();
		$category                 = esc_attr( get_post_meta( $id, 'edgt_blog_category_meta', true ) );
		$number_of_posts_per_page = get_post_meta( $id, 'edgt_show_posts_per_page_meta', true );
		$post_number              = ! empty( $number_of_posts_per_page ) ? esc_attr( $number_of_posts_per_page ) : esc_attr( get_option( 'posts_per_page' ) );
		
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}
		
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'paged'          => $paged,
			'category_name'  => $category,
			'posts_per_page' => $post_number
		);
		
		$blog_query = new WP_Query( $query_array );
		if ( is_archive() ) {
			global $wp_query;
			$blog_query = $wp_query;
		}
		
		return $blog_query;
	}
}

if ( ! function_exists( 'educator_edge_get_max_number_of_pages' ) ) {
	/**
	 * Function that return max number of posts/pages for pagination
	 */
	function educator_edge_get_max_number_of_pages() {
		global $wp_query;
		
		$max_number_of_pages = 10; //default value
		
		if ( $wp_query ) {
			$max_number_of_pages = $wp_query->max_num_pages;
		}
		
		return $max_number_of_pages;
	}
}

if ( ! function_exists( 'educator_edge_get_blog_list_holder_classes' ) ) {
	/**
	 * Function set blog list classes
	 *
	 * @param $type - type of blog list that is passing
	 *
	 * @return string - string with formatted classes
	 */
	function educator_edge_get_blog_list_holder_classes( $type ) {
		$blog_classes   = array();
		$blog_classes[] = 'edgt-blog-holder';
		$blog_classes[] = 'edgt-blog-' . $type;
		
		$pagination_type = educator_edge_get_meta_field_intersect( 'blog_pagination_type' );
		if ( ! empty( $pagination_type ) ) {
			$blog_classes[] = 'edgt-blog-pagination-' . $pagination_type;
		}
		
		$masonry_type = educator_edge_get_meta_field_intersect( 'blog_list_featured_image_proportion' );
		if ( ! empty( $masonry_type ) ) {
			$blog_classes[] = 'edgt-masonry-images-' . $masonry_type;
		}
		
		$blog_classes = apply_filters( 'educator_edge_blog_list_classes', $blog_classes );
		
		return implode( ' ', $blog_classes );
	}
}

if ( ! function_exists( 'educator_edge_get_blog_holder_data_params' ) ) {
	/**
	 * Function which set data params on blog holder div
	 *
	 * @param $type - type of blog list that is loaded
	 *
	 * @return string - string with formatted parameters
	 */
	function educator_edge_get_blog_holder_data_params( $type ) {
		$current_query = educator_edge_get_blog_query();
		$paged         = isset( $current_query->query['paged'] ) ? $current_query->query['paged'] : 1;
		
		$data_params                   = array();
		$data_return_string            = '';
		$data_params['data-blog-type'] = $type;
		
		$posts_number        = get_option( 'posts_per_page' );
		$posts_per_page_meta = get_post_meta( get_the_ID(), "edgt_show_posts_per_page_meta", true );
		if ( ! empty( $posts_per_page_meta ) ) {
			$posts_number = esc_attr( $posts_per_page_meta );
		}
		
		$category       = get_post_meta( educator_edge_get_page_id(), 'edgt_blog_category_meta', true );
		$excerpt_length = educator_edge_get_meta_field_intersect( 'number_of_chars', educator_edge_get_page_id() );
		
		//set data params
		$data_params['data-next-page']      = $paged + 1;
		$data_params['data-max-num-pages']  = $current_query->max_num_pages;
		$data_params['data-post-number']    = $posts_number;
		$data_params['data-excerpt-length'] = $excerpt_length;
		
		if ( ! empty( $category ) ) {
			$data_params['data-category'] = $category;
		}
		
		if ( is_archive() ) {
			
			if ( is_category() ) {
				$cat_id                               = get_queried_object_id();
				$data_params['data-archive-category'] = $cat_id;
			}
			
			if ( is_author() ) {
				$author_id                          = get_queried_object_id();
				$data_params['data-archive-author'] = $author_id;
			}
			
			if ( is_tag() ) {
				$current_tag_id                  = get_queried_object_id();
				$data_params['data-archive-tag'] = $current_tag_id;
			}
			
			if ( is_date() ) {
				$day   = get_query_var( 'day' );
				$month = get_query_var( 'monthnum' );
				$year  = get_query_var( 'year' );
				
				$data_params['data-archive-day']   = $day;
				$data_params['data-archive-month'] = $month;
				$data_params['data-archive-year']  = $year;
			}
		}
		
		foreach ( $data_params as $key => $value ) {
			if ( $key !== '' ) {
				$data_return_string .= $key . '= ' . esc_attr( $value ) . ' ';
			}
		}
		
		return $data_return_string;
	}
}

if ( ! function_exists( 'educator_edge_blog_load_more' ) ) {
	function educator_edge_blog_load_more() {
		$params           = array();
		$paged            = $post_number = $category = $blog_type = $excerpt_length = '';
		$archive_category = $archive_author = $archive_tag = $archive_day = $archive_month = $archive_year = '';
		
		if ( ! empty( $_POST['nextPage'] ) ) {
			$paged = $_POST['nextPage'];
		}
		if ( ! empty( $_POST['postNumber'] ) ) {
			$post_number = $_POST['postNumber'];
		}
		if ( ! empty( $_POST['category'] ) ) {
			$category = $_POST['category'];
		}
		if ( ! empty( $_POST['blogType'] ) ) {
			$blog_type = $_POST['blogType'];
		}
		if ( ! empty( $_POST['archiveCategory'] ) ) {
			$archive_category = $_POST['archiveCategory'];
		}
		if ( ! empty( $_POST['archiveAuthor'] ) ) {
			$archive_author = $_POST['archiveAuthor'];
		}
		if ( ! empty( $_POST['archiveTag'] ) ) {
			$archive_tag = $_POST['archiveTag'];
		}
		if ( ! empty( $_POST['archiveDay'] ) ) {
			$archive_day = $_POST['archiveDay'];
		}
		if ( ! empty( $_POST['archiveMonth'] ) ) {
			$archive_month = $_POST['archiveMonth'];
		}
		if ( ! empty( $_POST['archiveYear'] ) ) {
			$archive_year = $_POST['archiveYear'];
		}
		if ( ! empty( $_POST['excerptLength'] ) ) {
			$excerpt_length = $_POST['excerptLength'];
		}
		
		$params['excerpt_length'] = $excerpt_length;
		
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'post',
			'paged'          => $paged,
			'posts_per_page' => $post_number,
			'post__not_in'   => get_option( 'sticky_posts' )
		);
		
		if ( ! empty( $category ) ) {
			$query_array['category_name'] = $category;
		}
		
		if ( ! empty( $archive_category ) ) {
			$query_array['cat'] = $archive_category;
		}
		
		if ( ! empty( $archive_author ) ) {
			$query_array['author'] = $archive_author;
		}
		
		if ( ! empty( $archive_tag ) ) {
			$query_array['tag'] = $archive_tag;
		}
		
		if ( $archive_day !== '' && $archive_month !== '' && $archive_year !== '' ) {
			$query_array['day']      = $archive_day;
			$query_array['monthnum'] = $archive_month;
			$query_array['year']     = $archive_year;
		}
		
		$query_results = new \WP_Query( $query_array );
		
		include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/blog/templates/lists/' . $blog_type . '/helper.php';
		
		$html = '';
		if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				$html .= educator_edge_get_post_format_html( $blog_type, 'yes', $params );
			endwhile;
		else:
			$html .= educator_edge_get_module_template_part( 'templates/parts/no-posts', 'blog' );
		endif;
		
		wp_reset_postdata();
		
		$return_obj = array(
			'html' => $html,
		);
		
		echo json_encode( $return_obj );
		exit;
	}
	
	add_action( 'wp_ajax_nopriv_educator_edge_blog_load_more', 'educator_edge_blog_load_more' );
	add_action( 'wp_ajax_educator_edge_blog_load_more', 'educator_edge_blog_load_more' );
}

if ( ! function_exists( 'educator_edge_get_post_format_html' ) ) {
	/**
	 * Function which return html for post formats
	 *
	 * @param $type
	 * @param $ajax
	 * @param $ajax_params
	 *
	 * @return html with format template
	 */
	function educator_edge_get_post_format_html( $type = "", $ajax = '', $ajax_params = array() ) {
		$post_format = educator_edge_return_post_format();
		
		$params                       = array();
		$params['blog_template_type'] = $type;
		$params['post_format']        = $post_format;
		
		$post_classes = array();
		
		// Sticky class is added on posts only when they are displayed on the first page of the blog home
		if ( is_sticky( get_the_ID() ) ) {
			$post_classes[] = 'sticky';
		}
		
		$post_classes[] = educator_edge_return_has_media() ? 'edgt-post-has-media' : 'edgt-post-no-media';
		
		$params['post_classes'] = $post_classes;
		
		/*
		* Available parameters for template parts
		* -featured_image_size
		* -title_tag
		* -link_tag
		* -quote_tag
		* -share_type
		*/
		$part_params_temp      = array_merge( array(), $ajax_params );
		$params['part_params'] = apply_filters( 'educator_edge_blog_part_params', $part_params_temp );
		
		if ( $ajax == '' ) {
			educator_edge_get_module_template_part( 'templates/lists/' . $type . '/post', 'blog', $post_format, $params );
		}
		if ( $ajax == 'yes' ) {
			return educator_edge_get_blog_module_template_part( 'templates/lists/' . $type . '/post', $post_format, $params );
		}
	}
}

if ( ! function_exists( 'educator_edge_single_link_pages' ) ) {
	/**
	 * Function which return parts on single.php which are just below content
	 */
	function educator_edge_single_link_pages() {
		$args_pages = array(
			'before'      => '<div class="edgt-single-links-pages"><div class="edgt-single-links-pages-inner">',
			'after'       => '</div></div>',
			'link_before' => '<span>' . esc_html__( 'Page Link ', 'educator' ),
			'link_after'  => '</span>',
			'pagelink'    => '%'
		);
		
		wp_link_pages( $args_pages );
	}
	
	add_action( 'educator_edge_single_link_pages', 'educator_edge_single_link_pages' );
}

if ( ! function_exists( 'educator_edge_get_blog_single' ) ) {
	/**
	 * Function which return holder for single posts
	 *
	 * @param type - type of single layout
	 */
	function educator_edge_get_blog_single( $type ) {
		$sidebar_layout = educator_edge_sidebar_layout();
		
		$holder_classes = $sidebar_layout !== 'no-sidebar' ? 'edgt-content-has-sidebar' : '';
		$holder_classes = apply_filters( 'educator_edge_blog_single_holder_classes', $holder_classes );
		
		$params = array(
			'holder_classes'      => $holder_classes,
			'sidebar_layout'      => $sidebar_layout,
			'blog_single_type'    => $type,
			'blog_single_classes' => 'edgt-blog-single-' . $type
		);
		
		educator_edge_get_module_template_part( 'templates/singles/holder', 'blog', '', $params );
	}
}

if ( ! function_exists( 'educator_edge_get_blog_single_type' ) ) {
	/**
	 * Function which returns proper single post template
	 *
	 * @param $type string with name of list that is loaded
	 */
	function educator_edge_get_blog_single_type( $type ) {
		$params = array();
		
		$params['blog_single_type'] = $type;
		/*
		 * Available parameters for info parts
		 * -related_posts_image_size
		 */
		$params['single_info_params'] = apply_filters( 'educator_edge_blog_single_info_params', array() );
		
		educator_edge_get_module_template_part( 'templates/singles/' . $type . '/single', 'blog', '', $params );
	}
}

if ( ! function_exists( 'educator_edge_get_single_post_format_html' ) ) {
	/**
	 * Function return all parts on single.php page
	 *
	 * @param $type - type of blog single layout
	 */
	function educator_edge_get_single_post_format_html( $type ) {
		$post_format = educator_edge_return_post_format();
		
		$params = array();
		/*
		 * Available parameters for template parts
		 * -featured_image_size
		 * -title_tag
		 * -link_tag
		 * -quote_tag
		 * -share type
		 */
		$params['part_params'] = apply_filters( 'educator_edge_blog_part_params', array() );
		
		educator_edge_get_module_template_part( 'templates/singles/' . $type . '/' . $post_format, 'blog', '', $params );
	}
}

if ( ! function_exists( 'educator_edge_excerpt' ) ) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in edgt_set_blog_word_count function.
	 *
	 * @param $length - default excerpt length
	 *
	 * @return string - formatted excerpt
	 *
	 * It current post has read more tag set it will return content of the post, else it will return post excerpt
	 *
	 */
	function educator_edge_excerpt( $length ) {
		global $post;
		
		//does current post has read more tag set?
		if ( educator_edge_post_has_read_more() ) {
			global $more;
			
			//override global $more variable so this can be used in blog templates
			$more = 0;
			
			return get_the_content( true );
		}
		
		$number_of_chars = educator_edge_get_meta_field_intersect( 'number_of_chars', educator_edge_get_page_id() );
		$word_count      = $length !== '' ? $length : $number_of_chars;
		
		//is word count set to something different that 0?
		if ( $word_count > 0 ) {
			
			//if post excerpt field is filled take that as post excerpt, else that content of the post
			$post_excerpt = $post->post_excerpt !== '' ? $post->post_excerpt : strip_tags( strip_shortcodes( $post->post_content ) );
			
			//remove leading dots if those exists
			$clean_excerpt = strlen( $post_excerpt ) && strpos( $post_excerpt, '...' ) ? strstr( $post_excerpt, '...', true ) : $post_excerpt;
			
			//if clean excerpt has text left
			if ( $clean_excerpt !== '' ) {
				//explode current excerpt to words
				$excerpt_word_array = explode( ' ', $clean_excerpt );
				
				//cut down that array based on the number of the words option
				$excerpt_word_array = array_slice( $excerpt_word_array, 0, $word_count );
				
				//and finally implode words together
				$excerpt = implode( ' ', $excerpt_word_array );
				
				//is excerpt different than empty string?
				if ( $excerpt !== '' ) {
					return rtrim( wp_kses_post( $excerpt ) );
				}
			}
			
			return '';
		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'educator_edge_excerpt_length' ) ) {
	/**
	 * Function that changes excerpt length based on theme options
	 */
	function educator_edge_excerpt_length() {
		$numb_of_chars = educator_edge_options()->getOptionValue( 'number_of_chars' );
		
		return $numb_of_chars !== '' ? $numb_of_chars : 45;
	}
	
	add_filter( 'excerpt_length', 'educator_edge_excerpt_length', 999 );
}

if ( ! function_exists( 'educator_edge_post_has_read_more' ) ) {
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function educator_edge_post_has_read_more() {
		global $post;
		
		return strpos( $post->post_content, '<!--more-->' );
	}
}

if ( ! function_exists( 'educator_edge_modify_read_more_link' ) ) {
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function educator_edge_modify_read_more_link() {
		$link = '<div class="edgt-more-link-container">';
		
		if ( educator_edge_core_plugin_installed() ) {
			$link .= educator_edge_get_button_html(
				array(
					'link' => get_permalink() . '#more-' . get_the_ID(),
					'text' => esc_html__( 'Continue reading', 'educator' )
				)
			);
		} else {
			$link .= '<a itemprop="url" class="edgt-btn edgt-btn-solid" href="' . get_permalink() . '#more-' . get_the_ID() . '" target="_self">';
			$link .= '<span class="edgt-btn-text">';
			$link .= esc_html__( 'Continue reading', 'educator' );
			$link .= '</span></a>';
		}
		
		$link .= '</div>';
		
		return $link;
	}
	
	add_filter( 'the_content_more_link', 'educator_edge_modify_read_more_link' );
}

if ( ! function_exists( 'educator_edge_get_blog_related_post_type' ) ) {
	/**
	 * Function for returning latest posts types
	 *
	 * @param $post_id
	 * @param array $options
	 *
	 * @return WP_Query
	 */
	function educator_edge_get_blog_related_post_type( $post_id, $options = array() ) {
		$tags = get_the_tags( $post_id );
		//Get categories
		$categories = get_the_category( $post_id );
		
		$tag_ids = array();
		if ( $tags ) {
			foreach ( $tags as $tag ) {
				$tag_ids[] = $tag->term_id;
			}
		}
		
		$category_ids = array();
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$category_ids[] = $category->term_id;
			}
		}
		
		$hasRelatedByTag = false;
		
		if ( $tag_ids ) {
			$related_by_tag = educator_edge_get_blog_related_posts( $post_id, $tag_ids, 'tag', $options );
			
			if ( ! empty( $related_by_tag->posts ) ) {
				$hasRelatedByTag = true;
				
				return $related_by_tag;
			}
		}
		
		if ( $categories && ! $hasRelatedByTag ) {
			$related_by_category = educator_edge_get_blog_related_posts( $post_id, $category_ids, 'category', $options );
			
			if ( ! empty( $related_by_category->posts ) ) {
				return $related_by_category;
			}
		}
	}
}

if ( ! function_exists( 'educator_edge_get_blog_related_posts' ) ) {
	/**
	 * Function for related posts
	 *
	 * @param $post_id - Post ID
	 * @param $term_ids - Category or Tag IDs
	 * @param $slug - term slug for WP_Query
	 * @param array $options
	 *
	 * @return WP_Query
	 */
	function educator_edge_get_blog_related_posts( $post_id, $term_ids, $slug, $options = array() ) {
		//Query options
		$posts_per_page = - 1;
		
		//Override query options
		extract( $options );
		
		$args = array(
			'post_status'    => 'publish',
			'post__not_in'   => array( $post_id ),
			$slug . '__in'   => $term_ids,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'posts_per_page' => $posts_per_page
		);
		
		$related_posts = new WP_Query( $args );
		
		return $related_posts;
	}
}

if ( ! function_exists( 'educator_edge_blog_shortcode_load_more' ) ) {
	
	function educator_edge_blog_shortcode_load_more() {
		$params = array();
		
		if ( ! empty( $_POST ) ) {
			foreach ( $_POST as $key => $value ) {
				if ( $key !== '' ) {
					$addUnderscoreBeforeCapitalLetter = preg_replace( '/([A-Z])/', '_$1', $key );
					$setAllLettersToLowercase         = strtolower( $addUnderscoreBeforeCapitalLetter );
					
					$params[ $setAllLettersToLowercase ] = $value;
				}
			}
		}
		
		$this_object = new \EdgeCore\CPT\Shortcodes\BlogList\BlogList();
		
		$query_array           = $this_object->generateQueryArray( $params );
		$query_results         = new \WP_Query( $query_array );
		$params['this_object'] = $this_object;
		
		ob_start();
		
		if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				educator_edge_get_module_template_part( 'shortcodes/blog-list/layout-collections/' . $params['type'], 'blog', '', $params );
			endwhile;
		else:
			educator_edge_get_module_template_part( 'templates/parts/no-posts', 'blog', '', $params );
		endif;
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		wp_reset_postdata();
		
		$return_obj = array(
			'html' => $html,
		);
		
		echo json_encode( $return_obj );
		exit;
	}
	
	add_action( 'wp_ajax_nopriv_educator_edge_blog_shortcode_load_more', 'educator_edge_blog_shortcode_load_more' );
	add_action( 'wp_ajax_educator_edge_blog_shortcode_load_more', 'educator_edge_blog_shortcode_load_more' );
}

if ( ! function_exists( 'educator_edge_get_user_custom_fields' ) ) {
	/**
	 * Function returns links and icons for author social networks
	 */
	function educator_edge_get_user_custom_fields() {
		$user_social_array    = array();
		$social_network_array = array(
			'facebook',
			'twitter',
			'linkedin',
			'instagram',
			'pinterest',
			'tumblr',
			'googleplus'
		);
		
		foreach ( $social_network_array as $network ) {
			if ( get_the_author_meta( $network ) !== '' ) {
			    if ($network == 'instagram'){
                    $$network                      = array(
                        'link'  => get_the_author_meta( $network ),
                        'class' => 'fa-' . $network . ' edgt-author-social-' . $network . ' edgt-author-social-icon'
                    );
                } else {
                    $$network = array(
                        'link' => get_the_author_meta($network),
                        'class' => 'social_' . $network . ' edgt-author-social-' . $network . ' edgt-author-social-icon'
                    );
                }
				$user_social_array[ $network ] = $$network;
			}
		}
		
		return $user_social_array;
	}
}

if ( ! function_exists( 'educator_edge_blog_item_has_link' ) ) {
	/**
	 * Function returns true/false depends is single post or in loop
	 */
	function educator_edge_blog_item_has_link() {
		$is_link = ( is_single() && ( get_the_ID() === educator_edge_get_page_id() ) ) ? false : true;
		
		return $is_link;
	}
}

if ( ! function_exists( 'educator_edge_get_blog_module' ) ) {
	/**
	 * Function returns single/list depending is single post or in loop
	 */
	function educator_edge_get_blog_module() {
		$module = ( is_single() && ( get_the_ID() === educator_edge_get_page_id() ) ) ? 'single' : 'list';
		
		return $module;
	}
}

if ( ! function_exists( 'educator_edge_return_post_format' ) ) {
	/**
	 * Function return all parts on single.php page
	 */
	function educator_edge_return_post_format() {
		$post_format            = get_post_format();
		$supported_post_formats = array( 'audio', 'video', 'link', 'quote', 'gallery' );
		$post_format            = in_array( $post_format, $supported_post_formats ) ? $post_format : 'standard';
		
		return $post_format;
	}
}

if ( ! function_exists( 'educator_edge_return_has_media' ) ) {
	/**
	 * Function return all parts on single.php page
	 *
	 * @return string with post format
	 */
	function educator_edge_return_has_media() {
		$post_format = get_post_format();
		
		switch ( $post_format ):
			case "video":
				return get_post_meta( get_the_ID(), 'edgt_post_video_custom_meta', true ) !== '' || get_post_meta( get_the_ID(), 'edgt_post_video_link_meta', true ) !== '';
				break;
			case "audio":
				return get_post_meta( get_the_ID(), 'edgt_post_audio_custom_meta', true ) !== '' || get_post_meta( get_the_ID(), 'edgt_post_audio_link_meta', true ) !== '';
				break;
			case "gallery":
				return get_post_meta( get_the_ID(), 'edgt_post_gallery_images_meta', true ) !== '';
				break;
			case "quote":
				return get_post_meta( get_the_ID(), 'edgt_post_quote_text_meta', true ) !== '';
				break;
			case "link":
				return get_post_meta( get_the_ID(), 'edgt_post_link_link_meta', true ) !== '';
				break;
			default:
				return get_post_meta( get_the_ID(), 'edgt_blog_list_featured_image_meta', true ) !== '' || has_post_thumbnail();
				break;
		
		endswitch;
	}
}

if ( ! function_exists( 'educator_edge_set_title_text_output_for_single_posts' ) ) {
	function educator_edge_set_title_text_output_for_single_posts( $title ) {
	    $setSingleTitle = educator_edge_options()->getOptionValue('blog_single_title');
		$setSinglePostTitle = educator_edge_options()->getOptionValue( 'blog_single_title_in_title_area' );
		
		if ( is_singular( 'post' ) && $setSinglePostTitle === 'yes' && $setSingleTitle === 'yes' ) {
			$title = get_the_title( educator_edge_get_page_id() );
		}
		else if(is_singular( 'post' ) && $setSingleTitle == 'no'){
		    $title = '';
        }
		
		return $title;
	}
	
	add_filter( 'educator_edge_title_text', 'educator_edge_set_title_text_output_for_single_posts' );
}