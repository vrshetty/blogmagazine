<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package    dineshghimire
 * @subpackage blogmagazine
 * @author     Dinesh Ghimire <developer.dinesh1@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt
 * @link       https://codex.wordpress.org/Creating_an_Error_404_Page
 * @since      1.0.0
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'blogmagazine' ); ?></h1>
				</header><!-- .page-header -->
				<div class="error-num"> <?php esc_html_e( '404', 'blogmagazine' ); ?> <span><?php esc_html_e( 'error', 'blogmagazine' );?></span> </div>
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'blogmagazine' ); ?></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
