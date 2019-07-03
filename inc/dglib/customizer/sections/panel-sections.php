<?php
/*
 * Panel Section
 */
$wp_customize->add_panel(
	'site_additional_sections',
	array(
		'priority'       => 50,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__('Additional Sections', '__Text_Domain__'),
		'description'    => esc_html__('Overall section settings goes here.', '__Text_Domain__')
	)
);

require_once dglib_file_directory( 'customizer/sections/section-social-icons.php' );
require_once dglib_file_directory( 'customizer/sections/section-visitor-reaction.php' );
require_once dglib_file_directory( 'customizer/sections/section-breadcrumbs.php' );

