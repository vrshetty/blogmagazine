<?php
/**
 * @widget_name: Recent Posts Widget
 * @description: Widget to display latest posts with thumbnail.
 * @package: dineshghimire
 * @subpackage: BlogMagazine
 * @author: Dinesh Ghimire
 * @author_uri: https://dinesh-ghimire.com.np
 * @since 1.0.0
 */
class BlogMagazine_Recent_Posts_Widget extends Dglib_Master_Widget{

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'blogmagazine_recent_posts',
            'description' => esc_html__( 'A widget shows recent posts with thumbnail.', 'blogmagazine' )
        );
        parent::__construct( 'blogmagazine_recent_posts', esc_html__( 'DG: Recent Posts', 'blogmagazine' ), $widget_ops );
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
                                'dg_widget_field_title'        => esc_html__( 'Title', 'blogmagazine' ),
                                'dg_widget_field_default'  => esc_html__('Recent Posts', 'blogmagazine'),
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
                            'posts_per_page' => array(
                                'dg_widget_field_name'         => 'posts_per_page',
                                'dg_widget_field_title'        => esc_html__( 'No. of Posts', 'blogmagazine' ),
                                'dg_widget_field_default'      => '5',
                                'dg_widget_field_type'   => 'number'
                            ),
                            'thumbnail_size' => array(
                                'dg_widget_field_name'         => 'thumbnail_size',
                                'dg_widget_field_title'        => esc_html__( 
                                    'Thumbnail Image Size', 'blogmagazine' ),
                                'dg_widget_field_default'=> 'blogmagazine-thumb-136x102',
                                'dg_widget_field_type' => 'select',
                                'dg_widget_field_options'   => dglib_get_image_sizes(),
                            ),
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
    public function widget( $args, $instance ) {

        extract( $args );
        
        $title = isset( $instance['title'] ) ? sanitize_text_field($instance['title']) : '';
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $title_link = isset( $instance['title_link'] ) ? esc_url($instance['title_link']) : '';
        $title_target = isset( $instance['title_target'] ) ? dglib_sanitize_link_target($instance['title_target']) : '';
        $posts_per_page   = isset( $instance['posts_per_page'] ) ? absint($instance['posts_per_page']) : 0;
        $thumbnail_size   = isset( $instance['thumbnail_size'] ) ? blogmagazine_sanitize_image_size($instance['thumbnail_size']) : 'blogmagazine-thumb-136x102';

        $recent_args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page
        );
        $blogmagazine_query = new WP_Query( $recent_args );

        dglib_before_widget($args);

        ?>
        <div class="blogmagazine-recent-posts-wrapper">
            <?php
            $title_args = array(
                'title' => $title,
                'title_target'=> $title_target,
                'title_link' => $title_link,
                'before_title'=>$before_title,
                'after_title'=>$after_title
            );
            do_action('blogmagazine_widget_title', $title_args);

            if( $blogmagazine_query->have_posts() ) {
                echo '<ul>';
                while( $blogmagazine_query->have_posts() ) {
                    $blogmagazine_query->the_post();
                    ?>
                    <li>
                        <div class="blogmagazine-single-post dg-clearfix">
                            <div class="blogmagazine-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( $thumbnail_size ); ?>
                                </a>
                            </div><!-- .blogmagazine-post-thumb -->
                            <div class="blogmagazine-post-content">
                                <h3 class="blogmagazine-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="blogmagazine-post-meta"><?php blogmagazine_posted_on(); ?></div>
                            </div><!-- .blogmagazine-post-content -->
                        </div><!-- .blogmagazine-single-post -->
                    </li>
                    <?php
                }
                echo '</ul>';
            }
            wp_reset_postdata();
            ?>
        </div><!-- .blogmagazine-recent-posts-wrapper -->
        <?php
    
        dglib_after_widget($args);

    }

}