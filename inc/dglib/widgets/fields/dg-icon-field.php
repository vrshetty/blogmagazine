<?php
/**
 * @package dineshghimire
 * @subpackage dglib
 * @since dglib 1.0.0
 * @version 1.0.0
 * @description this file for icon field
 */
?>
<div class="dg-widget-field-wrapper dg-icons-wrapper <?php echo esc_attr($dg_widget_field_wraper); ?>">
    <div class="dg-icon-preview">
        <?php if( !empty( $dg_widget_field_value ) ) { echo '<i class="fa '. esc_attr( $dg_widget_field_value ).'"></i>'; } ?>
    </div>
    <div class="icon-toggle">
        <?php echo ( empty( $dg_widget_field_value )? esc_html__('Add Icon','blogmagazine'): esc_html__('Edit Icon','blogmagazine') ); ?>
        <span class="dashicons dashicons-arrow-down"></span>
    </div>
    <div class="icons-list-wrapper hidden">
        <input class="icon-search widefat" type="text" placeholder="<?php esc_attr_e('Search Icon','blogmagazine')?>">
        <?php
        $dglib_icons_list = dglib_fa_iconslist();
        foreach ( $dglib_icons_list as $single_icon ) {
            if( $dg_widget_field_value == $single_icon ) {
                echo '<span class="single-icon selected"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
            } else {
                echo '<span class="single-icon"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
            }
        }
        ?>
    </div>
    <input class="widefat dg-icon-value <?php echo esc_attr($dg_widget_relation_class); ?>" id="<?php echo esc_attr( $dglibwidget->get_field_id( $dg_widget_field_name ) ); ?>" type="hidden" name="<?php echo esc_attr( $dglibwidget->get_field_name( $dg_widget_field_name ) ); ?>" value="<?php echo esc_attr( $dg_widget_field_value ); ?>" placeholder="fa-desktop"  data-relations="<?php echo esc_attr($dg_widget_relation_json) ?>"/>
</div>