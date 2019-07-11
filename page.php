<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */
get_header(); 
$enable_magazine_layout = get_theme_mod( 'enable_magazine_layout', 'enable' );
if(is_front_page() && $enable_magazine_layout=='enable'):
	get_template_part( 'template-parts/templates/front', 'page' );
else:
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
				
				get_template_part( 'template-parts/single-details/content', 'page' );

				/**
			     * dblib_reaction_section_icons hook
			     *
			     * @hooked -  - 10
			     *
			     * @since 1.0.6
		     	 */
				do_action('dblib_reaction_section_icons');

				// If comments are open or we have at least one comment, load up the comment template.
				if( comments_open() || get_comments_number() ){
					comments_template();
				}
			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
	get_sidebar();
endif;
get_footer();
