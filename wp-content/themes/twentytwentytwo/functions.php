<?php
/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */


if ( ! function_exists( 'twentytwentytwo_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'twentytwentytwo_support' );

if ( ! function_exists( 'twentytwentytwo_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'twentytwentytwo-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'twentytwentytwo-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';


// task code start here
function custom_ip_redirect() {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    if (strpos($user_ip, '77.29.') === 0) {
        wp_redirect('https://example.com/redirect-page/');
        exit;
    }
}
add_action('template_redirect', 'custom_ip_redirect');


// register post type here
function custom_register_post_type() {
    register_post_type('projects', [
        'labels' => [
            'name' => 'Projects',
            'singular_name' => 'Project',
        ],
        'public' => true,
        'has_archive' => true,
    ]);
    
    register_taxonomy('project_type', 'projects', [
        'labels' => [
            'name' => 'Project Type',
            'singular_name' => 'Project Type',
        ],
        'hierarchical' => true,
    ]);
}
add_action('init', 'custom_register_post_type');


// ajax function start here
function custom_ajax_get_projects() {
    $project_type = 'architecture';
    $num_posts = is_user_logged_in() ? 6 : 3;
    $args = [
        'post_type' => 'projects',
        'tax_query' => [
            [
                'taxonomy' => 'project_type',
                'field' => 'slug',
                'terms' => $project_type,
            ],
        ],
        'posts_per_page' => $num_posts,
        'orderby' => 'date',
        'order' => 'DESC',
    ];
    $query = new WP_Query($args);
    $projects = $query->get_posts();
    $result = [
        'success' => true,
        'data' => [],
    ];
    foreach ($projects as $project) {
        $result['data'][] = [
            'id' => $project->ID,
            'title' => $project->post_title,
            'link' => get_permalink($project->ID),
        ];
    }
    wp_send_json($result);
}
add_action('wp_ajax_custom_get_projects', 'custom_ajax_get_projects');
add_action('wp_ajax_nopriv_custom_get_projects', 'custom_ajax_get_projects');

// http code start from here

function hs_give_me_coffee() {
    $api_url = 'https://random-coffee-api.com/api/brew';
    $response = wp_remote_get($api_url);
    if (is_wp_error($response)) {
        return 'Error: Unable to fetch coffee link.';
    }
    $coffee_data = json_decode(wp_remote_retrieve_body($response), true);
    return $coffee_data['link'];
}
