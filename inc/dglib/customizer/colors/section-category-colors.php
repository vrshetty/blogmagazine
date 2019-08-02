<?php
/**
 * Category Colors
 * @package dineshghimire
 * @subpackage dglib
 * @since 1.0.0
 */
$wp_customize->add_section(
	'dglib_categories_color_options',
	array(
		'priority'      => 20,
		'title'         => esc_html__( 'Category Colors', 'blogmagazine' ),
		'panel'         => 'site_color_options',
	)
);

$priority = 10;

$categories = get_categories( array( 'hide_empty' => 0 ) );

foreach ( $categories as $category_list ) {

	$wp_customize->add_setting( 
		'dglib_category_color_'.esc_attr( strtolower( $category_list->slug ) ),
		array(
			'default'              => '',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control(
			$wp_customize, 
			'dglib_category_color_'.esc_attr( strtolower( $category_list->slug ) ),
			array(
				/* translators: %s: Category Name */
				'label'    => sprintf( esc_html__( ' %s Button Background', 'blogmagazine' ), esc_attr( $category_list->name ) ),
				'section'  => 'dglib_categories_color_options',
				'priority' => $priority
			)
		)
	);

	$priority+=10;

}