<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Z_Platform
 */

$archive_container_mode = get_theme_mod( 'archive_container_mode', 'container' );
$theme_archive_style = get_theme_mod( 'theme_archive_style', 'archive_1' );
$display_archive_desc = get_theme_mod( 'display_archive_desc', 'display_block' );
$theme_archive_sidebar = get_theme_mod( 'theme_archive_sidebar', '1' );
$theme_blog_main_breadcrumbs = get_theme_mod( 'theme_blog_main_breadcrumbs', 'no');
$display_blog_title = get_theme_mod( 'display_blog_title', 'no');
$theme_blog_main_breadcrumbs_shortcode = get_theme_mod( 'theme_blog_main_breadcrumbs_shortcode', 'no');

get_header();
?>

<div id="primary" class="site-content <?php echo esc_attr($archive_container_mode); ?> mt-5">
	<main id="primary" class="site-main row">

        <?php if( get_theme_mod( 'theme_blog_main_breadcrumbs' ) == 'yes') { ?>

            <div class="overflow-hidden">

                <div class="col-sm-12 mb-3 border-bottom pb-2">

                    <?php echo do_shortcode("$theme_blog_main_breadcrumbs_shortcode"); ?>

                </div>

            </div>

        <?php } // end if ?>

        <?php if( get_theme_mod( 'display_blog_title' ) == 'yes') { ?>

            <div class="overflow-hidden">

                <div class="page_title mb-5">

                    <h1><?php esc_html_e('Blog', 'z-platform'); ?></h1>

                </div>

            </div>

        <?php } // end if ?>


        <div class="<?php if( get_theme_mod( 'theme_archive_sidebar', '1' ) == '1') { ?>col-md-9<?php } // end if ?> <?php if( get_theme_mod( 'theme_archive_sidebar' ) == '0') { ?>col-12<?php } // end if ?>">

            <?php get_template_part( "/template-parts/archive/$theme_archive_style", get_post_type('') ); ?>

		    <?php z_platform_pagination(); ?>

        </div>

        <?php if( get_theme_mod( 'theme_archive_sidebar', '1' ) == '1') { ?>

            <?php get_sidebar(); ?>

        <?php } // end if ?>

	</main><!-- #main -->

</div>

<?php
get_footer();