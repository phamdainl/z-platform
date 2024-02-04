<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Z_Platform
 */

get_header();
?>

<div class="row" data-masonry='{"percentPosition": true }'>

    <?php if (have_posts()) { ?>

    	<?php } ?>

    <?php while (have_posts()) : the_post(); ?>

        <?php get_template_part( '/template-parts/content-3', get_post_type('') ); ?>

    <?php endwhile; ?>

</div>