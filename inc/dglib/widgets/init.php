<?php
/*
 * Widget Initialized
 */

// Require Widget related Fields 
require_once dglib_file_directory('widgets/fields/init.php');
/*
 * Widget Register
 */
if(!function_exists('dglib_widget_initialize')):

    function dglib_widget_initialize(){

        require_once dglib_file_directory('widgets/function-dg-widget-dependencies.php');
        require_once dglib_file_directory('widgets/class-dg-social-icons-widget.php');
        require_once dglib_file_directory('widgets/class-dg-author-info-widget.php');
        
        register_widget( 'Dglib_Social_Icons_Widget' );
        register_widget( 'Dglib_Author_Info_Widget' );

        do_action( 'dglib_widgets_init' );

    }

endif;
add_action('widgets_init', 'dglib_widget_initialize');