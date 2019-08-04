<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DineshGhimire
 * @subpackage BlogMagazineazine
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$show_featured_image = get_theme_mod( 'dglib_enable_featured_image_post', 'show' );
	if($show_featured_image=='show' ){
		do_action( 'blogmagazine_single_before_post_thumbnail' );
		$show_featured_image = apply_filters( 'blogmagazine_show_featuredimage_single', true );
		if($show_featured_image){
			?>
			<div class="blogmagazine-article-thumb">
				<?php the_post_thumbnail( 'full' ); ?>
			</div><!-- .blogmagazine-article-thumb -->
			<?php
		}
	}
	?>
	<header class="entry-header">
		<?php 
		the_title( '<h1 class="entry-title">', '</h1>' );
		$show_categories = get_theme_mod( 'dglib_enable_categories_post', 'show' );
		if($show_categories=='show'){
			blogmagazine_single_post_categories_list();
		}

		$show_date = get_theme_mod( 'dglib_enable_date_post', 'show' );
		$show_author = get_theme_mod( 'dglib_enable_authorname_post', 'show' );
		$show_comments = get_theme_mod( 'dglib_enable_comments_post', 'show' );
		if( $show_date == 'show' || $show_author == 'show' || $show_comments == 'show' ){
			?>
			<div class="entry-meta">
				<?php 
				$args1 = ($show_date=='show') ? true : false;
				$args2 = ($show_author=='show') ? true : false;
				$args3 = ($show_comments=='show') ? true : false;
				blogmagazine_inner_posted_on( $args1, $args2, $args3 ); 
				?>
			</div><!-- .entry-meta -->
			<?php 
		}
		?>
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
	<?php 
		$dglib_enable_tags_post = get_theme_mod( 'dglib_enable_tags_post', 'show' );
		$show_tags = ($dglib_enable_tags_post=='show') ? true : false;
	?>
	<footer class="entry-footer">
		<?php blogmagazine_entry_footer( $show_tags ); ?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-<?php the_ID(); ?> -->