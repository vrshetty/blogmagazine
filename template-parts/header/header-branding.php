<?php
/**
 * The template for displaying header branding
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.7
 */
?>
<div class="blogmagazine-logo-section-wrapper">
	<div class="dg-container">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) { ?>
				<div class="site-logo">
					<?php the_custom_logo(); ?>
				</div><!-- .site-logo -->
			<?php } ?>
			<?php
			$header_textcolor = get_theme_mod('header_textcolor');
			if($header_textcolor!='blank'){
				if ( is_front_page() || is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo esc_html($description); /* WPCS: xss ok. */ ?></p>
					<?php
				endif;
			}
			?>
		</div><!-- .site-branding -->
		<div class="blogmagazine-header-ads-area">
			<?php
			if ( is_active_sidebar( 'blogmagazine_header_ads_area' ) ) {
				dynamic_sidebar( 'blogmagazine_header_ads_area' );
			}
			?>
		</div><!-- .blogmagazine-header-ads-area -->
	</div><!-- .dg-container -->
</div><!-- .blogmagazine-logo-section-wrapper -->