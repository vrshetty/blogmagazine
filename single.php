<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/single-details/content', 'single' );

			the_post_navigation();

			/**
		     * blogmagazine_related_posts hook
		     *
		     * @hooked - blogmagazine_related_posts_start - 10
		     * @hooked - blogmagazine_related_posts_section - 20
		     * @hooked - blogmagazine_related_posts_end - 30
		     *
		     * @since 1.0.0
		     */
		    do_action( 'blogmagazine_related_posts' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();

get_footer();