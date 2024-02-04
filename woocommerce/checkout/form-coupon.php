<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="woocommerce-form-coupon-toggle z-woo-coupon-toggle p-3 mb-3 position-relative">
    <?php wc_print_notice(apply_filters('woocommerce_checkout_coupon_message', esc_html__('Have a coupon?', 'z-platform') . ' <a href="#" class="showcoupon">' . esc_html__('Click here to enter your code', 'z-platform') . '</a>'), 'notice'); ?>
</div>

<form class="checkout_coupon woocommerce-form-coupon mb-3" method="post" style="display:none">

    <div class="card">

        <div class="card-body">

            <p><?php esc_html_e('If you have a coupon code, please apply it below.', 'z-platform'); ?></p>

            <div class="input-group">
                <input type="text" name="coupon_code" class="form-control" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'z-platform'); ?>" />
                <button type="submit" class="input-group-text btn z-product-atc-btn<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'z-platform' ); ?>"><?php esc_html_e( 'Apply coupon', 'z-platform' ); ?></button>
                <?php do_action('woocommerce_cart_coupon'); ?>
            </div>

            <div class="clear"></div>

        </div><!-- card-body -->

    </div><!-- card -->

</form>