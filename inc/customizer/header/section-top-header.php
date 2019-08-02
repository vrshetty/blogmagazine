<?php
/*
 * Top Header Section
 */
$wp_customize->add_section(
    'blogmagazine_topheader_section',
    array(
        'title'     => esc_html__( 'Top Header', 'blogmagazine' ),
        'priority'  => 30,
        'panel'     => 'site_header_panel'
    )
);


$wp_customize->add_setting(
    'blogmagazine_top_header_option',
    array(
        'default' => 'show',
        'sanitize_callback' => 'blogmagazine_sanitize_show_hide_option',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'blogmagazine_top_header_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Top Header Section', 'blogmagazine' ),
            'description'   => esc_html__( 'Show/Hide option for top header section.', 'blogmagazine' ),
            'section'   => 'blogmagazine_topheader_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'blogmagazine' ),
                'hide'  => esc_html__( 'Hide', 'blogmagazine' )
            ),
            'priority'  => 10,
        )
    )
);

$wp_customize->add_setting(
    'blogmagazine_top_date_option',
    array(
        'default' => 'show',
        'sanitize_callback' => 'blogmagazine_sanitize_show_hide_option',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'blogmagazine_top_date_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Current Date', 'blogmagazine' ),
            'description'   => esc_html__( 'Show/Hide option for current date at top header section.', 'blogmagazine' ),
            'section'   => 'blogmagazine_topheader_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'blogmagazine' ),
                'hide'  => esc_html__( 'Hide', 'blogmagazine' )
            ),
            'priority'  => 20,
        )
    )
);


$wp_customize->add_setting(
    'blogmagazine_top_social_option',
    array(
        'default' => 'show',
        'sanitize_callback' => 'blogmagazine_sanitize_show_hide_option',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'blogmagazine_top_social_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Social Icons', 'blogmagazine' ),
            'description'   => esc_html__( 'Show/Hide option for social media icons at top header section.', 'blogmagazine' ),
            'section'   => 'blogmagazine_topheader_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'blogmagazine' ),
                'hide'  => esc_html__( 'Hide', 'blogmagazine' )
            ),
            'priority'  => 30,
        )
    )
);
