<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description this file for term list field
 */
?>
<p class="dg-widget-field-wrapper <?php echo esc_attr($dg_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ); ?>">
		<?php echo esc_html( $dg_widget_field_title ); ?>: 
	</label>
	<?php
	/* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
	if( taxonomy_exists( $dg_widget_taxonomy_type ) ){
		$args = array(
			'show_option_all'	=> esc_html__('Show All', 'blogmagazine'),
			'show_option_none'   => false,
			'orderby'            => 'name',
			'order'              => 'asc',
			'show_count'         => 1,
			'hide_empty'         => 0,
			'echo'               => 1,
			'selected'           => $dg_widget_field_value,
			'hierarchical'       => 1,
			'name'               => esc_attr( $dglibwidget->get_field_name( $dg_widget_field_name ) ),
			'id'                 => esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ),
			'class'              => 'widefat',
			'taxonomy'           => $dg_widget_taxonomy_type,
			'hide_if_empty'      => false,
		);
		wp_dropdown_categories( $args );	
	}else{
		?><select id="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ); ?>" name="<?php echo esc_attr( $dglibwidget->get_field_name( $dg_widget_field_name ) ); ?>" class="widefat">
			<option value=""><?php esc_html_e( 'No terms found in this taxonomy', 'blogmagazine' ); ?></option>
		</select><?php
	}	

	if ( isset( $dg_widget_field_description ) ) { 
		?>
		<br/>
		<small><?php echo esc_html( $dg_widget_field_description ); ?></small>
		<?php 
	} 
	?>

</p>