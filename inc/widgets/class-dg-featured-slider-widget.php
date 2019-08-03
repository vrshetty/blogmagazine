<?php
/**
 * @widget_name: Featured Slider Widget
 * @description: Widget to display posts from selected categories in featured slider ( slider + featured section )
 * @package: dineshghimire
 * @subpackage: BlogMagazine
 * @author: Dinesh Ghimire
 * @author_uri: https://dinesh-ghimire.com.np
 * @since 1.0.0
 */
class BlogMagazine_Featured_Slider_Widget extends Dglib_Master_Widget{

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'blogmagazine_featured_slider',
            'description' => esc_html__( 'Displays posts from selected categories in the slider with the featured section.', 'blogmagazine' )
        );
        parent::__construct( 'blogmagazine_featured_slider', esc_html__( 'DG: Featured Slider', 'blogmagazine' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    public function widget_fields( $instance = array() ) {

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
                                'dg_widget_field_title'        => esc_html__( 'Block title', 'blogmagazine' ),
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
                            'slider_term_ids' => array(
                                'dg_widget_field_name'         => 'slider_term_ids',
                                'dg_widget_field_title'        => esc_html__( 'Slider Categories', 'blogmagazine' ),
                                'dg_widget_taxonomy_type' => 'category',
                                'dg_widget_field_type'   => 'multitermlist',
                            ),
                            'featured_term_ids' => array(
                                'dg_widget_field_name'         => 'featured_term_ids',
                                'dg_widget_field_title'        => esc_html__( 'Featured Post Categories', 'blogmagazine' ),
                                'dg_widget_taxonomy_type' => 'category',
                                'dg_widget_field_type'   => 'multitermlist',
                            )
                        )
                    )
                )
            )
        );
        
        $widget_fields_key = 'fields_'.$this->id_base;
        $widgets_fields = apply_filters( $widget_fields_key, $fields );
        return $widgets_fields;

    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ){

        extract( $args );

        $title = isset( $instance['title'] ) ? sanitize_text_field($instance['title']) : '';
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $title_link = isset( $instance['title_link'] ) ? esc_url($instance['title_link']) : '';
        $title_target = isset( $instance['title_target'] ) ? dglib_sanitize_link_target($instance['title_target']) : '';
        $slider_term_ids    = isset( $instance['slider_term_ids'] ) ?  $instance['slider_term_ids'] : '';
        $featured_term_ids  = isset( $instance['featured_term_ids'] ) ?  $instance['featured_term_ids'] : '';

        dglib_before_widget($args);

        ?>
        <div class="blogmagazine-block-wrapper dg-clearfix">
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
            <div class="slider-posts">
                <?php
                $blogmagazine_post_count = apply_filters( 'blogmagazine_slider_posts_count', 4 );
                $blogmagazine_slider_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => absint( $blogmagazine_post_count )
                );
                if($slider_term_ids){
                    $blogmagazine_slider_args['tax_query'] = array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'term_id',
                            'terms'    => $slider_term_ids,
                        )
                    );
                }
                $blogmagazine_slider_query = new WP_Query( $blogmagazine_slider_args );
                if( $blogmagazine_slider_query->have_posts() ){
                    ?>
                    <ul class="blogmagazine-featured-main-slider">
                        <?php
                        while( $blogmagazine_slider_query->have_posts() ) {
                            $blogmagazine_slider_query->the_post();
                            ?>
                            <li>
                                <div class="blogmagazine-single-slide-wrap">
                                    <div class="blogmagazine-slide-thumb">
                                        <a href="<?php the_permalink(); ?>" class="<?php echo (has_post_thumbnail()) ? 'slide-has-thumbnail' : 'slide-no-thumbnail'; ?>">
                                            <?php 
                                            the_post_thumbnail( 'blogmagazine-thumb-800x600' ); 
                                            ?>
                                        </a>
                                    </div><!-- .blogmagazine-slide-thumb -->
                                    <div class="blogmagazine-slide-content-wrap">
                                        <?php blogmagazine_post_categories_list(); ?>
                                        <h3 class="post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="blogmagazine-post-meta"><?php blogmagazine_posted_on(); ?></div>
                                    </div> <!-- blogmagazine-slide-content-wrap -->
                                </div><!-- .single-slide-wrap -->
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </div><!-- .slider-posts -->
            <div class="featured-posts">
                <div class="featured-posts-wrapper">
                    <?php
                    $blogmagazine_post_count = apply_filters( 'blogmagazine_slider_featured_posts_count', 4 );
                    $blogmagazine_slider_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => absint( $blogmagazine_post_count )
                    );
                    if($featured_term_ids){
                        $blogmagazine_slider_args['tax_query'] = array(
                            array(
                                'taxonomy' => 'category',
                                'field'    => 'term_id',
                                'terms'    => $featured_term_ids,
                            )
                        );
                    }
                    $blogmagazine_slider_query = new WP_Query( $blogmagazine_slider_args );
                    if( $blogmagazine_slider_query->have_posts() ) {
                        while( $blogmagazine_slider_query->have_posts() ) {
                            $blogmagazine_slider_query->the_post();
                            ?>
                            <div class="blogmagazine-single-post-wrap dg-clearfix">
                                <div class="blogmagazine-single-post">
                                    <div class="blogmagazine-post-thumb">
                                        <a href="<?php the_permalink(); ?>" class="<?php echo (has_post_thumbnail()) ? 'featured-has-thumbnail' : 'featured-no-thumbnail'; ?>">
                                            <?php
                                            if( has_post_thumbnail() ) {
                                                the_post_thumbnail( 'blogmagazine-thumb-500x365' );
                                            }
                                            ?>
                                        </a>
                                    </div><!-- .blogmagazine-post-thumb -->
                                    <div class="blogmagazine-post-content">
                                        <?php blogmagazine_post_categories_list(); ?>
                                        <h3 class="blogmagazine-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <div class="blogmagazine-post-meta"><?php blogmagazine_posted_on(); ?></div>
                                    </div><!-- .blogmagazine-post-content -->
                                </div> <!-- blogmagazine-single-post -->
                            </div><!-- .blogmagazine-single-post-wrap -->

                            <?php
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div><!-- .featured-posts -->
        </div><!--- .blogmagazine-block-wrapper -->
        <?php

        dglib_after_widget($args);
    
    }

}