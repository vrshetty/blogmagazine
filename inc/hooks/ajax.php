<?php
/*
 * Dglib Ajax related Hook goes here.
 */
if(!function_exists('blogmagazine_block_posts_tabs_callback')):

	function blogmagazine_block_posts_tabs_callback(){

		$block_layout   = isset( $_POST['block_layout'] ) ? esc_attr($_POST['block_layout']) : '';
		$thumbnail_size   = isset( $_POST['thumbnail_size'] ) ? esc_attr($_POST['thumbnail_size']) : '';
		$largeimg_size   = isset( $_POST['largeimg_size'] ) ? esc_attr($_POST['largeimg_size']) : '';
		$excerpt_length   = isset( $_POST['excerpt_length'] ) ? absint($_POST['excerpt_length']) : '';
		$posts_per_page   = isset( $_POST['posts_per_page'] ) ? absint($_POST['posts_per_page']) : 6;
		$terms_ids   = isset( $_POST['terms_ids'] ) ? absint($_POST['terms_ids']) : '';

		$response = array(
			'request' => $_POST,
			'is_success' => false,
			'widget_html' => false,
		);
        // Verify the nonce before proceeding.
		$block_posts_nonce   = isset( $_POST['block_posts_nonce'] ) ? esc_html($_POST['block_posts_nonce']) : '';
		$block_posts_action = 'blogmagazine_block_post_tabs_nonce';

        // Check if nonce is set...
		if ( ! isset( $block_posts_nonce ) ) {
			$response['is_success'] = esc_html__( 'Nonce doesnot exist.', 'blogmagazine' );
			wp_send_json($response);
		}

        // Check if nonce is valid...
		if ( ! wp_verify_nonce( $block_posts_nonce, $block_posts_action ) ) {
			$response['is_success'] = esc_html__( 'Nonce doesnot match.', 'blogmagazine' );
			wp_send_json($response);
		}

		ob_start();
		$blogmagazine_args = array(
			'terms_ids' => $terms_ids,
			'thumbnail_size' => $thumbnail_size,
			'largeimg_size' => $largeimg_size,
			'excerpt_length' => $excerpt_length,
		);
		?><div class="blogmagazine-block-posts-wrapper blgmg-tab-term-<?php echo absint($terms_ids); ?> tab-active"><?php
		switch ( $block_layout ){
			case 'layout2':
			blogmagazine_block_second_layout_section( $blogmagazine_args );
			break;
			case 'layout3':
			blogmagazine_block_box_layout_section( $blogmagazine_args );
			break;
			case 'layout4':
			blogmagazine_block_alternate_grid_section( $blogmagazine_args );
			break;
			default:
			blogmagazine_block_first_layout_section( $blogmagazine_args );
			break;
		}
		?></div><?php
		$widget_html = ob_get_clean();
		if($widget_html){
			$response['widget_html'] = $widget_html;
		}
		wp_send_json($response);
		
	}

endif;
add_action( 'wp_ajax_blogmagazine_block_posts_tabs', 'blogmagazine_block_posts_tabs_callback' );
add_action( 'wp_ajax_nopriv_blogmagazine_block_posts_tabs', 'blogmagazine_block_posts_tabs_callback' );