<?php
/*
 * Archive Settings
 */
$wp_customize->add_section(
    'blogmagazine_template_archive',
    array(
        'title'     => esc_html__( 'Archive Settings', 'blogmagazine' ),
        'panel'     => 'site_template_options',
        'priority'  => 40,
    )
);      

$wp_customize->add_setting(
    'blogmagazine_archive_sidebar',
    array(
        'default'           => 'right_sidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Imageoptions_Control(
        $wp_customize,
        'blogmagazine_archive_sidebar',
        array(
            'label'    => esc_html__( 'Archive Sidebars', 'blogmagazine' ),
            'description' => esc_html__( 'Choose sidebar from available layouts', 'blogmagazine' ),
            'section'  => 'blogmagazine_template_archive',
            'choices'  => array(
                'left_sidebar' => array(
                    'label' => esc_html__( 'Left Sidebar', 'blogmagazine' ),
                    'url'   => '%s/inc/dglib/assets/img/sidebars/left-sidebar.png'
                ),
                'right_sidebar' => array(
                    'label' => esc_html__( 'Right Sidebar', 'blogmagazine' ),
                    'url'   => '%s/inc/dglib/assets/img/sidebars/right-sidebar.png'
                ),
                'no_sidebar' => array(
                    'label' => esc_html__( 'No Sidebar', 'blogmagazine' ),
                    'url'   => '%s/inc/dglib/assets/img/sidebars/no-sidebar.png'
                ),
                'no_sidebar_center' => array(
                    'label' => esc_html__( 'No Sidebar Center', 'blogmagazine' ),
                    'url'   => '%s/inc/dglib/assets/img/sidebars/no-sidebar-center.png'
                )
            ),
            'priority' => 10
        )
    )
);

$wp_customize->add_setting(
    'blogmagazine_archive_layout',
    array(
        'default'           => 'classic',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Imageoptions_Control(
        $wp_customize,
        'blogmagazine_archive_layout',
        array(
            'label'    => esc_html__( 'Archive Layouts', 'blogmagazine' ),
            'description' => esc_html__( 'Choose layout from available layouts', 'blogmagazine' ),
            'section'  => 'blogmagazine_template_archive',
            'choices'  => array(
                'classic' => array(
                    'label' => esc_html__( 'Classic', 'blogmagazine' ),
                    'url'   => '%s/inc/dglib/assets/img/layouts/layout6.png'
                ),
                'grid' => array(
                    'label' => esc_html__( 'Grid', 'blogmagazine' ),
                    'url'   => '%s/inc/dglib/assets/img/layouts/layout5.png'
                )
            ),
            'priority' => 20
        )
    )
);

$wp_customize->add_setting(
    'blogmagazine_archive_read_more_text',
    array(
        'default'      => esc_html__( 'Continue Reading', 'blogmagazine' ),
        'transport'    => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'blogmagazine_archive_read_more_text',
    array(
        'type'      	=> 'text',
        'label'        	=> esc_html__( 'Read More Text', 'blogmagazine' ),
        'description'  	=> esc_html__( 'Enter read more button text for archive page.', 'blogmagazine' ),
        'section'   	=> 'blogmagazine_template_archive',
        'priority'  	=> 30
    )
);

$wp_customize->selective_refresh->add_partial( 
    'blogmagazine_archive_read_more_text', 
    array(
        'selector' => '.blogmagazine-archive-more > a',
        'render_callback' => 'blogmagazine_customize_partial_archive_more',
    )
);