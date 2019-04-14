<?php
/*
 * Custom Controls for customizers
 */
require_once dglib_file_directory('customizer/controls/init.php');

/**
 *
 * @package dineshghimire
 * @subpackage dglib
 * @since 1.0.0
 */
if( !function_exists('dglib_customize_register') ):

    function dglib_customize_register($wp_customize){


        require_once dglib_file_directory('customizer/header/panel-header.php'); // priority - 30
        require_once dglib_file_directory('customizer/templates/panel-templates.php'); // priority - 40
        require_once dglib_file_directory('customizer/sections/panel-sections.php'); // priority - 50
        require_once dglib_file_directory('customizer/footer/panel-footer.php'); // priority - 60
        require_once dglib_file_directory('customizer/colors/panel-colors.php'); // priority - 70
        require_once dglib_file_directory('customizer/options/panel-options.php'); // priority - 80
        
    }

endif;
add_action( 'customize_register', 'dglib_customize_register', 10, 1 );