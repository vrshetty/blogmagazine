<?php
/*
 * Header Panel
 */

$header_image = $wp_customize->get_section( 'header_image' );
$header_image->priority = 20;
$header_image->panel = 'site_header_panel';