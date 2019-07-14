<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */
?>
</div><!-- .dg-container -->
</div><!-- #content -->
<?php
		/**
	     * @hook - blogmagazine_footer hook
	     * @hooked - blogmagazine_footer_main_callback - 10
	     *
	     * @since 1.0.0
	     */
		do_action( 'blogmagazine_footer' );
		?>
	</div><!-- #page -->
	<?php
	/**
     * blogmagazine_after_page hook
     *
     * @since 1.0.0
     */
	do_action( 'blogmagazine_after_page' );
	wp_footer(); 
	?>
</body>
</html>