<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description Repeater field for widget
 */
$dg_repeater_row_title = isset($widget_field['dg_repeater_row_title']) ? $widget_field['dg_repeater_row_title'] : esc_html__('Row', 'blogmagazine');
$dg_repeater_addnew_label = isset($widget_field['dg_repeater_addnew_label']) ? $widget_field['dg_repeater_addnew_label'] : esc_html__('Add row', 'blogmagazine');
$dg_widget_field_options = isset($widget_field['dg_widget_field_options']) ? $widget_field['dg_widget_field_options'] : array();
$coder_repeater_depth = 'coderRepeaterDepth_'.'0';
$dg_repeater_main_key = $dg_widget_field_name;
?>
<div class="dg-widget-field-wrapper dg-widget-repeater-wrapper <?php echo esc_attr($dg_widget_field_wraper); ?>">
	<label class="dg-widget-repeater-heading" for="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ); ?>"><?php echo esc_html( $dg_widget_field_title ); ?>:</label>
	<div class="dg-repeater">
		<?php
		$repeater_count = 0;
		if( is_array( $dg_widget_field_value ) && count( $dg_widget_field_value ) > 0 ){
			foreach ($dg_widget_field_value as $repeater_key=>$repeater_details){
				?>
				<div class="dg-widget-repeater-table">
					<div class="dg-repeater-top">
						<div class="dg-repeater-title-action">
							<button type="button" class="dg-repeater-action">
								<span class="te-toggle-indicator" aria-hidden="true"></span>
							</button>
						</div>
						<div class="dg-repeater-title">
							<h3><?php echo esc_attr($dg_repeater_row_title); ?><span class="dg-repeater-inner-title"></span></h3>
						</div>
					</div>
					<div class='dg-repeater-inside hidden'>
						<?php
						foreach($dg_widget_field_options as $repeater_slug => $repeater_data){
							
							$dg_repeater_child_field_name = (isset($repeater_data['dg_widget_field_name'] ) ) ? esc_attr($repeater_data['dg_widget_field_name']) : '';
							$repeater_field_id  = esc_attr($dglibwidget->get_field_id( $dg_widget_field_name).$dg_repeater_child_field_name);
							$dg_widget_field_name = esc_attr($dg_repeater_main_key.'['.$repeater_count.']['.$dg_repeater_child_field_name.']');
							$repeater_data['dg_widget_field_name'] = $dg_widget_field_name;
							$dg_widget_field_default = (isset($repeater_data['dg_widget_field_default']) ) ? $repeater_data['dg_widget_field_default'] : '';
							$dg_widget_field_value = ( isset($repeater_details[$dg_repeater_child_field_name] ) ) ? $repeater_details[$dg_repeater_child_field_name] : $dg_widget_field_default;
							dg_widgets_show_widget_field( $dglibwidget, $repeater_data, $dg_widget_field_value );
						}
						?>
						<div class="dg-repeater-control-actions">
							<button type="button" class="button-link button-link-delete dg-repeater-remove"><?php esc_html_e('Remove','blogmagazine');?></button> |
							<button type="button" class="button-link dg-repeater-close"><?php esc_html_e('Close','blogmagazine');?></button>
						</div>
					</div>
				</div>
				<?php
				$repeater_count++;
			}
		}

		?>
		<script type="text/html" class="dg-code-for-repeater">
			<div class="dg-widget-repeater-table">
				<div class="dg-repeater-top">
					<div class="dg-repeater-title-action">
						<button type="button" class="dg-repeater-action">
							<span class="te-toggle-indicator" aria-hidden="true"></span>
						</button>
					</div>
					<div class="dg-repeater-title">
						<h3><?php echo esc_attr($dg_repeater_row_title); ?><span class="dg-repeater-inner-title"></span></h3>
					</div>
				</div>
				<div class='dg-repeater-inside hidden'>
					<?php
					
					foreach($dg_widget_field_options as $repeater_slug => $repeater_data){
						/**/
						$dg_repeater_child_field_name = (isset($repeater_data['dg_widget_field_name'] ) ) ? esc_attr($repeater_data['dg_widget_field_name']) : '';
						$repeater_field_id  = esc_attr($dglibwidget->get_field_id( $dg_widget_field_name).$dg_repeater_child_field_name);
						$dg_widget_field_name = esc_attr($dg_repeater_main_key.'['.$coder_repeater_depth.']['.$dg_repeater_child_field_name.']');
						$repeater_data['dg_widget_field_name'] = $dg_widget_field_name;
						$dg_widget_field_default = isset($repeater_data['dg_widget_field_default']) ? $repeater_data['dg_widget_field_default'] : '';
						dg_widgets_show_widget_field( $dglibwidget, $repeater_data, $dg_widget_field_default );
					}
					?>
					<div class="dg-repeater-control-actions">
						<button type="button" class="button-link button-link-delete dg-repeater-remove"><?php esc_html_e('Remove','blogmagazine');?></button> |
						<button type="button" class="button-link dg-repeater-close"><?php esc_html_e('Close','blogmagazine');?></button>
					</div>
				</div>
			</div>
		</script>

		<input class="dg-total-repeater-counter" type="hidden" value="<?php echo esc_attr( $repeater_count ) ?>">
		<span class="button dg-add-repeater" id="<?php echo esc_attr( $coder_repeater_depth ); ?>"><?php echo esc_html($dg_repeater_addnew_label); ?></span><br/>

	</div>
	<?php if ( isset( $dg_widget_field_description ) ) { ?>
		<small><?php echo esc_html( $dg_widget_field_description ); ?></small>
	<?php } ?>
</div>