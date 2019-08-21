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

	add_image_size( 'blogmagazine-thumb-400x600', 400, 600, true );
	add_image_size( 'blogmagazine-thumb-500x365', 500, 365, true );
	add_image_size( 'blogmagazine-thumb-600x600', 600, 600, true );
	add_image_size( 'blogmagazine-thumb-800x400', 800, 400, true );
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
			'flex-height'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support( 
		'custom-background', 
		apply_filters( 
			'blogmagazine_custom_background_args', 
			array(
				'default-color' => '#ffffff',
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

	$defaults = array(
		'width'                  => 1200,
		'height'                 => 800,
		'audio'					=> true,
		'video'					 => true,
		'flex-height'            => true,
		'flex-width'             => true,
		'uploads'                => true,
		'random-default'         => false,
		'header-text'            => true,
		'default-text-color'     => '#0c4da2',
	);
	add_theme_support( 'custom-header', $defaults );

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
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function blogmagazine_scripts() {
    
    global $blogmagazine_version;

    wp_enqueue_style( 'blogmagazine-fonts', blogmagazine_fonts_url(), array(), null );

    wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

    wp_enqueue_style( 'lightslider-style', get_template_directory_uri().'/assets/library/lightslider/css/lightslider.min.css', array(), '1.1.6' );
   
    wp_enqueue_style( 'blogmagazine-main-style', get_template_directory_uri().'/assets/css/blogmagazine.min.css', array(), '1.0.0' );
    wp_style_add_data( 'blogmagazine-main-style', 'rtl', 'replace' );

    wp_enqueue_style( 'blogmagazine-style', get_stylesheet_uri(), array(), esc_attr( $blogmagazine_version ) );

    $menu_sticky_option = get_theme_mod( 'blogmagazine_menu_sticky_option', 'show' );
    if ( $menu_sticky_option == 'show' ) {
        wp_enqueue_script( 'jquery-sticky', get_template_directory_uri(). '/assets/library/sticky/jquery.sticky.js', array( 'jquery' ), '20150416', true );
    }

    wp_enqueue_script( 'blogmagazine-skip-link-focus-fix', get_template_directory_uri() . '/assets/library/_s/js/skip-link-focus-fix.js', array(), esc_attr( $blogmagazine_version ), true );

    wp_enqueue_script( 'lightslider', get_template_directory_uri().'/assets/library/lightslider/js/lightslider.min.js', array('jquery'), '1.1.6', true );

    wp_enqueue_script( 'blogmagazine-main', get_template_directory_uri().'/assets/js/blogmagazine.min.js', array('jquery'), esc_attr( $blogmagazine_version ), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'blogmagazine_scripts' );

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

	function blogmagazine_admin_enqueue_scripts($hooks){

		$load_related_page = array(
			'nav-menus.php',
			'widgets.php',
			'post.php',
			'edit.php',
			'post-new.php',
			'customize.php'
		);
		if(in_array($hooks, $load_related_page)){
		
			wp_enqueue_style( 'blogmagazine-admin-styles', get_template_directory_uri().'/assets/css/admin-styles.min.css', array(), '1.0.0');
			wp_style_add_data( 'blogmagazine-admin-styles', 'rtl', 'replace' );

		}

		// This theme styles the visual editor to resemble the theme style
		// add_editor_style autometically enqueue .min-rtl.css if needed
        add_editor_style( 'assets/css/editor-style.min.css' );

	}

endif;

add_action('admin_enqueue_scripts', 'blogmagazine_admin_enqueue_scripts', 20, 1);


/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles for only admin
 *
 * @since 1.0.0
 */


function blogmagazine_admin_scripts( $hook ) {

    global $blogmagazine_version;

    if( 'widgets.php' != $hook && 'customize.php' != $hook && 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook ) {
        return;
    }

    wp_enqueue_script( 'jquery-ui-button' );
    
}

add_action( 'admin_enqueue_scripts', 'blogmagazine_admin_scripts' );

if(!function_exists('blogmagazine_customizer_print_styles')){

	function blogmagazine_customizer_print_styles(){

		wp_enqueue_style( 'blogmagazine-customizer-style', get_template_directory_uri().'/assets/css/customizer.min.css', array(), '1.0.0', false );

	}

}

add_action( 'customize_controls_print_styles', 'blogmagazine_customizer_print_styles' );