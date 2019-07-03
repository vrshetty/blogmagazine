<?php
/**
 * Template Post
 * @package dineshghimire
 * @subpackage dblib
 * @since 1.0.0
 */
$wp_customize->add_section(
    'template_page_options', 
    array(
        'title' => esc_html__('Page Options', '__Text_Domain__'),
        'panel' => 'site_template_options',
        'priority' => 30,
    )
);

/**
 * Enable Breadcrumbs
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_breadcrumbs_page', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'enable',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_breadcrumbs_page', 
        array(
            'label' => esc_html__('Enable Breadcrumbs?', '__Text_Domain__'),
            'section' => 'template_page_options',
            'priority' => 10,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', '__Text_Domain__'),
                'disable'=> esc_html__('Disable', '__Text_Domain__'),
            ),
            'description'=> esc_html__('You can enable breadcrumbs to show before page details.', '__Text_Domain__'),
        )
    )
);

/**
 * Sidebar Layouts
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_default_page_sidebar',
    array(
        'default'           => 'right_sidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Imageoptions_Control(
        $wp_customize,
        'dglib_default_page_sidebar',
        array(
            'label'    => esc_html__( 'Sidebar Layout', '__Text_Domain__' ),
            'description' => esc_html__( 'Choose sidebar from available layouts', '__Text_Domain__' ),
            'section'  => 'template_page_options',
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
 * Enable Featured Image
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_featured_image_page', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_featured_image_page', 
        array(
            'label' => esc_html__('Show Featured Image?', '__Text_Domain__'),
            'section' => 'template_page_options',
            'priority' => 30,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', '__Text_Domain__'),
                'hide'=> esc_html__('Hide', '__Text_Domain__'),
            ),
            'description'=> esc_html__('If you can show featured image on single page check on show button.', '__Text_Domain__'),
        )
    )
);


/**
 * Enable Reactions on Page
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_reaction_page', array(
        'sanitize_callback' => 'esc_attr',
        'default' => 'disable',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_reaction_page', 
        array(
            'label' => esc_html__('Enable Reactions', '__Text_Domain__'),
            'section' => 'template_page_options',
            'priority' => 40,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', '__Text_Domain__'),
                'disable'=> esc_html__('Disable', '__Text_Domain__'),
            ),
            'description'=> esc_html__('You can enable reaction to show after page details.', '__Text_Domain__'),
        )
    )
);

