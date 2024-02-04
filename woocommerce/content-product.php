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

$card_style = get_theme_mod( 'z_woo_cat_show_style', 'style_1' );

?>

<?php

if ( $card_style == 'style_1' ) {
    return get_template_part('/woocommerce/loop/archive-product-style', '1');
} elseif ( $card_style == 'style_2' ) {
    return get_template_part('/woocommerce/loop/archive-product-style', '2');
}