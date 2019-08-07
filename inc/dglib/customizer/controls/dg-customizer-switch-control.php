<?php
/**
 * Switch button customize control.
 * @since 1.0.0
 * @access public
 * @package dineshghimire
 *
 */
class Dglib_Customize_Switch_Control extends WP_Customize_Control {

    public $type = 'switch';

    /*
     * Set Default switch type is radio
     */
    public $switch_type = 'radio';

    /**
     * Switch contstructor
     *
     * @since  1.0.0
     */
    public function __construct( $manager, $id, $args = array() ) {

        $this->switch_type = isset($args['switch_type']) ? esc_attr($args['switch_type']) : 'radio';
        parent::__construct( $manager, $id, $args );

    }

    public function enqueue(){

        wp_enqueue_style( 'dg-customizer-switch-control-css',  dglib_directory_uri('assets/parts/controls/css/dg-customizer-switch-control.min.css'), array(), '1.0.0' );
        wp_enqueue_script('dg-customizer-switch-control-js', dglib_directory_uri('assets/parts/controls/js/dg-customizer-switch-control.min.js'), array('jquery'), '1.0.0', false);

    }

    public function render_content(){

        $switch_type = $this->switch_type;
        $checked_value = $this->value();
        if( dglib_is_json($checked_value) ){
            $checked_value = json_decode( $checked_value, true );
        }
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <div class="description customize-control-description"><?php echo esc_html( $this->description ); ?></div>
        <div class="dg-customizer-switch-wrapper <?php echo esc_attr($switch_type); ?>">
            <?php 
            $show_choices = $this->choices;
            foreach ( $show_choices as $key => $value ) {
                if(is_array($checked_value)){
                    $is_checked = in_array($key, $checked_value);
                }else{
                    $is_checked = ($key==$checked_value) ? true : false;
                }
                ?>
                <fieldset class="dg-customizer-switch-single"><input name="<?php echo esc_attr($this->id); ?>" class="dg-switch-item" id="<?php echo esc_attr($this->id.'_'.$key); ?>" <?php checked($is_checked); ?> type="<?php echo esc_attr($switch_type); ?>" value="<?php echo esc_attr($key); ?>"/><label for="<?php echo esc_attr($this->id.'_'.$key); ?>" ><?php echo esc_html( $value ); ?></label></fieldset>
                <?php
            }
            ?>
        </div>
        <input class="dg-customizer-switch-value" value='<?php echo esc_attr($this->value()); ?>' type="hidden" <?php $this->link(); ?> />
        <?php
    }

} // end Dglib_Customize_Switch_Control
