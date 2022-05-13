<?php


// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// Jungolmok : Setup 
if (!function_exists('Jungolmok_setup')) :
	function Jungolmok_setup()
	{
		load_theme_textdomain('Jungolmok', get_template_directory() . '/languages');

		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');

		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(300, 300);
		add_image_size('Jungolmok-featured-image', 1920, 9999);
		add_image_size('Jungolmok-hero-image', 2000, 1500, true);

		register_nav_menus(
			array(
				'primary' => __('Primary Menu', 'Jungolmok'),
				'footer'  => __('Footer Menu', 'Jungolmok'),
			)
		);

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
	}
endif;
add_action('after_setup_theme', 'Jungolmok_setup');
// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––



// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// Jungolmok : Import JS & CSS
function jungolmok_scripts() {
  wp_enqueue_script('jg-bundle', get_stylesheet_directory_uri() . '/assets/dist/jg.bundle.js', [], '1.0.0', true);
  wp_enqueue_style('jg', get_stylesheet_directory_uri() . '/assets/dist/jg.css', [], '1.0.0', 'all');
};
add_action('wp_enqueue_scripts', 'jungolmok_scripts');
// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––



// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// Jungolmok : add svg support
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function jungolmok_cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'jungolmok_cc_mime_types' );

function jungolmok_fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'jungolmok_fix_svg' );
// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––



// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// Jungolmok : add filetype json to media library
function my_myme_types($mime_types)
{
	$mime_types['json'] = 'json';
	$mime_types['js'] = 'js';
	return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);
// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––



// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// Jungolmok : Duplicate Posts & Pages 
function rd_duplicate_post_as_draft()
{
	global $wpdb;
	if (!(isset($_GET['post']) || isset($_POST['post'])  || (isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action']))) {
		wp_die('No post to duplicate has been supplied!');
	}
	if (!isset($_GET['duplicate_nonce']) || !wp_verify_nonce($_GET['duplicate_nonce'], basename(__FILE__)))
		return;
	$post_id = (isset($_GET['post']) ? absint($_GET['post']) : absint($_POST['post']));
	$post = get_post($post_id);
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
	if (isset($post) && $post != null) {
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
		$new_post_id = wp_insert_post($args);

		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos) != 0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				if ($meta_key == '_wp_old_slug') continue;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query .= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
		wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action('admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft');
function rd_duplicate_post_link($actions, $post)
{
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce') . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}
add_filter('post_row_actions', 'rd_duplicate_post_link', 10, 2);
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);
// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––



// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// Jungolmok : DEAKTIVIEREN
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action( 'wp_head', 'rest_output_link_wp_head'); // disable application json
remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action ('wp_head', 'wp_site_icon', 99);
add_filter( 'wp_calculate_image_srcset', '__return_false' ); // img scrset disable
add_filter( 'big_image_size_threshold', '__return_false' ); // image scaled disable
add_filter('wp_lazy_loading_enabled', '__return_false'); // LazyLload in WordPress 5.5+ 
add_action('wp_footer', function() { wp_dequeue_script( 'wp-embed' ); });
function remove_wp_block_library_css(){
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' ); // REMOVE WOOCOMMERCE BLOCK CSS
	wp_dequeue_style( 'global-styles' ); // REMOVE THEME.JSON
	wp_dequeue_script( 'comment-reply' );
};
add_action( 'wp_enqueue_scripts', 'remove_wp_block_library_css', 100 );



// SVG wp-duotone-dark-grayscale DELETE
function remove_global_styles() {
	remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
	remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
}
add_action('after_setup_theme', 'remove_global_styles', 10, 0);

// Disable the emoji's
function disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
  add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
  if ( 'dns-prefetch' == $relation_type ) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
    $urls = array_diff( $urls, array( $emoji_svg_url ) );
  }
  return $urls;
}
remove_theme_support( 'block-templates' );
// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––





// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
// ACF Import for Working well!
function my_acf_json_save_point( $path ) {    
    $path = get_stylesheet_directory() . '/inc/acf';		// update path
    return $path;
}
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_load_point( $paths ) {
    unset($paths[0]);										// remove original path (optional)
    $paths[] = get_stylesheet_directory() . '/inc/acf';		// append path
    return $paths;
}
add_filter('acf/settings/load_json', 'my_acf_json_load_point');





