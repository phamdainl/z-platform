<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<div class="col-12 col-md-3 float-start mb-5 mb-md-0">
    <nav class="z-woo-account-nav">
        <ul class="list-group">
            <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                <li class="bb-0 list-group-item list-group-item-action p-0 <?php echo esc_html(wc_get_account_menu_item_classes( $endpoint ) ); ?>">
                    <a class="p-2 w-100 float-start" href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</div>
<?php do_action( 'woocommerce_after_account_navigation' ); ?>