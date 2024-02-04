<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
    $get_addresses = apply_filters(
        'woocommerce_my_account_get_addresses',
        array(
            'billing'  => __( 'Billing address', 'z-platform' ),
            'shipping' => __( 'Shipping address', 'z-platform' ),
        ),
        $customer_id
    );
} else {
    $get_addresses = apply_filters(
        'woocommerce_my_account_get_addresses',
        array(
            'billing' => __( 'Billing address', 'z-platform' ),
        ),
        $customer_id
    );
}

$oldcol = 1;
$col    = 1;
?>

    <p>
        <?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'z-platform' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </p>
<div class="col-12 col-md-8 float-start w-100">
    <?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
        <div class="u-columns woocommerce-Addresses col2-set addresses">
    <?php endif; ?>

    <?php foreach ( $get_addresses as $name => $address_title ) : ?>
        <?php
        $address = wc_get_account_formatted_address( $name );
        $col     = $col * -1;
        $oldcol  = $oldcol * -1;
        ?>

        <div class="col-<?php echo $col < 0 ? 12 : 12; ?> col-md-<?php echo $oldcol < 0 ? 6 : 6; ?> woocommerce-Address float-start">
            <header class="woocommerce-Address-title title">
                <h3><?php echo esc_html( $address_title ); ?></h3>
                <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit"><?php echo $address ? esc_html__( 'Edit', 'z-platform' ) : esc_html__( 'Add', 'z-platform' ); ?></a>
            </header>
            <address>
                <?php
                echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'z-platform' );
                ?>
            </address>
        </div>

    <?php endforeach; ?>

    <?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
        </div>
    </div>
    <?php
    endif;