<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Z_Platform
 */

$theme_excerpt = get_theme_mod('theme_archive_excerpt', '25');
$display_single_blog_columns = get_theme_mod('display_single_blog_columns', '6');

?>

<div class="col-sm-<?php echo esc_attr($display_single_blog_columns); ?> mb-5 article">
    <div class="article_style bg-white">        
	
		<?php if (has_post_thumbnail( $post->ID ) ): ?>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'z_platform_thumbnail_blog' ); ?>
            
            <a class="blog_image_url" href="<?php esc_url(the_permalink()); ?>"><img alt="<?php the_title();?>" width="540" height="303" src="<?php echo esc_url($image[0]); ?>"></a>

		<?php endif; ?>

        <div class="w-100 p-4 w-100 float-start">

            <?php if( get_theme_mod( 'post_blog_style_1_meta', 'yes'  ) == 'yes') { ?>
                <div class="col-sm-12 post_meta_style">
                    <?php $date_format = get_option('date_format'); echo get_the_date( $date_format ); ?> <span>/</span> <?php comments_number( __('No Comments', 'z-platform'), __('Comments (1)', 'z-platform'), __('% Comments', 'z-platform') ); ?>
                </div>
            <?php } // end if ?>

            <div class="article_style_info">                

                <div class="post_blog_style_1_info w-100 overflow-hidden">

                    <?php if( get_theme_mod( 'post_blog_style_1_title', 'yes' ) == 'yes') { ?>
                        <div class="post_blog_style_1_title w-100">
                            <a href="<?php the_permalink(); ?>">
                                <h3><?php the_title(); ?></h3>
                            </a>
                        </div>
                    <?php } // end if ?>

                    <?php if( get_theme_mod( 'post_blog_style_1_content', 'yes' ) == 'yes') { ?>
                        <div class="post_blog_style_1_content w-100">
                            <p><?php echo esc_html(wp_trim_words( get_the_excerpt(), $theme_excerpt, '...' )); ?>
                                <span class="ms-2 screen-reader-text" ><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html_e( 'Read More', 'z-platform' ); ?></a></span>
                            </p>
                        </div>
                    <?php } // end if ?>

                </div>                
            </div>
        </div>
    </div>
</div>