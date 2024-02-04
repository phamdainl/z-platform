<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Z_Platform
 */
$display_single_related_columns = get_theme_mod('display_single_related_columns', '6');

?>
<div class="col-sm-<?php echo esc_attr($display_single_related_columns); ?> mb-5 article">
    <div class="col-padding article_style_related overflow-hidden">
        <?php if (has_post_thumbnail( $post->ID ) ): ?>
            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'z_platform_thumbnail_blog' ); ?>
                <a class="blog_image_url" href="<?php the_permalink(); ?>"><img alt="<?php the_title();?>" src="<?php echo esc_url($image[0]); ?>"></a>
        <?php endif; ?>
        <?php if( get_theme_mod( 'post_blog_style_1_title', 'yes' ) == 'yes') { ?>
            <div class="post_blog_style_1_meta w-100">
                <div class="post_blog_style_1_info w-100">
                    <div class="post_blog_style_1_title w-100">
                        <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                    </div>
                </div>
            </div>
        <?php } // end if ?>
    </div>
</div>