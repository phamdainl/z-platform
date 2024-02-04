<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Z_Platform
 */

$theme_page_sidebar = get_theme_mod( 'theme_page_sidebar', '1' );

get_header();
?>

	<main id="primary" class="site-main">

		<div class="container mt-0 mt-md-5">

            <div class="row">

                <?php if (!is_page('cart') && !is_page('checkout')) { ?>

                    <div class="col-12 col-md-8">
                        <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/content', 'page' );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>
                    </div>

                    <div class="col-12 col-md-3 offset-0 offset-md-1 sidebar page-sidebar">
                        <div class="padding-sidebar">
                            <?php dynamic_sidebar( 'sidebar-page', 'z-platform' ); ?>
                        </div>
                    </div>

                <?php } else { ?>

                    <div class="col-12 col-md-8">
                        <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/content', 'page' );

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>
                    </div>                    

                <?php } ?>

            </div>

		</div>

	</main><!-- #main -->

<?php
get_footer();