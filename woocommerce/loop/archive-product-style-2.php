<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $woocommerce_loop;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

if ( get_theme_mod( 'z_woo_cat_rounded_card', 'no' ) == 'no' ) {
    $rounded_setting = 'rounded-0';
} else {
    $rounded_setting = 'rounded-3';
}

$card_shadow = get_theme_mod( 'z_woo_cat_card_shadow', 'shadow-none' );
$card_style = get_theme_mod( 'z_woo_cat_show_style', 'style_1' );
$border_line = get_theme_mod( 'z_woo_cat_add_border', 'border' );
$card_text_alignment = get_theme_mod( 'z_woo_cat_text_alignment', 'text-center' );
$columns_set = esc_attr( wc_get_loop_prop( 'columns' ));
$columns_set_clearfix = $columns_set + 1;
if ( $columns_set == '0' || $columns_set == '1' ) {
    $grid_set = '';
} elseif ( $columns_set == '2' ) {
    $grid_set = ' col-sm-6';
} elseif ( $columns_set == '3' ) {
    $grid_set = ' col-sm-4';
} elseif ( $columns_set == '4' ) {
    $grid_set = ' col-sm-3';
}

?>