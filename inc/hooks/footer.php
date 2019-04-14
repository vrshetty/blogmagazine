<?php
/**
 * Custom hooks functions are define about footer section.
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_footer_start' ) ) :
	function blogmagazine_footer_start() {
		echo '<footer id="colophon" class="site-footer" role="contentinfo">';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer widget section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_footer_widget_section' ) ) :
	function blogmagazine_footer_widget_section() {
		$blogmagazine_footer_widget_option = get_theme_mod( 'blogmagazine_footer_widget_option', 'show' );
	    if( $blogmagazine_footer_widget_option == 'hide' ) {
	        return;
	    }
	    if( !is_active_sidebar( 'blogmagazine-footer' ) && !is_active_sidebar( 'blogmagazine-footer-2' ) && !is_active_sidebar( 'blogmagazine-footer-3' ) && !is_active_sidebar( 'blogmagazine-footer-4' ) ) {
	           return;
	    }
	    $blogmagazine_footer_layout = absint(get_theme_mod( 'footer_widget_layout', 4 ));
	    ?>
	    <div id="top-footer" class="blogmagazine-top-footer footer-widgets-wrapper footer_column_<?php echo esc_attr( $blogmagazine_footer_layout ); ?> dg-clearfix">
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
	    <?php
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_bottom_footer_start' ) ) :
	function blogmagazine_bottom_footer_start() {
		echo '<div class="bottom-footer dg-clearfix">';
		echo '<div class="dg-container">';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer side info
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_footer_site_info_section' ) ) :
	function blogmagazine_footer_site_info_section() {
?>
		<div class="site-info">
			<span class="blogmagazine-copyright-text">
				<?php 
					$blogmagazine_copyright_text = get_theme_mod( 'blogmagazine_copyright_text', esc_html__( 'BlogMagazine', 'blogmagazine' ) );
					echo esc_html( $blogmagazine_copyright_text );
				?>
			</span>
			<span class="sep"> | </span>
			<?php
				$blogmagazine_author_url = 'https://dinesh-ghimire.com.np/';
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'blogmagazine' ), 'BlogMagazine', '<a href="'. esc_url( $blogmagazine_author_url ).'" rel="designer" target="_blank">Dinesh Ghimire</a>' );
			?>
		</div><!-- .site-info -->
<?php
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer menu
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_footer_menu_section' ) ) :
	function blogmagazine_footer_menu_section() {
?>
		<nav id="footer-navigation" class="footer-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'blogmagazine_footer_menu', 'menu_id' => 'footer-menu', 'fallback_cb' => false ) );
			?>
		</nav><!-- #site-navigation -->
<?php
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_bottom_footer_end' ) ) :
	function blogmagazine_bottom_footer_end() {
		echo '</div><!-- .dg-container -->';
		echo '</div> <!-- bottom-footer -->';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_footer_end' ) ) :
	function blogmagazine_footer_end() {
		echo '</footer><!-- #colophon -->';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Go to Top Icon
 *
 * @since 1.0.0
 */

if( ! function_exists( 'blogmagazine_go_top' ) ) :
	function blogmagazine_go_top() {
		echo '<div id="blogmagazine-scrollup" class="animated arrow-hide"><i class="fa fa-chevron-up"></i></div>';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Managed functions for footer hook
 *
 * @since 1.0.0
 */
add_action( 'blogmagazine_footer', 'blogmagazine_footer_start', 5 );
add_action( 'blogmagazine_footer', 'blogmagazine_footer_widget_section', 10 );
add_action( 'blogmagazine_footer', 'blogmagazine_bottom_footer_start', 15 );
add_action( 'blogmagazine_footer', 'blogmagazine_footer_site_info_section', 20 );
add_action( 'blogmagazine_footer', 'blogmagazine_footer_menu_section', 25 );
add_action( 'blogmagazine_footer', 'blogmagazine_bottom_footer_end', 30 );
add_action( 'blogmagazine_footer', 'blogmagazine_footer_end', 35 );
add_action( 'blogmagazine_footer', 'blogmagazine_go_top', 40 );

if(!function_exists('blogmagazine_additional_javascript')):
	function blogmagazine_additional_javascript(){
		$custom_javascript = get_option( 'custom_javascript_code', '' );
		?>
		<script type="text/javascript">
			(function ($) {
				"use strict";
				<?php echo $custom_javascript . "\n"; ?>
			})(jQuery);
		</script>
		<?php
	}
endif;
add_action( 'wp_footer', 'blogmagazine_additional_javascript', 20 );