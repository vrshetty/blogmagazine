<?php
/**
 * Website layout section
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */
$wp_customize->add_section(
    'blogmagazine_website_layout',
    array(
        'title'         => esc_html__( 'Website Layout', 'blogmagazine' ),
        'description'   => esc_html__( 'Choose a site to display your website more effectively.', 'blogmagazine' ),
        'priority'      => 30,
        'panel'         => 'site_setting_options',
    )
);
$wp_customize->add_setting(
    'blogmagazine_site_layout',
    array(
        'default'           => 'fullwidth_layout',
        'sanitize_callback' => 'blogmagazine_sanitize_website_layout',
    )
);
$wp_customize->add_control(
    'blogmagazine_site_layout',
    array(
        'type'          => 'radio',
        'priority'      => 10,
        'label'         => esc_html__( 'Site Layout', 'blogmagazine' ),
        'section'       => 'blogmagazine_website_layout',
        'choices'       => array(
            'fullwidth_layout' => esc_html__( 'FullWidth Layout', 'blogmagazine' ),
            'boxed_layout' => esc_html__( 'Boxed Layout', 'blogmagazine' )
        ),
    )
);
