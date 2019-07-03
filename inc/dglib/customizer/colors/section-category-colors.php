<?php
/**
 * Category Colors
 * @package dineshghimire
 * @subpackage dblib
 * @since 1.0.0
 */
$wp_customize->add_section(
	'dglib_categories_color_options',
	array(
		'priority'      => 20,
		'title'         => esc_html__( 'Category Colors', '__Text_Domain__' ),
		'panel'         => 'site_color_options',
	)
);

$priority = 10;

$categories = get_categories( array( 'hide_empty' => 0 ) );

foreach ( $categories as $category_list ) {

	$wp_customize->add_setting( 
		'dglib_category_color_'.esc_html( strtolower( $category_list->slug ) ),
		array(
			'default'              => '#00a9e0',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize, 
			'dglib_category_color_'.esc_html( strtolower( $category_list->slug ) ),
			array(
				'label'    => sprintf( esc_html__( ' %s Button Background', '__Text_Domain__' ), esc_html( $category_list->name ) ),
				'section'  => 'dglib_categories_color_options',
				'priority' => $priority
			)
		)
	);

	$priority+=10;

}