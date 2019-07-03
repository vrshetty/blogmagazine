<?php
/*
 * Panel Options
 */
$wp_customize->add_panel(
	'site_code_editor',
	array(
		'priority'       => 200,
		'capability'     => 'edit_theme_options',
		//'theme_supports' => '',
		'title'          => esc_html__('Additional Code', '__Text_Domain__'),
		'description'    => esc_html__('You can add new css and js from this panel.', '__Text_Domain__'),
	)
);
require_once dglib_file_directory( 'customizer/editor/section-custom-css.php' );
require_once dglib_file_directory( 'customizer/editor/section-custom-javascript.php' );