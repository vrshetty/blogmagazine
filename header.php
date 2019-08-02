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
<body <?php body_class(); ?> <?php do_action('blogmagazine_body_attribute'); ?>>
<?php
	// body open hooks
	do_action( 'wp_body_open' );
	/**
     * blogmagazine_before_page hook
     *
     * @since 1.0.0
     */
    do_action( 'blogmagazine_before_page' );
	?>
	<div id="page" class="site">	
		<?php
			/**
		     * blogmagazine_header_section hook
		     *
		     * @hooked - blogmagazine_section_header_callback - 10
		     *
		     * @since 1.0.0
		     */
		    do_action( 'blogmagazine_header_section' );
		?>
		<div id="content" class="site-content">
			<div class="dg-container">