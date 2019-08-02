<?php
/*
 * Ticker Options
 */
$wp_customize->add_section(
    'blogmagazine_ticker_section',
    array(
        'title'     => esc_html__( 'Ticker Section', 'blogmagazine' ),
        'priority'  => 60,
        'panel'     => 'site_header_panel'
    )
);
$wp_customize->add_setting(
    'blogmagazine_ticker_option',
    array(
        'default' => 'show',
        'sanitize_callback' => 'blogmagazine_sanitize_show_hide_option',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'blogmagazine_ticker_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Ticker Option', 'blogmagazine' ),
            'description'   => esc_html__( 'Show/Hide option for news ticker section.', 'blogmagazine' ),
            'section'   => 'blogmagazine_ticker_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'blogmagazine' ),
                'hide'  => esc_html__( 'Hide', 'blogmagazine' )
            ),
            'priority'  => 10,
        )
    )
);


$wp_customize->add_setting(
    'blogmagazine_ticker_caption',
    array(
        'default'    => esc_html__( 'Breaking News', 'blogmagazine' ),
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'blogmagazine_ticker_caption',
    array(
        'type'      => 'text',
        'label'     => esc_html__( 'Ticker Caption', 'blogmagazine' ),
        'section'   => 'blogmagazine_ticker_section',
        'priority'  => 20
    )
);
$wp_customize->selective_refresh->add_partial(
    'blogmagazine_ticker_caption', 
    array(
        'selector' => '.ticker-caption',
        'render_callback' => 'blogmagazine_customize_partial_ticker_caption',
    )
);


$wp_customize->add_setting(
    'blogmagazine_ticker_cat_id',
    array(
        'default'    => '0',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control(
    new Dglib_Term_List_Control(
        $wp_customize,
        'blogmagazine_ticker_cat_id',
        array(
            'type'      => 'termlist',
            'label'     => esc_html__( 'Ticker Category', 'blogmagazine' ),
            'section'   => 'blogmagazine_ticker_section',
            'priority'  => 20
        )
    )
);