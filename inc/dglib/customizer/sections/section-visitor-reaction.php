<?php
/**
 * Visitor Reactions Section
 * @package dineshghimire
 * @subpackage dblib
 * @since 1.0.0
 */
$wp_customize->add_section(
    'visitor_reaction_section', 
    array(
        'title' => esc_html__('Visitor Reactions', '__Text_Domain__'),
        'panel' => 'site_additional_sections',
        'priority' => 20,
        'description' => esc_html__('Set reaction format and display visitor reactions in perentage and number.', '__Text_Domain__'),
    )
);

/**
 * Visitor Reaction Heading
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'visitor_reaction_heading', array(
        'default' => esc_html__('Share your feeling about this article.', '__Text_Domain__'),
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Control(
        $wp_customize,
        'visitor_reaction_heading',
        array(
            'label'    => esc_html__( 'Reactions Heading', '__Text_Domain__' ),
            'section'  => 'visitor_reaction_section',
            'settings' => 'visitor_reaction_heading',
            'type'     => 'text',
            'priority' => 10,
        )
    )
);

/**
 * Visitor Reaction Type
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'display_reaction_value', array(
        'default' => 'percentage',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Control(
        $wp_customize,
        'display_reaction_value',
        array(
            'label'    => esc_html__( 'Display Reactions Type', '__Text_Domain__' ),
            'description' => esc_html__('Choose display reaction type.', '__Text_Domain__'),
            'section'  => 'visitor_reaction_section',
            'settings' => 'display_reaction_value',
            'type'     => 'select',
            'priority' => 10,
            'choices'  => array(
                'percentage' => esc_html__( 'Percentage', '__Text_Domain__' ),
                'total_number' => esc_html__( 'Total Values', '__Text_Domain__' ),
            ),
        )
    )
);

/**
 * Repeater field for social media icons
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'dglib_reaction_icons', 
    array(
        'sanitize_callback' => 'dglib_sanitize_repeater_data',
        'default' => json_encode( 
            array(
                'reaction_icon_name' => 'like',
                'reaction_icon_title' => '',
            ) 
        ),
    )
);
$wp_customize->add_control(
    new Dglib_Customizer_Repeater_Control(
        $wp_customize, 
        'dglib_reaction_icons', 
        array(
            'label' => esc_html__('Visitor reaction icons.', '__Text_Domain__'),
            'section' => 'visitor_reaction_section',
            'settings' => 'dglib_reaction_icons',
            'priority' => 20,
            'add_row_label' => esc_html__('Add Reaction', '__Text_Domain__'),
            'wraper_item_label' => esc_html__('Reaction Details', '__Text_Domain__'),
        ), 
        array(
            'reaction_icon_name' => array(
                'type' => 'reaction',
                'label' => esc_html__('Reaction Icon', '__Text_Domain__'),
                'description' => esc_html__('Choose reaction icon.', '__Text_Domain__')
            ),
            'reaction_icon_title' => array(
                'type' => 'text',
                'label' => esc_html__('Reaction Title', '__Text_Domain__'),
                'description' => esc_html__('Enter reaction title here.', '__Text_Domain__')
            ),

        )
    )
);
