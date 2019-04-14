<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description this file for color field
 */
?>
<p class="dg-widget-field-wrapper dg-color-field-wrapper <?php echo esc_attr($dg_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $centurywidget->get_field_id( $dg_widget_field_name ) ); ?>">
		<?php echo esc_html( $dg_widget_field_title ); ?>:
	</label>
	<input class="widefat dg-color-picker <?php echo esc_attr($dg_widget_relation_class); ?>" id="<?php echo esc_attr( $centurywidget->get_field_id( $dg_widget_field_name ) ); ?>" name="<?php echo esc_attr( $centurywidget->get_field_name( $dg_widget_field_name ) ); ?>" type="text" value="<?php echo sanitize_hex_color( $dg_widget_field_value ); ?>"  data-relations="<?php echo esc_attr($dg_widget_relation_json) ?>"/>
	<?php if ( isset( $dg_widget_field_description ) ) { ?>
		<br/>
		<small><?php echo esc_html( $dg_widget_field_description ); ?></small>
	<?php } ?>
</p>