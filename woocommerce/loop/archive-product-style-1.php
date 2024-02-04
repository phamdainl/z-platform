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
    <li <?php wc_product_class( 'list-unstyled mb-4 col col-12'.$grid_set, $product ); ?>>
    <div class="card z-card h-100 <?php echo esc_attr($card_shadow ), ' ', esc_attr($rounded_setting ), ' ', esc_attr($border_line ), ' ', esc_attr($card_text_alignment ); ?> overflow-hidden">
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action( 'woocommerce_before_shop_loop_item' );

        /**
         * Hook: woocommerce_before_shop_loop_item_title.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );

        /**
         * Hook: woocommerce_shop_loop_item_title.
         *
         * @hooked woocommerce_template_loop_product_title - 10
         */
        do_action( 'woocommerce_shop_loop_item_title' );

        /**
         * Hook: woocommerce_after_shop_loop_item_title.
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action( 'woocommerce_after_shop_loop_item_title' );

        /**
         * Hook: woocommerce_after_shop_loop_item.
         *
         * @hooked woocommerce_template_loop_product_link_close - 5
         * @hooked woocommerce_template_loop_add_to_cart - 10
         */
        do_action( 'woocommerce_after_shop_loop_item' );
        ?>
    </div>
</li>

<?php if($woocommerce_loop['loop'] % $columns_set === 0) {  echo '</li><li class="row">';} ?>