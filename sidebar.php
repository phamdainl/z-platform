<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Z_Platform
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<div class="col-12 col-md-3 sidebar archive-sidebar">
    <?php dynamic_sidebar( 'sidebar-1', 'z-platform' ); ?>
</div>