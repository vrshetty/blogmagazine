<?php
/**
 * The template for displaying header primary navigation
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.7
 */
?>
<div id="blogmagazine-menu-wrap" class="blogmagazine-header-menu-wrapper">
	<div class="blogmagazine-header-menu-block-wrap">
		<div class="dg-container">
			<?php
			$blogmagazine_home_icon_option = get_theme_mod( 'blogmagazine_home_icon_option', 'show' );
			if( $blogmagazine_home_icon_option == 'show' ) {
				?>
				<div class="blogmagazine-home-icon">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <i class="fa fa-home"> </i> </a>
				</div><!-- .blogmagazine-home-icon -->
			<?php } ?>
			<a href="javascript:void(0)" class="menu-toggle hide"> <i class="fa fa-navicon"> </i> </a>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php 
				$primary_menu_args = array(
					'menu_id' => 'primary-menu',
					'menu_class'=>'primary-menu menu',
					'theme_location' => 'blogmagazine_primary_menu',
					'fallback_cb' => 'blogmagazine_fallback_primary_menu',
				);
				wp_nav_menu( $primary_menu_args );
				?>
			</nav><!-- #site-navigation -->
			<div class="blogmagazine-header-search-wrapper">     
				<?php
				$blogmagazine_search_icon_option = get_theme_mod( 'blogmagazine_search_icon_option', 'show' );
				if( $blogmagazine_search_icon_option == 'show' ){
					?>
					<span class="search-main other-menu-icon"><i class="fa fa-search"></i></span>
					<div class="search-form-main dg-clearfix">
						<?php get_search_form(); ?>
					</div>
					<?php
				}
				$blogmagazine_random_post_option = get_theme_mod( 'blogmagazine_random_post_option', 'show' );
				if( $blogmagazine_random_post_option == 'show' ){
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 1,
						'orderby' => 'rand'
					);
					$random_query = new WP_Query($args);
					if($random_query->have_posts()):
						$random_query->the_post();
						$random_icon_class = get_theme_mod( 'blogmagazine_random_post_icon', 'fa-random' );
						?>
						<a class="menu-random-news other-menu-icon" href="<?php the_permalink(); ?>"><i class="fa <?php echo esc_attr($random_icon_class); ?>"></i></a>
						<?php
					endif;
				}
				?>
			</div><!-- .blogmagazine-header-search-wrapper -->
		</div>
	</div>
</div><!-- .blogmagazine-header-menu-wrapper -->