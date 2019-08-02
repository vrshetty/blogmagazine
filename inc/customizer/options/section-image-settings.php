<?php
/*
 * Widget Settings
 */
$wp_customize->add_section(
    'blogmagazine_image_setting_section',
    array(
        'title'     => esc_html__( 'Image Settings', 'blogmagazine' ),
        'panel'     => 'site_setting_options',
        'priority'  => 40,
    )
);
$wp_customize->add_setting(
    'blogmagazine_image_src_set_option',
    array(
        'default' => 'disable',
        'sanitize_callback' => 'blogmagazine_sanitize_enable_disable_option',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'blogmagazine_image_src_set_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Image src set option', 'blogmagazine' ),
            'description'   => esc_html__( 'Enable/Disable option for image src set.', 'blogmagazine' ),
            'section'   => 'blogmagazine_image_setting_section',
            'choices'   => array(
                'enable'  => esc_html__( 'Enable', 'blogmagazine' ),
                'disable'  => esc_html__( 'Disable', 'blogmagazine' )
            ),
            'priority'  => 10,
        )
    )
);
