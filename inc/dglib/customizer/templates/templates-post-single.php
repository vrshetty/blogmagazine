<?php
/**
 * Template Post
 * @package dineshghimire
 * @subpackage dglib
 * @since 1.0.0
 */
$wp_customize->add_section(
    'template_post_options', 
    array(
        'title' => esc_html__('Post Options', 'blogmagazine'),
        'panel' => 'site_template_options',
        'priority' => 20,
    )
);

/**
 * Enable Breadcrumbs
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_breadcrumbs_post', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'enable',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_breadcrumbs_post', 
        array(
            'label' => esc_html__('Enable Breadcrumbs?', 'blogmagazine'),
            'section' => 'template_post_options',
            'priority' => 10,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', 'blogmagazine'),
                'disable'=> esc_html__('Disable', 'blogmagazine'),
            ),
            'description'=> esc_html__('You can enable breadcrumbs to show before post details.', 'blogmagazine'),
        )
    )
);

/**
 * Sidebar Options for Single Page
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_default_post_sidebar',
    array(
        'default'           => 'right_sidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Imageoptions_Control(
        $wp_customize,
        'dglib_default_post_sidebar',
        array(
            'label'    => esc_html__( 'Sidebar Layout', 'blogmagazine' ),
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
 * Enable Featured Image
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_featured_image_post', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_featured_image_post', 
        array(
            'label' => esc_html__('Show Featured Image?', 'blogmagazine'),
            'section' => 'template_post_options',
            'priority' => 30,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'blogmagazine'),
                'hide'=> esc_html__('Hide', 'blogmagazine'),
            ),
            'description'=> esc_html__('If you can show featured image on single page check on show button.', 'blogmagazine'),
        )
    )
);

/**
 * Enable Categories
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_categories_post', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_categories_post', 
        array(
            'label' => esc_html__('Show Categories?', 'blogmagazine'),
            'section' => 'template_post_options',
            'priority' => 40,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'blogmagazine'),
                'hide'=> esc_html__('Hide', 'blogmagazine'),
            ),
            'description'=> esc_html__('If you can show categories list of related post on post details please check show button.', 'blogmagazine'),
        )
    )
);

/**
 * Enable Post Date
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_date_post', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_date_post', 
        array(
            'label' => esc_html__('Show date on post?', 'blogmagazine'),
            'section' => 'template_post_options',
            'priority' => 50,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'blogmagazine'),
                'hide'=> esc_html__('Hide', 'blogmagazine'),
            ),
            'description'=> esc_html__('If you can show post date on post details please check show button.', 'blogmagazine'),
        )
    )
);

/**
 * Enable Author Name
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_authorname_post', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_authorname_post', 
        array(
            'label' => esc_html__('Show author name on post?', 'blogmagazine'),
            'section' => 'template_post_options',
            'priority' => 60,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'blogmagazine'),
                'hide'=> esc_html__('Hide', 'blogmagazine'),
            ),
            'description'=> esc_html__('If you can show author name on post details please check show button.', 'blogmagazine'),
        )
    )
);


/**
 * Enable Tagged
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_tags_post', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_enable_tags_post', 
        array(
            'label' => esc_html__('Show tags name on post?', 'blogmagazine'),
            'section' => 'template_post_options',
            'priority' => 70,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'blogmagazine'),
                'hide'=> esc_html__('Hide', 'blogmagazine'),
            ),
            'description'=> esc_html__('If you can show tags name on post details please check show button.', 'blogmagazine'),
        )
    )
);

/**
 * Enable Prev and Next post on single post
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_prev_next_button_post', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_prev_next_button_post', 
        array(
            'label' => esc_html__('Show before and after post link on post?', 'blogmagazine'),
            'section' => 'template_post_options',
            'priority' => 80,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'blogmagazine'),
                'hide'=> esc_html__('Hide', 'blogmagazine'),
            ),
            'description'=> esc_html__('If you can show before and after post link on post details please check show button.', 'blogmagazine'),
        )
    )
);

/**
 * Enable author info
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_author_info_post', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_author_info_post', 
        array(
            'label' => esc_html__('Show author info on post?', 'blogmagazine'),
            'section' => 'template_post_options',
            'priority' => 90,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'blogmagazine'),
                'hide'=> esc_html__('Hide', 'blogmagazine'),
            ),
            'description'=> esc_html__('If you can show author info on post details please check show button.', 'blogmagazine'),
        )
    )
);


/**
 * Related Posts
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_enable_related_posts',
    array(
        'default' => 'show',
        'sanitize_callback' => 'sanitize_text_field',
    )
);


$wp_customize->add_control( 
    new Dglib_Customize_Switch_Control(
        $wp_customize,
        'dglib_enable_related_posts',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Related Post Option', 'blogmagazine' ),
            'description'   => esc_html__( 'Show/Hide option for related posts section at single post page.', 'blogmagazine' ),
            'section'   => 'template_post_options',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'blogmagazine' ),
                'hide'  => esc_html__( 'Hide', 'blogmagazine' )
            ),
            'priority'  => 110,
        )
    )
);
$wp_customize->add_setting(
    'dglib_related_posts_title',
    array(
        'default'    => esc_html__( 'Related Posts', 'blogmagazine' ),
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'dglib_related_posts_title',
    array(
        'type'      => 'text',
        'label'     => esc_html__( 'Related Post Title', 'blogmagazine' ),
        'section'   => 'template_post_options',
        'priority'  => 120
    )
);

$wp_customize->add_setting(
    'dglib_related_posts_from',
    array(
        'default'    => 'category',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'dglib_related_posts_from',
    array(
        'type'      => 'select',
        'label'     => esc_html__( 'Related Posts from?', 'blogmagazine' ),
        'section'   => 'template_post_options',
        'priority'  => 130,
        'choices'   => dglib_taxonomy_list( 'post' ),
    )
);