<?php
/**
 * Post Settings
 *
 * @since 1.0.0
 */

$wp_customize->get_setting( 'dglib_related_posts_title' )->transport = 'postMessage';
$wp_customize->selective_refresh->add_partial(
    'dglib_related_posts_title', 
    array(
        'selector' => 'h2.blogmagazine-related-title',
        'render_callback' => 'blogmagazine_customize_partial_related_title',
    )
);