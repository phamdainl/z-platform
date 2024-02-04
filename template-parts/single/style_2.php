<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Z_Platform
 */

$display_single_author = get_theme_mod('display_single_author', 'display_block');
$display_single_related = get_theme_mod('display_single_related', 'display_block');
$display_single_comments = get_theme_mod('display_single_comments', 'display_block');
$display_single_img = get_theme_mod('display_single_img', 'display_block');
$theme_single_post_sidebar = get_theme_mod( 'theme_single_post_sidebar', '1');
$theme_blog_main_breadcrumbs_shortcode = get_theme_mod( 'theme_blog_main_breadcrumbs_shortcode', 'no');
?>

	<div class="col-sm-12 container mt-5">

		<?php if( get_theme_mod( 'theme_blog_main_breadcrumbs' ) == 'yes') { ?>

            <div class="col-sm-12 mb-3 border-bottom pb-3">

                <?php echo do_shortcode("$theme_blog_main_breadcrumbs_shortcode"); ?>

            </div>

        <?php } // end if ?>

        <div class="page_title mb-5">

            <h1 class="single_post_title"> <?php the_title(); ?></h1>

        </div>
		
	</div>


	<main id="primary" class="site-main container single_post">

		<div class="row">

            <div class="<?php if( get_theme_mod( 'theme_single_post_sidebar', '1' ) == '1') { ?>col-12 col-md-8<?php } else { ?>col-12<?php } ?>">
                <?php if( get_theme_mod( 'display_single_img', 'yes' ) == 'yes') { ?>
                    <div class="w-100 overflow-hidden">
                        <?php if (has_post_thumbnail( $post->ID ) ): ?>
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                            <img class="single_img" alt="<?php the_title();?>" src="<?php echo esc_url($image[0]); ?>">
                        <?php endif; ?>
                    </div>
                <?php } // end if ?>

				<div class="col-12 mt-3 float-start zplatform-single-content">

					<?php the_content();?>

					<div class="col-12 single_cat">
						<?php if( get_theme_mod( 'display_single_category', 'yes' ) == 'yes') { ?><?php the_category(' '); ?><?php } // end if ?>
						<?php if( get_theme_mod( 'display_single_tag', 'yes' ) == 'yes') { ?><?php the_tags(' ', ' '); ?><?php } // end if ?>
					</div>

				</div>

                <?php if( get_theme_mod( 'display_single_author', 'yes' ) == 'yes') { ?>
                    <div class="col-12 mt-6 float-start w-100">
                        <?php get_template_part('inc/author'); ?>
                    </div>
                <?php } // end if ?>

                <?php if( get_theme_mod( 'display_single_comments', 'no' ) == 'yes') { ?>
                    <div class="col-sm-12 mt-6 float-start w-100">
                        <?php get_template_part('inc/comments'); ?>
                    </div>
                <?php } // end if ?>

                <?php if( get_theme_mod( 'display_single_related', 'yes') == 'yes') { ?>
                    <div class="col-12 mt-6 float-start w-100">
                        <?php get_template_part('inc/related'); ?>
                    </div>
                <?php } // end if ?>

			</div>

			<?php if( get_theme_mod( 'theme_single_post_sidebar', '1' ) == '1') { ?>

                <div class="col-12 col-md-3 offset-0 offset-md-1 sidebar single-sidebar">
                    <div class="ps-0 ps-md-5">
                        <?php dynamic_sidebar( 'zplatform_sidebar', 'z-platform' ); ?>
                    </div>
                </div>

			<?php } // end if ?>

		</div>

	</main><!-- #main -->