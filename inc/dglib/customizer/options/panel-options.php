<?php
/*
 * Panel Options
 */
$wp_customize->add_panel(
	'site_setting_options',
	array(
		'priority'       => 70,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__('Setting Options', 'blogmagazine'),
		'description'    => esc_html__('Overall setting options goes here.', 'blogmagazine'),
	)
);
