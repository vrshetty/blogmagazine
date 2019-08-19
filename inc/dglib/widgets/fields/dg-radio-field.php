<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description this file for radio field
 */
?>
<p class="dg-widget-field-wrapper <?php echo esc_attr($dg_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ); ?>">
		<?php echo esc_html( $dg_widget_field_title ); ?>:
	</label>
	<div class="radio-wrapper">
		<?php
			foreach ( $dg_widget_field_options as $athm_option_name => $athm_option_title ){
		?>
			<input id="<?php echo esc_attr( $dglibwidget->get_field_id( $athm_option_name ) ); ?>" name="<?php echo esc_attr( $dglibwidget->get_field_name( $dg_widget_field_name ) ); ?>" type="radio" value="<?php echo esc_attr( $athm_option_name ); ?>" <?php checked( $athm_option_name, $dg_widget_field_value ); ?> />
				<label for="<?php echo esc_attr( $dglibwidget->get_field_id( $athm_option_name ) ); ?>"><?php echo esc_html( $athm_option_title ); ?>:</label>
		<?php } ?>
	</div>
	<?php if ( isset( $dg_widget_field_description ) ) { ?>
		<small><?php echo esc_html( $dg_widget_field_description ); ?></small>
	<?php } ?>
</p>