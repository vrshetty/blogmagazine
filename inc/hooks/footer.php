<?php
/**
 * Custom hooks functions are define about footer section.
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */
/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Footer Middle
 *
 * @since 1.0.0
 */
if(!function_exists( 'blogmagazine_footer_middle_area_callback') ):

	function blogmagazine_footer_middle_area_callback(){

		get_template_part( 'template-parts/footer/footer', 'middle' );

	}

endif;

add_action( 'blogmagazine_middle_footer_area', 'blogmagazine_footer_middle_area_callback', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Footer Bottom
 *
 * @since 1.0.0
 */
if(!function_exists( 'blogmagazine_footer_bottom_area_callback') ):

	function blogmagazine_footer_bottom_area_callback(){

		get_template_part( 'template-parts/footer/footer', 'bottom' );

	}

endif;

add_action( 'blogmagazine_bottom_footer_area', 'blogmagazine_footer_bottom_area_callback', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Footer Scroll Top
 *
 * @since 1.0.0
 */
if(!function_exists( 'blogmagazine_footer_scroll_top_callback') ):

	function blogmagazine_footer_scroll_top_callback(){

		get_template_part( 'template-parts/footer/footer', 'scrolltop' );

	}

endif;

add_action( 'blogmagazine_sccrolltop_footer_area', 'blogmagazine_footer_scroll_top_callback', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Blogmagazine Footer Main
 *
 * @since 1.0.0
 */
if(!function_exists( 'blogmagazine_footer_main_callback') ):

	function blogmagazine_footer_main_callback(){

		echo '<footer id="colophon" class="site-footer" role="contentinfo">';

		/**
	     * @hook - blogmagazine_before_inner_footer hook
	     *
	     * @since 1.0.7
	     */
		do_action( 'blogmagazine_before_inner_footer' );	

		/**
	     * @hook - blogmagazine_middle_footer_area hook
	     * @hooked - blogmagazine_footer_middle_area_callback - 10
	     *
	     * @since 1.0.7
	     */
		do_action( 'blogmagazine_middle_footer_area' );

		/**
	     * @hook - blogmagazine_bottom_footer_area hook
	     * @hooked - blogmagazine_footer_bottom_area_callback - 10
	     *
	     * @since 1.0.7
	     */
		do_action( 'blogmagazine_bottom_footer_area' );

		/**
	     * @hook - blogmagazine_after_inner_footer hook
	     *
	     * @since 1.0.7
	     */
		do_action( 'blogmagazine_after_inner_footer' );

		echo '</footer><!-- #colophon -->';	

		/**
	     * @hook - blogmagazine_sccrolltop_footer_area hook
	     * @hooked - blogmagazine_footer_scroll_top_callback - 10
	     *
	     * @since 1.0.7
	     */
		do_action( 'blogmagazine_sccrolltop_footer_area' );	

	}

endif;

add_action( 'blogmagazine_footer', 'blogmagazine_footer_main_callback', 10 );
