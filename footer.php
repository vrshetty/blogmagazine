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
	     * @hooked - blogmagazine_footer_start - 5
	     * @hooked - blogmagazine_footer_widget_section - 10
	     * @hooked - blogmagazine_bottom_footer_start - 15
	     * @hooked - blogmagazine_footer_site_info_section - 20
	     * @hooked - blogmagazine_footer_menu_section - 25
	     * @hooked - blogmagazine_bottom_footer_end - 30
	     * @hooked - blogmagazine_footer_end - 35
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