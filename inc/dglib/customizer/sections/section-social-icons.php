<?php
/**
 * Social Icons Section
 * @package dineshghimire
 * @subpackage dglib
 * @since 1.0.0
 */
$wp_customize->add_section(
    'social_icons_section', 
    array(
        'title' => esc_html__('Social Icons', 'blogmagazine'),
        'panel' => 'site_additional_sections',
        'priority' => 10,
        'description' => esc_html__('Social media icons to display sidebar and widget from here.', 'blogmagazine'),
    )
);

/**
 * Repeater field for social media icons
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'social_media_icons', array(
        'sanitize_callback' => 'dglib_sanitize_repeater_data',
        'default' => json_encode(
            array(
                array(
                    'icon_class' => 'fa fa-facebook-f',
                    'icon_url' => '',
                    'icon_background' => '',
                )
            )
        )
    )
);
$wp_customize->add_control(
    new Dglib_Customizer_Repeater_Control(
        $wp_customize, 
        'social_media_icons', 
        array(
            'label' => esc_html__('Social Media Icons', 'blogmagazine'),
            'section' => 'social_icons_section',
            'settings' => 'social_media_icons',
            'priority' => 10,
            'add_row_label' => esc_html__('Add Icon', 'blogmagazine'),
            'wraper_item_label' => esc_html__('Social Media Icon', 'blogmagazine'),
            'description' => esc_html__('Social media icons for sharing article page and posts.', 'blogmagazine'),
            
        ), 
        array(
            'icon_class' => array(
                'type' => 'icons',
                'label' => esc_html__('Social Media Icon', 'blogmagazine'),
                'description' => esc_html__('Choose social media icon.', 'blogmagazine')
            ),
            'icon_url' => array(
                'type' => 'url',
                'label' => esc_html__('Social Icon Url', 'blogmagazine'),
                'description' => esc_html__('Enter social media url.', 'blogmagazine')
            ),
            'icon_background' => array(
                'type' => 'color',
                'default' => '#214d74',
                'label' => esc_html__('Social Icon Background', 'blogmagazine'),
                'description' => esc_html__('Choose social media icon background color.', 'blogmagazine')
            ),
        )
    )
);

