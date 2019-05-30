<?php
/**
 * @widget_name: Featured Posts Widget
 * @description: Featured posts widgets goes here.
 * @package: dineshghimire
 * @subpackage: BlogMagazine
 * @author: Dinesh Ghimire
 * @author_uri: https://dinesh-ghimire.com.np
 * @since 1.0.0
 */
class BlogMagazine_Featured_Posts_Widget extends Dglib_Master_Widget{

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'blogmagazine_featured_posts',
            'description' => esc_html__( 'Displays featured posts from selected categories in different layouts.', 'blogmagazine' )
        );
        parent::__construct( 'blogmagazine_featured_posts', esc_html__( 'DG: Featured Posts', 'blogmagazine' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    public function widget_fields( $instance = array() ) {

        $blogmagazine_categories_lists = blogmagazine_categories_lists();
        
        $fields = array(
            'dg_widget_tab'       => array(
                'dg_widget_field_name'     => 'dg_widget_tab',
                'dg_widget_field_title'    => esc_html__( 'General', 'blogmagazine' ),
                'dg_widget_field_default'  => 'general',
                'dg_widget_field_type'     => 'tabgroup',
                'dg_widget_field_options'  => array(
                    'general'=>array(
                        'dg_widget_field_title'=>esc_html__('General', 'blogmagazine'),
                        'dg_widget_field_options'=> array(
                            'title' => array(
                                'dg_widget_field_name'         => 'title',
                                'dg_widget_field_title'        => esc_html__( 'Title', 'blogmagazine' ),
                                'dg_widget_field_description'  => esc_html__( 'Enter your block title. (Optional - Leave blank to hide the title.)', 'blogmagazine' ),
                                'dg_widget_field_type'   => 'text'
                            ),
                            'title_target'    => array(
                                'dg_widget_field_name'     => 'title_target',
                                'dg_widget_field_wraper'   => 'title-target',
                                'dg_widget_field_title'    => esc_html__( 'Link Target', 'blogmagazine' ),
                                'dg_widget_field_default'  => '',
                                'dg_widget_field_type'     => 'select',
                                'dg_widget_field_options'  => dglib_link_target(),
                                'dg_widget_field_relation' => array(
                                    'exist' => array(
                                        'show_fields'   => array(
                                            'title-link', 
                                        ),
                                    ),
                                    'empty' => array(
                                        'hide_fields'   => array(
                                            'title-link', 
                                        ),
                                    ),
                                ),
                            ),
                            'title_link'    => array(
                                'dg_widget_field_name'     => 'title_link',
                                'dg_widget_field_wraper'   => 'title-link',
                                'dg_widget_field_title'    => esc_html__( 'Title link', 'blogmagazine' ),
                                'dg_widget_field_default'  => '',
                                'dg_widget_field_type'     => 'text',
                            ),
                            'terms_ids' => array(
                                'dg_widget_field_name'         => 'terms_ids',
                                'dg_widget_field_title'        => esc_html__( 
                                    'Block Categories', 'blogmagazine' ),
                                'dg_widget_taxonomy_type' => 'category',
                                'dg_widget_field_type'   => 'multitermlist',
                            ),
                        ),
                        
                    ),
                    'layout'=>array(
                        'dg_widget_field_title'=>esc_html__('Layout', 'blogmagazine'),
                        'dg_widget_field_options'=> array(
                            'thumbnail_size' => array(
                                'dg_widget_field_name'         => 'thumbnail_size',
                                'dg_widget_field_title'        => esc_html__( 
                                    'Image Size', 'blogmagazine' ),
                                'dg_widget_field_default'=> 'blogmagazine-thumb-136x102',
                                'dg_widget_field_type' => 'select',
                                'dg_widget_field_options'   => dglib_get_image_sizes(),
                            ),
                            'excerpt_length' => array(
                                'dg_widget_field_name'         => 'excerpt_length',
                                'dg_widget_field_title'        => esc_html__( 'Description Length', 'blogmagazine' ),
                                'dg_widget_field_default'=> '150',
                                'dg_widget_field_description'  => esc_html__( 'Choose excerpt length in character. default length description length is 150. you can set zero if you want to hide description.', 'blogmagazine' ),
                                'dg_widget_field_type'   => 'number'
                            ),
                        )
                    ),
                )
            )
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

        extract($args);
        /*
         * General tabs
         */
        $title = isset( $instance['title'] ) ? esc_attr($instance['title']) : '';
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $title_link = isset( $instance['title_link'] ) ? esc_url($instance['title_link']) : '';
        $title_target = isset( $instance['title_target'] ) ? esc_attr($instance['title_target']) : '';
        $terms_ids  = isset( $instance['terms_ids'] ) ? $instance['terms_ids'] : '';

        /*
         * Layout tabs
         */
        $thumbnail_size = isset( $instance['thumbnail_size'] ) ? esc_attr($instance['thumbnail_size']) : 'full';
        $excerpt_length = isset( $instance['excerpt_length'] ) ? absint($instance['excerpt_length']) : 0;

        echo $before_widget;
        ?>
        <div class="blogmagazine-block-wrapper featured-posts dg-clearfix">
            <?php 
            $title_args = array(
                'title' => $title,
                'title_target'=> $title_target,
                'title_link' => $title_link,
                'before_title'=>$before_title,
                'after_title'=>$after_title
            );
            do_action('blogmagazine_widget_title', $title_args);
            ?>
            <div class="blogmagazine-featured-posts-wrapper">
                <?php
                if( !empty( $terms_ids ) ) {
                    $blogmagazine_post_count = apply_filters( 'blogmagazine_featured_posts_count', 4 );
                    $blogmagazine_posts_args = array(
                        'post_type' => 'post',
                        'cat' => $terms_ids,
                        'posts_per_page' => absint( $blogmagazine_post_count )
                    );
                    $blogmagazine_posts_query = new WP_Query( $blogmagazine_posts_args );
                    if( $blogmagazine_posts_query->have_posts() ) {
                        while( $blogmagazine_posts_query->have_posts() ) {
                            $blogmagazine_posts_query->the_post();
                            ?>
                            <div class="blogmagazine-single-post-wrap dg-clearfix">
                                <div class="blogmagazine-single-post">
                                    <div class="blogmagazine-post-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                            if( has_post_thumbnail() ) {
                                                the_post_thumbnail( $thumbnail_size );
                                            }
                                            ?>
                                        </a>
                                    </div><!-- .blogmagazine-post-thumb -->
                                    <div class="blogmagazine-post-content">
                                        <h3 class="blogmagazine-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="blogmagazine-post-meta"><?php blogmagazine_posted_on(); ?></div>
                                    </div><!-- .blogmagazine-post-content -->
                                    <?php if($excerpt_length>0){ ?>
                                        <div class="blogmagazine-post-description">
                                            <?php dglib_the_excerpt($excerpt_length, false); ?>
                                        </div><!-- .blogmagazine-post-description -->
                                    <?php } ?>
                                </div> <!-- blogmagazine-single-post -->
                            </div><!-- .blogmagazine-single-post-wrap -->
                            <?php
                        }
                    }
                }
                ?>
            </div><!-- .blogmagazine-featured-posts-wrapper -->
        </div><!--- .blogmagazine-block-wrapper -->
        <?php
        echo $after_widget;
    }

}