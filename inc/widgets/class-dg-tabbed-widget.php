<?php
/**
 * @widget_name: Tabbed Widget
 * @description: Widget to display latest posts and comment in tabbed layout.
 * @package: dineshghimire
 * @subpackage: BlogMagazine
 * @author: Dinesh Ghimire
 * @author_uri: https://dinesh-ghimire.com.np
 * @since 1.0.0
 */
class BlogMagazine_Tabbed_Widget extends Dglib_Master_Widget{

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'blogmagazine_default_tabbed',
            'description' => esc_html__( 'A widget shows recent posts and comment in tabbed layout.', 'blogmagazine' )
        );
        parent::__construct( 'blogmagazine_default_tabbed', esc_html__( 'DG: Default Tabbed', 'blogmagazine' ), $widget_ops );
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
                            'latest_tab_title' => array(
                                'dg_widget_field_name'         => 'latest_tab_title',
                                'dg_widget_field_title'        => esc_html__( 'Latest Tab title', 'blogmagazine' ),
                                'dg_widget_field_default'      => esc_html__( 'Latest', 'blogmagazine' ),
                                'dg_widget_field_type'   => 'text'
                            ),
                            'comments_tab_title' => array(
                                'dg_widget_field_name'         => 'comments_tab_title',
                                'dg_widget_field_title'        => esc_html__( 'Comments Tab title', 'blogmagazine' ),
                                'dg_widget_field_default'      => esc_html__( 'Comments', 'blogmagazine' ),
                                'dg_widget_field_type'   => 'text'
                            ),
                            'posts_per_page' => array(
                                'dg_widget_field_name'         => 'posts_per_page',
                                'dg_widget_field_title'        => esc_html__( 'No of posts', 'blogmagazine' ),
                                'dg_widget_field_default'      => 6,
                                'dg_widget_field_type'   => 'number'
                            ),
                            'comments_per_page' => array(
                                'dg_widget_field_name'         => 'comments_per_page',
                                'dg_widget_field_title'        => esc_html__( 'No of comments', 'blogmagazine' ),
                                'dg_widget_field_default'      => 6,
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
                            'avatar_size' => array(
                                'dg_widget_field_name'         => 'avatar_size',
                                'dg_widget_field_title'        => esc_html__( 
                                    'Avatar Image Size', 'blogmagazine' ),
                                'dg_widget_field_default'=> 150,
                                'dg_widget_field_type' => 'number',
                            ),
                            'comments_length' => array(
                                'dg_widget_field_name'         => 'comments_length',
                                'dg_widget_field_title'        => esc_html__( 
                                    'Comment Length', 'blogmagazine' ),
                                'dg_widget_field_default'=> 100,
                                'dg_widget_field_type' => 'number',
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
        $latest_tab_title   = isset( $instance['latest_tab_title'] ) ? sanitize_text_field($instance['latest_tab_title']) : esc_html__('Latest', 'blogmagazine');
        $comments_tab_title   = isset( $instance['comments_tab_title'] ) ? sanitize_text_field($instance['comments_tab_title']) : esc_html__('Comments', 'blogmagazine');
        $posts_per_page   = isset( $instance['posts_per_page'] ) ? absint($instance['posts_per_page']) : 6;
        $comments_per_page   = isset( $instance['comments_per_page'] ) ? absint($instance['comments_per_page']) : 6;
        $thumbnail_size   = isset( $instance['thumbnail_size'] ) ? blogmagazine_sanitize_image_size($instance['thumbnail_size']) : 'blogmagazine-thumb-136x102';
        $avatar_size   = isset( $instance['avatar_size'] ) ? absint($instance['avatar_size']) : 150;
        $comments_length   = isset( $instance['comments_length'] ) ? absint($instance['comments_length']) : 50;
        dglib_before_widget($args);
        ?>
        <div class="blogmagazine-default-tabbed-wrapper dg-clearfix" id="blogmagazine-tabbed-widget">
            <ul class="widget-tabs dg-clearfix blogmagazine-widget-tab" >
                <li class="active-item"><a href="#<?php echo esc_attr( 'latest_' . $this->id ); ?>"><?php echo esc_html( $latest_tab_title ); ?></a></li>
                <li><a href="#<?php echo esc_attr( 'comments_' . $this->id ); ?>"><?php echo esc_html( $comments_tab_title ); ?></a></li>
            </ul><!-- .widget-tabs -->

            <div id="<?php echo esc_attr( 'latest_' . $this->id ); ?>" class="blogmagazine-tabbed-section tabbed-latest dg-clearfix active">
                <?php
                $latest_args = array(
                    'posts_per_page' => $posts_per_page
                );
                $latest_query = new WP_Query( $latest_args );
                if( $latest_query->have_posts() ) {
                    while( $latest_query->have_posts() ) {
                        $latest_query->the_post();
                        ?>
                        <div class="blogmagazine-single-post dg-clearfix">
                            <div class="blogmagazine-post-thumb">
                                <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail( $thumbnail_size ); ?> </a>
                            </div><!-- .blogmagazine-post-thumb -->
                            <div class="blogmagazine-post-content">
                                <h3 class="blogmagazine-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="blogmagazine-post-meta"><?php blogmagazine_posted_on(); ?></div>
                            </div><!-- .blogmagazine-post-content -->
                        </div><!-- .blogmagazine-single-post -->
                        <?php
                    }
                }
                wp_reset_postdata();
                ?>
            </div><!-- #latest -->

            <div id="<?php echo esc_attr( 'comments_' . $this->id ); ?>" class="blogmagazine-tabbed-section tabbed-comments dg-clearfix">
                <ul>
                    <?php
                    $tab_comments = get_comments( array( 'number' => $comments_per_page ) );
                    foreach( $tab_comments as $comment  ) {
                        ?>
                        <li class="blogmagazine-single-comment dg-clearfix">
                            <?php
                            $title = get_the_title( $comment->comment_post_ID );
                            echo '<div class="blogmagazine-comment-avatar">'. get_avatar( $comment, $avatar_size ) .'</div>';
                            ?>
                            <div class="blogmagazine-comment-desc-wrap">
                                <strong><?php echo esc_html( $comment->comment_author ); ?></strong>
                                <?php esc_html_e( '&nbsp;commented on', 'blogmagazine' ); ?> 
                                <a href="<?php echo esc_url( get_permalink( $comment->comment_post_ID ) ); ?>" rel="external nofollow" title="<?php echo esc_attr( $title ); ?>"> <?php echo esc_html( $title ); ?></a>: <?php echo esc_html( wp_html_excerpt( $comment->comment_content, $comments_length ) ); ?>
                            </div><!-- .blogmagazine-comment-desc-wrap -->
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div><!-- #comments -->

        </div><!-- .blogmagazine-default-tabbed-wrapper -->
        <?php
        dglib_after_widget($args);
    
    }

}