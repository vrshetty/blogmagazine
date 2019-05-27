<?php
/*
 * Panel Colors
 */
$wp_customize->add_panel(
	'site_color_options',
	array(
		'priority'       => 70,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__('Color Options', 'blogmagazine'),
		'description'    => esc_html__('Colors related settings and sections goes here. You can manage color from this panel.', 'blogmagazine'),
	)
);
