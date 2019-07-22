<?php
/**
 * @since DGLib 1.0.0
 * @param string $file_path, path from the dglib
 * @return string full path of file inside dglib
 *
 */
if( !function_exists('dglib_file_directory') ){

    function dglib_file_directory( $file_path ){

        $dglib_path = 'inc/dglib/'.$file_path;
        $parent_file_path = trailingslashit( get_stylesheet_directory() ) . $dglib_path;
        $child_file_path = trailingslashit( get_stylesheet_directory() ) . $dglib_path;
        if( file_exists( wp_normalize_path( $parent_file_path ) ) ){
            return wp_normalize_path( $parent_file_path );
        }else{
            return wp_normalize_path( $child_file_path );
        }

    }

}

/**
 * @since DGLib 1.0.0
 * @param string $file_path, path from the dglib
 * @return string full path of file inside dglib
 *
 */
if( !function_exists('dglib_directory_uri') ){

    function dglib_directory_uri( $file_url='' ){
    
        $dglib_file_url = '/inc/dglib/'.$file_url;

        $theme_file_url = get_template_directory_uri() . $dglib_file_url;

        return $theme_file_url;
    
    }

}

require_once dglib_file_directory('core/init.php');

require_once dglib_file_directory('widgets/init.php');

require_once dglib_file_directory('customizer/init.php');

require_once dglib_file_directory('hooks/init.php');

require_once dglib_file_directory('sections/init.php');

require_once dglib_file_directory('metabox/init.php');