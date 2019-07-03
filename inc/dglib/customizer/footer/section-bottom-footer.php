<?php
/**
 * Bottom Footer
 * @package dineshghimire
 * @subpackage dblib
 * @since 1.0.0
 */
$wp_customize->add_section(
	'footer_bottom_section',
	array(
		'priority'      => 30,
		'title'         => esc_html__( 'Footer Bottom', '__Text_Domain__' ),
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
        'default'           => esc_html__( 'Copyright © 2019. All rights reserved.', '__Text_Domain__'),
    )
);
$wp_customize->add_control(
    'footer_copyright_text', 
    array(
        'type'=>'text',
        'priority' => 10,
        'label' => esc_html__('Copyright Text', '__Text_Domain__'),
        'section' => 'footer_bottom_section',
        'description'=> esc_html__('Write your own copyright text here to display bottom of the footer.', '__Text_Domain__'),
    )
);