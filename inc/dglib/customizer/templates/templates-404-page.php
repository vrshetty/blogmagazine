<?php
/**
 * Template Archive
 * @package dineshghimire
 * @subpackage dblib
 * @since 1.0.0
 */
$wp_customize->add_section(
    'template_notfound_options', 
    array(
        'title' => esc_html__('404 Options', '__Text_Domain__'),
        'panel' => 'site_template_options',
        'priority' => 70,
    )
);

/**
 * Enable Breadcrumbs
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_breadcrumbs_notfound', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'enable',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_breadcrumbs_notfound', 
        array(
            'label' => esc_html__('Enable Breadcrumbs?', '__Text_Domain__'),
            'section' => 'template_notfound_options',
            'settings' => 'dglib_enable_breadcrumbs_notfound',
            'priority' => 10,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', '__Text_Domain__'),
                'disable'=> esc_html__('Disable', '__Text_Domain__'),
            ),
            'description'=> esc_html__('You can enable breadcrumbs to show before notfound page.', '__Text_Domain__'),
        )
    )
);

/**
 * Sidebar Layouts
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_default_notfound_sidebar',
    array(
        'default'           => 'right_sidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Imageoptions_Control(
        $wp_customize,
        'dglib_default_notfound_sidebar',
        array(
            'label'    => esc_html__( 'Sidebar Layout', '__Text_Domain__' ),
            'description' => esc_html__( 'Choose sidebar from available layouts', '__Text_Domain__' ),
            'section'  => 'template_notfound_options',
            'choices'  => array(
                'left_sidebar' => array(
                    'label' => esc_html__( 'Left Sidebar', '__Text_Domain__' ),
                    'url'   => '%s/inc/dglib/assets/img/sidebars/left-sidebar.png'
                ),
                'right_sidebar' => array(
                    'label' => esc_html__( 'Right Sidebar', '__Text_Domain__' ),
                    'url'   => '%s/inc/dglib/assets/img/sidebars/right-sidebar.png'
                ),
                'no_sidebar' => array(
                    'label' => esc_html__( 'No Sidebar', '__Text_Domain__' ),
                    'url'   => '%s/inc/dglib/assets/img/sidebars/no-sidebar.png'
                ),
                'no_sidebar_center' => array(
                    'label' => esc_html__( 'No Sidebar Center', '__Text_Domain__' ),
                    'url'   => '%s/inc/dglib/assets/img/sidebars/no-sidebar-center.png'
                ),
                'both_sidebar' => array(
                    'label' => esc_html__( 'Both Sidebar', '__Text_Domain__' ),
                    'url'   => '%s/inc/dglib/assets/img/sidebars/both-sidebar.png'
                )
            ),
            'priority' => 20
        )
    )
);

/**
 * 404 Page Title
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_notfound_page_title', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => esc_html__( 'Oops! That page can’t be found.', '__Text_Domain__'),
    )
);
$wp_customize->add_control(
    'dglib_notfound_page_title', 
    array(
        'type'=>'text',
        'priority' => 30,
        'label' => esc_html__('404 Page Title', '__Text_Domain__'),
        'section' => 'template_notfound_options',
        'settings' => 'dglib_notfound_page_title',
        'description'=> esc_html__('Please enter title to display on 404 page.', '__Text_Domain__'),
    )
);

/**
 * 404 Page Title
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_notfound_page_description', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => esc_html__( 'It looks like nothing was found at this location. Maybe try a search?', '__Text_Domain__'),
    )
);
$wp_customize->add_control(
    'dglib_notfound_page_description', 
    array(
        'type'=>'textarea',
        'priority' => 40,
        'label' => esc_html__('404 Page Description', '__Text_Domain__'),
        'section' => 'template_notfound_options',
        'settings' => 'dglib_notfound_page_description',
        'description'=> esc_html__('Please enter description to display on 404 page.', '__Text_Domain__'),
    )
);