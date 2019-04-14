<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dineshghimire
 * @subpackage blogmagazine
 * @since 1.0.0
 */

$static_frontpage_layout = get_theme_mod( 'static_frontpage_layout', 'magazine' );
if(is_front_page()):
	$static_frontpage_layout = 'archive';
endif;
echo '<h1>'.$static_frontpage_layout.'</h1>';
die();/*
swtich($static_frontpage_layout){
	case "magazine":
		get_header();
		get_template_part( 'template-parts/templates/front', 'page' );
		get_footer();
		break;
	case "page":
		get_template_part('archive');
		break;
	default:
		get_template_part('page');
		break;
}*/