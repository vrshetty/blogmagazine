<?php
/**
 * The template for displaying footer middle
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.7
 */
$blogmagazine_footer_widget_option = get_theme_mod( 'blogmagazine_footer_widget_option', 'show' );
if( $blogmagazine_footer_widget_option == 'hide' ) {
	return;
}
if( !is_active_sidebar( 'blogmagazine-footer' ) && !is_active_sidebar( 'blogmagazine-footer-2' ) && !is_active_sidebar( 'blogmagazine-footer-3' ) && !is_active_sidebar( 'blogmagazine-footer-4' ) ) {
	return;
}
$blogmagazine_footer_layout = absint(get_theme_mod( 'footer_widget_layout', 4 ));
?>
<div id="middle-footer" class="blogmagazine-middle-footer footer-widgets-wrapper footer_column_<?php echo esc_attr( $blogmagazine_footer_layout ); ?> dg-clearfix">
	<div class="dg-container">
		<div class="footer-widgets-area  dg-clearfix">
			<div class="dg-footer-widget-wrapper dg-column-wrapper dg-clearfix">
				<?php if( $blogmagazine_footer_layout > 0 ){ ?>
					<div class="dg-footer-widget widget-area wow fadeInLeft" data-wow-duration="0.5s">
						<?php dynamic_sidebar( 'blogmagazine-footer' ); ?>
					</div>
				<?php } ?>
				<?php if( $blogmagazine_footer_layout > 1 ){ ?>
					<div class="dg-footer-widget widget-area wow fadeInLeft" data-woww-duration="1s">
						<?php dynamic_sidebar( 'blogmagazine-footer-2' ); ?>
					</div>
				<?php } ?>
				<?php if( $blogmagazine_footer_layout > 2 ){ ?>
					<div class="dg-footer-widget widget-area wow fadeInLeft" data-wow-duration="1.5s">
						<?php dynamic_sidebar( 'blogmagazine-footer-3' ); ?>
					</div>
				<?php } ?>
				<?php if( $blogmagazine_footer_layout > 3 ){ ?>
					<div class="dg-footer-widget widget-area wow fadeInLeft" data-wow-duration="2s">
						<?php dynamic_sidebar( 'blogmagazine-footer-4' ); ?>
					</div>
				<?php } ?>
			</div><!-- .dg-footer-widget-wrapper -->
		</div><!-- .footer-widgets-area -->
	</div><!-- .dg-container -->
</div><!-- .footer-widgets-wrapper -->