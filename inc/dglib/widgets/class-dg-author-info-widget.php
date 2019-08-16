<?php
/**
 * @widget_name: Author Widget
 * @description: The Widget will display author details in your sidebar with lot's of filters
 * @package: dineshghimire
 * @subpackage: dglib
 * @author: dineshghimire
 * @author_uri: https://dinesh-ghimire.com.np
 * @since 1.0.0
 */

if (!class_exists('Dglib_Author_Info_Widget')) {

    class Dglib_Author_Info_Widget extends Dglib_Master_Widget {

        public  function __construct() {

            $widget_options = array(
                'classname' => 'dglib-autor-info',
                'description' => esc_html__( 'A widget to display posts and thumbs with a lots of filters.', 'blogmagazine' ));
            parent::__construct('dglib-autor-info', esc_html__( 'DG - Author Info', 'blogmagazine' ), $widget_options);	

        }

    	/**
    	 * Helper function that holds widget fields
    	 * Array is used in update and form functions
    	 */
    	public function widget_fields( $instance = array() ){

            $dglib_author_listing = dglib_author_listing();
            $dglib_link_target = dglib_link_target();

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
                                'title'    => array(
                                    'dg_widget_field_name'     => 'title',
                                    'tcy_widget_field_wraper'   => 'title',
                                    'dg_widget_field_title'    => esc_html__( 'Title', 'blogmagazine' ),
                                    'dg_widget_field_default'  => '',
                                    'dg_widget_field_type'     => 'text',
                                ),
                                'title_target'    => array(
                                    'dg_widget_field_name'     => 'title_target',
                                    'tcy_widget_field_wraper'   => 'title-target',
                                    'dg_widget_field_title'    => esc_html__( 'Title Target', 'blogmagazine' ),
                                    'dg_widget_field_default'  => '_self',
                                    'dg_widget_field_type'     => 'select',
                                    'dg_widget_field_options'  => $dglib_link_target,
                                    'tcy_widget_field_relation' => array(
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
                                    'tcy_widget_field_wraper'   => 'title-link',
                                    'dg_widget_field_title'    => esc_html__( 'Title link', 'blogmagazine' ),
                                    'dg_widget_field_default'  => '',
                                    'dg_widget_field_type'     => 'text',
                                ),
                                'author_id'    => array(
                                    'dg_widget_field_name'     => 'author_id',
                                    'tcy_widget_field_wraper'   => 'dglib-post-type',
                                    'dg_widget_field_title'    => esc_html__( 'Choose author/user', 'blogmagazine' ),
                                    'dg_widget_field_default'  => 'post',
                                    'dg_widget_field_type'     => 'select',
                                    'dg_widget_field_options'  => $dglib_author_listing,
                                ),
                                'author_designation'   => array(
                                    'dg_widget_field_name'     => 'author_designation',
                                    'tcy_widget_field_wraper'   => 'author-designation',
                                    'dg_widget_field_title'    => esc_html__( 'Author Designation', 'blogmagazine' ),
                                    'dg_widget_field_default'  => esc_html__('CEO / Co-Founder', 'blogmagazine'),
                                    'dg_widget_field_type'     => 'text',
                                ),
                                'show_avatar'    => array(
                                    'dg_widget_field_name'     => 'show_avatar',
                                    'tcy_widget_field_wraper'   => 'show-avatar',
                                    'dg_widget_field_title'    => esc_html__( 'Show Author Avatar?', 'blogmagazine' ),
                                    'dg_widget_field_default'  => 0,
                                    'dg_widget_field_type'     => 'checkbox',
                                    'tcy_widget_field_relation' => array(
                                        'exist' => array(
                                            'show_fields'   => array(
                                                'avatar-size', 
                                            ),
                                        ),
                                        'empty' => array(
                                            'hide_fields'   => array(
                                                'avatar-size', 
                                            ),
                                        ),
                                    ),
                                ),
                                'avatar_size'          => array(
                                    'dg_widget_field_name'     => 'avatar_size',
                                    'tcy_widget_field_wraper'   => 'avatar-size',
                                    'dg_widget_field_title'    => esc_html__( 'Avatar Size', 'blogmagazine' ),
                                    'dg_widget_field_default'  => 150,
                                    'dg_widget_field_type'     => 'number'
                                )
                            )
                        ),
                        'layout'=>array(
                            'dg_widget_field_title'    => esc_html__('Layout', 'blogmagazine'),
                            'dg_widget_field_options'          => array(
                                'show_description'=>array(
                                    'dg_widget_field_name'     => 'show_description',
                                    'dg_widget_field_title'    => esc_html__( 'Show Author Description?', 'blogmagazine' ),
                                    'dg_widget_field_default'  => 1,
                                    'dg_widget_field_type'     => 'checkbox',
                                    'tcy_widget_field_relation' => array(
                                        'empty'=>array(
                                            'hide_fields'=>array(
                                                'description-limit',
                                            ),
                                        ),
                                        'exist'=>array(
                                            'show_fields'=>array(
                                                'description-limit',
                                            ),
                                        ),
                                    ),
                                ),
                                'description_limit'=>array(
                                    'dg_widget_field_name'     => 'description_limit',
                                    'dg_widget_field_title'    => esc_html__( 'Description Limit', 'blogmagazine' ),
                                    'tcy_widget_field_wraper'   => 'description-limit',
                                    'dg_widget_field_default'  => '100',
                                    'dg_widget_field_type'     => 'number',
                                    'tcy_widget_field_description'=> esc_html__('Specify number of characters to limit author description length', 'blogmagazine'),
                                ),
                                'author_link_target'=>array(
                                    'dg_widget_field_name'     => 'author_link_target',
                                    'tcy_widget_field_wraper'   => 'view-all-option',
                                    'dg_widget_field_title'         => esc_html__( 'Author link target', 'blogmagazine' ),
                                    'dg_widget_field_default'  => 'disable',
                                    'dg_widget_field_type'     => 'select',
                                    'dg_widget_field_options'  => $dglib_link_target,
                                ),
                                'all_link_text'=>array(
                                    'dg_widget_field_name'     => 'all_link_text',
                                    'tcy_widget_field_wraper'   => 'all-link-text',
                                    'dg_widget_field_title'    => esc_html__( 'All link text', 'blogmagazine' ),
                                    'dg_widget_field_default'  => '',
                                    'dg_widget_field_type'     => 'text',
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
    	 * Display the widget
    	 */	
    	function widget( $args, $instance ) {

            /*
             * Args Values
             */
            $before_title = isset( $args['before_title'] ) ? $args['before_title'] : '';
            $after_title  = isset( $args['after_title'] ) ? $args['after_title'] : '';

            /*
             * Instance General Tab Value
             */
            $title      = isset( $instance['title'] ) ? esc_html( $instance['title'] ) : '';
            $title_target      = isset( $instance['title_target'] ) ? esc_html( $instance['title_target'] ) : '';
            $title_link      = isset( $instance['title_link'] ) ? esc_html( $instance['title_link'] ) : '';
            $author_id    = isset($instance['author_id']) ? absint( $instance['author_id'] ) : 0;
            $author_designation       = isset( $instance['author_designation'] ) ? esc_html( $instance['author_designation'] ) : '';
            $show_avatar       = isset( $instance['show_avatar'] ) ? esc_html( $instance['show_avatar'] ) : '';
            $avatar_size       = isset( $instance['avatar_size'] ) ? esc_html( $instance['avatar_size'] ) : 120;

            /*
             * Instance Layout Tab Value
             */
            $show_description = isset( $instance['show_description'] ) ? absint( $instance['show_description'] ) : 0;
            $description_limit = isset( $instance['description_limit'] ) ? absint( $instance['description_limit'] ) : '';
            $author_link_target = isset( $instance['author_link_target'] ) ? esc_attr( $instance['author_link_target'] ) : '';
            $all_link_text = isset( $instance['all_link_text'] ) ? esc_html( $instance['all_link_text'] ) : '';

            //Get origional Author Link for author_id
            $author_link = get_author_posts_url( get_the_author_meta( 'ID', $author_id ) );
            dglib_before_widget($args);
            $title_args = array(
                'title' => $title,
                'title_target'=> $title_target,
                'title_link' => $title_link,
                'before_title'=>$before_title,
                'after_title'=>$after_title
            );
            do_action('dglib_widget_title', $title_args);
            ?>
            <div class="card card-profile">
                <?php if ( $show_avatar ) { ?>
                    <div class="card-avatar">
                        <a href="<?php echo esc_url($author_link); ?>"><?php 
                        echo get_avatar( get_the_author_meta( 'ID', $author_id ), $avatar_size ); 
                        ?></a>
                    </div>
                <?php } ?>
                <div class="card-content">
                    <?php 
                    if ( ! empty( $author_designation ) ): 
                        ?><h5 class="category text-gray"><?php echo esc_html( $author_designation ) ?></h5><?php 
                    endif; 
                    ?>
                    <h4 class="card-title"><?php echo get_the_author_meta( 'display_name', $author_id ); ?></h4>
                    <?php 
                    if ( $show_description ) : ?>
                        <div class="card-description">
                            <?php 
                            $description = get_the_author_meta( 'description', $author_id ); 
                            echo wpautop( $this->trim_chars( $description, $description_limit ) );
                            if ( $author_link_target && $all_link_text ) : 
                                ?><a href="<?php echo esc_url( $author_link ); ?>"
                                 class="button secondary radius "><?php echo esc_html( $all_link_text ); ?></a><?php 
                             endif;
                             ?>
                         </div>
                         <?php 
                     endif; 
                     ?>
                 </div>
             </div>
             <?php 
             dglib_after_widget($args);
         }

        /**
         * Limit character description
         *
         * @param string $string Content to trim
         * @param int $limit Number of characters to limit
         * @param string $more Chars to append after trimmed string
         *
         * @return string Trimmed part of the string
         */
        public function trim_chars( $string, $limit, $more = '...' ) {
            if ( ! empty( $limit ) ) {
                $text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $string ), ' ' );
                preg_match_all( '/./u', $text, $chars );
                $chars = $chars[0];
                $count = count( $chars );

                if ( $count > $limit ) {
                    $chars = array_slice( $chars, 0, $limit );

                    for ( $i = ( $limit - 1 ); $i >= 0; $i -- ) {
                        if ( in_array( $chars[ $i ], array( '.', ' ', '-', '?', '!' ) ) ) {
                            break;
                        }
                    }

                    $chars  = array_slice( $chars, 0, $i );
                    $string = implode( '', $chars );
                    $string = rtrim( $string, ".,-?!" );
                    $string .= $more;
                }
            }

            return $string;
        }
    }

}