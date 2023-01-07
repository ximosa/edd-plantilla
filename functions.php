<?php
/**
 * eidmart functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eidmart
 */

if ( ! function_exists( 'eidmart_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function eidmart_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on eidmart, use a find and replace
		 * to change 'eidmart' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'eidmart', get_template_directory() . '/languages' );

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
		add_image_size( 'eidmart-slide-image', 1024, 600, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'eidmart' ),
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
		add_theme_support( 'custom-background', apply_filters( 'eidmart_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Declare WooCommerce support
		add_theme_support( 'woocommerce' );

		// Remove widget block
		if( get_theme_mod( 'ewidget_opt', '0' ) == 0 ):
			remove_theme_support( 'widgets-block-editor' );
		endif;

	}
	endif;
	add_action( 'after_setup_theme', 'eidmart_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function eidmart_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'eidmart_content_width', 640 );
}
add_action( 'after_setup_theme', 'eidmart_content_width', 0 );


if ( ! function_exists( 'eidmart_fonts_url' ) ) :
/**
 * Register Google fonts.
 *
 * @return string Google fonts URL for the theme.
 */

function eidmart_fonts_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	
	$primary_font = get_theme_mod( 'primary_font' ) ? get_theme_mod( 'primary_font' ) : 'Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,400;1,600';
	$secondary_font = get_theme_mod( 'secondary_font' ) ? get_theme_mod( 'secondary_font' ) : 'Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500&display=swap';

	if ( 'off' !== _x( 'on', 'Fonts: on or off', 'eidmart' ) ) {
		$query_args = array(
			'family' => $primary_font.'&family='. $secondary_font,
		);
		$font_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );
	}
	return $font_url;
}
endif;

// Menu fallback
function eidmart_primary_menu_fallback(){
	echo '<ul class="navbar-nav ml-auto main-menu-nav"><li><a href="'.esc_url( admin_url( 'nav-menus.php' ) ).'"></a></li></ul>';
}

/**
 * Enqueue scripts and styles.
 */
function eidmart_scripts() {

	//  Font awesome icon css
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );
	wp_enqueue_style( 'line-awesome', get_template_directory_uri() . '/fonts/line-awesome/css/line-awesome.min.css' );

	// Theme Google fonts
	wp_enqueue_style( 'eidmart-fonts', eidmart_fonts_url(), array(), null );

	// Get Bootstrap Version
	$bootstrap_script = get_theme_mod( 'bootstrap_script', '4' );

	// Bootstrap ( v4.6.0 )
	if( $bootstrap_script == 4 ):
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap/v4/bootstrap.min.css' );
	endif;

	// Bootstrap ( v5.0.2 )
	if( $bootstrap_script == 5 ):
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap/v5/bootstrap.min.css' );
	endif;

	// Slick CSS
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/inc/slick/slick.css' );

	// Fancybox CSS
	if( get_theme_mod( 'lightbox_script' ) == '1' ):
		wp_enqueue_style( 'jquery-fancybox', get_template_directory_uri() . '/inc/lightbox/css/jquery.fancybox.css' );
	endif;

	// FakeLoader
	if( get_theme_mod( 'loader_show' ) == 1 ):
		wp_enqueue_style( 'fakeLoader', get_template_directory_uri() . '/css/fakeLoader.css' );
	endif;

	// Popup video
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css' );

	// If Audio Version Active
	if( get_theme_mod( 'mp3_script' ) == '1' ):
		wp_enqueue_style( 'aplayer', get_template_directory_uri() . '/css/aplayer.min.css' );
	endif;

	// Main stylesheet
	wp_enqueue_style( 'eidmart-style', get_stylesheet_uri() ); 

	// Responsive file
	wp_enqueue_style( 'eidmart-responsive', get_template_directory_uri() . '/css/responsive.css' );


	// eidmart all scripts *************************************************************************************************************

	// Bootstrap Script ( v4.6.0 )
	if( $bootstrap_script == 4 ):
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap/v4/bootstrap.bundle.min.js', array( 'jquery' ), false, true );
	endif;

	// Bootstrap Script ( v5.0.2 )
	if( $bootstrap_script == 5 ):
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap/v5/bootstrap.bundle.min.js', false, false, true );
	endif;

	// Smooth Scrool Script
	wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery' ), false, true );
	
	// Jquery Mixitup
	wp_enqueue_script( 'jquery-mixitup', get_template_directory_uri() . '/js/jquery.mixitup.min.js', array( 'jquery' ), false, true );

	// Waypoints
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array( 'jquery' ), false, true );

	// Cookie js
	if( get_theme_mod( 'alert_show' ) == 1 ):
		wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/js/cookie.js', array( 'jquery' ), false, true );
	endif;
	
	// Jquery fancybox pack // Lightbox
	if( get_theme_mod( 'lightbox_script' ) == '1' ):
		wp_enqueue_script( 'jquery-fancybox-pack', get_template_directory_uri() . '/inc/lightbox/js/jquery.fancybox.pack.js', array( 'jquery' ), false, true );	
		wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/inc/lightbox/js/lightbox.js', array( 'jquery' ), false, true );
	endif;

	// FakeLoader
	if( get_theme_mod( 'loader_show' ) == 1 ):
		wp_enqueue_script( 'fakeloader', get_template_directory_uri() . '/js/fakeLoader.min.js', array( 'jquery' ), false, true );
	endif;

	// Slick Script
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/inc/slick/slick.min.js', array( 'jquery' ), false, true );

	// Popup video
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), false, true );

	// Sticky Menu
	if( get_theme_mod( 'sticky_menu' ) == 1 ):
		wp_enqueue_script( 'sticky', get_template_directory_uri() . '/js/sticky-min.js', array( 'jquery' ), false, true );
	endif;

	// If Audio Version Active
	if( get_theme_mod( 'mp3_script' ) == '1' ):
		wp_enqueue_script( 'aplayer', get_template_directory_uri() . '/js/aplayer.min.js', array( 'jquery' ), false, true );
	endif;

	// eidmart custom js
	wp_enqueue_script( 'eidmart-script', get_template_directory_uri() . '/js/custom.js', array( 'jquery', 'masonry' ), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Adding Dashicons in WordPress Front-end
	wp_enqueue_style( 'dashicons' );

	$ajax_url = ( function_exists( 'edd_get_ajax_url' ) ) ? edd_get_ajax_url(): admin_url( 'admin-ajax.php' );
    wp_localize_script(
		'eidmart-script',
		'eidmart_custom_ajax',
		array(
			'ajaxurl' => $ajax_url,
			'nonce' => wp_create_nonce( 'eidmart_custom' ),
		)
    );

}
add_action( 'wp_enqueue_scripts', 'eidmart_scripts' );

// Admin scripts
function eidmart_admin_scripts( $screen ) {	
	wp_enqueue_style('font-awesome-admin',get_template_directory_uri() .'/fonts/font-awesome.min.css'); 
	wp_enqueue_style('eidmart-admin',get_template_directory_uri() .'/css/admin/admin.css');
	
	// Admin js
	if( 'widgets.php' == $screen ){
		wp_enqueue_script( 'welearner-script', get_template_directory_uri() . '/js/admin/admin-main.js', array( 'jquery' ), false, true );
	}
}
add_action( 'admin_enqueue_scripts', 'eidmart_admin_scripts' );

// WordPress Default login scripts
function eidmart_login_stylesheet() {
    wp_enqueue_style( 'eidmart-login', get_stylesheet_directory_uri() . '/css/admin/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'eidmart_login_stylesheet' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Widget additions.
 */
require get_template_directory() . '/inc/widget.php';

/**
 * Breadcrumbs additions.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

 /**
 * Add Plugins
 */
 require get_template_directory() . '/inc/plugins.php';

/**
 * Botstrap nav additions.
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
