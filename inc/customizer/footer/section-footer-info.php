<?php
/**
 * Bottom Section
 *
 * @since 1.0.0
 */
$wp_customize->get_setting( 'footer_copyright_text' )->transport = 'postMessage';

$wp_customize->selective_refresh->add_partial( 
    'footer_copyright_text', 
    array(
        'selector' => 'span.blogmagazine-copyright-text',
        'render_callback' => 'blogmagazine_customize_partial_copyright',
    )
);
