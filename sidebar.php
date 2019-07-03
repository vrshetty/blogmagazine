<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */
$sidebar_list_items = blogmagazine_sidebar_name_array();
foreach( $sidebar_list_items as $index=>$sidebar_name ){
	if ( ! is_active_sidebar( $sidebar_name ) ){
		continue;
	}
	?>
	<aside id="secondary" class="sidebar-main widget-area <?php echo esc_attr($sidebar_name); ?>" role="complementary">
		<?php dynamic_sidebar( $sidebar_name ); ?>
	</aside><!-- #secondary -->
	<?php

}