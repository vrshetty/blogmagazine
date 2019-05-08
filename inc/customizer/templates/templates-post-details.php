<?php
/**
 * Post Settings
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'template_post_options',
    array(
        'title'     => esc_html__( 'Post Settings', 'blogmagazine' ),
        'panel'     => 'site_template_options',
        'priority'  => 20,
    )
);
$wp_customize->add_setting(
    'blogmagazine_default_post_sidebar',
    array(
        'default'           => 'right_sidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Imageoptions_Control(
        $wp_customize,
        'blogmagazine_default_post_sidebar',
        array(
            'label'    => esc_html__( 'Post Sidebars', 'blogmagazine' ),
            'description' => esc_html__( 'Choose sidebar from available layouts', 'blogmagazine' ),
            'section'  => 'template_post_options',
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
    'blogmagazine_related_posts_option',
    array(
        'default' => 'show',
        'sanitize_callback' => 'blogmagazine_sanitize_switch_option',
    )
);


$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'blogmagazine_related_posts_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Related Post Option', 'blogmagazine' ),
            'description'   => esc_html__( 'Show/Hide option for related posts section at single post page.', 'blogmagazine' ),
            'section'   => 'template_post_options',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'blogmagazine' ),
                'hide'  => esc_html__( 'Hide', 'blogmagazine' )
            ),
            'priority'  => 20,
        )
    )
);
$wp_customize->add_setting(
    'blogmagazine_related_posts_title',
    array(
        'default'    => esc_html__( 'Related Posts', 'blogmagazine' ),
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'blogmagazine_related_posts_title',
    array(
        'type'      => 'text',
        'label'     => esc_html__( 'Related Post Section Title', 'blogmagazine' ),
        'section'   => 'template_post_options',
        'priority'  => 30
    )
);
$wp_customize->selective_refresh->add_partial(
    'blogmagazine_related_posts_title', 
    array(
        'selector' => 'h2.blogmagazine-related-title',
        'render_callback' => 'blogmagazine_customize_partial_related_title',
    )
);
$wp_customize->add_setting(
    'blogmagazine_related_posts_from',
    array(
        'default'    => 'category',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    'blogmagazine_related_posts_from',
    array(
        'type'      => 'select',
        'label'     => esc_html__( 'Related Posts from?', 'blogmagazine' ),
        'section'   => 'template_post_options',
        'priority'  => 40,
        'choices'   => blogmagazine_get_taxonomy_list( 'post' ),
    )
);