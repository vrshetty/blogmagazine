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
        'title' => esc_html__('Page Options', 'blogmagazine'),
        'panel' => 'site_template_options',
        'priority' => 30,
    )
);

/**
 * Repeater field for social media icons
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'enable_reaction_page', array(
        'sanitize_callback' => 'esc_attr',
        'default' => 'disable',
    )
);
$wp_customize->add_control(
    new Dglib_Customize_Switch_Control(
        $wp_customize, 
        'enable_reaction_page', 
        array(
            'label' => esc_html__('Enable Reactions', 'blogmagazine'),
            'section' => 'template_page_options',
            'settings' => 'enable_reaction_page',
            'priority' => 10,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', 'blogmagazine'),
                'disable'=> esc_html__('Disable', 'blogmagazine'),
            ),
            'description'=> esc_html__('You can enable reaction to show after page details.', 'blogmagazine'),
        )
    )
);

