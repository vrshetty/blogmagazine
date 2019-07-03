<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description show widget fueld field for widget
 */
function dg_widgets_show_widget_field( $centurywidget = '', $widget_field = '', $dg_widget_field_value = '' ){

	extract( $widget_field );

	$dg_widget_field_wraper = isset($dg_widget_field_wraper) ? $dg_widget_field_wraper : '';
	$dg_widget_field_relation = isset($dg_widget_field_relation) ? $dg_widget_field_relation : array();
	$dg_widget_relation_json = wp_json_encode( $dg_widget_field_relation);
	$dg_widget_relation_class = ($dg_widget_field_relation) ? 'dg_widget_field_relation' : '';
	
	$widget_fild_path = dglib_file_directory('widgets/fields/dg-'.$dg_widget_field_type.'-field.php');
	if( file_exists($widget_fild_path) ){
		require $widget_fild_path;
	}else{
		?>
		<p><?php echo esc_html__('Field type', '__Text_Domain__').' '.esc_attr($dg_widget_field_type).' '.esc_html__('Not found.', '__Text_Domain__'); ?></p>
		<?php
	}

}

function dg_widgets_updated_field_value( $widget_field, $new_field_value ){

	$dg_widget_field_type = '';

	extract( $widget_field );

	switch ( $dg_widget_field_type ) {
		// Allow only integers in number fields
		case 'number':
			return dglib_sanitize_number( $new_field_value, $widget_field );
			break;
		// Allow some tags in textareas
		case 'textarea':
			return dglib_sanitize_textarea($new_field_value);
			break;
		// No allowed tags for all other fields
		case 'url':
			return esc_url_raw( $new_field_value );
			break;
		case 'multitermlist':
			return dglib_sanitize_multitermlist($new_field_value);
			break;
		case 'multiselect':
			return dglib_sanitize_multiselect($new_field_value);
			break;
		case 'accordion':
			return dglib_sanitize_accordion($new_field_value);
			break;
		case 'repeater':
			return dglib_sanitize_repeater($widget_field, $new_field_value );
			break;
		default:
			return wp_kses_post( sanitize_text_field( $new_field_value ) );

	}
}