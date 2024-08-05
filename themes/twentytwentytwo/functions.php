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

function hs_enqueue_scripts() {
    wp_enqueue_script('hs-ajax-script', get_template_directory_uri() . '/js/hs-ajax.js', array('jquery'), null, true);
    wp_localize_script('hs-ajax-script', 'hs_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('hs-ajax-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'hs_enqueue_scripts');

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';

// Register Custom Post Type "Projects"
function add_projects_cpt() {
    $labels = array(
                                    'name'=> 'Projects',
                                    'singular_name' => 'Projects',
                                    'add_new' => 'Add New Project',
                                    'add_new_item' => 'Add New Project',
                                    'edit' => 'Edit Project',
                                    'edit_item' => 'Edit Project',
                                    'new-item' => 'New Project',
                                    'view' => 'View Project',
    );

    $args = array(
        'labels' => $labels,
        'supports' => array('title', 'editor'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
		'show_in_rest' => true,
    );

    register_post_type('projects', $args);
}
add_action('init', 'add_projects_cpt', 0);

// Register Custom Taxonomy "Project Type"
function add_project_type_taxonomy() {
    $labels = array(
                                    'name'=> 'Projects Type',
                                    'singular_name' => 'Project Type',
                                    'add_new' => 'Add New Project Type',
                                    'add_new_item' => 'Add New Project Type',
                                    'edit' => 'Edit Project Type',
                                    'edit_item' => 'Edit Project Type',
                                    'new-item' => 'New Project Type',
                                    'view' => 'View Project Type',
                                    'menu_name' => __('Project Type', 'textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
		
    );

    register_taxonomy('project_type', array('projects'), $args);
}
add_action('init', 'add_project_type_taxonomy', 0);

// show custom post in json formate show 3 project post for not user logged in and show 6 post for logged in user

function hs_get_architecture_projects() {
    check_ajax_referer('hs-ajax-nonce', 'security');

    $query = new WP_Query(array(
        'post_type' => 'projects',
        'tax_query' => array(array(
            'taxonomy' => 'project_type',
            'field'    => 'slug',
            'terms'    => 'architecture',
        )),
        'posts_per_page' => is_user_logged_in() ? 6 : 3,
    ));

    $projects = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $projects[] = array(
                'id'    => get_the_ID(),
                'title' => get_the_title(),
                'link'  => get_permalink(),
            );
        }
    }

    wp_send_json_success(array('data' => $projects));
}
add_action('wp_ajax_nopriv_hs_get_architecture_projects', 'hs_get_architecture_projects');
add_action('wp_ajax_hs_get_architecture_projects', 'hs_get_architecture_projects');

