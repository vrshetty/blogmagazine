<?php
/*
 * Static Front Page
 */
$wp_customize->add_setting(
    'enable_magazine_layout', 
    array(
        'sanitize_callback' => 'blogmagazine_sanitize_enable_disable_option',
        'default' => 'enable',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'enable_magazine_layout', 
        array(
            'label' => esc_html__('Static homepage as Magazine Layout', 'blogmagazine'),
            'section' => 'static_front_page',
            'settings' => 'enable_magazine_layout',
            'priority' => 50,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', 'blogmagazine'),
                'disable'=> esc_html__('Disable', 'blogmagazine'),
            ),
            'description'=> esc_html__('Enable static homepage as magazine layout.', 'blogmagazine'),
        )
    )
);
