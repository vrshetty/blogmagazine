<?php
/**
 * Panel: Theme Options
 * @package dineshghimire
 * @subpackage dblib
 * @since 1.0.0
 */
$wp_customize->add_panel(
	'site_setting_options',
	array(
		'priority'       => 70,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__('Theme Options', '__Text_Domain__'),
		'description'    => esc_html__('Remaining all setting options goes here.', '__Text_Domain__'),
	)
);

require_once dglib_file_directory( 'customizer/options/section-background-image.php' );