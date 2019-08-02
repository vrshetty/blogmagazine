<?php
/**
 * Social Icons Section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'dglib_breadcrumbs_section', 
    array(
        'title' => esc_html__('Breadcrumbs', 'blogmagazine'),
        'panel' => 'site_additional_sections',
        'priority' => 30,
    )
);

/**
 * Breadcrumbs Layout
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_breadcrumbs_layout', 
    array(
        'sanitize_callback' => 'dglib_sanitize_breadcrumbs_layout',
        'default' => 'layout1'
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'dglib_breadcrumbs_layout', 
        array(
            'label' => esc_html__('Breadcrumbs Layout', 'blogmagazine'),
            'section' => 'dglib_breadcrumbs_section',
            'priority' => 10,
            'type'=>'switch',
            'choices'=> array(
                'layout1'=> esc_html__('Layout One', 'blogmagazine'),
                'layout2'=> esc_html__('Layout Two', 'blogmagazine'),
            ),
            'description'=> esc_html__('You can choose breadcrumbs layout to show website.', 'blogmagazine'),
        )
    )
);

/**
 * Breadcrumbs Background
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_breadcrumbs_background', 
    array(
        'sanitize_callback' => 'esc_url_raw',
        'default'           => ''
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'dglib_breadcrumbs_background', 
        array(
            'type'      => 'image',
            'label'     => esc_html__('Breadcrumbs Background', 'blogmagazine'),
            'section'   => 'dglib_breadcrumbs_section',
            'priority'  => 20,
        )
    )
);

