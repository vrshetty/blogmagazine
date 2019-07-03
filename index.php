<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;
			/* Start the Loop */
			$blog_layout = get_theme_mod( 'blogmagazine_index_layout', 'classic' );
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/layouts/' . $blog_layout );
			endwhile;
			the_posts_navigation();
		else :
			get_template_part( 'template-parts/post-format/content', 'none' );
		endif; ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_sidebar();

get_footer();