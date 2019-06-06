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
						$repeater_json[$boxes][$key] = esc_attr( $value );
					}
				}
			}
			return json_encode( $repeater_json );
		}
		return json_encode(array());
	}
}

if(!function_exists('dglib_sanitize_javascript')){
	/**
	 * Function to sanitize javascript
	 * @param $javascript_code
	 * @return sanitize $javascript_code
	 */
	function dglib_sanitize_javascript( $javascript_code ){

		return $javascript_code;

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
