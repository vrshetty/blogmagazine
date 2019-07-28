<?php
/*
 * Theme Color
 *
 */
$blogmagazine_color_section = $wp_customize->get_section( 'colors' );
$blogmagazine_color_section->priority = 10;
$blogmagazine_color_section->title = esc_html__('Theme Color', 'blogmagazine');
$blogmagazine_color_section->panel    = 'site_color_options';

$wp_customize->add_setting(
    'blogmagazine_theme_color',
    array(
        'default'     => '#0c4da2',
        'sanitize_callback' => 'sanitize_hex_color',
    )
); 
$wp_customize->add_control( 
    new WP_Customize_Color_Control(
        $wp_customize,
        'blogmagazine_theme_color',
        array(
            'label'      => esc_html__( 'Theme Color', 'blogmagazine' ),
            'section'    => 'colors',
            'priority'   => 20
        )
    )
);
$wp_customize->add_setting(
    'blogmagazine_site_title_color',
    array(
        'default'     => '#0c4da2',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control(
        $wp_customize,
        'blogmagazine_site_title_color',
        array(
            'label'      => esc_html__( 'Site title color', 'blogmagazine' ),
            'section'    => 'colors',
            'priority'   => 30
        )
    )
);