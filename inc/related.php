<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Z_Platform
 */

$display_single_related_posts = get_theme_mod('display_single_related_posts_number');

get_header();
?>

<h2 class="single_h2"> <span><?php esc_html_e( 'Related Posts', 'z-platform' ); ?></span> </h2>
<div class="row">
    <?php

    	$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => $display_single_related_posts, 'post__not_in' => array($post->ID),'orderby'=> 'rand', 'order' => 'ASC' ) );
    	if( $related ) foreach( $related as $post  ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
    	setup_postdata($post); 

    	get_template_part('/template-parts/content-related');

    } wp_reset_postdata(); // phpcs:ignore PSR2.Files.ClosingTag.NotAllowed ?>
</div>