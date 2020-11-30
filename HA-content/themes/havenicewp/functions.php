<?php
/**
 * HAveniceWP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package HAveniceWP
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'havenicewp_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function havenicewp_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on HAveniceWP, use a find and replace
		 * to change 'havenicewp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'havenicewp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );


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

	}
endif;
add_action( 'after_setup_theme', 'havenicewp_setup' );

/**
 * Enqueue scripts and styles.
 */
function havenicewp_scripts() {
	wp_enqueue_style( 'havenicewp-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'havenicewp-style', 'rtl', 'replace' );
	wp_enqueue_style( 'flickity', get_template_directory_uri() . '/css/flickity.min.css', array(), _S_VERSION);
	wp_enqueue_style( 'glightbox', get_template_directory_uri() . '/css/glightbox.min.css', array(), _S_VERSION);
	wp_enqueue_style( 'havenicewp-common', get_template_directory_uri() . '/css/common.css', array('havenicewp-style'), _S_VERSION);
	if (is_single()) {
		wp_enqueue_style( 'flickity-fullscreen', get_template_directory_uri() . '/css/flickity-fullscreen.css', array('havenicewp-style'), _S_VERSION);
	}


	wp_enqueue_script( 'havenicewp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', array(), '', true);
	wp_enqueue_script( 'glightbox', get_template_directory_uri() . '/js/glightbox.min.js', array('flickity'), '', true);
	wp_enqueue_script( 'havenicewp-common', get_template_directory_uri() . '/js/common.js', array('glightbox'), _S_VERSION, true);
	if (is_single()) {
		wp_enqueue_script( 'havenicewp-common', get_template_directory_uri() . '/js/flickity-fullscreen.js', array('flickity'), _S_VERSION, true);
	}


}
add_action( 'wp_enqueue_scripts', 'havenicewp_scripts' );



/* custom functions for HAveniceWP theme */
require get_template_directory() . '/inc/HA-custom.php';
