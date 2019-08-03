<?php
/**
 * @widget_name: Block Posts Widget
 * @description: This class handles posts as blocks
 * @package: dineshghimire
 * @subpackage: BlogMagazine
 * @author: Dinesh Ghimire
 * @author_uri: https://dinesh-ghimire.com.np
 * @since 1.0.0
 */
if(!class_exists( 'BlogMagazine_BlockPosts_Widget' ) ):

    class BlogMagazine_BlockPosts_Widget extends Dglib_Master_Widget{

    	/**
         * Register widget with WordPress.
         */
        public function __construct() {

            $widget_ops = array( 
                'classname' => 'blogmagazine_block_posts dg-clearfix',
                'description' => esc_html__( 'Displays block posts from selected category in different layouts.', 'blogmagazine' )
            );
            parent::__construct( 'blogmagazine_block_posts', esc_html__( 'DG: Block Posts', 'blogmagazine' ), $widget_ops );
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
                                    'dg_widget_field_default'  => esc_html__('Block Posts', 'blogmagazine'),
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
                                    'dg_widget_field_title'        => esc_html__( 'Block Category', 'blogmagazine' ),
                                    'dg_widget_field_default'      => 0,
                                    'dg_widget_field_type'   => 'multitermlist',
                                    'dg_widget_taxonomy_type' => 'category',
                                ),
                                'tab_term_list' => array(
                                    'dg_widget_field_name'         => 'tab_term_list',
                                    'dg_widget_field_title'        => esc_html__( 'Tab Category List', 'blogmagazine' ),
                                    'dg_widget_field_default'      => 'none',
                                    'dg_widget_field_type'   => 'select',
                                    'dg_widget_field_options' => array(
                                        'none' => esc_html__( 'None', 'blogmagazine' ),
                                        'selected' => esc_html__( 'Block Category List', 'blogmagazine' ),
                                        'otherterm' => esc_html__( 'Others Category List', 'blogmagazine' ),
                                    ),
                                    'dg_widget_field_relation' => array(
                                        'values' => array(
                                            'otherterm' => array(
                                                'show_fields'   => array(
                                                    'tabs-terms', 
                                                    'default-tablabel',
                                                ),
                                            ),
                                            'none' => array(
                                                'hide_fields'   => array(
                                                    'tabs-terms', 
                                                    'default-tablabel',
                                                ),
                                            ),
                                            'selected' => array(
                                                'hide_fields'   => array(
                                                    'tabs-terms', 
                                                ),
                                                'show_fields'   => array(
                                                    'default-tablabel',
                                                ),
                                            ),
                                        ),
                                    ),
                                ),
                                'tabs_terms' => array(
                                    'dg_widget_field_name'         => 'tabs_terms',
                                    'dg_widget_field_wraper'       => 'tabs-terms',
                                    'dg_widget_field_title'        => esc_html__( 'Tab Categories', 'blogmagazine' ),
                                    'dg_widget_field_default'      => 0,
                                    'dg_widget_field_type'   => 'multitermlist',
                                    'dg_widget_taxonomy_type' => 'category',
                                ),
                                'default_tablabel' => array(
                                    'dg_widget_field_name'         => 'default_tablabel',
                                    'dg_widget_field_wraper'       => 'default-tablabel',
                                    'dg_widget_field_title'        => esc_html__( 'Default Tab Label', 'blogmagazine' ),
                                    'dg_widget_field_default'      => esc_html__('Default', 'blogmagazine'),
                                    'dg_widget_field_type'         => 'text',
                                ),
                                'excerpt_length' => array(
                                    'dg_widget_field_name'         => 'excerpt_length',
                                    'dg_widget_field_title'        => esc_html__( 'Description Length', 'blogmagazine' ),
                                    'dg_widget_field_default'      => '100',
                                    'dg_widget_field_type'   => 'number',
                                    'dg_widget_field_description'  => esc_html__( 'Enter the short description length in character.', 'blogmagazine'),
                                ),
                            )
                        ),
                        'layout'=>array(
                            'dg_widget_field_title'=>esc_html__('Layout', 'blogmagazine'),
                            'dg_widget_field_options'=> array(
                                'block_layout' => array(
                                    'dg_widget_field_name'         => 'block_layout',
                                    'dg_widget_field_title'        => esc_html__( 'Block Layouts', 'blogmagazine' ),
                                    'dg_widget_field_default'      => 'layout1',
                                    'dg_widget_field_type'   => 'select',
                                    'dg_widget_field_options' => array(
                                        'layout1' => esc_html__( 'Layout 1', 'blogmagazine' ),
                                        'layout2' => esc_html__( 'Layout 2', 'blogmagazine' ),
                                        'layout3' => esc_html__( 'Layout 3', 'blogmagazine' ),
                                        'layout4' => esc_html__( 'Layout 4', 'blogmagazine' ),
                                    ),
                                ),
                                'largeimg_size' => array(
                                    'dg_widget_field_name'         => 'largeimg_size',
                                    'dg_widget_field_title'        => esc_html__( 
                                        'Large Image Size', 'blogmagazine' ),
                                    'dg_widget_field_default'=> 'blogmagazine-thumb-622x420',
                                    'dg_widget_field_type' => 'select',
                                    'dg_widget_field_options'   => dglib_get_image_sizes(),
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

            extract( $args );
            if( empty( $instance ) ) {
                return ;
            }
            /*
             * General Tab
             */
            $title = isset( $instance['title'] ) ? sanitize_text_field($instance['title']) : '';
            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $title_link = isset( $instance['title_link'] ) ? esc_url($instance['title_link']) : '';
            $title_target = isset( $instance['title_target'] ) ? dglib_sanitize_link_target($instance['title_target']) : '';
            $terms_ids   = isset( $instance['terms_ids'] ) ? $instance['terms_ids'] : '';
            $default_tablabel   = isset( $instance['default_tablabel'] ) ? sanitize_text_field($instance['default_tablabel']) : '';
            $excerpt_length   = isset( $instance['excerpt_length'] ) ? absint($instance['excerpt_length']) : 100;
            $tab_term_list   = isset( $instance['tab_term_list'] ) ? blogmagazine_sanitize_widget_tab_options($instance['tab_term_list']) : 'none';
            $tabs_terms   = isset( $instance['tabs_terms'] ) ? $instance['tabs_terms'] : '';

            /*
             * Layout Tab
             */
            $block_layout   = isset( $instance['block_layout'] ) ? blogmagazine_sanitize_block_post_layout($instance['block_layout']) : 'layout1';
            $thumbnail_size = isset( $instance['thumbnail_size'] ) ? blogmagazine_sanitize_image_size($instance['thumbnail_size']) : 'thumbnail';
            $largeimg_size = isset( $instance['largeimg_size'] ) ? blogmagazine_sanitize_image_size($instance['largeimg_size']) : 'full';

            dglib_before_widget($args);

            $title_args = array(
                'title' => $title,
                'title_target'=> $title_target,
                'title_link' => $title_link,
                'before_title'=>$before_title,
                'after_title'=>$after_title,
            );
            if($tab_term_list!='none'){
                $title_args['title_terms'] = ($tab_term_list=='otherterm') ? $tabs_terms : $terms_ids;
                $title_args['default_tablabel'] = isset( $instance['default_tablabel'] ) ? esc_attr($instance['default_tablabel']) : '';
                $title_args['tab_ajax_data'] = array(
                    'type'      => 'POST',
                    'dataType'  => 'json',
                    'url'       => admin_url( 'admin-ajax.php' ),
                    'data'      => array(
                        'action'                => 'blogmagazine_block_posts_tabs',
                        'block_layout'          => $block_layout,
                        'thumbnail_size'        => $thumbnail_size,
                        'largeimg_size'         => $largeimg_size,
                        'excerpt_length'        => $excerpt_length,
                        'posts_per_page'        => 6,
                        'block_posts_nonce'    => wp_create_nonce( 'blogmagazine_block_post_tabs_nonce' )
                    ),
                );
            }
            do_action('blogmagazine_widget_title', $title_args);
            ?>
            <div class="blogmagazine-block-wrapper block-posts dg-clearfix <?php echo esc_attr( $block_layout ); ?>">
                <div class="blogmagazine-block-posts-wrapper dglib-tab-alldata tab-active">
                	<?php
                    $blogmagazine_args = array(
                        'terms_ids' => $terms_ids,
                        'thumbnail_size' => $thumbnail_size,
                        'largeimg_size' => $largeimg_size,
                        'excerpt_length' => $excerpt_length,
                    );
                    switch ( $block_layout ){
                        case 'layout2':
                        blogmagazine_block_second_layout_section( $blogmagazine_args );
                        break;
                        case 'layout3':
                        blogmagazine_block_box_layout_section( $blogmagazine_args );
                        break;
                        case 'layout4':
                        blogmagazine_block_alternate_grid_section( $blogmagazine_args );
                        break;
                        default:
                        blogmagazine_block_first_layout_section( $blogmagazine_args );
                        break;
                    }
                    ?>
                </div><!-- .blogmagazine-block-posts-wrapper -->
                <?php do_action( 'blogmagazine_widget_blockposts_pagination', $blogmagazine_args ); ?>
                <figure class="blgmg-wdgt-preloader hidden">
                    <span class="helper"></span>
                    <img src="<?php echo esc_url( dglib_directory_uri('assets/img/preloader/loader3.gif') ); ?>" height="100" width="100" alt="<?php esc_html_e('Preloader', 'blogmagazine'); ?>" title="<?php esc_html_e('Preloader', 'blogmagazine'); ?>" />
                </figure>
            </div><!--- .blogmagazine-block-wrapper -->
            <?php
            dglib_after_widget($args);
        }
    }
endif;