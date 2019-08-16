<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if(!function_exists('blogmagazine_register_sidebar') ):

    function blogmagazine_register_sidebar() {

         register_sidebar(array(
            'name' => esc_html__('Sidebar Right', 'blogmagazine'),
            'id' => 'sidebar-right',
            'description' => esc_html__('Add widgets here to appear in your right sidebar.', 'blogmagazine'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="blogmagazine-block-title"><span class="title-wrapper">',
            'after_title' => '</span></h3>',
        ));

        register_sidebar(array(
            'name' => esc_html__('Sidebar Left', 'blogmagazine'),
            'id' => 'sidebar-left',
            'description' => esc_html__('Add widgets here to appear in your left sidebar.', 'blogmagazine'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="blogmagazine-block-title"><span class="title-wrapper">',
            'after_title' => '</span></h2>',
        ));

        register_sidebar( array(
            'name'          => esc_html__( 'Header Ads', 'blogmagazine' ),
            'id'            => 'blogmagazine_header_ads_area',
            'description'   => esc_html__( 'Add banner widgets here.', 'blogmagazine' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title"><span class="title-wrapper">',
            'after_title'   => '</span></h2>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Home Top Section', 'blogmagazine' ),
            'id'            => 'blogmagazine_home_top_section_area',
            'description'   => esc_html__( 'Add widgets here.', 'blogmagazine' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="blogmagazine-block-title"><span class="title-wrapper">',
            'after_title'   => '</span></h2>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Home Middle Section', 'blogmagazine' ),
            'id'            => 'blogmagazine_home_middle_section_area',
            'description'   => esc_html__( 'Add widgets here.', 'blogmagazine' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="blogmagazine-block-title"><span class="title-wrapper">',
            'after_title'   => '</span></h2>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Home Middle Aside', 'blogmagazine' ),
            'id'            => 'blogmagazine_home_middle_aside_area',
            'description'   => esc_html__( 'Add widgets here.', 'blogmagazine' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="blogmagazine-block-title"><span class="title-wrapper">',
            'after_title'   => '</span></h3>',
        ) );

        register_sidebar( array(
            'name'          => esc_html__( 'Home Bottom Section', 'blogmagazine' ),
            'id'            => 'blogmagazine_home_bottom_section_area',
            'description'   => esc_html__( 'Add widgets here.', 'blogmagazine' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="blogmagazine-block-title"><span class="title-wrapper">',
            'after_title'   => '</span></h2>',
        ) );

        register_sidebars(4, array(
            'name' => esc_html__('Footer Widget Area %d', 'blogmagazine'),
            'id' => 'blogmagazine-footer',
            'description' => esc_html__('Add widgets here to appear in your footer.', 'blogmagazine'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span class="title-wrapper">',
            'after_title' => '</span></h3>',
        ));
        
    }

endif;
add_action('dglib_widgets_init', 'blogmagazine_register_sidebar', 20);

if(!function_exists('blogmagazine_register_widgets')):

    function blogmagazine_register_widgets(){

        require_once blogmagazine_file_directory('inc/widgets/functions-blogmagazine-widgets.php');
        require_once blogmagazine_file_directory('inc/widgets/class-dg-blockposts-widget.php');
        require_once blogmagazine_file_directory('inc/widgets/class-dg-carousel-widget.php');
        require_once blogmagazine_file_directory('inc/widgets/class-dg-featured-posts-widget.php');
        require_once blogmagazine_file_directory('inc/widgets/class-dg-featured-slider-widget.php');
        require_once blogmagazine_file_directory('inc/widgets/class-dg-tabbed-widget.php');
        require_once blogmagazine_file_directory('inc/widgets/class-dg-recent-posts-widget.php');

        register_widget( 'BlogMagazine_BlockPosts_Widget' );
        register_widget( 'BlogMagazine_Carousel_Widget' );
        register_widget( 'BlogMagazine_Featured_Posts_Widget' );
        register_widget( 'BlogMagazine_Featured_Slider_Widget' );
        register_widget( 'BlogMagazine_Tabbed_Widget' );
        register_widget( 'BlogMagazine_Recent_Posts_Widget' );

    }

endif;
add_action('dglib_widgets_init', 'blogmagazine_register_widgets', 30);