<?php
/*
 * Global theme related settings
 */

if(!function_exists('dglib_after_setup_theme')):

	function dglib_after_setup_theme(){

		add_image_size( 'dglib-thumb-400x300', 400, 300, true );

	}

endif;
add_action( 'after_setup_theme', 'dglib_after_setup_theme' );

/*
 * Enqueue Scripts and Styles
 */

if(!function_exists('dglib_admin_enqueue_scripts') ):

	function dglib_admin_enqueue_scripts($hooks){

		$load_related_page = array(
			'nav-menus.php',
			'widgets.php',
			'post.php',
			'edit.php',
			'post-new.php',
			'customize.php'
		);
		if(!in_array($hooks, $load_related_page)){
			return;
		}

		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');

		wp_enqueue_style( 'font-awesome', dglib_assets_url('library/font-awesome/css/font-awesome.min.css'), array(), '1.0.0');

		wp_enqueue_style( 'dg-admin-styles', dglib_assets_url('css/dg-admin-styles.min.css'), array(), '1.0.0');
		wp_style_add_data( 'dg-admin-styles', 'rtl', 'replace' );

		wp_enqueue_script('dg-admin-script', dglib_assets_url('js/dg-admin-script.min.js'), array('jquery'), '1.0.0', true);

	}

endif;

add_action('admin_enqueue_scripts', 'dglib_admin_enqueue_scripts', 10, 1);

if(!function_exists('dglib_front_enqueue_scripts') ):

	function dglib_front_enqueue_scripts(){

		wp_enqueue_style( 'font-awesome', dglib_assets_url('library/font-awesome/css/font-awesome.min.css'), array(), '1.0.0');
		wp_enqueue_style( 'dg-front-style', dglib_assets_url('css/dg-front-style.min.css'), array(), '1.0.0' );
		wp_style_add_data( 'dg-front-style', 'rtl', 'replace' );

		wp_enqueue_script('dg-front-script', dglib_assets_url('js/dg-front-script.min.js'), array('jquery'), '1.0.0', true);
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

endif;
add_action('wp_enqueue_scripts', 'dglib_front_enqueue_scripts');
