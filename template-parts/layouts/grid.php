<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dinesh Ghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */

global $wp_query;

$post_count = $wp_query->current_post;
$total_post_count = $wp_query->found_posts;

if( $post_count % 5 == 0 ) {
	$article_layout = 'classic-post';
	echo '<div class="blogmagazine-archive-classic-post-wrapper">';
} else {
	if( $post_count == 1 || $post_count == 6 ) {
		echo '<div class="blogmagazine-archive-grid-post-wrapper blogmagazine-clearfix">';
	}
	$article_layout = 'grid-post';
}
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
			$show_date = 'show';
			$show_author = 'show';
			$excerpt_length = 150;
			$readmore_text = esc_html__( 'Read More...', 'blogmagazine' );
			if(is_archive()){
				$show_date = get_theme_mod( 'dglib_enable_date_archive', $show_date );
				$show_author = get_theme_mod( 'dglib_enable_authorname_archive', $show_author );
				$excerpt_length = get_theme_mod( 'dglib_excerpt_length_archive', $excerpt_length );
				$readmore_text = get_theme_mod( 'dglib_readmore_text_archive', $readmore_text );
			}
			if(is_home()){
				$show_date = get_theme_mod( 'dglib_enable_date_index', $show_date );
				$show_author = get_theme_mod( 'dglib_enable_authorname_index', $show_author );
				$excerpt_length = get_theme_mod( 'dglib_excerpt_length_index', $excerpt_length );
				$readmore_text = get_theme_mod( 'dglib_readmore_text_index', $readmore_text );
			}
			if(is_search()){
				$show_date = get_theme_mod( 'dglib_enable_date_search', $show_date );
				$show_author = get_theme_mod( 'dglib_enable_authorname_search', $show_author );
				$excerpt_length = get_theme_mod( 'dglib_excerpt_length_search', $excerpt_length );
				$readmore_text = get_theme_mod( 'dglib_readmore_text_search', $readmore_text );
			}
			$args1 = ($show_date == 'show') ? true : false;
			$args2 = ($show_author == 'show') ? true : false;
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php blogmagazine_inner_posted_on( $args1, $args2 ); ?>
				</div><!-- .entry-meta -->
				<?php
			endif;
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			dglib_the_excerpt( absint($excerpt_length), true, $readmore_text);
			?>
		</div><!-- .entry-content -->
		<footer class="entry-footer">
			<?php blogmagazine_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .blogmagazine-archive-post-content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php
if( $post_count % 5 == 0 ) {
	echo '</div>';
} else {
	if( $post_count == 4 || $post_count == 9 || $post_count == $total_post_count-1 ) {
		echo '</div>';
	}
}