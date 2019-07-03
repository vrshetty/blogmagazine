<?php
/*
 * Dglib Ajax related Hook goes here.
 */
if(!function_exists('dglib_reaction_submit_data_callback')):

	function dglib_reaction_submit_data_callback(){

		$response = array(
			'prev_update' => false,
			'current_update' => false,
			'message' => false,
		);

		$_post_values = wp_unslash( $_POST );

        // Verify the nonce before proceeding.
		$dglib_reaction_nonce   = isset( $_post_values['reaction_icon_nonce'] ) ? esc_html($_post_values['reaction_icon_nonce']) : '';
		$dglib_nonce_reaction_action = 'dglib_post_reaction_nonce';

        // Check if nonce is set...
		if ( ! isset( $dglib_reaction_nonce ) ) {
			$response['message'] = esc_html__( 'Nonce doesnot exist.', '__Text_Domain__' );
			wp_send_json($response);
		}

        // Check if nonce is valid...
		if ( ! wp_verify_nonce( $dglib_reaction_nonce, $dglib_nonce_reaction_action ) ) {
			$response['message'] = esc_html__( 'Nonce doesnot match.', '__Text_Domain__' );
			wp_send_json($response);
		}

		$singular_post_id   = isset( $_post_values['singular_post_id'] ) ? absint($_post_values['singular_post_id']) : 0;
		// Check if singular post id is exist...
		if( !$singular_post_id ){
			$response['message'] = esc_html__( 'Post id not found.', '__Text_Domain__' );
			wp_send_json($response);
		}

		$reaction_icon_name   = isset( $_post_values['reaction_icon_name'] ) ? esc_attr($_post_values['reaction_icon_name']) : '';
		// Check if reaction name is exist...
		if( !$reaction_icon_name ){
			$response['message'] = esc_html__( 'Reaction value not found.', '__Text_Domain__' );
			wp_send_json($response);
		}

		$reaction_prev_icon   = isset( $_post_values['reaction_prev_icon'] ) ? esc_attr($_post_values['reaction_prev_icon']) : '';
		// Check if same reaction is already submitted...
		if($reaction_icon_name==$reaction_prev_icon){
			$response['message'] = esc_html__( 'You are already react on this emoji.', '__Text_Domain__' );
			wp_send_json($response);
		}

		$current_reaction_value = get_post_meta( $singular_post_id, 'dglib_reaction_'.$reaction_icon_name.'_values', true );
		$new_current_raction_val = absint($current_reaction_value)+1;
		// Update Current post reaction
		$current_update = update_post_meta( $singular_post_id, 'dglib_reaction_'.$reaction_icon_name.'_values', $new_current_raction_val );
		$response['current_update'] = $current_update;
		if($current_update){
			$response['message'] = esc_html__('Successfully react on emoji.', '__Text_Domain__');
		}
		if($reaction_prev_icon){
			// Update Previous post reaction
			$previous_reaction_value = get_post_meta( $singular_post_id, 'dglib_reaction_'.$reaction_prev_icon.'_values', true );
			$new_previous_reaction_val = absint($previous_reaction_value)-1;
			// Update Current post reaction
			$prev_update = update_post_meta( $singular_post_id, 'dglib_reaction_'.$reaction_prev_icon.'_values', $new_previous_reaction_val );
			$response['prev_update'] = $prev_update;
		}

		wp_send_json($response);
		
	}

endif;
add_action( 'wp_ajax_dglib_reaction_data', 'dglib_reaction_submit_data_callback' );
add_action( 'wp_ajax_nopriv_dglib_reaction_data', 'dglib_reaction_submit_data_callback' );