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
		'title'          => esc_html__('Footer Options', 'blogmagazine'),
		'description'    => esc_html__('Footer related settings and sections goes here. You can manage footer from this panel.', 'blogmagazine'),
	)
);

require_once dglib_file_directory( 'customizer/footer/section-bottom-footer.php' );