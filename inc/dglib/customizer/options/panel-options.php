<?php
/**
 * Panel: Theme Options
 * @package dineshghimire
 * @subpackage dglib
 * @since 1.0.0
 */
$wp_customize->add_panel(
	'site_setting_options',
	array(
		'priority'       => 70,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__('Theme Options', 'blogmagazine'),
		'description'    => esc_html__('Remaining all setting options goes here.', 'blogmagazine'),
	)
);

require_once dglib_file_directory( 'customizer/options/section-background-image.php' );