<?php
/*
 * Dglib Ajax related Hook goes here.
 */
if(!function_exists('dglib_megamenu_posts_callback')):

	function dglib_megamenu_posts_callback(){

		$response = array(
			'message' => false,
			'post_value' => $_POST,
		);

        // Verify the nonce before proceeding.
		$megamenu_nonce_value   = isset( $_POST['megamenu_nonce_value'] ) ? esc_html($_POST['megamenu_nonce_value']) : '';
		$dglib_nonce_megamenu_action = 'dglib_megamenu_posts_nonce';

        // Check if nonce is set...
		if ( ! isset( $megamenu_nonce_value ) ) {
			$response['message'] = esc_html__( 'Nonce doesnot exist.', 'blogmagazine' );
			wp_send_json($response);
		}

        // Check if nonce is valid...
		if ( ! wp_verify_nonce( $megamenu_nonce_value, $dglib_nonce_megamenu_action ) ) {
			$response['message'] = esc_html__( 'Nonce doesnot match.', 'blogmagazine' );
			wp_send_json($response);
		}

		$paged = (isset($_POST['paged']) ) ? absint($_POST['paged']) : 1;

		$terms = (is_array($_POST['term_ids'])) ? array_map( 'absint', wp_unslash( $_POST['term_ids'] ) ) : absint($_POST['term_ids']);
		$args = array(
			'paged' 	=> $paged,
			'post_type' => 'post',
			'posts_per_page' => (isset($_POST['posts_per_page'])) ? absint($_POST['posts_per_page']) : 4,
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field'		=> 'term_id',
					'terms'		=> $terms,
					'operator' => 'IN',
				)
			),
		);

		$query = new WP_Query($args);
		$megamenu_html = '';
		if($query->have_posts()):

			while($query->have_posts()): $query->the_post();

				$featured_image_class = (has_post_thumbnail()) ? 'has-image' : 'no-image';
				$megamenu_html .= '<div class="'.join( ' ', get_post_class( 'dglib-post-single', get_the_ID() ) ).'">';
				$megamenu_html .= '<figure class="megamenu_featured_image">';
				$megamenu_html .= '<a href="'.get_the_permalink().'" class="'.esc_attr($featured_image_class).'">';
				$megamenu_html .= get_the_post_thumbnail( null, 'dglib-thumb-400x300', '' );
				$megamenu_html .= '</a>';
				$megamenu_html .= '</figure>';
				$megamenu_html .= '<h5 class="dglib-megamenu-post-title">';
				$megamenu_html .= '<a href="'.get_the_permalink().'">';
				$megamenu_html .= get_the_title();
				$megamenu_html .= '</a>';
				$megamenu_html .= '</h5>';
				//$megamenu_html .= get_the_tag_list('<ul class="post-tags-list"><li class="tags-button">','</li><li class="tags-button">','</li></ul>');
				$megamenu_html .= '</div>';

			endwhile;
			$response['megamenu_args'] = $args;
			$response['megamenu_html'] = $megamenu_html;

		endif;
		$response['megamenu_html'] = $megamenu_html;
		wp_send_json($response);
		
	}

endif;
add_action( 'wp_ajax_dglib_megamenu_posts', 'dglib_megamenu_posts_callback' );
add_action( 'wp_ajax_nopriv_dglib_megamenu_posts', 'dglib_megamenu_posts_callback' );