<?php
/**
 * Custom hooks functions are define about header section.
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */

/**
 * Skip Link 
 *
 * @since 1.0.0
 */
if(!function_exists('blogmagazine_skip_link_callback')):

	function blogmagazine_skip_link_callback(){
		?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'blogmagazine' ); ?></a><?php
	}

endif;
add_action( 'blogmagazine_before_page', 'blogmagazine_skip_link_callback', 10 );
/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * header media
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_media_header_callback' ) ) :
	
	function blogmagazine_media_header_callback() {
	
		get_template_part( 'template-parts/header/header', 'media' );

	}

endif;

add_action( 'blogmagazine_header_media', 'blogmagazine_media_header_callback', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Top header callback
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_header_top_callback' ) ) :
	
	function blogmagazine_header_top_callback() {
		
		get_template_part( 'template-parts/header/top', 'header' );

	}

endif;

add_action( 'blogmagazine_top_header', 'blogmagazine_header_top_callback', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Header Branding Callback
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_branding_header_callback' ) ) :
	
	function blogmagazine_branding_header_callback() {
		
		get_template_part( 'template-parts/header/header', 'branding' );

	}

endif;

add_action( 'blogmagazine_header_branding', 'blogmagazine_branding_header_callback', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Header Navigation Callback
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_navigation_header_callback' ) ) :
	
	function blogmagazine_navigation_header_callback() {
		
		get_template_part( 'template-parts/header/primary', 'navigation' );

	}

endif;

add_action( 'blogmagazine_header_navigation', 'blogmagazine_navigation_header_callback', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Header Navigation Callback
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_ticker_header_callback' ) ) :
	
	function blogmagazine_ticker_header_callback() {

		get_template_part( 'template-parts/header/header', 'ticker' );

	}

endif;

add_action( 'blogmagazine_header_ticker', 'blogmagazine_ticker_header_callback', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Header Section Callback
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_section_header_callback' ) ) :
	
	function blogmagazine_section_header_callback() {

		echo '<header id="masthead" class="site-header" role="banner">';

		do_action( 'blogmagazine_inneer_header_before' );

		do_action( 'blogmagazine_header_media' );

		$blogmagazine_top_header_option = get_theme_mod( 'blogmagazine_top_header_option', 'show' );
		if( $blogmagazine_top_header_option == 'show' ) {

			/**
		     * blogmagazine_top_header hook
		     *
		     * @hooked - blogmagazine_header_top_callback - 10
		     *
		     * @since 1.0.0
		     */
		    do_action( 'blogmagazine_top_header' );

		}

		/**
		 * blogmagazine_header_branding hook
		 *
		 * @hooked - blogmagazine_branding_header_callback - 10
		 *
		 * @since 1.0.0
		 */
		do_action( 'blogmagazine_header_branding' );

		/**
		 * blogmagazine_header_navigation hook
		 *
		 * @hooked - blogmagazine_navigation_header_callback - 10
		 *
		 * @since 1.0.0
		 */
		do_action( 'blogmagazine_header_navigation' );

		$blogmagazine_ticker_option = get_theme_mod( 'blogmagazine_ticker_option', 'show' );
		if( $blogmagazine_ticker_option == 'show' && is_front_page() ) {
			/**
		     * blogmagazine_header_ticker hook
		     *
		     * @hooked - blogmagazine_ticker_header_callback - 10
		     *
		     * @since 1.0.0
		     */
		    do_action( 'blogmagazine_header_ticker' );
		}

		do_action( 'blogmagazine_inneer_header_after' );

		echo '</header>';

	}

endif;

add_action( 'blogmagazine_header_section', 'blogmagazine_section_header_callback', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/
