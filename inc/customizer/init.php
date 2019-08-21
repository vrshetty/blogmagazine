<?php
/**
 * BlogMagazine Theme Customizer.
 *
 * @package dineshghimire
 * @subpackage BlogMagazine
 * @since 1.0.0
 */
if( !function_exists( 'blogmagazine_customizer' ) ):

    function blogmagazine_customizer($wp_customize){

    	require_once blogmagazine_file_directory( 'inc/customizer/upsell/blogmagazine-upsell-section.php' );
        require_once blogmagazine_file_directory( 'inc/customizer/header/panel-header.php' );
        require_once blogmagazine_file_directory( 'inc/customizer/templates/panel-templates.php' );
        require_once blogmagazine_file_directory( 'inc/customizer/footer/panel-footer.php' );
        require_once blogmagazine_file_directory( 'inc/customizer/colors/panel-colors.php' );
        require_once blogmagazine_file_directory( 'inc/customizer/options/panel-options.php' );
          
    }

endif;

add_action( 'dglib_customize_register', 'blogmagazine_customizer', 10, 1 );