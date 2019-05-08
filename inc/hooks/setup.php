<?php
/**
 * blogmagazine functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */

if ( ! function_exists( 'blogmagazine_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blogmagazine_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on blogmagazine, use a find and replace
	 * to change 'blogmagazine' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blogmagazine', get_template_directory() . '/languages' );

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
	add_image_size( 'blogmagazine-thumb-136x102', 136, 102, true );
	add_image_size( 'blogmagazine-thumb-300x316', 340, 316, true );
	add_image_size( 'blogmagazine-thumb-305x207', 305, 207, true );
	add_image_size( 'blogmagazine-thumb-622x420', 622, 420, true );

	add_image_size( 'blogmagazine-thumb-500x365', 500, 365, true );
	add_image_size( 'blogmagazine-thumb-800x600', 800, 600, true );

	$blogmagazine_image_src_set_option = get_theme_mod( 'blogmagazine_image_src_set_option', 'disable' );
	$calculate_image_srcset_callback = ($blogmagazine_image_src_set_option=='enable') ? '__return_true' : '__return_false';
	add_filter( 'wp_calculate_image_srcset', $calculate_image_srcset_callback );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'blogmagazine_top_menu' 		=> esc_html__( 'Top Menu', 'blogmagazine' ),
		'blogmagazine_primary_menu' 	=> esc_html__( 'Primary Menu', 'blogmagazine' ),
		'blogmagazine_footer_menu' 	=> esc_html__( 'Footer Menu', 'blogmagazine' )
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

	// Add theme support for Custom Logo.
	add_theme_support( 
		'custom-logo', 
		array(
			'width'       => 300,
			'height'      => 45,
			'flex-width'  => true,
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support( 
		'custom-background', 
		apply_filters( 
			'blogmagazine_custom_background_args', 
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) 
		) 
	);

	// Add theme support for post format.
	add_theme_support( 
		'post-formats', 
		array( 
			'standard',
			'aside',
			'chat',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
		) 
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// WooCommerce Support
	if ( class_exists( 'WooCommerce' ) ) {
		add_theme_support( 'woocommerce' );
	}

}
endif;
add_action( 'after_setup_theme', 'blogmagazine_setup' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blogmagazine_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blogmagazine_content_width', 640 );
}
add_action( 'after_setup_theme', 'blogmagazine_content_width', 0 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set the theme version
 *
 * @global int $blogmagazine_version
 * @since 1.0.0
 */
function blogmagazine_theme_version() {
	$blogmagazine_theme_info = wp_get_theme();
	$GLOBALS['blogmagazine_version'] = $blogmagazine_theme_info->get( 'Version' );
}
add_action( 'after_setup_theme', 'blogmagazine_theme_version', 0 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function blogmagazine_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'blogmagazine_pingback_header' );

/*
 * Admin Enqueue Scripts and Styles
 */

if(!function_exists('blogmagazine_admin_enqueue_scripts') ):

	function blogmagazine_admin_enqueue_scripts(){

		wp_enqueue_style( 'blogmagazine-admin-styles', get_template_directory_uri().'/assets/css/admin-styles.min.css', array(), '1.0.0');

	}

endif;

add_action('admin_enqueue_scripts', 'blogmagazine_admin_enqueue_scripts');
