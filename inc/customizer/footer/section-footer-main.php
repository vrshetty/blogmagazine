<?php

/**
 * Widget Area Section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'blogmagazine_footer_widget_section',
    array(
        'title'		=> esc_html__( 'Footer Main', 'blogmagazine' ),
        'panel'     => 'site_footer_options',
        'priority'  => 20,
    )
);

$wp_customize->add_setting(
    'blogmagazine_footer_widget_option',
    array(
        'default' => 'show',
        'sanitize_callback' => 'blogmagazine_sanitize_show_hide_option',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'blogmagazine_footer_widget_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Footer Widget Section', 'blogmagazine' ),
            'description'   => esc_html__( 'Show/Hide option for footer widget area section.', 'blogmagazine' ),
            'section'   => 'blogmagazine_footer_widget_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'blogmagazine' ),
                'hide'  => esc_html__( 'Hide', 'blogmagazine' )
            ),
            'priority'  => 10,
        )
    )
);

$wp_customize->add_setting(
    'footer_widget_layout',
    array(
        'default'           => '4',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control( 

    new Dglib_Customize_Imageoptions_Control(
        $wp_customize,
        'footer_widget_layout',
        array(
            'label'    => esc_html__( 'Footer Widget Layout', 'blogmagazine' ),
            'description' => esc_html__( 'Choose layout from available layouts', 'blogmagazine' ),
            'section'  => 'blogmagazine_footer_widget_section',
            'choices'  => array(
               '4' => array(
                   'label' => esc_html__( 'Columns Four', 'blogmagazine' ),
                   'url'   => '%s/inc/dglib/assets/img/grid/four-column.png'
               ),
               '3' => array(
                   'label' => esc_html__( 'Columns Three', 'blogmagazine' ),
                   'url'   => '%s/inc/dglib/assets/img/grid/three-column.png'
               ),
               '2' => array(
                   'label' => esc_html__( 'Columns Two', 'blogmagazine' ),
                   'url'   => '%s/inc/dglib/assets/img/grid/two-column.png'
               ),
               '1' => array(
                   'label' => esc_html__( 'Column One', 'blogmagazine' ),
                   'url'   => '%s/inc/dglib/assets/img/grid/one-column.png'
               )
           ),
            'priority' => 20
        )
    )
);