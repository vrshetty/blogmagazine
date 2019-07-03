<?php
/**
 * The template for displaying archive pages
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
		if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php
			/* Start the Loop */
			$blogmagazine_archive_layout = get_theme_mod( 'blogmagazine_archive_layout', 'classic' );
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/layouts/'. $blogmagazine_archive_layout );
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
