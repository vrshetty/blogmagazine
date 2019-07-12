<?php
/*
 * Category Color
 */
$wp_customize->add_section(
	'blogmagazine_category_color',
	array(
		'title'         => esc_html__( 'Categories Color', 'blogmagazine' ),
		'priority'      => 20,
		'panel'         => 'site_color_options',
	)
);

$priority = 10;

$categories = get_categories( array( 'hide_empty' => 1 ) );

foreach ( $categories as $category_list ) {

	$wp_customize->add_setting( 
		'dglib_category_color_'.esc_attr( strtolower( $category_list->slug ) ),
		array(
			'default'              => '#00a9e0',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize, 
			'dglib_category_color_'.esc_attr( strtolower( $category_list->slug ) ),
			array(
				'label'    => sprintf( esc_html__( ' %s Button Background', 'blogmagazine' ), esc_html( $category_list->name ) ),
				'section'  => 'blogmagazine_category_color',
				'priority' => $priority
			)
		)
	);

	$priority+=10;

}
