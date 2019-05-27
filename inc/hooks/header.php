<?php
/**
 * Custom hooks functions are define about header section.
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Top header start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_top_header_start' ) ) :
	function blogmagazine_top_header_start() {
		echo '<div class="blogmagazine-top-header-wrap">';
		echo '<div class="dg-container">';
	}
endif;

/**
 * Top header left section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_top_left_section' ) ) :
	function blogmagazine_top_left_section() {
		$blogmagazine_date_option = get_theme_mod( 'blogmagazine_top_date_option', 'show' );
?>
		<div class="blogmagazine-top-left-section-wrapper">
			<?php
				if( $blogmagazine_date_option == 'show' ) {
					echo '<div class="date-section">'. esc_html( date_i18n('l, F d, Y') ) .'</div>';
				}
			?>

			<?php if ( has_nav_menu( 'blogmagazine_top_menu' ) ) { ?>
				<nav id="top-navigation" class="top-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'blogmagazine_top_menu', 'fallback_cb' => false, 'menu_id' => 'top-menu' ) );
					?>
				</nav><!-- #site-navigation -->
			<?php } ?>
		</div><!-- .blogmagazine-top-left-section-wrapper -->
<?php
	}
endif;

/**
 * Top header right section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_top_right_section' ) ) :
	function blogmagazine_top_right_section() {
?>
		<div class="blogmagazine-top-right-section-wrapper">
			<?php
				$blogmagazine_top_social_option = get_theme_mod( 'blogmagazine_top_social_option', 'show' );
				if( $blogmagazine_top_social_option == 'show' ) {
					blogmagazine_social_media();
				}
			?>
		</div><!-- .blogmagazine-top-right-section-wrapper -->
<?php
	}
endif;

/**
 * Top header end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_top_header_end' ) ) :
	function blogmagazine_top_header_end() {
		echo '</div><!-- .dg-container -->';
		echo '</div><!-- .blogmagazine-top-header-wrap -->';
	}
endif;

/**
 * Managed functions for top header hook
 *
 * @since 1.0.0
 */
add_action( 'blogmagazine_top_header', 'blogmagazine_top_header_start', 5 );
add_action( 'blogmagazine_top_header', 'blogmagazine_top_left_section', 10 );
add_action( 'blogmagazine_top_header', 'blogmagazine_top_right_section', 15 );
add_action( 'blogmagazine_top_header', 'blogmagazine_top_header_end', 20 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * header section start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_header_section_start' ) ) :
	function blogmagazine_header_section_start() {
		echo '<header id="masthead" class="site-header" role="banner">';
	}
endif;

/**
 * header logo and ads section start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_header_logo_ads_section_start' ) ) :
	function blogmagazine_header_logo_ads_section_start() {
		echo '<div class="blogmagazine-logo-section-wrapper">';
		echo '<div class="dg-container">';
	}
endif;

/**
 * site branding section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_site_branding_section' ) ) :
	function blogmagazine_site_branding_section() {
?>
		<div class="site-branding">

			<?php if ( the_custom_logo() ) { ?>
				<div class="site-logo">
					<?php the_custom_logo(); ?>
				</div><!-- .site-logo -->
			<?php } ?>

			<?php
			if ( is_front_page() || is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
			
		</div><!-- .site-branding -->
<?php
	}
endif;

/**
 * header ads area
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_header_ads_section' ) ) :
	function blogmagazine_header_ads_section() {
?>
		<div class="blogmagazine-header-ads-area">
			<?php
				if ( is_active_sidebar( 'blogmagazine_header_ads_area' ) ) {
					dynamic_sidebar( 'blogmagazine_header_ads_area' );
				}
			?>
		</div><!-- .blogmagazine-header-ads-area -->
<?php
	}
endif;

/**
 * header logo and ads section end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_header_logo_ads_section_end' ) ) :
	function blogmagazine_header_logo_ads_section_end() {
		echo '</div><!-- .dg-container -->';
		echo '</div><!-- .blogmagazine-logo-section-wrapper -->';
	}
endif;

/**
 * header primary menu section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_primary_menu_section' ) ):
	
	function blogmagazine_primary_menu_section() {
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
						<?php wp_nav_menu( array( 'theme_location' => 'blogmagazine_primary_menu', 'menu_id' => 'primary-menu', 'menu_class'=>'primary-menu menu' ) );
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
							if($random_query->have_posts()):$random_query->the_post();
								?>
								<a class="menu-random-news other-menu-icon" href="<?php the_permalink(); ?>"><i class="fa fa-random"></i></a>
								<?php
							endif;
						}
						?>
					</div><!-- .blogmagazine-header-search-wrapper -->
				</div>
			</div>
		</div><!-- .blogmagazine-header-menu-wrapper -->
<?php
	}
endif;

/**
 * header section end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_header_section_end' ) ) :
	function blogmagazine_header_section_end() {
		echo '</header><!-- .site-header -->';
	}
endif;

/**
 * Managed functions for ticker section
 *
 * @since 1.0.0
 */
add_action( 'blogmagazine_header_section', 'blogmagazine_header_section_start', 5 );
add_action( 'blogmagazine_header_section', 'blogmagazine_header_logo_ads_section_start', 10 );
add_action( 'blogmagazine_header_section', 'blogmagazine_site_branding_section', 15 );
add_action( 'blogmagazine_header_section', 'blogmagazine_header_ads_section', 20 );
add_action( 'blogmagazine_header_section', 'blogmagazine_header_logo_ads_section_end', 25 );
add_action( 'blogmagazine_header_section', 'blogmagazine_primary_menu_section', 30 );
add_action( 'blogmagazine_header_section', 'blogmagazine_header_section_end', 35 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Ticker section start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_ticker_section_start' ) ) :
	function blogmagazine_ticker_section_start() {
		echo '<div class="blogmagazine-ticker-wrapper">';
		echo '<div class="dg-container">';
		echo '<div class="blogmagazine-ticker-block dg-clearfix">';
	}
endif;

/**
 * Ticker content area
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_ticker_content' ) ) :
	function blogmagazine_ticker_content() {
		
		$blogmagazine_ticker_caption = get_theme_mod( 'blogmagazine_ticker_caption', esc_html__( 'Breaking News', 'blogmagazine' ) );
?>
		<span class="ticker-caption"><?php echo esc_html( $blogmagazine_ticker_caption ); ?></span>
		<div class="ticker-content-wrapper">
			<?php
				$blogmagazine_ticker_cat_id = apply_filters( 'blogmagazine_ticker_cat_id', null );
				$ticker_args = array(
					'cat' => $blogmagazine_ticker_cat_id,
					'posts_per_page' => '5'
				);
				$ticker_query = new WP_Query( $ticker_args );
				if( $ticker_query->have_posts() ) {
					echo '<ul class="blogmagazine-newsticker">';
					while( $ticker_query->have_posts() ) {
						$ticker_query->the_post();
			?>			
						<li><div class="news-ticker-title"><?php blogmagazine_post_categories_list(); ?> <a href="<?php the_permalink(); ?>"><?php the_title();?></a></div></li>
			<?php
					}
					echo '</ul>';
				}
			?>
		</div><!-- .ticker-content-wrapper -->
<?php
	}
endif;

/**
 * Ticker section end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'blogmagazine_ticker_section_end' ) ) :
	function blogmagazine_ticker_section_end() {
		echo '</div><!-- .blogmagazine-ticker-block -->';
		echo '</div><!-- .dg-container -->';
		echo '</div><!-- .blogmagazine-ticker-wrapper -->';
	}
endif;

/**
 * Managed functions for ticker section
 *
 * @since 1.0.0
 */
add_action( 'blogmagazine_ticker_section', 'blogmagazine_ticker_section_start', 5 );
add_action( 'blogmagazine_ticker_section', 'blogmagazine_ticker_content', 10 );
add_action( 'blogmagazine_ticker_section', 'blogmagazine_ticker_section_end', 15 );