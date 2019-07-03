<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description UPLOAD field for widget
 */
?>
<p class="dg-widget-field-wrapper sub-option widget-upload <?php echo esc_attr($dg_widget_field_wraper); ?>">
	<label for="<?php echo esc_attr( $centurywidget->get_field_id( $dg_widget_field_name ) ); ?>"><?php echo esc_html( $dg_widget_field_title ); ?></label>
	<span class="img-preview-wrap" <?php echo empty( $dg_widget_field_value ) ? 'style="display:none;"' : ''; ?>>
		<img class="widefat" src="<?php echo esc_url( $dg_widget_field_value ); ?>" alt="<?php esc_attr_e( 'Image preview', '__Text_Domain__' ); ?>"  />
	</span>
	<!-- .img-preview-wrap -->
	<input type="text" class="widefat <?php echo esc_attr($dg_widget_relation_class); ?>" name="<?php echo esc_attr( $centurywidget->get_field_name( $dg_widget_field_name ) ); ?>" id="<?php echo esc_attr( $centurywidget->get_field_id( $dg_widget_field_name ) ); ?>" placeholder="<?php esc_html_e('Choose file', '__Text_Domain__'); ?>" value="<?php echo esc_url( $dg_widget_field_value ); ?>" data-relations="<?php echo esc_attr($dg_widget_relation_json) ?>" />
	<input type="button" value="<?php esc_attr_e( 'Upload Image', '__Text_Domain__' ); ?>" class="button media-image-upload" data-title="<?php esc_attr_e( 'Select Image','__Text_Domain__'); ?>" data-button="<?php esc_attr_e( 'Select Image','__Text_Domain__'); ?>"/>
	<input type="button" value="<?php esc_attr_e( 'Remove Image', '__Text_Domain__' ); ?>" class="button media-image-remove" />
</p>