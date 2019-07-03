<?php
/**
 * Template part for fallback single page content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DineshGhimire
 * @subpackage BlogMagazineazine
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blogmagazine-article-thumb">
		<?php the_post_thumbnail( 'full' ); ?>
	</div><!-- .blogmagazine-article-thumb -->
	<header class="entry-header">
		<?php 
			the_title( '<h1 class="entry-title">', '</h1>' );
			blogmagazine_single_post_categories_list();
		?>
		<div class="entry-meta">
			<?php blogmagazine_inner_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blogmagazine' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogmagazine' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php blogmagazine_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->