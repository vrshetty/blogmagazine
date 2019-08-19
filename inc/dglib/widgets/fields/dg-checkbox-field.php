<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description this file for checkbox field
 */
?>
<p class="dg-widget-field-wrapper <?php echo esc_attr($dg_widget_field_wraper); ?>">
	<input class="<?php echo esc_attr($dg_widget_relation_class); ?>" id="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ); ?>" name="<?php echo esc_attr( $dglibwidget->get_field_name( $dg_widget_field_name ) ); ?>" type="checkbox" value="1" <?php checked( '1', $dg_widget_field_value ); ?> data-relations="<?php echo esc_attr($dg_widget_relation_json) ?>"/>
	<label for="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ); ?>">
		<?php echo esc_html( $dg_widget_field_title ); ?>
	</label>
	<?php if ( isset( $dg_widget_field_description ) ) { ?>
		<br/>
		<small><?php echo wp_kses_post( $dg_widget_field_description ); ?></small>
	<?php } ?>
</p>