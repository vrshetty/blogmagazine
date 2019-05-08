<?php
/**
 * Custom hooks functions are define.
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Related Posts start
 *
 * @since 1.0.2
 */
if( ! function_exists( 'blogmagazine_related_posts_start' ) ) :
	function blogmagazine_related_posts_start() {
		echo '<div class="blgmg-related-section-wrapper">';
	}
endif;

/**
 * Related Posts section
 *
 * @since 1.0.2
 */
if( ! function_exists( 'blogmagazine_related_posts_section' ) ) :
	function blogmagazine_related_posts_section() {

		$blogmagazine_related_option = get_theme_mod( 'blogmagazine_related_posts_option', 'show' );
		$blogmagazine_taxonomy_type = get_theme_mod( 'blogmagazine_related_posts_from', 'category' );
		
		global $post;
        if( empty( $post ) ) {
            $post_id = '';
        } else {
            $post_id = $post->ID;
        }

        $all_term_list = get_the_terms( $post_id, $blogmagazine_taxonomy_type );

		if( $blogmagazine_related_option == 'hide' ) {
			return;
		}

		if( empty( $all_term_list ) && $blogmagazine_taxonomy_type != 'post_format' ) {
			return;
		}

		$blogmagazine_related_title = get_theme_mod( 'blogmagazine_related_posts_title', esc_html__( 'Related Posts', 'blogmagazine' ) );
		if( !empty( $blogmagazine_related_title ) ) {
			echo '<h2 class="blogmagazine-block-title"><span class="title-wrapper">'. esc_html( $blogmagazine_related_title ) .'</span></h2>';
		}
        
        $term_ids = array();
        if ( $all_term_list ) {
            foreach( $all_term_list as $category_ed ) {
                $term_ids[] = $category_ed->term_id;
            }
        }

		$blogmagazine_post_count = apply_filters( 'blogmagazine_related_posts_count', 3 );
		
		$related_args = array(
			'no_found_rows'            	=> true,
			//'update_post_meta_cache'   	=> false,
			//'update_post_term_cache'   	=> false,
			'ignore_sticky_posts'      	=> 1,
			'orderby'                  	=> 'rand',
			'post__not_in'             	=> array( $post_id ),
			'posts_per_page' 		   	=> $blogmagazine_post_count
		);
		if( $blogmagazine_taxonomy_type == 'post_format' ){
			$post_format  = get_post_format( $post_id );
			if($post_format){
				$post_format_operator = 'IN';
			}else{
				$post_format = array(
					'aside',
					'chat',
					'gallery',
					'link',
					'image',
					'quote',
					'status',
					'video',
					'audio',
				);
				$post_format_operator = 'NOT IN';
			}
			$related_args['tax_query'] =  array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => $post_format,
					'operator' => $post_format_operator,
				),
			);
			
		}else{
			$related_args['tax_query'] =  array(
				'relation' => 'AND',
				array(
					'taxonomy' => $blogmagazine_taxonomy_type,
					'field'    => 'term_id',
					'terms'    => $term_ids,
					'operator' => 'IN',
				),
			);
		}
		$related_query = new WP_Query( $related_args );
		if( $related_query->have_posts() ) {
			echo '<div class="blgmg-related-posts-wrap dg-clearfix">';
			while( $related_query->have_posts() ) {
				$related_query->the_post();
	?>
				<div class="blogmagazine-single-post dg-clearfix">
					<div class="blogmagazine-post-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'blogmagazine-block-medium' ); ?>
						</a>
					</div><!-- .blogmagazine-post-thumb -->
					<div class="blogmagazine-post-content">
						<h3 class="blogmagazine-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="blogmagazine-post-meta">
							<?php blogmagazine_posted_on(); ?>
						</div>
					</div><!-- .blogmagazine-post-content -->
				</div><!-- .blogmagazine-single-post -->
	<?php
			}
			echo '</div><!-- .blgmg-related-posts-wrap -->';
		}
		wp_reset_postdata();
	}
endif;

/**
 * Related Posts end
 *
 * @since 1.0.2
 */
if( ! function_exists( 'blogmagazine_related_posts_end' ) ) :
	function blogmagazine_related_posts_end() {
		echo '</div><!-- .blgmg-related-section-wrapper -->';
	}
endif;

/**
 * Managed functions for related posts section
 *
 * @since 1.0.2
 */
add_action( 'blogmagazine_related_posts', 'blogmagazine_related_posts_start', 10 );
add_action( 'blogmagazine_related_posts', 'blogmagazine_related_posts_section', 20 );
add_action( 'blogmagazine_related_posts', 'blogmagazine_related_posts_end', 30 );