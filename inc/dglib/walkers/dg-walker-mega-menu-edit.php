<?php
/**
 * Navigation Menu API: Walker_Nav_Menu_Edit class
 *
 * @package dineshghimire
 * @subpackage dblib
 * @since 1.0.0
 */

class Dglib_Walker_Mega_Menu_Edit extends Dglib_Walker_Nav_Menu_Edit{
	
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $item_output = '';

        parent::start_el( $item_output, $item, $depth, $args, $id );

        $output .= preg_replace(
            // NOTE: Check this regex from time to time!
            '/(?=<(fieldset|p)[^>]+class="[^"]*field-move)/',
            $this->get_fields( $item, $depth, $args ),
            $item_output
        );
    }

    protected function get_fields( $item, $depth, $args = array(), $id = 0 ) {
        ob_start();

        /**
         * Get menu item custom fields from plugins/themes
         *
         * @since 0.1.0
         * @since 1.0.0 Pass correct parameters.
         *
         * @param int    $item_id  Menu item ID.
         * @param object $item     Menu item data object.
         * @param int    $depth    Depth of menu item. Used for padding.
         * @param array  $args     Menu item args.
         * @param int    $id       Nav menu ID.
         *
         * @return string Custom fields HTML.
         */
        do_action( 'dglib_mega_menu_item_fields', $item->ID, $item, $depth, $args, $id );

        return ob_get_clean();
    }

} // Dglib_Walker_Mega_Menu_Edit
