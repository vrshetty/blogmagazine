<?php 
/*
 * Breadcrumbs Section Frontend
 */
if( !function_exists( 'dglib_breadcrumbs_section_callback' ) ):

    function dglib_breadcrumbs_section_callback(){

        $enable_breadcrumbs = 'enable';
        if( is_single() ){
            $enable_breadcrumbs = get_theme_mod( 'dglib_enable_breadcrumbs_post', 'enable' );
        }
        if( is_page() ){
            $enable_breadcrumbs = get_theme_mod( 'dglib_enable_breadcrumbs_page', 'enable' );
        }
        if( is_home() ){
            $enable_breadcrumbs = get_theme_mod( 'dglib_enable_breadcrumbs_index', 'enable' );
        }
        if( is_search() ){
            $enable_breadcrumbs = get_theme_mod( 'dglib_enable_breadcrumbs_search', 'enable' );
        }
        if( is_archive() ){
            $enable_breadcrumbs = get_theme_mod( 'dglib_enable_breadcrumbs_archive', 'enable' );
        }

        if( is_404() ){
            $enable_breadcrumbs = get_theme_mod( 'dglib_enable_breadcrumbs_notfound', 'enable' );
        }
        if($enable_breadcrumbs == 'disable' ){
            return;
        }

        if ( ! function_exists( 'dglib_breadcrumb_trail' ) ) {
            require_once dglib_file_directory( 'library/breadcrumbs/breadcrumbs.php' );
        }
        $breadcrumbs_background = get_theme_mod( 'dglib_breadcrumbs_background', false );
        $breadcrumbs_class = get_theme_mod( 'dglib_breadcrumbs_layout', 'layout1' );
        $breadcrumbs_class .= ($breadcrumbs_background) ? ' has-image' : ' no-image';
        ?>
        <div id="breadcrumbs" class="dglib-breadcrumbs-wrapper">
            <div class="breadcrumbs-wrap <?php echo esc_attr($breadcrumbs_class); ?>" style="background-image:url(<?php echo esc_url($breadcrumbs_background); ?>);" >
                <div class="dglib-bdcb-container">
                    <?php
                    $breadcrumb_args = array(
                        'container'   => 'div',
                        'show_browse' => false,
                    );
                    dglib_breadcrumb_trail( $breadcrumb_args );
                    ?>
                </div><!-- .container -->
            </div>
        </div><!-- #breadcrumb -->
        <?php
    }

endif;
add_action( 'dglib_breadcrumbs_section_template', 'dglib_breadcrumbs_section_callback', 10 );