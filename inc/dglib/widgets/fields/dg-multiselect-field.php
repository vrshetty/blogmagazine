<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description this file for multiple select field
 */
?>
<div class="dg-widget-field-wrapper <?php echo esc_attr($dg_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ); ?>">
		<?php echo esc_html( $dg_widget_field_title ); ?>: 
	</label>
	<ul class="dg-multiple-checkbox">
		<?php
		if( $dg_widget_field_options ){
			foreach( $dg_widget_field_options as $athm_option_name => $athm_option_title ){
				?>
				<li>
					<input 
					id="<?php echo esc_attr( $dglibwidget->get_field_id($dg_widget_field_name) .'_'.$athm_option_name ); ?>" 
					name="<?php echo esc_attr( $dglibwidget->get_field_name($dg_widget_field_name).'[]' ); ?>" 
					type="checkbox" 
					value="<?php echo esc_attr( $athm_option_name ); ?>" 
					<?php checked(in_array($athm_option_name, (array)$dg_widget_field_value)); ?> 
					/>
					<label for="<?php echo esc_attr( $dglibwidget->get_field_id($dg_widget_field_name) .'_'.$athm_option_name ); ?>"><?php echo esc_html( $athm_option_title ); ?></label>
				</li>
				<?php
			}
		}
		if ( isset( $dg_widget_field_description ) ) { 
			?>
			<br/>
			<small><?php echo esc_html( $dg_widget_field_description ); ?></small>
			<?php 
		}
		?>
	</ul>
</div>