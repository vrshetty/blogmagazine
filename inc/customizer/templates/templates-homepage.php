<?php
/*
 * Static Front Page
 */
$wp_customize->add_setting(
    'enable_magazine_layout',
    array(
        'default'    => 'disable',
        'sanitize_callback' => 'blogmagazine_sanitize_switch_option',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'enable_magazine_layout',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Magazine Layout on home page', 'blogmagazine' ),
            'description'   => esc_html__( 'If you enable setting than home page show magazine layout other wise default blog listing shows on home page.', 'blogmagazine' ),
            'section'   => 'static_front_page',
            'choices'   => array(
                'enable'  => esc_html__( 'Enable', 'blogmagazine' ),
                'disable'  => esc_html__( 'Disable', 'blogmagazine' ),
            ),
            'priority'  => 1,
        )
    )
);


/*
 * Static Front Page
 */
$wp_customize->add_setting(
    'static_frontpage_layout',
    array(
        'default'    => 'disable',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Control(
        $wp_customize,
        'static_frontpage_layout',
        array(
            'type'      => 'select',
            'label'     => esc_html__( 'Front Page layout', 'blogmagazine' ),
            'description'   => esc_html__( 'Please choose front page layout..', 'blogmagazine' ),
            'section'   => 'static_front_page',
            'choices'   => array(
                'page'  => esc_html__( 'Default Page', 'blogmagazine' ),
                'archive'  => esc_html__( 'Default Archive', 'blogmagazine' ),
                'magazine'  => esc_html__( 'Magazine Layout', 'blogmagazine' ),
            ),
            'priority'  => 10,
        )
    )
);