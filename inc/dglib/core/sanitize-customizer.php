<?php
/*
 * Sanitize Repeater Data
 */
if ( ! function_exists( 'dglib_sanitize_repeater_data' ) ){
	function dglib_sanitize_repeater_data( $repeater_value ){
		$repeater_json = json_decode( $repeater_value, true );
		if( !empty( $repeater_json ) ) {
			foreach ( $repeater_json as $boxes => $box ){
				foreach ( $box as $key => $value ){
					if( $key == 'link' || $key == 'image' ){
						$repeater_json[$boxes][$key] = esc_url_raw( $value );
					}
                    elseif ( $key == 'checkbox' ){
						$repeater_json[$boxes][$key] = dglib_sanitize_checkbox( $value );
					}
					else{
						$repeater_json[$boxes][$key] = sanitize_text_field( $value );
					}
				}
			}
			return json_encode( $repeater_json );
		}
		return json_encode(array());
	}
}


/*
 * Sanitize Checkbox Data
 */
if(!function_exists('dglib_sanitize_checkbox')){

	function dglib_sanitize_checkbox($is_checked){

		return ( ( isset( $is_checked ) && true == $is_checked ) ? true : false );

	}

}


/*
 * Sanitize breadcrumbs layout
 */
if( !function_exists('dglib_sanitize_breadcrumbs_layout') ):
	
	function dglib_sanitize_breadcrumbs_layout($customizer_value){

		$return_value = 'layout1';
		switch($customizer_value){
			case 'layout2':
				$return_value = $customizer_value;
				break;
			default:
				$return_value = 'layout1';
				break;
		}

		return $return_value;

	}

endif;

/*
 * Sanitize reaction type
 */
if( !function_exists('dglib_sanitize_reaction_type') ):
	
	function dglib_sanitize_reaction_type($customizer_value){

		$return_value = 'percentage';
		switch($customizer_value){
			case 'total_number':
				$return_value = $customizer_value;
				break;
			default:
				$return_value = 'percentage';
				break;
		}

		return $return_value;

	}

endif;
