<?php
/**
 *
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */

get_header(); 

/*
 * dglib_breadcrumbs_section_template - hook
 *
 * @hooked - dglib_breadcrumbs_section_callback - 10
 *
 * @since 1.0.6
 */
do_action( 'dglib_breadcrumbs_section_template' );

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php

		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/single-details/content', 'single' );
			$show_before_after = get_theme_mod( 'dglib_prev_next_button_post', 'show' );
			if($show_before_after=='show'){
				the_post_navigation();
			}	

			/**
		     * blogmagazine_author_info_section hook
		     *
		     * @hooked -  - 10
		     *
		     * @since 1.0.6
		     */
			do_action( 'blogmagazine_author_info_section' );

			/**
		     * dglib_reaction_section_icons hook
		     *
		     * @hooked -  - 10
		     *
		     * @since 1.0.6
		     */
			do_action('dglib_reaction_section_icons');

			/**
		     * blogmagazine_related_posts hook
		     *
		     * @hooked - blogmagazine_related_posts_section - 10
		     *
		     * @since 1.0.0
		     */
		    do_action( 'blogmagazine_related_posts' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ){
				comments_template();
			}

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();

get_footer();