<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
	/**
     * blogmagazine_before_page hook
     *
     * @since 1.0.0
     */
    do_action( 'blogmagazine_before_page' );
?>

<div id="page" class="site">
	<?php

		$blogmagazine_top_header_option = get_theme_mod( 'blogmagazine_top_header_option', 'show' );
		if( $blogmagazine_top_header_option == 'show' ) {
			
			/**
		     * blogmagazine_top_header hook
		     *
		     * @hooked - blogmagazine_top_header_start - 5
		     * @hooked - blogmagazine_top_left_section - 10
		     * @hooked - blogmagazine_top_right_section - 15
		     * @hooked - blogmagazine_top_header_end - 20
		     *
		     * @since 1.0.0
		     */
		    do_action( 'blogmagazine_top_header' );
		}

		/**
	     * blogmagazine_header_section hook
	     *
	     * @hooked - blogmagazine_header_section_start - 5
	     * @hooked - blogmagazine_header_logo_ads_section_start - 10
	     * @hooked - blogmagazine_site_branding_section - 15
	     * @hooked - blogmagazine_header_ads_section - 20
	     * @hooked - blogmagazine_header_logo_ads_section_end - 25
	     * @hooked - blogmagazine_primary_menu_section - 30
	     * @hooked - blogmagazine_header_section_end - 35
	     *
	     * @since 1.0.0
	     */
	    do_action( 'blogmagazine_header_section' );
	    
		$blogmagazine_ticker_option = get_theme_mod( 'blogmagazine_ticker_option', 'show' );
		if( $blogmagazine_ticker_option == 'show' && is_front_page() ) {

			/**
		     * blogmagazine_top_header hook
		     *
		     * @hooked - blogmagazine_ticker_section_start - 5
		     * @hooked - blogmagazine_ticker_content - 10
		     * @hooked - blogmagazine_ticker_section_end - 15
		     *
		     * @since 1.0.0
		     */
		    do_action( 'blogmagazine_ticker_section' );
		}
	?>

	<div id="content" class="site-content">
		<div class="dg-container">