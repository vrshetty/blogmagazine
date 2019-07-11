<?php
/**
 * Background Image
 * @package dineshghimire
 * @subpackage dglib
 * @since 1.0.0
 */
$background_image = $wp_customize->get_section( 'background_image' );
$background_image->priority 	= 10;
$background_image->panel 		= 'site_setting_options';