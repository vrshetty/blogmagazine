<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */

if(!function_exists('blogmagazine_sidebar_layout_name')):

    function blogmagazine_sidebar_layout_name( ) {

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

        $sidebar_id = apply_filters( 'blogmagazine_sidebar_layout_name', $sidebar_id );      
       
        if(is_singular()){

            $sidebar_metabox = get_post_meta( get_the_ID(), 'dglib_single_post_sidebar', true );
            $sidebar_layout = (isset($sidebar_metabox['sidebar_layout'])) ? $sidebar_metabox['sidebar_layout'] : '';
            $sidebar_id = ( $sidebar_layout && $sidebar_layout != 'default_sidebar' ) ? $sidebar_layout : $sidebar_id;
        }       

        return $sidebar_id;

    }


endif;

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

        $sidebar_id = blogmagazine_sidebar_layout_name();
        
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

        $sidebar_class = apply_filters( 'blogmagazine_body_sidebar_class', $sidebar_class );

        $classes[] = $sidebar_class;

        return $classes;

    }

endif;

add_filter( 'body_class', 'blogmagazine_body_classes' );

/**
 * Function to get sidebar name in array
 *
 * @since 1.0.0
 */
if(!function_exists('blogmagazine_sidebar_name_array') ){

    function blogmagazine_sidebar_name_array(){
        $sidebar_name = blogmagazine_sidebar_layout_name();
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

        $blogmagazine_sidebars = apply_filters( 'blogmagazine_sidebar_name_list', $blogmagazine_sidebars );

        return $blogmagazine_sidebars;
    }

}


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
        $font_families = apply_filters( 'blogmagazine_google_fontfamilies', $font_families );
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
                $icon_class = (isset($single_icon->icon_class)) ? $single_icon->icon_class : '';
                $icon_url = (isset($single_icon->icon_url)) ? $single_icon->icon_url : '';
                $icon_background = (isset($single_icon->icon_background)) ? $single_icon->icon_background : '';
                if( !empty( $icon_url ) ) {
                    echo '<span class="social-link"><a href="'. esc_url( $icon_url ) .'" target="_blank" style="background-color: '.esc_attr($icon_background).';"><i class="fa '. esc_attr( $icon_class ) .'"></i></a></span>';
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
        $blogmagazine_categories = get_categories( array( 'hide_empty' => false ) );
        $blogmagazine_categories_lists = array();
        foreach( $blogmagazine_categories as $category ) {
            $blogmagazine_categories_lists[$category->term_id] = $category->name . ' ('.$category->count.')';
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
            $blogmagazine_categories_lists[esc_attr( $category->term_id )] = esc_html( $category->name . ' ('.$category->count.')' );
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



if(!function_exists('blogmagazine_fallback_menu')):

    function blogmagazine_fallback_primary_menu(){
        ?>
        <div class="menu-primary-menu-container">
            <ul id="primary-menu" class="primary-menu menu">
                <li class="menu-item"><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e( 'Home', 'blogmagazine' ); ?></a></li>
            </ul>
        </div>
        <?php
    }
    
endif;

