<?php
/**
 * BlogMagazine Functions
 */
require_once blogmagazine_file_directory('inc/functions/init.php');

/*
 * Include dglib library 
 */
require_once blogmagazine_file_directory( 'inc/dglib/init.php' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
require_once blogmagazine_file_directory( 'inc/widgets/init.php' );

/**
 * require BlogMagazine hooks files.
 */
require_once blogmagazine_file_directory( 'inc/hooks/init.php' );

/**
 * BlogMagazine Customizer
 */
require_once blogmagazine_file_directory( 'inc/customizer/init.php' );

/**
 * BlogMagazine TGMPA initialized
 */
require_once blogmagazine_file_directory( 'inc/tgmpa/init.php' );
