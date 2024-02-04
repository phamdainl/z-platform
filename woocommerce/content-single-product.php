<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

$card_style = get_theme_mod( 'z_woo_single_style', 'style_1' );

?>

<?php if ( get_theme_mod('z_woo_single_style', 'style_1') === 'style_1' ) { ?>
    <div class="col-12 row position-relative m-0 product type-product post-326 status-publish first instock product_cat-bracelets has-post-thumbnail sale shipping-taxable purchasable product-type-simple">
        <?php
        do_action( 'woocommerce_before_single_product' );
        do_action( 'woocommerce_before_single_product_summary' );
        ?>
        <div class="summary entry-summary col col-lg-6 p-0 ps-lg-5">
            <?php do_action( 'woocommerce_single_product_summary' ); ?>
        </div>
        <div class="p-0 mt-5 z-woo-tabs">
            <?php
            do_action( 'woocommerce_after_single_product_summary' );
            do_action( 'woocommerce_after_single_product' );
            ?>
        </div>
    </div>
<?php } else { ?>
    style 2
<?php } ?>
