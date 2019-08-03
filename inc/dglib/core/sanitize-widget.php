<?php
/**
 * Function to sanitize number
 *
 * @since 1.0.0
 *
 * @param $dglib_input
 * @param $dglib_setting
 * @return int || float || numeric value
 *
 */
if ( ! function_exists( 'dglib_sanitize_number' ) ) :
	function dglib_sanitize_number ( $dglib_input ) {
		$dglib_sanitize_text = sanitize_text_field( $dglib_input );
		// If the input is an number, return it; otherwise, return the default
		return ( is_numeric( $dglib_sanitize_text ) ? $dglib_sanitize_text : 0 );
	}
endif;

/**
 * Function to sanitize textarea
 *
 * @since 1.0.0
 *
 * @param $new_field_value
 * @return array
 *
 */
if ( ! function_exists( 'dglib_sanitize_textarea' ) ) :
	function dglib_sanitize_textarea ( $new_field_value ) {
		$dg_widgets_allowed_tags = array(
			'p' => array(),
			'em' => array(),
			'strong' => array(),
			'a' => array(
				'href' => array(),
			),
		);
		return wp_kses( $new_field_value, $dg_widgets_allowed_tags );
	}
endif;

/**
 * Function to sanitize multitermlist
 *
 * @since 1.0.0
 *
 * @param $new_field_value
 * @return array
 *
 */
if ( ! function_exists( 'dglib_sanitize_multitermlist' ) ) :
	function dglib_sanitize_multitermlist ( $new_field_value ) {
		$multi_term_list = array();
			if(is_array($new_field_value)){
				foreach($new_field_value as $key=>$value){
					$multi_term_list[] = absint($value);
				}
			}
			return $multi_term_list;
	}
endif;

/**
 * Function to sanitize multiselect
 *
 * @since 1.0.0
 *
 * @param $new_field_value
 * @return array
 *
 */
if( ! function_exists( 'dglib_sanitize_multiselect' ) ) :
	function dglib_sanitize_multiselect ( $new_field_value ) {
		$multiselect_list = array();
		if(is_array($new_field_value)){
			foreach($new_field_value as $key=>$value){
				$multiselect_list[] = sanitize_text_field($value);
			}
		}
		return $multiselect_list;
	}
endif;

/**
 * Function to sanitize accordion
 *
 * @since 1.0.0
 *
 * @param $new_field_value
 * @return array
 *
 */
if( ! function_exists( 'dglib_sanitize_accordion' ) ) :
	function dglib_sanitize_accordion( $new_field_value ) {
		$dropdown_accordions = array();
		if(is_array($new_field_value)){
			foreach($new_field_value as $key=>$value){
				$dropdown_accordions[] = sanitize_text_field($value);
			}
		}
		return $dropdown_accordions;
	}
endif;

/**
 * Function to sanitize repeater
 *
 * @since 1.0.0
 *
 * @param $new_field_value
 * @return array
 *
 */
if( ! function_exists( 'dglib_sanitize_repeater' ) ) :
	function dglib_sanitize_repeater($widget_field, $new_field_value ) {
		$sanitize_repeater_value = array();
		if(count($new_field_value) && is_array($new_field_value)){
			foreach($new_field_value as $row_index=>$repeater_row){
				$repeater_fields = $widget_field['dg_widget_field_options'];
				foreach($repeater_fields as $fields_key=>$repeater_field){

					$repeater_field_type = isset($repeater_field['dg_widget_field_type']) ? $repeater_field['dg_widget_field_type'] : '';
					$repeater_field_name = isset($repeater_field['dg_widget_field_name']) ? $repeater_field['dg_widget_field_name'] : '';
					$repeater_field_value = isset($repeater_row[$repeater_field_name]) ? $repeater_row[$repeater_field_name] : '';
					$sanitize_repeater_value[$row_index][$repeater_field_name] = dg_widgets_updated_field_value( $repeater_field,  $repeater_field_value);

				}
			}
		}
		return $sanitize_repeater_value;
	}
endif;

/**
 * Function to sanitize target
 *
 * @since 1.0.0
 *
 * @param $link_target
 * @return array
 *
 */
if( ! function_exists( 'dglib_sanitize_link_target' ) ) :
	function dglib_sanitize_link_target( $target_value ) {
		
		$new_field_value = '';
		switch ($target_value){
			case '_blank':
			case '_self':
				$new_field_value = $target_value;
				break;
			default:
				$new_field_value = '';
				break;
		}

		return $new_field_value;

	}
endif;