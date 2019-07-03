<?php

/**
 * Home Top Section Area
 * 
 * @since 1.0.0
 */
if ( is_active_sidebar( 'blogmagazine_home_top_section_area' ) ) {
	?>
	<div class="blogmagazine-home-top-section widget-area dg-clearfix">
		<?php dynamic_sidebar( 'blogmagazine_home_top_section_area' ); ?>
	</div><!-- .blogmagazine-home-top-section -->
	<?php 
}


/**
 * Home Middle Section Area
 * 
 * @since 1.0.0
 */
if ( is_active_sidebar( 'blogmagazine_home_middle_section_area' ) ) {
	?>
	<div class="blogmagazine-home-middle-section dg-clearfix">
		<div class="middle-primary widget-area">
			<?php dynamic_sidebar( 'blogmagazine_home_middle_section_area' ); ?>
		</div><!-- .middle-primary -->
		<div class="middle-aside widget-area">
			<?php dynamic_sidebar( 'blogmagazine_home_middle_aside_area' ); ?>
		</div><!-- .middle-aside -->
	</div><!-- .blogmagazine-home-middle-section -->
	<?php 
}

/**
 * Home Bottom Section Area
 * 
 * @since 1.0.0
 */
if ( is_active_sidebar( 'blogmagazine_home_bottom_section_area' ) ) {
	?>
	<div class="blogmagazine-home-bottom-section widget-area">
		<?php dynamic_sidebar( 'blogmagazine_home_bottom_section_area' ); ?>
	</div><!-- .blogmagazine-home-bottom-section -->
	<?php 
}
