<?php
/*
 * Header Navigation
 */
$wp_customize->add_section(
    'blogmagazine_header_navigation',
    array(
        'title'     => esc_html__( 'Main Navigation', 'blogmagazine' ),
        'priority'  => 50,
        'panel'     => 'site_header_panel'
    )
);    


$wp_customize->add_setting(
    'blogmagazine_menu_sticky_option',
    array(
        'default' => 'show',
        'sanitize_callback' => 'blogmagazine_sanitize_show_hide_option',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'blogmagazine_menu_sticky_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Sticky Menu', 'blogmagazine' ),
            'description'   => esc_html__( 'Enable/Disable option for sticky menu.', 'blogmagazine' ),
            'section'   => 'blogmagazine_header_navigation',
            'choices'   => array(
                'show'  => esc_html__( 'Enable', 'blogmagazine' ),
                'hide'  => esc_html__( 'Disable', 'blogmagazine' )
            ),
            'priority'  => 10,
        )
    )
);


$wp_customize->add_setting(
    'blogmagazine_home_icon_option',
    array(
        'default' => 'show',
        'sanitize_callback' => 'blogmagazine_sanitize_show_hide_option',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'blogmagazine_home_icon_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Home Icon', 'blogmagazine' ),
            'description'   => esc_html__( 'Show/Hide option for home icon at primary menu.', 'blogmagazine' ),
            'section'   => 'blogmagazine_header_navigation',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'blogmagazine' ),
                'hide'  => esc_html__( 'Hide', 'blogmagazine' )
            ),
            'priority'  => 20,
        )
    )
);

$wp_customize->add_setting(
    'blogmagazine_search_icon_option',
    array(
        'default' => 'show',
        'sanitize_callback' => 'blogmagazine_sanitize_show_hide_option',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'blogmagazine_search_icon_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Search Icon', 'blogmagazine' ),
            'description'   => esc_html__( 'Show/Hide option for search icon at primary menu.', 'blogmagazine' ),
            'section'   => 'blogmagazine_header_navigation',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'blogmagazine' ),
                'hide'  => esc_html__( 'Hide', 'blogmagazine' )
            ),
            'priority'  => 30,
        )
    )
);

$wp_customize->add_setting(
    'blogmagazine_random_post_option',
    array(
        'default' => 'show',
        'sanitize_callback' => 'blogmagazine_sanitize_show_hide_option',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'blogmagazine_random_post_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Random Post Icon', 'blogmagazine' ),
            'description'   => esc_html__( 'Show/Hide option for random post icon at primary menu.', 'blogmagazine' ),
            'section'   => 'blogmagazine_header_navigation',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'blogmagazine' ),
                'hide'  => esc_html__( 'Hide', 'blogmagazine' )
            ),
            'priority'  => 40,
        )
    )
);

$wp_customize->add_setting(
    'blogmagazine_random_post_icon',
    array(
        'default' => 'fa-random',
        'sanitize_callback' => 'blogmagazine_sanitize_font_awesome_icons',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Icons_Control(
        $wp_customize,
        'blogmagazine_random_post_icon',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Choose Random Post Icon', 'blogmagazine' ),
            'description'   => esc_html__( 'Icon option for random post at primary menu.', 'blogmagazine' ),
            'section'   => 'blogmagazine_header_navigation',
            'priority'  => 50,
        )
    )
);