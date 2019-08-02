<?php
/*
 * Blog Page
 */
$wp_customize->add_setting(
    'blogmagazine_index_layout',
    array(
        'default'           => 'classic',
        'sanitize_callback' => 'blogmagazine_sanitize_list_item_layout',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Imageoptions_Control(
        $wp_customize,
        'blogmagazine_index_layout',
        array(
            'label'    => esc_html__( 'Blog Layouts', 'blogmagazine' ),
            'description' => esc_html__( 'Choose layout from available layouts', 'blogmagazine' ),
            'section'  => 'template_index_options',
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