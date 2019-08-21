<?php

require_once blogmagazine_file_directory( 'inc/customizer/upsell/upsell-section.php' );

$wp_customize->register_section_type( 'BlogMagazine_Customize_Upsell_Section' );

// Register sections.
$wp_customize->add_section(
	new BlogMagazine_Customize_Upsell_Section(
		$wp_customize,
		'theme_upsell',
		array(
			'title'    => esc_html__( 'BlogMagazine Pro', 'blogmagazine' ),
			'pro_text' => esc_html__( 'View Pro', 'blogmagazine' ),
			'pro_url'  => 'https://dinesh-ghimire.com.np/downloads/blogmagazine-pro-premium-wordpress-plugin/?ref=blogmagazine-upsell-button',
			'priority' => 1,
		)
	)
);