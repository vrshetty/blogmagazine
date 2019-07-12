<?php
/**
 * The template for displaying header ticker
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.7
 */
?>
<div class="blogmagazine-ticker-wrapper">
	<div class="dg-container">
		<div class="blogmagazine-ticker-block dg-clearfix">
			<?php 
			$blogmagazine_ticker_caption = get_theme_mod( 'blogmagazine_ticker_caption', esc_html__( 'Breaking News', 'blogmagazine' ) );
			$category_id = get_theme_mod( 'blogmagazine_ticker_cat_id', null );
			?>
			<span class="ticker-caption"><?php echo esc_html( $blogmagazine_ticker_caption ); ?></span>
			<div class="ticker-content-wrapper">
				<?php
				$ticker_args = array(
					'post_type'	=> 'post',
					'posts_per_page' => 5,
				);
				if($category_id){
					$ticker_args['tax_query'] = array(
						array(
							'taxonomy'	=> 'category',
							'field'		=> 'term_id',
							'terms'		=>$category_id
						),
					);
				}
				$ticker_query = new WP_Query( $ticker_args );
				if( $ticker_query->have_posts() ) {
					echo '<ul class="blogmagazine-newsticker">';
					while( $ticker_query->have_posts() ) {
						$ticker_query->the_post();
						?>			
						<li><div class="news-ticker-title"><?php blogmagazine_post_categories_list(); ?> <a href="<?php the_permalink(); ?>"><?php the_title();?></a></div></li>
						<?php
					}
					echo '</ul>';
				}
				?>
			</div><!-- .ticker-content-wrapper -->
		</div><!-- .blogmagazine-ticker-block -->
	</div><!-- .dg-container -->
</div><!-- .blogmagazine-ticker-wrapper -->