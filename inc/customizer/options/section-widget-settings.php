<?php
/*
 * Widget Settings
 */
$wp_customize->add_section(
    'blogmagazine_widget_settings_section',
    array(
        'title'     => esc_html__( 'Widget Settings', 'blogmagazine' ),
        'panel'     => 'site_setting_options',
        'priority'  => 20,
    )
);
$wp_customize->add_setting(
    'blogmagazine_widget_cat_link_option',
    array(
        'default' => 'show',
        'sanitize_callback' => 'blogmagazine_sanitize_switch_option',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'blogmagazine_widget_cat_link_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Category Link', 'blogmagazine' ),
            'description'   => esc_html__( 'Enable/Disable option for category link for widget title in block layout widget.', 'blogmagazine' ),
            'section'   => 'blogmagazine_widget_settings_section',
            'choices'   => array(
                'show'  => esc_html__( 'Enable', 'blogmagazine' ),
                'hide'  => esc_html__( 'Disable', 'blogmagazine' )
            ),
            'priority'  => 10,
        )
    )
);

$wp_customize->add_setting(
    'blogmagazine_widget_cat_color_option',
    array(
        'default' => 'show',
        'sanitize_callback' => 'blogmagazine_sanitize_switch_option',
    )
);
$wp_customize->add_control( new Dglib_Customize_Switch_Control(
    $wp_customize,
    'blogmagazine_widget_cat_color_option',
    array(
        'type'      => 'switch',
        'label'     => esc_html__( 'Category Color', 'blogmagazine' ),
        'description'   => esc_html__( 'Enable/Disable option for category color for widget title in block layout widget.', 'blogmagazine' ),
        'section'   => 'blogmagazine_widget_settings_section',
        'choices'   => array(
            'show'  => esc_html__( 'Enable', 'blogmagazine' ),
            'hide'  => esc_html__( 'Disable', 'blogmagazine' )
        ),
        'priority'  => 20,
    )
)
);
