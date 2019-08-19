<?php
/**
 * Custom hooks functions for different layout in widget section.
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */

/**
 * Widget Title
 *
 * @since 1.0.0
 */

if( ! function_exists( 'blogmagazine_widget_title_callback' ) ) :

	function blogmagazine_widget_title_callback( $title_args ){

		do_action('dglib_widget_title', $title_args );

	}

endif;

add_action( 'blogmagazine_widget_title', 'blogmagazine_widget_title_callback' );

/**
 * Block Default Layout
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_block_first_layout_section' ) ) :

	function blogmagazine_block_first_layout_section( $blogmagazine_args ) {

		$terms_ids = $blogmagazine_args['terms_ids'];
		$thumbnail_size = $blogmagazine_args['thumbnail_size'];
		$largeimg_size = $blogmagazine_args['largeimg_size'];
		$excerpt_length = $blogmagazine_args['excerpt_length'];
		$posts_page_page = 6;
		$block_args = array(
			'post_type' => 'post',
			'posts_per_page' => absint( $posts_page_page ),
		);
		if( ! empty( $terms_ids ) ){
			$block_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $terms_ids,
					'operator' => 'IN',
				),
			);
		}
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if( $block_query->have_posts() ) {
			$post_count = 1;
			while( $block_query->have_posts() ) {
				$block_query->the_post();
				if( $post_count == 1 ){
					echo '<div class="blogmagazine-primary-block-wrap">';
					$title_size = 'large-size';
				} elseif( $post_count == 2 ) {
					echo '<div class="blogmagazine-secondary-block-wrap">';
					$title_size = 'small-size';
				} else {
					$title_size = 'small-size';
				}
				?>
				<div class="blogmagazine-single-post dg-clearfix">
					<div class="blogmagazine-post-thumb">
						<?php $thumbnail_class = (has_post_thumbnail()) ? 'has-thumb' : 'no-thumb'; ?>
						<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr($thumbnail_class); ?>">
							<?php 
							if( $post_count == 1 ) {
								the_post_thumbnail( $largeimg_size );
							} else {
								the_post_thumbnail( $thumbnail_size );
							}
							?>
						</a>
					</div><!-- .blogmagazine-post-thumb -->
					<div class="blogmagazine-post-content">
						<h3 class="blogmagazine-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="blogmagazine-post-meta"><?php blogmagazine_posted_on(); ?></div>
						<?php if( $post_count == 1 ) { ?>
							<div class="blogmagazine-post-excerpt"><?php dglib_the_excerpt($excerpt_length); ?></div>
						<?php } ?>
					</div><!-- .blogmagazine-post-content -->
				</div><!-- .blogmagazine-single-post -->
				<?php
				if( $post_count == 1 ) {
					echo '</div><!-- .blogmagazine-primary-block-wrap -->';
				} elseif( $post_count == $total_posts_count ) {
					echo '</div><!-- .blogmagazine-secondary-block-wrap -->';
				}
				$post_count++;
			}
		}
		wp_reset_postdata();
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Second Layout
 *
 * @since 1.0.0
 */

if( ! function_exists( 'blogmagazine_block_second_layout_section' ) ) :
	function blogmagazine_block_second_layout_section( $blogmagazine_args ) {

		$terms_ids = $blogmagazine_args['terms_ids'];
		$thumbnail_size = $blogmagazine_args['thumbnail_size'];
		$largeimg_size = $blogmagazine_args['largeimg_size'];
		$excerpt_length = $blogmagazine_args['excerpt_length'];
		$posts_page_page = 6;
		$block_args = array(
			'post_type' => 'post',
			'posts_per_page' => absint( $posts_page_page ),
		);
		if( ! empty( $terms_ids ) ) {
			$block_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $terms_ids,
					'operator' => 'IN',
				),
			);
		}
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if( $block_query->have_posts() ) {
			$post_count = 1;
			while( $block_query->have_posts() ) {
				$block_query->the_post();
				if( $post_count == 1 ) {
					echo '<div class="blogmagazine-primary-block-wrap">';
				} elseif( $post_count == 3 ) {
					echo '<div class="blogmagazine-secondary-block-wrap">';
				}
				if( $post_count <= 2 ) {
					$title_size = 'large-size';
				} else {
					$title_size = 'small-size';
				}
				?>
				<div class="blogmagazine-single-post dg-clearfix">
					<div class="blogmagazine-post-thumb">
						<?php $thumbnail_class = (has_post_thumbnail()) ? 'has-thumb' : 'no-thumb'; ?>
						<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr($thumbnail_class); ?>">
							<?php 
							if( $post_count <= 2 ){
								the_post_thumbnail( $largeimg_size );
							}else{
								the_post_thumbnail( $thumbnail_size );
							}
							?>
						</a>
					</div><!-- .blogmagazine-post-thumb -->
					<div class="blogmagazine-post-content">
						<h3 class="blogmagazine-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="blogmagazine-post-meta"><?php blogmagazine_posted_on(); ?></div>
						<?php if( $post_count <= 2 ) { ?>
							<div class="blogmagazine-post-excerpt"><?php dglib_the_excerpt($excerpt_length); ?></div>
						<?php } ?>
					</div><!-- .blogmagazine-post-content -->
				</div><!-- .blogmagazine-single-post -->
				<?php
				if( $post_count == 2 ){
					echo '</div><!-- .blogmagazine-primary-block-wrap -->';
				}elseif( $post_count == $total_posts_count ){
					echo '</div><!-- .blogmagazine-secondary-block-wrap -->';
				}
				$post_count++;
			}
		}
		wp_reset_postdata();
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Box Layout
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_block_box_layout_section' ) ) :

	function blogmagazine_block_box_layout_section( $blogmagazine_args ) {
		$terms_ids = $blogmagazine_args['terms_ids'];
		$thumbnail_size = $blogmagazine_args['thumbnail_size'];
		$largeimg_size = $blogmagazine_args['largeimg_size'];
		$excerpt_length = $blogmagazine_args['excerpt_length'];
		$posts_page_page = apply_filters( 'blogmagazine_block_box_posts_count', 4 );
		$block_args = array(
			'post_type' => 'post',
			'posts_per_page' => absint( $posts_page_page ),
		);
		if( ! empty( $terms_ids ) ) {
			$block_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $terms_ids,
					'operator' => 'IN',
				),
			);
		}
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if( $block_query->have_posts() ) {
			$post_count = 1;
			while( $block_query->have_posts() ) {
				$block_query->the_post();
				if( $post_count == 1 ) {
					echo '<div class="blogmagazine-primary-block-wrap">';
					$title_size = 'large-size';
				} elseif( $post_count == 2 ) {
					echo '<div class="blogmagazine-secondary-block-wrap dg-clearfix">';
					$title_size = 'small-size';
				} else {
					$title_size = 'small-size';
				}
				?>
				<div class="blogmagazine-single-post">
					<div class="blogmagazine-post-thumb">
						<?php $thumb_class = (has_post_thumbnail()) ? 'has-thumb' : 'no-thumb' ?>
						<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr($thumb_class); ?>">
							<?php 
							if( $post_count == 1 ) {
								the_post_thumbnail( $largeimg_size );
							} else {
								the_post_thumbnail( $thumbnail_size );
							}
							?>
						</a>
					</div><!-- .blogmagazine-post-thumb -->
					<div class="blogmagazine-post-content">
						<h3 class="blogmagazine-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="blogmagazine-post-meta"><?php blogmagazine_posted_on(); ?></div>
					</div><!-- .blogmagazine-post-content -->
				</div><!-- .blogmagazine-single-post -->
				<?php
				if( $post_count == 1 ) {
					echo '</div><!-- .blogmagazine-primary-block-wrap -->';
				} elseif( $post_count == $total_posts_count ) {
					echo '</div><!-- .blogmagazine-secondary-block-wrap -->';
				}
				$post_count++;
			}
		}
		wp_reset_postdata();
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block alternate grid
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_block_alternate_grid_section' ) ) :
	function blogmagazine_block_alternate_grid_section( $blogmagazine_args ) {
		$terms_ids = $blogmagazine_args['terms_ids'];
		$thumbnail_size = $blogmagazine_args['thumbnail_size'];
		$largeimg_size = $blogmagazine_args['largeimg_size'];
		$excerpt_length = $blogmagazine_args['excerpt_length'];
		$posts_page_page = apply_filters( 'blogmagazine_block_alternate_grid_posts_count', 3 );
		$block_args = array(
			'post_type' => 'post',
			'posts_per_page' => absint( $posts_page_page ),
		);
		if( $terms_ids ){
			$block_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $terms_ids,
					'operator' => 'IN',
				),
			);
		}
		$block_query = new WP_Query( $block_args );
		$total_posts_count = $block_query->post_count;
		if( $block_query->have_posts() ) {
			while( $block_query->have_posts() ) {
				$block_query->the_post();
				?>
				<div class="blogmagazine-alt-grid-post blogmagazine-single-post dg-clearfix">
					<div class="blogmagazine-post-thumb">
						<a href="<?php the_permalink(); ?>" class="<?php echo (has_post_thumbnail()) ? 'has-thumb' : 'no-thumb' ?>">
							<?php the_post_thumbnail( $thumbnail_size ); ?>
						</a>
					</div><!-- .blogmagazine-post-thumb -->
					<div class="blogmagazine-post-content">
						<h3 class="blogmagazine-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="blogmagazine-post-meta"><?php blogmagazine_posted_on(); ?></div>
						<div class="blogmagazine-post-excerpt"><?php dglib_the_excerpt($excerpt_length, false); ?></div>
					</div><!-- .blogmagazine-post-content -->
				</div><!-- .blogmagazine-single-post -->
				<?php
			}
		}
		wp_reset_postdata();
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Carousel Default Layout
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_carousel_default_layout_section' ) ) :
	function blogmagazine_carousel_default_layout_section( $blogmagazine_block_args ) {
		$query_args = (isset($blogmagazine_block_args['query_args'])) ? $blogmagazine_block_args['query_args'] : array();
		if(!$query_args){
			return;
		}
		$thumbnail_size = (isset($blogmagazine_block_args['thumbnail_size'])) ? $blogmagazine_block_args['thumbnail_size'] : 'blogmagazine-thumb-800x600';
		$no_of_columns = (isset($blogmagazine_block_args['no_of_columns'])) ? absint($blogmagazine_block_args['no_of_columns']) : 4;


		$carousel_config = array(
			'auto'			=> true,
			'loop'			=> true,
			'speed'			=> 2000,
			'pause'			=> 6000,
			'pager'			=> false,
			'slideMargin'	=> 15,
			'controls'		=> false,
			'pauseOnHover'	=> true,
			'adaptiveHeight'=> true,
			'item'			=> $no_of_columns,
		);
		$blogmagazine_block_query = new WP_Query( $query_args );
		if( $blogmagazine_block_query->have_posts() ){
			?><ul class="blogmagazine-block-carousel column<?php echo absint($no_of_columns); ?>" data-config="<?php echo esc_attr( json_encode( $carousel_config ) ); ?>"><?php
			while( $blogmagazine_block_query->have_posts() ){
				$blogmagazine_block_query->the_post();
				?>
				<li>
					<div class="blogmagazine-single-post dg-clearfix">
						<div class="blogmagazine-post-thumb">
							<?php $thumbnail_class  = (has_post_thumbnail()) ? 'has-thumbnail' : 'no-thumbnail'; ?>
							<a href="<?php the_permalink(); ?>" class="<?php echo esc_attr($thumbnail_class); ?>">
								<?php the_post_thumbnail( $thumbnail_size ); ?>
							</a>
						</div><!-- .blogmagazine-post-thumb -->
						<div class="blogmagazine-post-content">
							<?php blogmagazine_post_categories_list(); ?>
							<h3 class="blogmagazine-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="blogmagazine-post-meta"><?php blogmagazine_posted_on(); ?></div>
						</div><!-- .blogmagazine-post-content -->
					</div><!-- .blogmagazine-single-post -->
				</li>
				<?php
			}
			?></ul><?php
		}
		wp_reset_postdata();
	}
endif;

