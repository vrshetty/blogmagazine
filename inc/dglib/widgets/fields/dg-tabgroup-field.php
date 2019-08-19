<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description this file for tab group field
 */
$current_widget_slug = $dglibwidget->id_base.'_'.$dglibwidget->number.'_';
?>
<div class="dg-widget-field-tab-wraper <?php echo esc_attr($dg_widget_field_wraper); ?>">
	<h5 class="dg-widget-tab-list nav-tab-wrapper">
		<?php 
		foreach($dg_widget_field_options as $tab_key=>$tab_details){
			$current_tab_id = $current_widget_slug.$tab_key;
			?>
			<label for="field_<?php echo esc_attr($current_tab_id); ?>" data-id="#content_<?php echo esc_attr($current_tab_id); ?>" class="nav-tab <?php echo ($tab_key == $dg_widget_field_value) ? 'nav-tab-active' : ''; ?>"><?php echo esc_html($tab_details['dg_widget_field_title']); ?><input id="field_<?php echo esc_attr($current_tab_id); ?>" type="radio" name="<?php echo esc_attr($dglibwidget->get_field_name($dg_widget_field_name) ); ?>" value="<?php echo esc_attr($tab_key); ?>" <?php checked($dg_widget_field_value, $tab_key); ?> class="dg-hidden"/></label>
		<?php } ?>
	</h5>
	<div class="dg-tab-content-wraper">
		<?php
		foreach($dg_widget_field_options as $tab_key=>$tab_details){ 
			$current_tab_id = $current_widget_slug.$tab_key;
			?>
			<div id="content_<?php echo esc_attr($current_tab_id); ?>" class="dg-tab-contents <?php echo ($dg_widget_field_value==$tab_key
			) ? 'dg-tab-active' : ''; ?>" >
				<?php
					$all_values = get_option('widget_' . $dglibwidget->id_base);
					$this_widget_instance = isset($all_values[$dglibwidget->number]) ? $all_values[$dglibwidget->number] : array();
					$widget_fields = isset($tab_details['dg_widget_field_options']) ? $tab_details['dg_widget_field_options'] : array();
					// Loop through fields
					if(count($widget_fields)):
			            foreach ( $widget_fields as $widget_field ) {
			                // Make array elements available as variables
			                extract( $widget_field );
			                $dg_widget_field_default = isset($widget_field['dg_widget_field_default']) ? $widget_field['dg_widget_field_default'] : '';
			                $dg_widgets_field_value = isset( $this_widget_instance[ $dg_widget_field_name ] ) ? $this_widget_instance[ $dg_widget_field_name ] : $dg_widget_field_default;
			                dg_widgets_show_widget_field( $dglibwidget, $widget_field, $dg_widgets_field_value );
			            }
			        else:
			        	?><p><?php echo esc_html__('No fields are added on ', 'blogmagazine').esc_attr($tab_details['dg_widget_field_name']).esc_html__(' tab', 'blogmagazine'); ?></p><?php
			        endif;
				?>
			</div>
		<?php } ?>
	</div>
</div>