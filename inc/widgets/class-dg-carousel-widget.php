<?php
/**
 * @widget_name: Carousel Widget
 * @description: This class handles posts as carousel
 * @package: dineshghimire
 * @subpackage: BlogMagazine
 * @author: Dinesh Ghimire
 * @author_uri: https://dinesh-ghimire.com.np
 * @since 1.0.0
 */
class BlogMagazine_Carousel_widget extends Dglib_Master_Widget{

	/**
     * Register widget with WordPress.
     */
    public function __construct() {

        $widget_ops = array(
            'classname' => 'blogmagazine_carousel',
            'description' => esc_html__( 'Displays posts from selected categories in carousel layouts.', 'blogmagazine' )
        );

        parent::__construct( 'blogmagazine_carousel', esc_html__( 'DG: Carousel', 'blogmagazine' ), $widget_ops );

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
                                'dg_widget_field_default'  => esc_html__('Carousel', 'blogmagazine'),
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
                                'dg_widget_field_title'        => esc_html__( 'Block Categories', 'blogmagazine' ),
                                'dg_widget_field_type'   => 'multitermlist',
                                'dg_widget_taxonomy_type' => 'category',
                            ),
                            'thumbnail_size' => array(
                                'dg_widget_field_name'         => 'thumbnail_size',
                                'dg_widget_field_title'        => esc_html__( 
                                    'Image Size', 'blogmagazine' ),
                                'dg_widget_field_default'=> 'blogmagazine-thumb-800x600',
                                'dg_widget_field_type' => 'select',
                                'dg_widget_field_options'   => dglib_get_image_sizes(),
                            ),
                            'total_no_slides' => array(
                                'dg_widget_field_name'         => 'total_no_slides',
                                'dg_widget_field_title'        => esc_html__( 
                                    'Total no of slides', 'blogmagazine' ),
                                'dg_widget_field_default'=> '4',
                                'dg_widget_field_type' => 'number',
                            ),
                        )
                    ),
                    'layout' => array(
                        'dg_widget_field_title'=>esc_html__('Layout', 'blogmagazine'),
                        'dg_widget_field_options'   => array(
                            'block_layout'  => array(
                                'dg_widget_field_name'          => 'block_layout',
                                'dg_widget_field_title'         => esc_html__( 'Carousel Layouts', 'blogmagazine' ),
                                'dg_widget_field_default'       => 'layout1',
                                'dg_widget_field_type'          => 'select',
                                'dg_widget_field_options'       => array(
                                    'layout1'   => esc_html__( 'Layout One', 'blogmagazine' ),
                                )
                            ),
                            'no_of_columns'  => array(
                                'dg_widget_field_name'          => 'no_of_columns',
                                'dg_widget_field_title'         => esc_html__( 'No of columns', 'blogmagazine' ),
                                'dg_widget_field_default'       => '4',
                                'dg_widget_field_type'          => 'select',
                                'dg_widget_field_options'       => array(
                                    '1'   => esc_html__( 'Column One', 'blogmagazine' ),
                                    '2'   => esc_html__( 'Column Two', 'blogmagazine' ),
                                    '3'   => esc_html__( 'Column Three', 'blogmagazine' ),
                                    '4'   => esc_html__( 'Column Four', 'blogmagazine' ),
                                )
                            ),
                        )
                    ),
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

        if( empty( $instance ) ) {
            return;
        }

        extract($args);

        $title = isset( $instance['title'] ) ? sanitize_text_field($instance['title']) : '';
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $title_link = isset( $instance['title_link'] ) ? esc_url($instance['title_link']) : '';
        $title_target = isset( $instance['title_target'] ) ? dglib_sanitize_link_target($instance['title_target']) : '';
        $terms_ids  = isset( $instance['terms_ids'] ) ? $instance['terms_ids'] : '';
        $thumbnail_size   = isset( $instance['thumbnail_size'] ) ? blogmagazine_sanitize_image_size($instance['thumbnail_size']) : 'blogmagazine-thumb-800x600';
        $total_no_slides   = isset( $instance['total_no_slides'] ) ? absint($instance['total_no_slides']) : 10;

        /*
         * Layout Options
         */
        $block_layout   = isset( $instance['block_layout'] ) ? blogmagazine_sanitize_carousel_layout($instance['block_layout']) : 'layout1';
        $no_of_columns   = isset( $instance['no_of_columns'] ) ? absint($instance['no_of_columns']) : 4;

        dglib_before_widget($args);
        ?>
        <div class="blogmagazine-block-wrapper carousel-posts dg-clearfix <?php echo esc_attr( $block_layout ); ?>">
            <div class="blogmagazine-block-title-nav-wrap">
                <?php 
                $title_args = array(
                    'title' => $title,
                    'title_target'=> $title_target,
                    'title_link' => $title_link,
                    'before_title'=>$before_title,
                    'after_title'=>$after_title,
                    'slider_nav' => true,
                );
                do_action('blogmagazine_widget_title', $title_args);
                ?>                  
            </div> <!-- blogmagazine-full-width-title-nav-wrap -->
            <div class="blogmagazine-block-posts-wrapper">
                <?php
                $blogmagazineargs = array(
                    'no_of_columns'     => $no_of_columns,
                    'thumbnail_size'    => $thumbnail_size,
                    'query_args'    => array(
                        'post_type'     => 'post',
                        'post_status'   => 'publish',
                        'posts_per_page'=> absint( $total_no_slides )
                    )
                );
                if($terms_ids){
                    $blogmagazineargs['tax_query'] = array(
                        array(
                            'taxonomy'  => 'category',
                            'terms'     => $terms_ids,
                            'field'     => 'term_id',
                            'operator' => 'IN'
                        )
                    );
                }
                switch ( $block_layout ) {
                    default:
                    blogmagazine_carousel_default_layout_section( $blogmagazineargs );
                    break;
                }
                ?>
            </div><!-- .blogmagazine-block-posts-wrapper -->
        </div><!--- .blogmagazine-block-wrapper -->
        <?php
        
        dglib_after_widget($args);
    
    }

}