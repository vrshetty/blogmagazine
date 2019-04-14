<?php
/**
 * Template Post
 * @package dineshghimire
 * @subpackage dblib
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
 * Repeater field for social media icons
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'enable_reaction_post', array(
        'sanitize_callback' => 'esc_attr',
        'default' => 'enable',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'enable_reaction_post', 
        array(
            'label' => esc_html__('Enable Reactions', 'blogmagazine'),
            'section' => 'template_post_options',
            'settings' => 'enable_reaction_post',
            'priority' => 10,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', 'blogmagazine'),
                'disable'=> esc_html__('Disable', 'blogmagazine'),
            ),
            'description'=> esc_html__('You can enable reaction to show after post details.', 'blogmagazine'),
        )
    )
);

