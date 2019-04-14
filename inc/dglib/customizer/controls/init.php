<?php
/*
 * Custom Controls for customizers
 */
if(!function_exists('dglib_customize_control_register')){

	function dglib_customize_control_register($wp_customize){

		require_once dglib_file_directory('customizer/controls/dg-theme-information-control.php');	
		require_once dglib_file_directory('customizer/controls/dg-customizer-icons-control.php');	
		require_once dglib_file_directory('customizer/controls/dg-customizer-message-control.php');		
		require_once dglib_file_directory('customizer/controls/dg-customizer-repeater-control.php');
		require_once dglib_file_directory('customizer/controls/dg-customizer-imageoptions-control.php');
		require_once dglib_file_directory('customizer/controls/dg-customizer-termslist-control.php');
		require_once dglib_file_directory('customizer/controls/dg-customizer-switch-control.php');

		$wp_customize->register_control_type('Dglib_Customize_Imageoptions_Control');
		
	}

}

add_action('customize_register', 'dglib_customize_control_register');