<?php
/*
 * Panel Options
 */
$wp_customize->add_panel(
	'site_setting_options',
	array(
		'priority'       => 80,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__('Setting Options', 'blogmagazine'),
		'description'    => esc_html__('Overall section settings goes here.', 'blogmagazine'),
	)
);
require_once blogmagazine_file_directory( 'inc/customizer/options/section-background-image.php' );
require_once blogmagazine_file_directory( 'inc/customizer/options/section-website-layout.php' );
require_once blogmagazine_file_directory( 'inc/customizer/options/section-image-settings.php' );