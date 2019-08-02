<?php
/*
 * Archive Settings
 */

$wp_customize->add_setting(
    'blogmagazine_archive_layout',
    array(
        'default'           => 'classic',
        'sanitize_callback' => 'blogmagazine_sanitize_list_item_layout',
    )
);
$wp_customize->add_control( 
    new Dglib_Customize_Imageoptions_Control(
        $wp_customize,
        'blogmagazine_archive_layout',
        array(
            'label'    => esc_html__( 'Archive Layouts', 'blogmagazine' ),
            'description' => esc_html__( 'Choose layout from available layouts', 'blogmagazine' ),
            'section'  => 'template_archive_options',
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

$wp_customize->get_setting( 'dglib_readmore_text_archive' )->transport  = 'postMessage';

$wp_customize->selective_refresh->add_partial( 
    'dglib_readmore_text_archive', 
    array(
        'selector' => '.blogmagazine-archive-more > a',
        'render_callback' => 'blogmagazine_customize_partial_archive_more',
    )
);