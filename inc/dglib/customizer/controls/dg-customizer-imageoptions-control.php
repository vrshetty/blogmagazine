<?php

if(!class_exists('Dglib_Customize_Imageoptions_Control')):
    /**
     * Radio image customize control.
     *
     * @since  1.0.0
     * @access public
     */
    class Dglib_Customize_Imageoptions_Control extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'imageoptions';

        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $option_nature = '';


        /**
         * Image options constructor
         *
         * @since  1.0.0
         */
        public function __construct( $manager, $id, $args = array() ) {
           
            $option_nature = ( isset( $args['option_nature'] ) ) ? esc_attr($args['option_nature']) : 'radio';
            $check_nature = array(
                'radio',
                'checkbox',
            );
            $this->option_nature = (in_array($option_nature, $check_nature)) ? $option_nature : 'radio';
            parent::__construct( $manager, $id, $args );

        }


        /**
         * Loads the jQuery UI Button script and custom scripts/styles.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function enqueue(){

            //wp_enqueue_script( 'jquery-ui-button' );
            wp_enqueue_style( 'dg-customizer-imageoptions-control-css',  dglib_directory_uri('assets/parts/controls/css/dg-customizer-imageoptions-control.min.css'), array(), '1.0.0' );
            wp_enqueue_script('dg-customizer-imageoptions-control-js', dglib_directory_uri('assets/parts/controls/js/dg-customizer-imageoptions-control.min.js'), array('jquery-ui-button'), '1.0.0', false );

        }

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0

         * @access public
         * @return void
         */
        public function to_json(){
            
            parent::to_json();
            // We need to make sure we have the correct image URL.
            foreach ( $this->choices as $value => $args )
                $this->choices[ $value ]['url'] = esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) );

            $this->json['choices'] = $this->choices;
            $this->json['link']    = $this->get_link();
            $this->json['value']   = $this->value();
            $this->json['id']      = $this->id;
            $this->json['option_nature'] = $this->option_nature;

        }

        /**
         * Underscore JS template to handle the control's output.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function content_template() { ?>
            <# if ( data.label ) { #>
            <span class="customize-control-title">{{ data.label }}</span>
            <# } #>
            <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>
            <div class="buttonset dg-imageoption-wrapper">
                <# for ( key in data.choices ) { #>
                    <# if(data.option_nature=='radio') { #>
                        <# var is_checked = ( key == data.value) ? 'checked="checked"' : 'data-type="radio"'; #>
                    <# }else{ #>
                        <# var imageoption_value = data.value.replace(/&quot;/g,'"'); #>
                        <# var imageoption_value = (imageoption_value) ? imageoption_value : '[]'; #>
                        <# var is_checked = (  _.contains(JSON.parse(imageoption_value), key) ) ? 'checked="checked"' : 'data-type="checkbox"'; #>
                    <# } #>
                    <fieldset class="dg-imageoption-single">
                        <input type="{{ data.option_nature }}" class="dglib-imageoption-{{ data.option_nature }}" value="{{ key }}" name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}-{{ key }}" {{{ is_checked }}} <# if (data.option_nature=='radio') { #>{{{ data.link }}}<# }  #> /> 
                        <label class="dg-customizer-imageoption-label" for="{{ data.id }}-{{ key }}">
                            <span class="screen-reader-text">{{ data.choices[ key ]['label'] }}</span>
                            <img src="{{ data.choices[ key ]['url'] }}" title="{{ data.choices[ key ]['label'] }}" alt="{{ data.choices[ key ]['label'] }}" />
                        </label>
                    </fieldset>
                <# } #>
                <# if(data.option_nature=='checkbox') { #>
                <input type="hidden" class="dglib-imageoption-value" {{{ data.link }}} value="{{ JSON.stringify(data.value) }}" />
                <# } #>
            </div><!-- .dg-imageoption-wrapper -->
            <?php 
        }
    
    }// end Dglib_Customize_Imageoptions_Control

endif;