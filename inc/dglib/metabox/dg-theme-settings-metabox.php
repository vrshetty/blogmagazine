<?php
/**
 * Create a metabox to added some custom filed in posts.
 *
 * @package Dinesh Ghimire
 * @subpackage dglib
 * @since 1.0.0
 */
if(!class_exists('Dglib_Theme_Settings_Metabox')):

    class Dglib_Theme_Settings_Metabox{

        public function __construct(){
            add_action( 'add_meta_boxes', array($this, 'add_meta_boxes' ) );
            add_action( 'save_post', array($this, 'save_post') );
        }

        public function save_post($post_id){
            
            global $post, $np_allowed_textarea;

            $_all_post_vals = wp_unslash( $_POST );

            // Verify the nonce before proceeding.
            $dglib_post_nonce   = isset( $_all_post_vals['dglib_post_meta_nonce'] ) ? esc_html($_all_post_vals['dglib_post_meta_nonce']) : '';
            $dglib_post_nonce_action = basename( __FILE__ );

            //* Check if nonce is set...
            if ( ! isset( $dglib_post_nonce ) ) {
                return;
            }

            //* Check if nonce is valid...
            if ( ! wp_verify_nonce( $dglib_post_nonce, $dglib_post_nonce_action ) ) {
                return;
            }

            //* Check if user has permissions to save data...
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }

            //* Check if not an autosave...
            if ( wp_is_post_autosave( $post_id ) ) {
                return;
            }

            //* Check if not a revision...
            if ( wp_is_post_revision( $post_id ) ) {
                return;
            }

            /**
             * Post sidebar
             */
            
            $dglib_single_sidebar_details = isset( $_all_post_vals['dglib_single_post_sidebar'] ) ? $_all_post_vals['dglib_single_post_sidebar'] : array();
            $dglib_single_post_sidebar = array_map( 'esc_attr', $dglib_single_sidebar_details );
            update_post_meta ( $post_id, 'dglib_single_post_sidebar', $dglib_single_post_sidebar );

            /**
             * post meta identity
             */
            $dglib_post_meta_identity = get_post_meta( $post_id, 'dglib_theme_settings_metabox_tab', true );
            $sanitize_post_identity = sanitize_text_field( $_all_post_vals[ 'dglib_theme_settings_metabox_tab' ] );

            if ( $sanitize_post_identity && '' == $sanitize_post_identity ){
                add_post_meta( $post_id, 'dglib_theme_settings_metabox_tab', $sanitize_post_identity );
            }elseif ( $sanitize_post_identity && $sanitize_post_identity != $dglib_post_meta_identity ) {
                update_post_meta($post_id, 'dglib_theme_settings_metabox_tab', $sanitize_post_identity );
            } elseif( '' == $sanitize_post_identity && $dglib_post_meta_identity ) {
                delete_post_meta( $post_id, 'dglib_theme_settings_metabox_tab', $dglib_post_meta_identity );
            }
            
        }

        public function sidebar_layouts(){

            $sidebar_layouts = array(
                'default-sidebar' => array(
                    'id'        => 'post-default-sidebar',
                    'value'     => 'default_sidebar',
                    'label'     => esc_html__( 'Default Sidebar', 'blogmagazine' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/dglib/assets/img/sidebars/default-sidebar.png'
                ),
                'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left_sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'blogmagazine' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/dglib/assets/img/sidebars/left-sidebar.png'
                ),
                'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value'     => 'right_sidebar',
                    'label'     => esc_html__( 'Right sidebar', 'blogmagazine' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/dglib/assets/img/sidebars/right-sidebar.png'
                ),
                'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no_sidebar',
                    'label'     => esc_html__( 'No sidebar Full width', 'blogmagazine' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/dglib/assets/img/sidebars/no-sidebar.png'
                ),
                'no-sidebar-center' => array(
                    'id'        => 'post-no-sidebar-center',
                    'value'     => 'no_sidebar_center',
                    'label'     => esc_html__( 'No sidebar Content Centered', 'blogmagazine' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/dglib/assets/img/sidebars/no-sidebar-center.png'
                ),
                'both-sidebar' => array(
                    'id'        => 'post-both-sidebar',
                    'value'     => 'both_sidebar',
                    'label'     => esc_html__( 'Both Sidebar', 'blogmagazine' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/dglib/assets/img/sidebars/both-sidebar.png'
                ),
            );

            return $sidebar_layouts;

        }

        public function add_meta_boxes(){

            add_meta_box(
                'dglib_sidebar_layout_meta',
                esc_html__( 'Theme Options', 'blogmagazine' ),
                array($this, 'metabox_callback'),
                array('post', 'page'),
                'normal',
                'high'
            );

        }

        public function metabox_fields(){

            $metabox_fields = array(
                'dglib_single_post_sidebar'       => array(
                    'sidebar_layout' => array(
                        'dg_metabox_field_name'     => 'sidebar_layout',
                        'dg_metabox_field_title'    => esc_html__( 'Sidebar Layout', 'blogmagazine' ),
                        'dg_metabox_field_default'  => 'general',
                        'dg_metabox_field_type'     => 'imageoptions',
                        'dg_metabox_field_options'  => array(
                            'default_sidebar' => array(
                                'label' => esc_html__( 'Default Sidebar', 'blogmagazine' ),
                                'url'   => '%s/inc/dglib/assets/img/sidebars/default-sidebar.png'
                            ),
                            'left_sidebar' => array(
                                'label' => esc_html__( 'Left Sidebar', 'blogmagazine' ),
                                'url'   => '%s/inc/dglib/assets/img/sidebars/left-sidebar.png'
                            ),
                            'right_sidebar' => array(
                                'label' => esc_html__( 'Right Sidebar', 'blogmagazine' ),
                                'url'   => '%s/inc/dglib/assets/img/sidebars/right-sidebar.png'
                            ),
                            'no_sidebar' => array(
                                'label' => esc_html__( 'No Sidebar', 'blogmagazine' ),
                                'url'   => '%s/inc/dglib/assets/img/sidebars/no-sidebar.png'
                            ),
                            'no_sidebar_center' => array(
                                'label' => esc_html__( 'No Sidebar Center', 'blogmagazine' ),
                                'url'   => '%s/inc/dglib/assets/img/sidebars/no-sidebar-center.png'
                            ),
                            'both_sidebar' => array(
                                'label' => esc_html__( 'Both Sidebar', 'blogmagazine' ),
                                'url'   => '%s/inc/dglib/assets/img/sidebars/both-sidebar.png'
                            )
                        )
                    )
                )
            );

            return $metabox_fields;

        }

        public function metabox_tabs(){

            $metabox_tabs = array(
                'dglib_single_post_sidebar'       => array(
                    'dg_metabox_field_title'    => esc_html__( 'Sidebars', 'blogmagazine' ),
                    'dg_metabox_field_dashicons'=>  'dashicons-exerpt-view',
                    'dg_metabox_field_heading'=>  esc_html__( 'Sidebar Settings', 'blogmagazine' ),
                    'dg_metabox_field_description'    =>  esc_html__( 'If you want to override customizer settings please choose sidebar otherwise leave it default sidebar.', 'blogmagazine' ),
                ),
            );
            return $metabox_tabs;
            
        }

        public function metabox_callback(){

            global $post;
            $sidebar_layouts = $this->sidebar_layouts();

            $dglib_theme_settings_metabox_tab = get_post_meta( $post->ID, 'dglib_theme_settings_metabox_tab', true );
            $dglib_theme_settings_metabox_tab = isset( $dglib_theme_settings_metabox_tab ) ? $dglib_theme_settings_metabox_tab : 'sidebars';
            wp_nonce_field( basename( __FILE__ ), 'dglib_post_meta_nonce' );

            $dglib_metabox_tabs = $this->metabox_tabs();
            $dglib_metabox_fields = $this->metabox_fields();

            ?> 
            <style type = "text/css">

            .dglib-metabox-theme-settings{
                border:none;
                padding-bottom: 40px;
            }
            .dglib-metabox-theme-settings:after{
                content:"";
                clear:both;
                display:block;
            }
            .dg-widget-tab-list{
                width: 25%;
                float: left;
                padding-top: 0px;
                box-sizing: border-box;
            }
            .dg-widget-tab-list .nav-tab{
                float: none;
                display: block;
            }
            .nav-tab:focus, .nav-tab:hover, .nav-tab-active{
                color: #fff;
                border-color: #0085ba;
                background-color: #0085ba;
            }
            .dg-tab-content-wraper{
                width: 75%;
                float: right;
                box-sizing: border-box;
            }
            .dglib-imageoption{
                display:none;
            }
            .dglib-fieldset-imageoption{
                margin:0 5px 5px 0;
                display: inline-block;
            }
            .dglib-fieldset-imageoption  .dglib-imageoption{
                display: none;
            }
            .dglib-imageoption~label{
                display:block;
                line-height: 1em;
                border:2px solid #dedede;
            }
            .dglib-imageoption:checked~label{
                border-color:#0085ba;
            }
            </style> 
            <div class="dglib-metabox-theme-settings dg-widget-field-tab-wraper">
                <div class="nav-tab-wrapper dg-widget-tab-list">
                    <?php 
                    $dglib_theme_settings_metabox_tab = ($dglib_theme_settings_metabox_tab) ? $dglib_theme_settings_metabox_tab : 'dglib_single_post_sidebar';
                    foreach($dglib_metabox_tabs as $dglib_tab_slug => $tabs_details){ 
                        $dg_metabox_field_title = (isset($tabs_details['dg_metabox_field_title'])) ? esc_html($tabs_details['dg_metabox_field_title']) : '';
                        $dg_metabox_field_dashicons = (isset($tabs_details['dg_metabox_field_dashicons'])) ? esc_html($tabs_details['dg_metabox_field_dashicons']) : '';
                        ?>
                        <label class="dglib-meta-tab nav-tab <?php echo ( $dglib_theme_settings_metabox_tab==$dglib_tab_slug ) ? 'nav-tab-active' : ''; ?>" for="dglib_theme_settings_metabox_tab_<?php echo esc_attr($dglib_tab_slug); ?>" data-id="#dglib_theme_option_content_<?php echo esc_attr($dglib_tab_slug); ?>"> <span class="dashicons <?php echo esc_attr($dg_metabox_field_dashicons); ?>"></span><?php echo esc_html($dg_metabox_field_title); ?><input id="dglib_theme_settings_metabox_tab_<?php echo esc_attr($dglib_tab_slug); ?>" type="radio" name="dglib_theme_settings_metabox_tab" value="<?php echo esc_attr($dglib_tab_slug); ?>" <?php checked( $dglib_theme_settings_metabox_tab, $dglib_tab_slug ); ?> class="dg-hidden"></label>
                    <?php } ?>
                </div><!-- .dg-widget-tab-list -->
                <div class="dg-tab-content-wraper">
                    <!-- Info tab content -->
                    <?php foreach($dglib_metabox_tabs as $dglib_tab_slug => $tabs_details){ 
                        $dg_metabox_field_heading = (isset($tabs_details['dg_metabox_field_heading'])) ? esc_html($tabs_details['dg_metabox_field_heading']) : '';
                        $dg_metabox_field_description = (isset($tabs_details['dg_metabox_field_description'])) ? esc_html($tabs_details['dg_metabox_field_description']) : '';
                        $dglib_tab_fields = (isset($dglib_metabox_fields[$dglib_tab_slug] ) ) ? $dglib_metabox_fields[$dglib_tab_slug] : array();
                        ?>
                        <div data-value="<?php echo esc_attr($dglib_theme_settings_metabox_tab.':'.$dglib_tab_slug); ?>" class="dg-tab-contents <?php echo ( $dglib_theme_settings_metabox_tab==$dglib_tab_slug ) ? 'dg-tab-active' : ''; ?>" id="dglib_theme_option_content_<?php echo esc_attr($dglib_tab_slug); ?>">
                            <div class="dglib-tab-content-header">
                                <h3><?php echo esc_html($dg_metabox_field_heading); ?></h3> 
                                <p><?php echo esc_html($dg_metabox_field_description); ?></p>
                            </div><!-- .content-header --> 
                            <div class="dglib-tab-content-fields">
                                <?php if($dglib_tab_fields){
                                    foreach($dglib_tab_fields as $dglib_field_slug=>$dglib_field_details){
                                        $dg_metabox_field_name = (isset($dglib_field_details['dg_metabox_field_name'])) ? esc_attr($dglib_field_details['dg_metabox_field_name']) : '';
                                        $dg_metabox_field_title = (isset($dglib_field_details['dg_metabox_field_title'])) ? esc_attr($dglib_field_details['dg_metabox_field_title']) : '';
                                        $dg_metabox_field_default = (isset($dglib_field_details['dg_metabox_field_default'])) ? esc_attr($dglib_field_details['dg_metabox_field_default']) : '';
                                        $dg_metabox_field_type = (isset($dglib_field_details['dg_metabox_field_type'])) ? esc_attr($dglib_field_details['dg_metabox_field_type']) : '';
                                        $dg_metabox_field_options = (isset($dglib_field_details['dg_metabox_field_options'])) ? $dglib_field_details['dg_metabox_field_options'] : array();
                                        $dglib_metabox_field_name = $dglib_tab_slug.'['.$dglib_field_slug.']';
                                        $dglib_metabox_field_id = 'id_'.$dglib_tab_slug.'_'.$dglib_field_slug;
                                        ?><div class="dglib-metabox-field-single"><?php
                                        switch ($dg_metabox_field_type){
                                            case 'imageoptions':
                                                ?>
                                                <div class="dglib-imageoption-field-wrapper">
                                                    <?php
                                                    foreach($dg_metabox_field_options as $imageoption_key => $imageoption_details){ 
                                                        $dglib_image_option_url = (isset($imageoption_details['url'])) ? $imageoption_details['url'] : '%s';
                                                        $dglib_image_option_label = (isset($imageoption_details['label'])) ? esc_html($imageoption_details['label']) : '';
                                                        $dglib_imageoption_id = $dglib_metabox_field_id.'_'.$imageoption_key;
                                                        $dglib_post_sidebar = 'default_sidebar';
                                                        ?>
                                                        <div class="dglib-fieldset-imageoption">
                                                            <input class="dglib-imageoption" type="radio" id="<?php echo esc_attr( $dglib_imageoption_id ); ?>" value="<?php echo esc_attr( $imageoption_key ); ?>" name="<?php echo esc_attr($dglib_metabox_field_name); ?>" <?php checked( $imageoption_key, $dglib_post_sidebar ); ?> />
                                                            <label for="<?php echo esc_attr( $dglib_imageoption_id ); ?>">
                                                                <span class="screen-reader-text"><?php echo esc_html( $dglib_image_option_label ); ?> </span>
                                                                <img src="<?php echo esc_url(sprintf( $dglib_image_option_url, get_template_directory_uri() ) ); ?>" title="<?php echo esc_attr( $dglib_image_option_label ); ?>" alt="<?php echo esc_attr( $dglib_image_option_label ); ?>" />
                                                            </label>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <?php
                                                break;
                                            default:
                                                ?><p><?php esc_html_e('Sorry metabox field not found.', 'blogmagazine'); ?></p><?php
                                                break;
                                        }
                                        ?></div><?php
                                    }
                                }else{
                                    ?><p><?php esc_html_e('Please put some fields to show on metabox', 'blogmagazine'); ?></p><?php
                                }
                                ?>
                            </div><!-- .meta-options-wrap  --> 
                        </div><!-- #dglib-metabox-info -->
                    <?php } ?>
                </div><!-- .dg-tab-content-wraper -->
            </div><!-- .dglib-meta-container --> 
            <?php
        }
    }
endif;
new Dglib_Theme_Settings_Metabox();