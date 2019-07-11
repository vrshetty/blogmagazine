<?php
/**
 * Global Colors
 * @package dineshghimire
 * @subpackage dglib
 * @since 1.0.0
 */
$dglib_colors = $wp_customize->get_section( 'colors' );
$dglib_colors->priority 	= 10;
$dglib_colors->panel 		= 'site_color_options';
$dglib_colors->title 		= esc_html__( 'Global Colors', 'blogmagazine' );