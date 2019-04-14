<?php
/**
 * Bottom Section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'blogmagazine_footer_info',
    array(
        'title'		=> esc_html__( 'Bottom Section', 'blogmagazine' ),
        'panel'     => 'site_footer_options',
        'priority'  => 10,
    )
);

$wp_customize->add_setting(
    'blogmagazine_copyright_text',
    array(
        'default'    => esc_html__( 'Copyright 2019', 'blogmagazine' ),
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'blogmagazine_copyright_text',
    array(
        'type'      => 'text',
        'label'     => esc_html__( 'Copyright Text', 'blogmagazine' ),
        'section'   => 'blogmagazine_footer_info',
        'priority'  => 10
    )
);
$wp_customize->selective_refresh->add_partial( 
    'blogmagazine_copyright_text', 
    array(
        'selector' => 'span.blogmagazine-copyright-text',
        'render_callback' => 'blogmagazine_customize_partial_copyright',
    )
);
