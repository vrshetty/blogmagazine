<?php
/**
 * The template for displaying footer bottom
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.7
 */
?>
<div class="bottom-footer dg-clearfix">
	<div class="dg-container">
		<div class="site-info">
			<span class="blogmagazine-copyright-text">
				<?php 
				$footer_copyright_text = get_theme_mod( 'footer_copyright_text', esc_html__( 'BlogMagazine', 'blogmagazine' ) );
				echo esc_html( $footer_copyright_text );
				?>
			</span>
			<?php 
			$remove_footer_link  = apply_filters( 'blogmagazine_remove_footer_link', false );
			if(!$remove_footer_link){
				?>
				<span class="sep"> | </span>
				<?php
				$blogmagazine_author_url = 'https://dinesh-ghimire.com.np/';
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'blogmagazine' ), 'BlogMagazine', '<a href="'. esc_url( $blogmagazine_author_url ).'" rel="designer" target="_blank">Dinesh Ghimire</a>' );
			}
			?>
		</div><!-- .site-info -->
		<nav id="footer-navigation" class="footer-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'blogmagazine_footer_menu', 'menu_id' => 'footer-menu', 'fallback_cb' => false ) );
			?>
		</nav><!-- #site-navigation -->
	</div><!-- .dg-container -->
</div> <!-- bottom-footer -->