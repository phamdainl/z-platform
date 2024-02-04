<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Z_Platform
 */

$theme_single_style = get_theme_mod( 'theme_single_style', 'style_2' );

get_header();
?>

	<?php get_template_part( "/template-parts/single/$theme_single_style", get_post_type('') ); ?>

<?php
get_footer();
