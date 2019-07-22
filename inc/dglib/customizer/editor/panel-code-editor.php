<?php
/*
 * Panel Options
 */
$wp_customize->add_panel(
	'site_code_editor',
	array(
		'priority'       => 200,
		'capability'     => 'edit_theme_options',
		'title'          => esc_html__('Additional Code', 'blogmagazine'),
		'description'    => esc_html__('You can add new css and js from this panel.', 'blogmagazine'),
	)
);
require_once dglib_file_directory( 'customizer/editor/section-custom-css.php' );
