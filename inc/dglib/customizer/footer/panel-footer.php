<?php
/*
 * Panel Footer
 */
$wp_customize->add_panel(
	'site_footer_options',
	array(
		'priority'       => 50,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__('Footer Options', '__Text_Domain__'),
		'description'    => esc_html__('Footer related settings and sections goes here. You can manage footer from this panel.', '__Text_Domain__'),
	)
);
