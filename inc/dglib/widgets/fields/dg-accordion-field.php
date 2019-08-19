<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description this file for accordion field
 */
$dg_widget_field_options = isset($widget_field['dg_widget_field_options']) ? $widget_field['dg_widget_field_options'] : array();
$all_values = get_option('widget_' . $dglibwidget->id_base);
$this_widget_instance = isset($all_values[$dglibwidget->number]) ? $all_values[$dglibwidget->number] : array();
$dg_widget_field_value = (array)$dg_widget_field_value;
?>
<div class="dg-widget-field-wrapper dg-widget-accordion-wrapper <?php echo esc_attr($dg_widget_field_wraper); ?>">
	<?php
	if( count( $dg_widget_field_options ) > 0 && is_array( $dg_widget_field_options ) ){ 
		foreach ($dg_widget_field_options as $accordion_key=>$accordion_details){
			$is_dropdown = in_array($accordion_key, $dg_widget_field_value);
			$dg_widget_field_title = isset($accordion_details['dg_widget_field_title']) ? esc_html($accordion_details['dg_widget_field_title']) : '';
			$dg_widget_field_options = isset($accordion_details['dg_widget_field_options']) ? $accordion_details['dg_widget_field_options'] : array();
			$accordion_wraper_class = ($is_dropdown) ? 'open' : 'closed';
			$accordion_icon_class = ($is_dropdown) ? 'fa-angle-up' : 'fa-angle-down';
			?>
			<div class="dg-accordion-wrapper <?php echo esc_attr($accordion_wraper_class); ?>">
				<label for="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name.$accordion_key ) ); ?>" class="dg-accordion-title"><?php esc_html($dg_widget_field_title); ?>
					<?php echo esc_html($dg_widget_field_title); ?><i class="dg-accordion-arrow fa <?php echo esc_attr($accordion_icon_class); ?>"></i>
					<input id="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name.$accordion_key ) ); ?>" name="<?php echo esc_attr( $dglibwidget->get_field_name( $dg_widget_field_name ) ); ?>[]" value="<?php echo esc_attr($accordion_key); ?>" <?php checked( 1, $is_dropdown ) ?> class="dg-hidden" type="checkbox">
				</label>
				<div class="dg-accordion-content">
					<?php
					if(count($dg_widget_field_options)):
					foreach($dg_widget_field_options as $field_key=>$accordion_field):
						$current_widgets_field_default = isset($accordion_field['dg_widget_field_default']) ? $accordion_field['dg_widget_field_default'] : '';
						$current_field_widget_name = isset($accordion_field['dg_widget_field_name']) ? $accordion_field['dg_widget_field_name'] : '';

						if(!$current_field_widget_name){
							return;
						}
						$current_widgets_field_value = isset($this_widget_instance[$current_field_widget_name]) ? $this_widget_instance[$current_field_widget_name] : $current_widgets_field_default;
						dg_widgets_show_widget_field( $dglibwidget, $accordion_field, $current_widgets_field_value );
					endforeach;
				else:
					?>
					<p><?php esc_html_e('Sorry no field are added on accordion.', 'blogmagazine'); ?></p>
					<?php
				endif;
					?>
				</div>
			</div>
			<?php
		}

	}else{
		?>
			<p><?php esc_html_e('There is no accordion on this accordion group', 'blogmagazine'); ?></p>
		<?php
	}
	?>
	<?php if ( isset( $dg_widget_field_description ) ) { ?>
		<br/>
		<small><?php echo wp_kses_post( $dg_widget_field_description ); ?></small>
	<?php } ?>
</div>