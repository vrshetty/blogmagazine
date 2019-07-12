<?php
/**
 * Bottom Footer
 * @package dineshghimire
 * @subpackage dglib
 * @since 1.0.0
 */
$wp_customize->add_section(
	'footer_bottom_section',
	array(
		'priority'      => 30,
		'title'         => esc_html__( 'Footer Bottom', 'blogmagazine' ),
		'panel'         => 'site_footer_options',
	)
);

/**
 * Copyright Text
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'footer_copyright_text', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => esc_html__( 'Copyright 2019. All rights reserved.', 'blogmagazine'),
    )
);
$wp_customize->add_control(
    'footer_copyright_text', 
    array(
        'type'=>'text',
        'priority' => 10,
        'label' => esc_html__('Copyright Text', 'blogmagazine'),
        'section' => 'footer_bottom_section',
        'description'=> esc_html__('Write your own copyright text here to display bottom of the footer.', 'blogmagazine'),
    )
);