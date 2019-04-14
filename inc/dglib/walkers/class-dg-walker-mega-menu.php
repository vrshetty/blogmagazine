<?php
class Dglib_Walker_Mega_Menu extends Walker_Nav_Menu{

    public $megamenu_id;

    public $count;

    public function __construct(){

        $this->megamenu_id = 0;

        $this->count = 0;

    }

    public function start_lvl(&$output, $depth = 0, $args = array()){

        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );

        // Default class.
        $classes = array( 
            'sub-menu',
            'dglib-submenu-depth'.$depth
        );

        $class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $output .= "{$n}{$indent}<ul$class_names>{$n}";
        
    }

    public function end_lvl(&$output, $depth = 0, $args = array()){

        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        $output .= "$indent</ul>{$n}";

    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){

        $megamenu_options = 'menu-item-dglib-megamenu';
        $megamenu_values = get_post_meta( $item->ID, $megamenu_options, true );
        $enable_megamenu = (isset($megamenu_values['enable_megamenu'])) ? absint($megamenu_values['enable_megamenu']) : 0;
        $description_tips = (isset($megamenu_values['description_tips'])) ? esc_html($megamenu_values['description_tips']) : '';
        $menu_icon = (isset($megamenu_values['menu_icon'])) ? esc_attr($megamenu_values['menu_icon']) : '';
        $megamenu_categories = (isset($megamenu_values['megamenu_categories'])) ? $megamenu_values['megamenu_categories'] : array();

        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        if($enable_megamenu){
            $classes[] = 'dglib-has-megamenu';
            $classes[] = 'menu-item-has-children';
        }else{
            $classes[] = 'dglib-no-megamenu';
        }

        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $megamenu_ajax_data = array(
            'type'      => 'POST',
            'dataType'  => 'json',
            'url'       => admin_url( 'admin-ajax.php' ),
            'data'      => array(
                'action'                => 'dglib_megamenu_posts',
                'term_ids'              => '',
                'posts_per_page'        => 4,
                'megamenu_nonce_value'  => wp_create_nonce( 'dglib_megamenu_posts_nonce' )
            ),
        );

        $megamenu_html = '';
        if($enable_megamenu && $megamenu_categories && $depth<1){   
            $megamenu_html .= '<div class="sub-menu dglib-megamenu-wrapper" >';
            $megamenu_html .= '<div class="dglib-megamenu-container" >';
            $megamenu_html .= '<div class="dglib-megamenu-left-part">';
            $megamenu_html .= '<ul class="dglib-listing-items">';      
            if($megamenu_categories){
                $megamenu_ajax_data['data']['term_ids'] = $megamenu_categories;
                $megamenu_html .= '<li class="dglib-term-list-item active-item" data-tab="dglib-megamenu-tab-all"><a data-config=\''.json_encode($megamenu_ajax_data).'\' data-term-ids="'.json_encode($megamenu_categories).'">'.esc_html__('All', 'blogmagazine').'</a></li>';
            }
            foreach($megamenu_categories as $index=>$category_id){
                $category_details = get_term_by( 'term_id', $category_id, 'category' );
                $megamenu_ajax_data['data']['term_ids'] = $category_id;
                $megamenu_html .= '<li class="dglib-term-list-item" data-tab="dglib-megamenu-tab-'.$category_id.'"><a data-config=\''.json_encode($megamenu_ajax_data).'\' href="'.get_category_link($category_id).'" data-term-ids="'.json_encode($category_id).'">'.esc_html($category_details->name).'</a></li>';
            }
            $megamenu_html .= '</ul>';
            $megamenu_html .= '</div>'; // .dglib-megamenu-left-part

            $megamenu_html .= '<div class="dglib-megamenu-right-part">';
            if($megamenu_categories){
                $megamenu_html .= '<div class="dglib-megamenu-terms-posts active-item dglib-megamenu-tab-all">';

                $megamenu_html .= '<div class="dglib-menu-posts-wrap">';
                $megamenu_html .= '</div>';

                $megamenu_html .= '<div class="dglib-menu-nav">';
                $megamenu_html .= '<span class="dglib-nav-prev dglib-carousel-control"><i class="fa fa-angle-left"></i></span>';
                $megamenu_html .= '<span class="dglib-nav-prev dglib-carousel-control"><i class="fa fa-angle-right"></i></span>';
                $megamenu_html .= '</div>';
                $megamenu_html .= '</div>';
            }
            foreach($megamenu_categories as $index=>$category_id){
                $megamenu_html .= '<div class="dglib-megamenu-terms-posts dglib-megamenu-tab-'.absint($category_id).'"  data-term-ids="'.json_encode($category_id).'">';

                $megamenu_html .= '<div class="dglib-menu-posts-wrap">';
                $megamenu_html .= '</div>';

                $megamenu_html .= '<div class="dglib-menu-nav">';
                $megamenu_html .= '<span class="dglib-nav-prev dglib-carousel-control"><i class="fa fa-angle-left"></i></span>';
                $megamenu_html .= '<span class="dglib-nav-prev dglib-carousel-control"><i class="fa fa-angle-right"></i></span>';
                $megamenu_html .= '</div>';
                $megamenu_html .= '</div>';
            }
            $megamenu_html .= '<figure class="dglib-menu-preloader">';
            $megamenu_html .= '<span class="helper"></span>';
            $megamenu_html .= '<img src="'.dglib_assets_url('img/preloader/loader3.gif').'" alt="'.esc_html__( 'Preloader', 'blogmagazine' ).'" title="'.esc_html__('Preloader', 'blogmagazine' ).'"/>';
            $megamenu_html .= '</figure>';
            $megamenu_html .= '</div>'; // .dglib-megamenu-right-part
            $megamenu_html .= '</div>'; // .dglib-megamenu-container
            $megamenu_html .= '</div>'; // .dglib-megamenu-wrapper

        }

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        if ($description_tips) {
            $atts['class']   = 'dglib-has-menu-tips';
        }

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $fa_icon_html = ($menu_icon) ? '<i class="fa '.$menu_icon.'"></i>' : '';
        $description_html = ($description_tips && $item->description) ? '<span class="dglib-menu-tips">'.$item->description.'</span>' : '';

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $args_arr = (array)$args;
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
        $item_output = $args_arr['before'];
        $item_output .= '<a '. $attributes .'>';
        $item_output .= $fa_icon_html;
        $item_output .= $args_arr['link_before'] . $title . $args_arr['link_after'];
        $item_output .= '</a>';
        $item_output .= $description_html;
        $item_output .= $args_arr['after'];

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        $output .= $megamenu_html;

    }

    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output){

        if (!$element) {
            return;
        }

        $id_field = $this->db_fields['id'];

        //display this element
        if (is_array($args[0])) {
            $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
        } elseif (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }

        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);

        $id = $element->$id_field;

        // descend only when the depth is right and there are childrens for this element
        if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {
            foreach ($children_elements[ $id ] as $child) {
                if (!isset($newlevel)) {
                    $newlevel = true;
              //start the child delimiter
              $cb_args = array_merge(array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }
                $this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
            }
            unset($children_elements[ $id ]);
        }

        if (isset($newlevel) && $newlevel) {
            //end the child delimiter
          $cb_args = array_merge(array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }

        //end this element
        $cb_args = array_merge(array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);
    }
}
