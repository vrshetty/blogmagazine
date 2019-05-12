<?php
/**
 * @widget_name: Social Icons Widget
 * @description: This class handles everything that needs to be handled with the widget:the settings, form, display, and update.  Nice!
 * @package: dineshghimire
 * @subpackage: dglib
 * @author: dineshghimire
 * @author_uri: https://dinesh-ghimire.com.np
 * @since 1.0.0
 */
class Dglib_Social_Icons_Widget extends Dglib_Master_Widget{
	
	public  function __construct(){

		$widget_options = array(
			'classname' => 'dglib-social-icons',
			'description' => esc_html__( 'A Widget to display social icons.', '__Text_Domain__' ));
		parent::__construct('dglib-social-icons', esc_html__( 'DG - Social Icons', '__Text_Domain__' ), $widget_options);	

	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	public function widget_fields( $instance = array() ){

        $dglib_link_target = dglib_link_target();

        $fields = array(
            'dg_widget_tab'       => array(
                'dg_widget_field_name'     => 'dg_widget_tab',
                'dg_widget_field_title'    => esc_html__( 'General', '__Text_Domain__' ),
                'dg_widget_field_default'  => 'general',
                'dg_widget_field_type'     => 'tabgroup',
                'dg_widget_field_options'  => array(
                    'general'=>array(
                        'dg_widget_field_title'=>esc_html__('General', '__Text_Domain__'),
                        'dg_widget_field_options'=> array(
                            'title'    => array(
                                'dg_widget_field_name'     => 'title',
                                'dg_widget_field_wraper'   => 'title',
                                'dg_widget_field_title'    => esc_html__( 'Title', '__Text_Domain__' ),
                                'dg_widget_field_default'  => '',
                                'dg_widget_field_type'     => 'text',
                            ),
                            'title_target'    => array(
                                'dg_widget_field_name'     => 'title_target',
                                'dg_widget_field_wraper'   => 'title-target',
                                'dg_widget_field_title'    => esc_html__( 'Link Target', '__Text_Domain__' ),
                                'dg_widget_field_default'  => '_self',
                                'dg_widget_field_type'     => 'select',
                                'dg_widget_field_options'  => $dglib_link_target,
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
                                'dg_widget_field_title'    => esc_html__( 'Title link', '__Text_Domain__' ),
                                'dg_widget_field_default'  => '',
                                'dg_widget_field_type'     => 'text',
                            ),
                            'social_icon_size'        => array(
                                'dg_widget_field_name'         => 'social_icon_size',
                                'dg_widget_field_title'        => esc_html__( 'Icons Size', '__Text_Domain__' ),
                                'dg_widget_field_default'      => '',
                                'dg_widget_field_type'         => 'select',
                                'dg_widget_field_options'      => dglib_faicon_sizes(),
                            ),
                            'social_media_target'        => array(
                                'dg_widget_field_name'         => 'social_media_target',
                                'dg_widget_field_title'        => esc_html__( 'Social icon open with', '__Text_Domain__' ),
                                'dg_widget_field_default'      => '_blank',
                                'dg_widget_field_type'         => 'select',
                                'dg_widget_field_options'      => $dglib_link_target,
                            ),
                            'social_icon_list'         => array(
                                'dg_widget_field_name'     => 'social_icon_list',
                                'dg_widget_field_title'    => esc_html__( 'Social Icon List', '__Text_Domain__' ),
                                'dg_widget_field_type'     => 'repeater',
                                'dg_widget_description'    => esc_html__('To add social icon click to add icon.', '__Text_Domain__'),
                                'dg_repeater_row_title'    => esc_html__('Social Icon', '__Text_Domain__'),
                                'dg_repeater_addnew_label' => esc_html__('Add Icon', '__Text_Domain__'),
                                'dg_widget_field_options'  => array(
                                    'social_media_icon'  => array(
                                        'dg_widget_field_name'     => 'social_media_icon',
                                        'dg_widget_field_title'    => esc_html__( 'Social Media Icon', '__Text_Domain__' ),
                                        'dg_widget_field_default'  => 'fa-facebook',
                                        'dg_widget_field_type'     => 'icon',
                                    ),
                                    'social_media_link' => array(
                                        'dg_widget_field_name'     => 'social_media_link',
                                        'dg_widget_field_title'    => esc_html__( 'Social Media Link', '__Text_Domain__' ),
                                        'dg_widget_field_default'  => 'https://facebook.com',
                                        'dg_widget_field_type'     => 'url',
                                    ),
                                    'social_media_color' => array(
                                        'dg_widget_field_name'     => 'social_media_color',
                                        'dg_widget_field_title'    => esc_html__( 'Social Icon Color', '__Text_Domain__' ),
                                        'dg_widget_field_default'  => '#00a0d2',
                                        'dg_widget_field_type'     => 'color',
                                    ),
                                ),
                            ),
                            
                        )
                    ),
                ),
            ),
        );

        $widget_fields_key = 'fields_'.$this->id_base;
        $widgets_fields = apply_filters( $widget_fields_key, $fields );
        return $widgets_fields;

    }

	/**
	 * Display the widget
	 */	
	function widget( $args, $instance ) {

        $title = isset( $instance['title'] ) ? esc_attr($instance['title']) : '';
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $title_link = isset( $instance['title_link'] ) ? esc_url($instance['title_link']) : '';
        $title_target = isset( $instance['title_target'] ) ? esc_attr($instance['title_target']) : '';
        $social_icon_size = isset( $instance['social_icon_size'] ) ? esc_attr($instance['social_icon_size']) : '';
        $social_media_target = isset( $instance['social_media_target'] ) ? esc_attr($instance['social_media_target']) : '';
        $social_icon_list = isset( $instance['social_icon_list'] ) ? $instance['social_icon_list'] : array();

		/* Before widget (defined by themes).
		 * Display the widget title if one was input (before and after defined by themes). 
		 */
		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title']; 
            if($title_target){
                ?><a href="<?php echo esc_url($title_link); ?>" target="<?php echo esc_attr($title_target); ?>"><?php 
            }
            echo esc_html( $title );
            if($title_target){
                ?></a><?php 
            }
            echo $args['after_title'];
		} 
		?>
		<div class="social-icons">
            <?php
            foreach($social_icon_list as $index=>$social_media_details){

                $social_media_link = (isset($social_media_details['social_media_link'])) ? esc_attr($social_media_details['social_media_link']) : '';
                $social_media_icon = (isset($social_media_details['social_media_icon'])) ? esc_attr($social_media_details['social_media_icon']) : '';
                $social_media_color = (isset($social_media_details['social_media_color'])) ? esc_attr($social_media_details['social_media_color']) : '';
                ?><a 
                title="<?php esc_html_e('Lekh Social Media Icons', '__Text_Domain__'); ?>" 
                target="<?php echo esc_attr($social_media_target); ?>" 
                <?php if($social_media_target){ ?>
                href="<?php echo esc_attr($social_media_link); ?>" 
                <?php } ?> 
                style="background-color:<?php echo esc_attr( $social_media_color ); ?>"
                ><i 
                class="fa <?php echo esc_attr($social_media_icon).' '.esc_attr($social_icon_size); ?>" 
                ></i></a><?php
            }
            ?>
        </div>
        <!-- End  social-icons -->
        <?php	
        /* After widget (defined by themes). */
        echo $args['after_widget'];

    }

}
