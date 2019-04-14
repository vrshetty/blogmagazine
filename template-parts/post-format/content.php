<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
	<div class="blogmagazine-article-thumb">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'full' ); ?>
		</a>
	</div><!-- .blogmagazine-article-thumb -->
	<div class="blogmagazine-archive-post-content-wrapper">
		<header class="entry-header">
			<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php blogmagazine_inner_posted_on(); ?>
				</div><!-- .entry-meta --> 
				<?php
			endif;
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			the_excerpt();
			blogmagazine_archive_read_more_button();
			?>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php blogmagazine_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .blogmagazine-archive-post-content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->