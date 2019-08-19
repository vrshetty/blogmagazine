<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description this file for page list field
 */
?>
<p class="dg-widget-field-wrapper <?php echo esc_attr($dg_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ); ?>">
		<?php echo esc_html( $dg_widget_field_title ); ?>: 
	</label>
	<?php
	/* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
	$args = array(
		'selected'              => $dg_widget_field_value,
		'name'                  => esc_attr( $dglibwidget->get_field_name( $dg_widget_field_name ) ),
		'id'                    => esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ),
		'class'                 => 'widefat',
		'show_option_none'      => esc_html__('Select Page','blogmagazine'),
		'option_none_value'     => 0 // string
	);
	wp_dropdown_pages( $args );

	if ( isset( $dg_widget_field_description ) ) { 
		?>
		<br/>
		<small><?php echo esc_html( $dg_widget_field_description ); ?></small>
		<?php 
	} 
	?>
</p>
