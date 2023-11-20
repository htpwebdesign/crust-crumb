<?php

/**
 * Crust & Crumb Bakery functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Crust_&_Crumb_Bakery
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function crust_crumb_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Crust & Crumb Bakery, use a find and replace
	 * to change 'crust-crumb' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('crust-crumb', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'crust-crumb'),
			'footer-left' => esc_html__('Footer Menu Left', 'crust-crumb'),
			'footer-right' => esc_html__('Footer Menu Right', 'crust-crumb'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'crust_crumb_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'crust_crumb_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function crust_crumb_content_width()
{
	$GLOBALS['content_width'] = apply_filters('crust_crumb_content_width', 640);
}
add_action('after_setup_theme', 'crust_crumb_content_width', 0);


/**
 * Enqueue scripts and styles.
 */
function crust_crumb_scripts()
{
	wp_enqueue_style('crust-crumb-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('crust-crumb-style', 'rtl', 'replace');
	wp_enqueue_script('crust-crumb-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	
	// enqueue Isotope only on Menu and Careers pages	
	if (is_post_type_archive(array('product', 'cac-careers'))) {
		wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), '3.0.6', true);
	}

	// enqueue filter-menu.js only on Menu page
	if (is_post_type_archive('product')) {
		wp_enqueue_script('filter-menu', get_template_directory_uri() . '/js/filter-menu.js', array('jquery', 'isotope'), '1.0', true);
	}
	// enqueue filter-jobs.js only on Careers page
	if (is_post_type_archive('cac-careers')) {
        wp_enqueue_script('filter-jobs', get_template_directory_uri() . '/js/filter-jobs.js', array('jquery'), null, true);
    }

	// enqueue toggle-location.js only on Checkout page
	if (is_page('checkout')) {
		wp_enqueue_script('toggle-location', get_template_directory_uri() . '/js/toggle-location.js', array('jquery'), null, true);
		}
	
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'crust_crumb_scripts');





/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Register CPTs and Taxonomies.
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}
