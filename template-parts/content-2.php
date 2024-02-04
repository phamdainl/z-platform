<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Z_Platform
 */

$theme_excerpt = get_theme_mod('theme_archive_excerpt', '25');

?>

<div class="col-12 mb-5 pb-5 article article_style1 d-flex justify-content-center">
    <div class="article_style d-flex align-items-center row bg-white">

    	<div class="col-12 col-lg-5 float-start px-0">

			<?php if (has_post_thumbnail( $post->ID ) ): ?>
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'z_platform_thumbnail_blog' ); ?>

            <a class="blog_image_url" href="<?php esc_url(the_permalink()); ?>"><img alt="<?php the_title();?>" width="540" height="303" src="<?php echo esc_url($image[0]); ?>"></a>

			<?php endif; ?>

    	</div>

    	<div class="col-12 col-lg-7 float-start p-3">

        	<div class="post_blog_style_1_info w-100 overflow-hidden">

        		<div class="post_blog_style_1_meta w-100">

                    <?php if( get_theme_mod( 'post_blog_style_1_meta', 'yes' ) == 'yes') { ?>
                        <div class="row clearfix">
                            <div class="col-12 post_meta_style">
                                <?php $date_format = get_option('date_format'); echo get_the_date( $date_format ); ?> <span>/</span> <?php comments_number( __('No Comments', 'z-platform'), __('Comments (1)', 'z-platform'), __('% Comments', 'z-platform') ); ?>
                            </div>
                        </div>
                    <?php } // end if ?>

                    <div class="post_blog_style_1_info w-100">
                        <?php if( get_theme_mod( 'post_blog_style_1_title', 'yes' ) == 'yes') { ?>
                            <div class="post_blog_style_1_title w-100">
                                <a href="<?php esc_url(the_permalink()); ?>"><h3><?php the_title(); ?></h3></a>
                            </div>
                        <?php } // end if ?>

                        <?php if( get_theme_mod( 'post_blog_style_1_content', 'yes' ) == 'yes') { ?>
                            <div class="post_blog_style_1_content w-100">
                                <p><?php echo esc_html(wp_trim_words( get_the_excerpt(), $theme_excerpt, '...' )); ?></p>
                            </div>
                        <?php } // end if ?>

                    </div>

        		</div>

        	    <div class="w-100 float-start">

        		  <a class="article_read_more_button" href="<?php esc_url(the_permalink());?>"><?php esc_html_e( 'Read More', 'z-platform' ); ?></a>

        	    </div>

            </div>

    	</div>

    </div>
</div>