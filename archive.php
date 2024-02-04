<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Z_Platform
 */

$archive_container_mode                = get_theme_mod( 'archive_container_mode', 'container' );
$theme_archive_style                   = get_theme_mod( 'theme_archive_style', 'archive_1' );
$theme_blog_main_breadcrumbs_shortcode = get_theme_mod( 'theme_blog_main_breadcrumbs_shortcode', 'no' );

get_header();
?>

<div id="primary" class="site-content <?php echo esc_attr( $archive_container_mode ); ?> mt-5">
    <main id="primary" class="site-main row">
        <div class="overflow-hidden">
            <?php if( get_theme_mod( 'theme_blog_main_breadcrumbs', 'no' ) == 'yes' ) { ?>
                <div class="col-sm-12 mb-3 border-bottom pb-2">
                    <?php echo do_shortcode( "$theme_blog_main_breadcrumbs_shortcode" ); ?>
                </div>
            <?php } // end if ?>
            <div class="page_title mb-5">
                <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
                <?php if( get_theme_mod( 'display_archive_desc', 'yes') == 'yes' ) { ?>
                    <?php echo category_description(); ?>
                <?php } // end if ?>
            </div>
        </div>
        <div class="<?php if( get_theme_mod( 'theme_archive_sidebar', '1' ) == '1' ) { ?>col-12 col-md-9<?php } else { ?>col-12<?php } ?>">
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