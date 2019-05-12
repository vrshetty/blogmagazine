<?php
/*
 * Panel Templates
 */
$wp_customize->add_panel(
	'site_template_options',
	array(
		'priority'       => 40,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__('Template Options', '__Text_Domain__'),
		'description'    => esc_html__('Templates related settings and sections goes here. You can manage different templates like page, post, 404page etc from this panel.', '__Text_Domain__'),
	)
);

require_once dglib_file_directory( 'customizer/templates/templates-homepage.php' );
require_once dglib_file_directory( 'customizer/templates/templates-post-single.php' );
require_once dglib_file_directory( 'customizer/templates/templates-page-details.php' );
