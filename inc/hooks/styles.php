<?php
/**
 * Dynamic style about template
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_dynamic_styles' ) ) :

    function blogmagazine_dynamic_styles() {

        $get_categories = get_categories( array( 'hide_empty' => 1 ) );
        $blogmagazine_theme_color = get_theme_mod( 'blogmagazine_theme_color', '#0c4da2' );
        $blogmagazine_theme_hover_color = blogmagazine_hover_color( $blogmagazine_theme_color, '-50' );

        $blogmagazine_site_title_option = get_theme_mod( 'blogmagazine_site_title_option', 'true' );        
        $blogmagazine_site_title_color = get_theme_mod( 'blogmagazine_site_title_color', '#0c4da2' );
        $header_text_color = get_theme_mod( 'header_textcolor', '#3d3d3d' );
        $output_css = '';

        foreach( $get_categories as $category ){

            $cat_color = get_theme_mod( 'dglib_category_color_'.strtolower( $category->slug ), '' );
            if(!$cat_color){
                continue;
            }

            $cat_hover_color = blogmagazine_hover_color( $cat_color, '-50' );
            $cat_id = $category->term_id;
            
            if( !empty( $cat_color ) ) {
                $output_css .= ".category-button.blogmagazine-cat-". esc_attr( $cat_id ) ." a { background-color: ". esc_attr( $cat_color ) ."; color:#fff;}\n";

                $output_css .= ".category-button.blogmagazine-cat-". esc_attr( $cat_id ) ." a:hover { color:#fff; }\n";

                $output_css .= ".category-button.blogmagazine-cat-". esc_attr( $cat_id ) ." a:hover { background-color: ". esc_attr( $cat_hover_color ) ."}\n";

                $output_css .= ".blogmagazine-block-title .blogmagazine-cat-". esc_attr( $cat_id ) ." { color: ". esc_attr( $cat_color ) ."}\n";
            }
        }

        $output_css .= ".ticker-caption, .blogmagazine-ticker-block .lSAction > a, .page-header .page-title, .blogmagazine-block-title .wdgt-tab-term.active-item, .blogmagazine-block-title .wdgt-tab-term:hover, .blogmagazine-block-title .title-wrapper, .blogmagazine-header-menu-block-wrap, .navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.widget_search .search-submit,.edit-link .post-edit-link,.reply .comment-reply-link,.blogmagazine-top-header-wrap,.blogmagazine-header-menu-wrapper,.main-navigation ul.sub-menu, .main-navigation ul.children,.blogmagazine-header-menu-wrapper::before, .blogmagazine-header-menu-wrapper::after,.blogmagazine-header-search-wrapper .search-form-main .search-submit,.blogmagazine_default_tabbed ul.widget-tabs li,.blogmagazine-full-width-title-nav-wrap .carousel-nav-action .carousel-controls:hover,.blogmagazine_social_media .social-link a,.blogmagazine-archive-more .blogmagazine-button:hover,.error404 .page-title,#blogmagazine-scrollup,.blogmagazine_featured_slider .slider-posts .lSAction > a:hover,div.wpforms-container-full .wpforms-form input[type='submit'], div.wpforms-container-full .wpforms-form button[type='submit'],div.wpforms-container-full .wpforms-form .wpforms-page-button,div.wpforms-container-full .wpforms-form input[type='submit']:hover, div.wpforms-container-full .wpforms-form button[type='submit']:hover,div.wpforms-container-full .wpforms-form .wpforms-page-button:hover { background-color: ". esc_attr( $blogmagazine_theme_color ) ."}\n";

        $output_css .= ".main-navigation ul .menu-item.current-menu-item > a, .main-navigation ul .menu-item.current-page-ancestor > a, .main-navigation ul .menu-item:hover > a, .home .blogmagazine-home-icon a, .main-navigation ul .menu-item:hover > a, .blogmagazine-home-icon a:hover,.main-navigation ul li:hover > a, .main-navigation ul li.current-menu-item > a,.main-navigation ul li.current_page_item > a,.main-navigation ul li.current-menu-ancestor > a,.blogmagazine_default_tabbed ul.widget-tabs li.ui-tabs-active, .blogmagazine_default_tabbed ul.widget-tabs li:hover { background-color: ". esc_attr( $blogmagazine_theme_hover_color ) ."}\n";

        $output_css .= ".blogmagazine-header-menu-block-wrap::before, .blogmagazine-header-menu-block-wrap::after { border-right-color: ". esc_attr( $blogmagazine_theme_hover_color ) ."}\n";

        $output_css .= "a,a:hover,a:focus,a:active,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.entry-footer a:hover,.comment-author .fn .url:hover,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.blogmagazine-slide-content-wrap .post-title a:hover,#middle-footer .widget a:hover,#middle-footer .widget a:hover:before,#middle-footer .widget li:hover:before,.blogmagazine_featured_posts .blogmagazine-single-post .blogmagazine-post-content .blogmagazine-post-title a:hover,.blogmagazine_fullwidth_posts .blogmagazine-single-post .blogmagazine-post-title a:hover,.blogmagazine_block_posts .layout3 .blogmagazine-primary-block-wrap .blogmagazine-single-post .blogmagazine-post-title a:hover,.blogmagazine_featured_posts .layout2 .blogmagazine-single-post-wrap .blogmagazine-post-content .blogmagazine-post-title a:hover,.blogmagazine-related-title,.blogmagazine-post-meta span:hover,.blogmagazine-post-meta span a:hover,.blogmagazine_featured_posts .layout2 .blogmagazine-single-post-wrap .blogmagazine-post-content .blogmagazine-post-meta span:hover,.blogmagazine_featured_posts .layout2 .blogmagazine-single-post-wrap .blogmagazine-post-content .blogmagazine-post-meta span a:hover,.blogmagazine-post-title.small-size a:hover,#footer-navigation ul li a:hover,.entry-title a:hover,.entry-meta span a:hover,.entry-meta span:hover,.blogmagazine-post-meta span:hover, .blogmagazine-post-meta span a:hover, .blogmagazine_featured_posts .blogmagazine-single-post-wrap .blogmagazine-post-content .blogmagazine-post-meta span:hover, .blogmagazine_featured_posts .blogmagazine-single-post-wrap .blogmagazine-post-content .blogmagazine-post-meta span a:hover,.blogmagazine_featured_slider .featured-posts .blogmagazine-single-post .blogmagazine-post-content .blogmagazine-post-title a:hover, .blogmagazine-block-title .wdgt-tab-term { color: ". esc_attr( $blogmagazine_theme_color ) ."}\n";

        $output_css .= ".dglib-breadcrumbs-wrapper .layout2 li.trail-item::before{ border-top-color: ".esc_attr($blogmagazine_theme_color)."; border-bottom-color: ".esc_attr($blogmagazine_theme_color)."; }\n";
        $output_css .= ".dglib-breadcrumbs-wrapper .layout2 li.trail-item::after{ border-left-color: ".esc_attr($blogmagazine_theme_color)."; }\n";
        $output_css .= ".dglib-breadcrumbs-wrapper .layout2 li.trail-item > a, .dglib-breadcrumbs-wrapper .layout2 li.trail-item > span{background-color:".esc_attr($blogmagazine_theme_color).";}\n";

        $output_css .= ".dglib-breadcrumbs-wrapper .layout2 li.trail-item.trail-end::before{ border-top-color: ".esc_attr($blogmagazine_theme_hover_color)."; border-bottom-color: ".esc_attr($blogmagazine_theme_hover_color)."; }\n";
        $output_css .= ".dglib-breadcrumbs-wrapper .layout2 li.trail-item.trail-end::after{ border-left-color: ".esc_attr($blogmagazine_theme_hover_color)."; }\n";
        $output_css .= ".dglib-breadcrumbs-wrapper .layout2 li.trail-item.trail-end > a, .dglib-breadcrumbs-wrapper .layout2 li.trail-item.trail-end > span{background-color:".esc_attr($blogmagazine_theme_hover_color).";}\n";        

        $output_css .= ".page-header, .blogmagazine-block-title, .navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.widget_search .search-submit,.blogmagazine-archive-more .blogmagazine-button:hover { border-color: ". esc_attr( $blogmagazine_theme_color ) ."}\n";

        $output_css .= ".comment-list .comment-body,.blogmagazine-header-search-wrapper .search-form-main { border-top-color: ". esc_attr( $blogmagazine_theme_color ) ."}\n";
        
        $output_css .= ".blogmagazine-header-search-wrapper .search-form-main:before { border-bottom-color: ". esc_attr( $blogmagazine_theme_color ) ."}\n";

        $output_css .= ".blogmagazine-block-title .wdgt-tab-term.active-item a, .blogmagazine-block-title .wdgt-tab-term:hover a{ color:#fff; }";

        $output_css .= ".blogmagazine-logo-section-wrapper{color:".esc_attr($header_text_color)."}";

        if ( $blogmagazine_site_title_option == 'false' ) {
                $output_css .=".site-title, .site-description {
                            position: absolute;
                            clip: rect(1px, 1px, 1px, 1px);
                        }\n";
            } else {
                $output_css .=".site-title a{
                            color:". esc_attr( $blogmagazine_site_title_color ) .";
                        }\n";
            }

        $refine_output_css = blogmagazine_css_strip_whitespace( $output_css );

        wp_add_inline_style( 'blogmagazine-style', $refine_output_css );
        
    }
endif;

add_action( 'wp_enqueue_scripts', 'blogmagazine_dynamic_styles' );
