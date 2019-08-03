<?php
/**
 * @widget_name: Ads Banner Widget
 * @description: This class handles banner for header
 * @package: dineshghimire
 * @subpackage: BlogMagazine
 * @author: Dinesh Ghimire
 * @author_uri: https://dinesh-ghimire.com.np
 * @since 1.0.0
 */
class BlogMagazine_Ads_Banner_Widget extends Dglib_Master_Widget{

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'blogmagazine_ads_banner',
            'description' => esc_html__( 'You can place a banner as an advertisement with links.', 'blogmagazine' )
        );
        parent::__construct( 'blogmagazine_ads_banner', esc_html__( 'DG: Banner Ads', 'blogmagazine' ), $widget_ops );
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
                                'dg_widget_field_title'        => esc_html__( 'Banner title', 'blogmagazine' ),
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
                            'banner_image' => array(
                                'dg_widget_field_name'         => 'banner_image',
                                'dg_widget_field_title'        => esc_html__( 'Select banner image', 'blogmagazine' ),
                                'dg_widget_field_type'   => 'upload',
                            ),
                            'banner_url' => array(
                                'dg_widget_field_name'         => 'banner_url',
                                'dg_widget_field_title'        => esc_html__( 'Banner Link', 'blogmagazine' ),
                                'dg_widget_field_type'   => 'url'
                            ),

                            'banner_target' => array(
                                'dg_widget_field_name'         => 'banner_target',
                                'dg_widget_field_title'        => esc_html__( 'Open in new tab', 'blogmagazine' ),
                                'dg_widget_field_type'   => 'checkbox'
                            ),
                            'banner_rel' => array(
                                'dg_widget_field_name'         => 'banner_rel',
                                'dg_widget_field_title'        => esc_html__( 'Rel attribute for link', 'blogmagazine' ),
                                'dg_widget_field_type'   => 'checkbox'
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
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        /*
         * General Tabs
         */
        $title  = isset( $instance['title'] ) ? sanitize_text_field($instance['title']) : '';
        $title_target  = isset( $instance['title_target'] ) ? dglib_sanitize_link_target($instance['title_target']) : '';
        $title_link  = isset( $instance['title_link'] ) ? esc_url($instance['title_link']) : '';
        $banner_image  = isset( $instance['banner_image'] ) ? esc_url($instance['banner_image']) : '';
        $banner_url    = isset( $instance['banner_url'] ) ? esc_url($instance['banner_url']) : '';
        $banner_target = isset( $instance['banner_target'] ) ? dglib_sanitize_link_target($instance['banner_target']) : '';
        $banner_rel    = isset( $instance['banner_rel'] ) ? '' : 'nofollow';

        dglib_before_widget($args);

        if( !empty( $banner_image ) ) {
            ?>
            <div class="blogmagazine-ads-wrapper">
                <?php
                $title_args = array(
                    'title' => $title,
                    'title_target'=> $title_target,
                    'title_link' => $title_link,
                    'before_title'=>$before_title,
                    'after_title'=>$after_title
                );
                do_action('blogmagazine_widget_title', $title_args);
                if( !empty( $banner_url ) ) {
                    ?>
                    <a href="<?php echo esc_url( $banner_url );?>" target="<?php echo esc_attr( $banner_target ); ?>" rel="<?php echo esc_attr( $banner_rel ); ?>"><img src="<?php echo esc_url( $banner_image ); ?>" /></a>
                    <?php
                } else {
                    ?>
                    <img src="<?php echo esc_url( $banner_image ); ?>" />
                    <?php
                }
                ?>
            </div><!-- .blogmagazine-ads-wrapper -->
            <?php
        }

        dglib_after_widget($args);
        
    }

}