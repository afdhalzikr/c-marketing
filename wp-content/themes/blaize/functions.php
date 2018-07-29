<?php
/**
 * Blaize functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blaize
 */

if ( ! function_exists( 'blaize_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function blaize_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Blaize, use a find and replace
		 * to change 'blaize' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'blaize', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-menu' => esc_html__( 'Primary', 'blaize' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'blaize_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/** Add Image Sizes **/
		add_image_size( 'blaize-portfolio-img', 370, 320, true );
		add_image_size( 'blaize-blog-img', 385, 255, true );
		add_image_size( 'blaize-blog-arch-img', 890, 460, true );
	}
endif;
add_action( 'after_setup_theme', 'blaize_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blaize_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'blaize_content_width', 640 );
}
add_action( 'after_setup_theme', 'blaize_content_width', 0 );


/**
 * Enqueue scripts and styles.
 */
function blaize_scripts() {

	$font_args = array(
        'family' => 'Raleway:100,200,300,,400,500,600,700,800,900|Open+Sans:400,600,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
    );

    $blaize_enable_wow = get_theme_mod( 'blaize_enable_wow', true );
    $blaize_slider_auto_slide = get_theme_mod( 'blaize_slider_auto_slide', true );

    $blz_obj = array(
    	'enable_wow' => $blaize_enable_wow,
        'slider_auto_slide' => $blaize_slider_auto_slide,
    );

    wp_enqueue_style('blaize-google-fonts', add_query_arg($font_args, "//fonts.googleapis.com/css"));

	wp_enqueue_style( 'blaize-style', get_stylesheet_uri() );

	wp_enqueue_style( 'blaize-loaders', get_template_directory_uri() . '/css/loaders.css');

	wp_enqueue_style( 'animate', get_template_directory_uri() . '/js/wow/animate.css');

	wp_enqueue_style( 'blaize-responsive', get_template_directory_uri() . '/css/responsive.css');

	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/faw/css/fontawesome-all.min.css');
	wp_enqueue_style( 'et-line', get_template_directory_uri() . '/css/et-line/style.css' );
	wp_enqueue_style( 'jquery-owl-carousel', get_template_directory_uri() . '/js/owl/owl.carousel.min.css');
	wp_enqueue_style( 'jquery-modal-video', get_template_directory_uri() . '/js/modal-video/modal-video.min.css');

	wp_enqueue_script( 'jquery-owl-carousel', get_template_directory_uri() . '/js/owl/owl.carousel.min.js', array('jquery') );
	wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/js/jquery.waypoints.js', array('jquery') );
	wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/js/jquery.counterup.js', array('jquery') );
	wp_enqueue_script( 'jquery-isotope-pkgd', get_template_directory_uri() . '/js/isotope.pkgd.js', array('jquery', 'imagesloaded') );
	wp_enqueue_script( 'jquery-modal-video', get_template_directory_uri() . '/js/modal-video/jquery-modal-video.min.js', array('jquery') );

	wp_enqueue_script( 'jquery-wow', get_template_directory_uri() . '/js/wow/wow.min.js', array('jquery') );

	wp_enqueue_script( 'blaize-custom-scripts', get_template_directory_uri() . '/js/custom-scripts.js', array('jquery', 'jquery-waypoints', 'jquery-counterup', 'jquery-isotope-pkgd', 'jquery-modal-video', 'jquery-wow' ) );

	wp_localize_script( 'blaize-custom-scripts', 'blzObj', $blz_obj );

	wp_enqueue_script( 'blaize-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blaize_scripts' );

/**
 * Initialize all the required files
 */
require get_template_directory() . '/inc/init.php';

/** 
 * Dynamic Styles
 */
require get_template_directory() . '/css/blaize-dynamic-styles.php';

/**
 * Registers an editor stylesheet for the theme.
 */
function blaize_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'blaize_theme_add_editor_styles' );