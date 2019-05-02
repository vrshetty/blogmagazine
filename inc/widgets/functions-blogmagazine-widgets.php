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

		extract($title_args);
		$title = (isset($title_args['title'])) ? $title_args['title'] : '';
		$title_target = (isset($title_args['title_target'])) ? $title_args['title_target'] : '';
		$title_link = (isset($title_args['title_link'])) ? $title_args['title_link'] : '';
		$before_title = (isset($title_args['before_title'])) ? $title_args['before_title'] : '';
		$after_title = (isset($title_args['after_title'])) ? $title_args['after_title'] : '';
		$slider_nav = (isset($title_args['slider_nav'])) ? $title_args['slider_nav'] : '';
		$title_terms = (isset($title_args['title_terms'])) ? $title_args['title_terms'] : '';
		$tab_default_label = (isset($title_args['tab_default_label'])) ? $title_args['tab_default_label'] : esc_html__('Default', 'blogmagazine');
		$tab_taxonomy = (isset($title_args['tab_taxonomy'])) ? $title_args['tab_taxonomy'] : 'category';
		$tab_ajax_data = (isset($title_args['tab_ajax_data'])) ? $title_args['tab_ajax_data'] : array();

		if ( ! empty( $title ) ){
			echo $before_title; 
			if($title_target && $title_link){
				?><a href="<?php echo esc_url($title_link); ?>" target="<?php echo esc_attr($title_target); ?>"><?php 
			}
			echo esc_html( $title );
			if($title_target){
				?></a><?php 
			}
			$title_other_html = '';
			if($title_terms && $tab_taxonomy){
				$title_other_html .= '<ul class="wdgt-title-tabs">';
				foreach($title_terms as $tab_term_id){
					$tab_ajax_data['data']['terms_ids'] = $tab_term_id;
					$tab_term_detail = get_term_by( 'id', absint( $tab_term_id ), $tab_taxonomy );
					$title_other_html .= '<li class="wdgt-tab-term">';
					$title_other_html .= '<a data-tab="blgmg-tab-term-'.absint($tab_term_id).'" class="dgwidgt-title-tab" data-ajax-args=\'' . json_encode($tab_ajax_data) . '\' href="'.get_term_link($tab_term_id, $tab_taxonomy).'">';
					$title_other_html .= $tab_term_detail->name;
					$title_other_html .= '</a>';
					$title_other_html .= '</li>';
				}
				$title_other_html .= '<li class="wdgt-tab-term active-item">';
				$title_other_html .= '<a data-tab="blgmg-tab-alldata" class="dgwidgt-title-tab" href="#">';
				$title_other_html .= $tab_default_label;
				$title_other_html .= '</a>';
					$title_other_html .= '</li>';
				$title_other_html .= '</ul>';
			}

			if($slider_nav){
				$title_other_html .= '<div class="carousel-nav-action">';
				$title_other_html .= '<span class="blogmagazine-nav-prev blogmagazine-carousel-control">';
				$title_other_html .= '<i class="fa fa-angle-left"></i>';
				$title_other_html .= '</span>';
				$title_other_html .= '<span class="blogmagazine-nav-next blogmagazine-carousel-control">';
				$title_other_html .= '<i class="fa fa-angle-right"></i>';
				$title_other_html .= '</span>';
				$title_other_html .= '</div>';
			}

			if($title_other_html){
				$replace_tag = '</h2>';
				if(stripos( $after_title, $replace_tag ) !== false ){
					$after_title = str_replace( $replace_tag, $title_other_html.$replace_tag, $after_title );
				}else{
					$replace_tag = '</h3>';
					$after_title = str_replace( $replace_tag, $title_other_html.$replace_tag, $after_title );
				}
			}
			echo $after_title;
		}
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
							<div class="blogmagazine-post-excerpt"><?php the_excerpt(); ?></div>
						<?php } ?>
					</div><!-- .blogmagazine-post-content -->
				</div><!-- .blogmagazine-single-post -->
				<?php
				if( $post_count == 2 ) {
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
		if( empty( $terms_ids ) ) {
			return;
		}
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
		if( empty( $terms_ids ) ) {
			return;
		}
		$posts_page_page = apply_filters( 'blogmagazine_block_alternate_grid_posts_count', 3 );
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
		$thumbnail_size = (isset($blogmagazine_block_args['thumbnail_size'])) ? $blogmagazine_block_args['thumbnail_size'] : 'blogmagazine-thumb-800x600';
		$blogmagazine_block_query = new WP_Query( $query_args );
		if( $blogmagazine_block_query->have_posts() ) {
			echo '<ul class="blogmagazine-block-carousel">';
			while( $blogmagazine_block_query->have_posts() ){
				$blogmagazine_block_query->the_post();
				?>
				<li>
					<div class="blogmagazine-single-post dg-clearfix">
						<div class="blogmagazine-post-thumb">
							<a href="<?php the_permalink(); ?>">
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
			echo '</ul>';
		}
		wp_reset_postdata();
	}
endif;

/**
 * Block Second Layout
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_block_second_layout_section' ) ) :
	function blogmagazine_block_second_layout_section( $terms_ids ) {
		if( empty( $terms_ids ) ) {
			return;
		}
		$posts_page_page = apply_filters( 'blogmagazine_block_second_layout_posts_count', 6 );
		$block_args = array(
			'cat' => $terms_ids,
			'posts_per_page' => absint( $posts_page_page ),
		);
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
						<a href="<?php the_permalink(); ?>">
							<?php 
							if( $post_count <= 2 ) {
								the_post_thumbnail( 'blogmagazine-thumb-622x420' );
							} else {
								the_post_thumbnail( 'blogmagazine-thumb-136x102' );
							}
							?>
						</a>
					</div><!-- .blogmagazine-post-thumb -->
					<div class="blogmagazine-post-content">
						<h3 class="blogmagazine-post-title <?php echo esc_attr( $title_size ); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="blogmagazine-post-meta"><?php blogmagazine_posted_on(); ?></div>
						<?php if( $post_count <= 2 ) { ?>
							<div class="blogmagazine-post-excerpt"><?php the_excerpt(); ?></div>
						<?php } ?>
					</div><!-- .blogmagazine-post-content -->
				</div><!-- .blogmagazine-single-post -->
				<?php
				if( $post_count == 2 ) {
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