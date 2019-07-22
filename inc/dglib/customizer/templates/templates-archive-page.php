<?php
/**
 * Template Archive
 * @package dineshghimire
 * @subpackage dglib
 * @since 1.0.0
 */
$wp_customize->add_section(
    'template_archive_options', 
    array(
        'title' => esc_html__('Archive Options', 'blogmagazine'),
        'panel' => 'site_template_options',
        'priority' => 40,
    )
);

/**
 * Enable Breadcrumbs
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_breadcrumbs_archive', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'enable',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_breadcrumbs_archive', 
        array(
            'label' => esc_html__('Enable Breadcrumbs?', 'blogmagazine'),
            'section' => 'template_archive_options',
            'priority' => 10,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', 'blogmagazine'),
                'disable'=> esc_html__('Disable', 'blogmagazine'),
            ),
            'description'=> esc_html__('You can enable breadcrumbs to show before archive page.', 'blogmagazine'),
        )
    )
);

/**
 * Sidebar Layouts
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_default_archive_sidebar',
    array(
        'default'           => 'right_sidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Imageoptions_Control(
        $wp_customize,
        'dglib_default_archive_sidebar',
        array(
            'label'    => esc_html__( 'Sidebar Layout', 'blogmagazine' ),
            'description' => esc_html__( 'Choose sidebar from available layouts', 'blogmagazine' ),
            'section'  => 'template_archive_options',
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
                ),
                'both_sidebar' => array(
                    'label' => esc_html__( 'Both Sidebar', 'blogmagazine' ),
                    'url'   => '%s/inc/dglib/assets/img/sidebars/both-sidebar.png'
                )
            ),
            'priority' => 20
        )
    )
);

/**
 * Read More Text Archive 
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_readmore_text_archive', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => esc_html__('Read More...', 'blogmagazine'),
    )
);
$wp_customize->add_control(
    'dglib_readmore_text_archive', 
    array(
        'type'=>'text',
        'priority' => 30,
        'label' => esc_html__('Readmore Text', 'blogmagazine'),
        'section' => 'template_archive_options',
        'description'=> esc_html__('If you can show featured image on archive page check on show button.', 'blogmagazine'),
    )
);

/**
 * Short Description Length 
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_excerpt_length_archive', array(
        'sanitize_callback' => 'absint',
        'default'           => 150,
    )
);
$wp_customize->add_control(
    'dglib_excerpt_length_archive', 
    array(
        'type'=>'number',
        'priority' => 40,
        'label' => esc_html__('Description Length', 'blogmagazine'),
        'section' => 'template_archive_options',
        'description'=> esc_html__('Please choose no of character to display description length in archive page.', 'blogmagazine'),
    )
);

/**
 * Enable Post Date
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_date_archive', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_date_archive', 
        array(
            'label' => esc_html__('Show date on posts?', 'blogmagazine'),
            'section' => 'template_archive_options',
            'priority' => 50,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'blogmagazine'),
                'hide'=> esc_html__('Hide', 'blogmagazine'),
            ),
            'description'=> esc_html__('If you can show post date on archive page please check show button.', 'blogmagazine'),
        )
    )
);

/**
 * Enable Author Name
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_authorname_archive', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_authorname_archive', 
        array(
            'label' => esc_html__('Show author name on posts?', 'blogmagazine'),
            'section' => 'template_archive_options',
            'priority' => 60,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'blogmagazine'),
                'hide'=> esc_html__('Hide', 'blogmagazine'),
            ),
            'description'=> esc_html__('If you can show author name on archive page please check show button.', 'blogmagazine'),
        )
    )
);
