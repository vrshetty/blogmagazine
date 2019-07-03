<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'blogmagazine' ), '<span>' . get_search_query() . '</span>' );
				?></h1>
			</header><!-- .page-header -->
			<?php
			/* Start the Loop */
			$search_layout = get_theme_mod( 'blogmagazine_search_layout', 'classic' );
			while ( have_posts() ) : the_post();
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/layouts/' . $search_layout );
			endwhile;
			the_posts_navigation();
		else :
			get_template_part( 'template-parts/post-format/content', 'none' );
		endif; ?>
	</main><!-- #main -->
</section><!-- #primary -->
<?php
get_sidebar();
get_footer();