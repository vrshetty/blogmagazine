<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description TEXTAREA field for widget
 */
$dg_widget_field_row  = (isset($dg_widget_field_row)) ? $dg_widget_field_row : 10;
?>
<p class="dg-widget-field-wrapper <?php echo esc_attr($dg_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ); ?>">
		<?php echo esc_html( $dg_widget_field_title ); ?>:
	</label>
	<textarea class="widefat <?php echo esc_attr($dg_widget_relation_class); ?>" rows="<?php echo intval( $dg_widget_field_row ); ?>" id="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ); ?>" name="<?php echo esc_attr( $dglibwidget->get_field_name( $dg_widget_field_name ) ); ?>" data-relations="<?php echo esc_attr($dg_widget_relation_json) ?>" ><?php echo esc_html( $dg_widget_field_value ); ?></textarea>
</p>