<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description this file for multiple term list field
 */
?>
<div class="dg-widget-field-wrapper <?php echo esc_attr($dg_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $centurywidget->get_field_id( $dg_widget_field_name ) ); ?>">
		<?php echo esc_html( $dg_widget_field_title ); ?>: 
	</label>
	<ul class="dg-multiple-checkbox">
		<?php
		/* see more here https://developer.wordpress.org/reference/functions/get_terms/*/
		if( taxonomy_exists( $dg_widget_taxonomy_type ) ){
			$args = array(
				'taxonomy'     => $dg_widget_taxonomy_type,
				'hide_empty'   => false,
				'number'      => 999,
			);
			$all_terms = get_terms($args);
			if( $all_terms ){
				foreach( $all_terms as $single_term ){
					$teg_term_id = $single_term->term_id;
					$teg_term_name = $single_term->name;
					?>
					<li>
						<input 
						id="<?php echo esc_attr( $centurywidget->get_field_id($dg_widget_field_name) ).'_'.$dg_widget_taxonomy_type.'_'.$teg_term_id; ?>" 
						name="<?php echo esc_attr( $centurywidget->get_field_name($dg_widget_field_name).'[]' ); ?>" 
						type="checkbox" 
						value="<?php echo $teg_term_id; ?>" 
						<?php checked(in_array($teg_term_id, (array)$dg_widget_field_value)); ?> 
						/>
						<label for="<?php echo esc_attr( $centurywidget->get_field_id($dg_widget_field_name) ).'_'.$dg_widget_taxonomy_type.'_'.$teg_term_id; ?>"><?php echo esc_html( $teg_term_name ).' ('.$single_term->count.')'; ?></label>
					</li>
					<?php
				}
			}else{
				?><span><?php esc_html_e( 'No terms found in this taxonomy', '__Text_Domain__' ); ?></span><?php
			}
		}else{
			?><span><?php esc_html_e( 'Selected taxonomy doesn\'t exist', '__Text_Domain__' ); ?></span><?php
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