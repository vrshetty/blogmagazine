<?php
/**
 * The template for displaying header top
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.7
 */
?>
<div class="blogmagazine-top-header-wrap">
	<div class="dg-container">
		<?php $blogmagazine_date_option = get_theme_mod( 'blogmagazine_top_date_option', 'show' ); ?>
		<div class="blogmagazine-top-left-section-wrapper">
			<?php if( $blogmagazine_date_option == 'show' ) { ?>
				<div class="date-section"><?php echo esc_html( date_i18n('l, F d, Y') ); ?></div>
			<?php } ?>
			<?php if ( has_nav_menu( 'blogmagazine_top_menu' ) ) { ?>
				<nav id="top-navigation" class="top-navigation" role="navigation">
					<?php
					$top_menu_args = array( 
						'depth'				=> 1,
						'fallback_cb' 		=> false, 
						'menu_id' 			=> 'top-menu',
						'theme_location' 	=> 'blogmagazine_top_menu', 
					);
					wp_nav_menu( $top_menu_args );
					?>
				</nav><!-- #site-navigation -->
			<?php } ?>
		</div><!-- .blogmagazine-top-left-section-wrapper -->
		<div class="blogmagazine-top-right-section-wrapper">
			<?php
			$blogmagazine_top_social_option = get_theme_mod( 'blogmagazine_top_social_option', 'show' );
			if( $blogmagazine_top_social_option == 'show' ) {
				blogmagazine_social_media();
			}
			?>
		</div><!-- .blogmagazine-top-right-section-wrapper -->
	</div>
</div>