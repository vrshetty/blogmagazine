<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */

if(!function_exists('blogmagazine_body_sidebar_id')):

    function blogmagazine_body_sidebar_id( ) {

        $sidebar_id = 'right_sidebar';

        if( is_home() ){
            $sidebar_id        = get_theme_mod( 'dglib_default_index_sidebar', 'right_sidebar' );
        }

        if(is_archive()){
            $sidebar_id        = get_theme_mod( 'dglib_default_archive_sidebar', 'right_sidebar' );
        }

        if(is_search()){
            $sidebar_id        = get_theme_mod( 'dglib_default_search_sidebar', 'right_sidebar' );
        }

        if(is_404()){
            $sidebar_id        = get_theme_mod( 'dglib_default_notfound_sidebar', 'right_sidebar' );
        }

        $post_type = get_post_type();
        if( is_singular() && $post_type == 'post' ){
            $sidebar_id        = get_theme_mod( 'dglib_default_post_sidebar', 'right_sidebar' );
        }

        if( is_singular() && $post_type == 'page' ){
            $sidebar_id        = get_theme_mod( 'dglib_default_page_sidebar', 'right_sidebar' );
        }      
       
        if(is_singular()){

            $sidebar_metabox = get_post_meta( get_the_ID(), 'dglib_single_post_sidebar', true );
            $sidebar_layout = (isset($sidebar_metabox['sidebar_layout'])) ? $sidebar_metabox['sidebar_layout'] : '';
            $sidebar_id = ( $sidebar_layout && $sidebar_layout != 'default_sidebar' ) ? $sidebar_layout : $sidebar_id;
        }

        return $sidebar_id;

    }


endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blogmagazine_body_classes_old( $classes ) {

    global $post;

    /**
     * Sidebar option for post/page/archive
     *
     * @since 1.0.0
     */
    if( 'post' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, 'np_single_post_sidebar', true );
    }

    if( 'page' === get_post_type() ) {
        $sidebar_meta_option = get_post_meta( $post->ID, '  ', true );
    }
     
    if( is_home() ) {
        $home_id = get_option( 'page_for_posts' );
        $sidebar_meta_option = get_post_meta( $home_id, 'np_single_post_sidebar', true );
    }
    
    if( empty( $sidebar_meta_option ) || is_archive() || is_search() ) {
        $sidebar_meta_option = 'default_sidebar';
    }
    $archive_sidebar        = get_theme_mod( 'dglib_default_archive_sidebar', 'right_sidebar' );
    $post_default_sidebar   = get_theme_mod( 'dglib_default_post_sidebar', 'right_sidebar' );        
    $page_default_sidebar   = get_theme_mod( 'dglib_default_page_sidebar', 'right_sidebar' );
    
    if( $sidebar_meta_option == 'default_sidebar' ) {
        if( is_single() ) {
            if( $post_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif( $post_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif( $post_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar';
            } elseif( $post_default_sidebar == 'no_sidebar_center' ) {
                $classes[] = 'no-sidebar-center';
            }
        } elseif( is_page() && !is_page_template( 'templates/home-template.php' ) ) {
            if( $page_default_sidebar == 'right_sidebar' ) {
                $classes[] = 'right-sidebar';
            } elseif( $page_default_sidebar == 'left_sidebar' ) {
                $classes[] = 'left-sidebar';
            } elseif( $page_default_sidebar == 'no_sidebar' ) {
                $classes[] = 'no-sidebar';
            } elseif( $page_default_sidebar == 'no_sidebar_center' ) {
                $classes[] = 'no-sidebar-center';
            }
        } elseif( $archive_sidebar == 'right_sidebar' ) {
            $classes[] = 'right-sidebar';
        } elseif( $archive_sidebar == 'left_sidebar' ) {
            $classes[] = 'left-sidebar';
        } elseif( $archive_sidebar == 'no_sidebar' ) {
            $classes[] = 'no-sidebar';
        } elseif( $archive_sidebar == 'no_sidebar_center' ) {
            $classes[] = 'no-sidebar-center';
        }
    } elseif( $sidebar_meta_option == 'right_sidebar' ) {
        $classes[] = 'right-sidebar';
    } elseif( $sidebar_meta_option == 'left_sidebar' ) {
        $classes[] = 'left-sidebar';
    } elseif( $sidebar_meta_option == 'no_sidebar' ) {
        $classes[] = 'no-sidebar';
    } elseif( $sidebar_meta_option == 'no_sidebar_center' ) {
        $classes[] = 'no-sidebar-center';
    }

    /**
     * option for web site layout 
     */
    $blogmagazine_website_layout = esc_attr( get_theme_mod( 'blogmagazine_site_layout', 'fullwidth_layout' ) );
    
    if( !empty( $blogmagazine_website_layout ) ) {
        $classes[] = $blogmagazine_website_layout;
    }

    /**
     * Class for archive
     */
    if( is_archive() ) {
        $blogmagazine_archive_layout = get_theme_mod( 'blogmagazine_archive_layout', 'classic' );
        if( !empty( $blogmagazine_archive_layout ) ) {
            $classes[] = 'archive-'.$blogmagazine_archive_layout;
        }
    }

    return $classes;
}
if( !function_exists( 'blogmagazine_body_classes' ) ):
    
    function blogmagazine_body_classes( $classes ) {

        if ( is_multi_author() ) {
            $classes[] = 'group-blog';
        }

        /**
         * option for web site layout 
         */
        $website_layout = esc_attr( get_theme_mod( 'blogmagazine_site_layout', 'fullwidth_layout' ) );

        $classes[] = $website_layout;

        // Adds a class of hfeed to non-singular pages.
        if ( ! is_singular() ) {
            $classes[] = 'hfeed';
        }

        $sidebar_id = blogmagazine_body_sidebar_id();
        
        $sidebar_class = 'right-sidebar';
        
        switch($sidebar_id){

            case 'right_sidebar':
                $sidebar_class = 'right-sidebar';
                break;

            case 'left_sidebar':
                $sidebar_class = 'left-sidebar';
                break;

            case 'no_sidebar':
                $sidebar_class = 'no-sidebar';
                break;

            case 'no_sidebar_center':
                $sidebar_class = 'no-sidebar-center';
                break;

            case 'both_sidebar':
                $sidebar_class = 'both-sidebar';
                break;

            default: 
                $sidebar_class = 'right-sidebar';
                break;

        }

        $classes[] = $sidebar_class;

        return $classes;

    }

endif;

add_filter( 'body_class', 'blogmagazine_body_classes' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register Google fonts for blogmagazine.
 *
 * @return string Google fonts URL for the theme.
 * @since 1.0.0
 */
if ( ! function_exists( 'blogmagazine_fonts_url' ) ) :
    function blogmagazine_fonts_url() {
        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto Condensed, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Roboto Condensed font: on or off', 'blogmagazine' ) ) {
            $font_families[] = 'Roboto Condensed:300italic,400italic,700italic,400,300,700';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'blogmagazine' ) ) {
            $font_families[] = 'Roboto:300,400,400i,500,700';
        }

        /*
         * Translators: If there are characters in your language that are not supported
         * by Titillium Web, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Titillium Web font: on or off', 'blogmagazine' ) ) {
            $font_families[] = 'Titillium Web:400,600,700,300';
        }       

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles for only admin
 *
 * @since 1.0.0
 */
add_action( 'admin_enqueue_scripts', 'blogmagazine_admin_scripts' );

function blogmagazine_admin_scripts( $hook ) {

    global $blogmagazine_version;

    if( 'widgets.php' != $hook && 'customize.php' != $hook && 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook ) {
        return;
    }

    wp_enqueue_script( 'jquery-ui-button' );
    
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function blogmagazine_scripts() {
    
    global $blogmagazine_version;

    wp_enqueue_style( 'blogmagazine-fonts', blogmagazine_fonts_url(), array(), null );

    wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );

    wp_enqueue_style( 'lightslider-style', get_template_directory_uri().'/assets/library/lightslider/css/lightslider.min.css', array(), '1.1.6' );
   
    wp_enqueue_style( 'blogmagazine-responsive-style', get_template_directory_uri().'/assets/css/blogmagazine.min.css', array(), '1.0.0' );

    wp_enqueue_style( 'blogmagazine-style', get_stylesheet_uri(), array(), esc_attr( $blogmagazine_version ) );

    $menu_sticky_option = get_theme_mod( 'blogmagazine_menu_sticky_option', 'show' );
    if ( $menu_sticky_option == 'show' ) {
        wp_enqueue_script( 'jquery-sticky', get_template_directory_uri(). '/assets/library/sticky/jquery.sticky.js', array( 'jquery' ), '20150416', true );
    }

    wp_enqueue_script( 'blogmagazine-skip-link-focus-fix', get_template_directory_uri() . '/assets/library/_s/js/skip-link-focus-fix.js', array(), esc_attr( $blogmagazine_version ), true );

    wp_enqueue_script( 'lightslider', get_template_directory_uri().'/assets/library/lightslider/js/lightslider.min.js', array('jquery'), '1.1.6', true );

    wp_enqueue_script( 'blogmagazine-main', get_template_directory_uri().'/assets/js/blogmagazine.min.js', array('jquery'), esc_attr( $blogmagazine_version ), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'blogmagazine_scripts' );

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Social media function
 *
 * @since 1.0.0
 */

if( !function_exists( 'blogmagazine_social_media' ) ):
    function blogmagazine_social_media() {
        $get_social_media_icons = get_theme_mod( 'social_media_icons', '' );
        $get_decode_social_media = json_decode( $get_social_media_icons );
        if( ! empty( $get_decode_social_media ) ) {
            echo '<div class="blogmagazine-social-icons-wrapper">';
            foreach ( $get_decode_social_media as $single_icon ) {
                $icon_class = $single_icon->icon_class;
                $icon_url = $single_icon->icon_url;
                if( !empty( $icon_url ) ) {
                    echo '<span class="social-link"><a href="'. esc_url( $icon_url ) .'" target="_blank"><i class="'. esc_attr( $icon_class ) .'"></i></a></span>';
                }
            }
            echo '</div><!-- .blogmagazine-social-icons-wrapper -->';
        }
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Category list
 *
 * @return array();
 */
if( !function_exists( 'blogmagazine_categories_lists' ) ):
    function blogmagazine_categories_lists() {
        $blogmagazine_categories = get_categories( array( 'hide_empty' => 1 ) );
        $blogmagazine_categories_lists = array();
        foreach( $blogmagazine_categories as $category ) {
            $blogmagazine_categories_lists[$category->term_id] = $category->name;
        }
        return $blogmagazine_categories_lists;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Category dropdown
 *
 * @return array();
 */
if( !function_exists( 'blogmagazine_categories_dropdown' ) ):
    function blogmagazine_categories_dropdown() {
        $blogmagazine_categories = get_categories( array( 'hide_empty' => 1 ) );
        $blogmagazine_categories_lists = array();
        $blogmagazine_categories_lists['0'] = esc_html__( 'Select Category', 'blogmagazine' );
        foreach( $blogmagazine_categories as $category ) {
            $blogmagazine_categories_lists[esc_attr( $category->term_id )] = esc_html( $category->name );
        }
        return $blogmagazine_categories_lists;
    }
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Get minified css and removed space
 *
 * @since 1.0.0
 */
function blogmagazine_css_strip_whitespace( $css ){
    $replace = array(
        "#/\*.*?\*/#s" => "",  // Strip C style comments.
        "#\s\s+#"      => " ", // Strip excess whitespace.
    );
    $search = array_keys( $replace );
    $css = preg_replace( $search, $replace, $css );

    $replace = array(
        ": "  => ":",
        "; "  => ";",
        " {"  => "{",
        " }"  => "}",
        ", "  => ",",
        "{ "  => "{",
        ";}"  => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        "} "  => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys( $replace );
    $css = str_replace( $search, $replace, $css );

    return trim( $css );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_hover_color' ) ) :
    function blogmagazine_hover_color( $hex, $steps ) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max( -255, min( 255, $steps ) );

        // Normalize into a six character long hex string
        $hex = str_replace( '#', '', $hex );
        if ( strlen( $hex ) == 3) {
            $hex = str_repeat( substr( $hex,0,1 ), 2 ).str_repeat( substr( $hex, 1, 1 ), 2 ).str_repeat( substr( $hex,2,1 ), 2 );
        }

        // Split into three parts: R, G and B
        $color_parts = str_split( $hex, 2 );
        $return = '#';

        foreach ( $color_parts as $color ) {
            $color   = hexdec( $color ); // Convert to decimal
            $color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
            $return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
        }

        return $return;
    }
endif;


/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Function define about page/post/archive sidebar
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_get_sidebar_name' ) ):

function blogmagazine_get_sidebar_name() {

    $default_sidebar = 'right_sidebar';
    $sidebar_name = $default_sidebar;
    if(is_home()){
        $sidebar_name = get_theme_mod( 'dglib_default_index_sidebar', $default_sidebar );
    }
    if(is_archive()){
        $sidebar_name = get_theme_mod( 'dglib_default_archive_sidebar', $default_sidebar );
    }
    if(is_search()){
        $sidebar_name = get_theme_mod( 'dglib_default_search_sidebar', $default_sidebar );
    }
    if(is_404()){
        $sidebar_name = get_theme_mod( 'dglib_default_notfound_sidebar', $default_sidebar );
    }
    if(is_page()){
        $page_sidebar_name = get_theme_mod( 'dglib_default_page_sidebar', $default_sidebar );
        $metabox_sidebar_details = get_post_meta( get_the_ID(), 'dglib_single_post_sidebar', true );
        $metabox_sidebar_name = (isset($metabox_sidebar_details['sidebar_layout'])) ? esc_attr($metabox_sidebar_details['sidebar_layout']) : '';
        $sidebar_name = ( $metabox_sidebar_name && $metabox_sidebar_name !='default_sidebar' ) ? $metabox_sidebar_name : $page_sidebar_name;       
    }
    if(is_single()){
        $single_sidebar_name = get_theme_mod( 'dglib_default_post_sidebar', $default_sidebar );
        $metabox_sidebar_details = get_post_meta( get_the_ID(), 'dglib_single_post_sidebar', true );
        $metabox_sidebar_name = (isset($metabox_sidebar_details['sidebar_layout'])) ? esc_attr($metabox_sidebar_details['sidebar_layout']) : '';
        $sidebar_name = ( $metabox_sidebar_name && $metabox_sidebar_name !='default_sidebar' ) ? $metabox_sidebar_name : $single_sidebar_name;  
    }

    return $sidebar_name;

}
endif;

/**
 * Function to get sidebar name in array
 *
 * @since 1.0.0
 */
if(!function_exists('blogmagazine_sidebar_name_arrray') ){

    function blogmagazine_sidebar_name_array(){
        $sidebar_name = blogmagazine_get_sidebar_name();
        $blogmagazine_sidebars = array();
        switch ($sidebar_name){
            case 'left_sidebar':
                $blogmagazine_sidebars[] = 'sidebar-left';
                break;
            case 'right_sidebar':
                $blogmagazine_sidebars[] = 'sidebar-right';
                break;
            case 'both_sidebar':
                $blogmagazine_sidebars[] = 'sidebar-left';
                $blogmagazine_sidebars[] = 'sidebar-right';
                break;
            case 'no_sidebar':
            case 'no_sidebar_center':
                $blogmagazine_sidebars = array();
                break;
            default:
                $blogmagazine_sidebars[] = 'sidebar-right';
                break;
        }

        return $blogmagazine_sidebars;
    }

}
